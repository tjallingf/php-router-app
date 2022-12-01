<?php
    namespace Tjall\Router\Controllers;

    use Tjall\Lib\Controllers\Middleware;
    use Tjall\Router\Models\UrlModel;
    use Tjall\Router\Models\UrlTemplateModel;

    class Route {
        protected static $listeners = [];

        public static function listen(string $method, string $url_template, callable $callback) {
            $method = trim(strtolower($method));

            array_push(self::$listeners, [
                'method' => $method,
                'template' => new UrlTemplateModel($url_template),
                'callback' => $callback
            ]);
        }
        
        protected static function answerListener(array $listener, UrlModel $url, string $method) {
            $res = Middleware::find('Response');
            $res::init($listener, $url);

            $req = Middleware::find('Request');
            $req::init($listener, $url, $method);

            $next = function (...$args) use ($res) { 
                return $res->sendError(...$args); 
            };

            // Call the listener callback
            call_user_func(
                $listener['callback'], 
                $req, $res, $next
            );

            return $res::end();
        }

        public static function handleRequest(string $method, string $path) {
            $method = trim(strtolower($method));
            $url = new UrlModel($path);

            // Find listener
            $selected_listener = self::findListener($method, $url);
            
            // Throw 404 error if no listener was found
            if(!$selected_listener)
                throw new \Exception('404 page not found oops');

            return self::answerListener($selected_listener, $url, $method);
        }

        protected function findListener(string $method, UrlModel $url) {
            $selected_listener = false;

            foreach (self::$listeners as $listener) {
                if($listener['method'] != $method && $listener['method'] != 'all')
                    continue;
                
                if(!$url->matchesTemplate($listener['template']))
                    continue;

                $selected_listener = $listener;
                break;
            }

            return $selected_listener;
        }

        /* Aliases for self::listen() */
        public static function all(string $path, callable $callback) {
            return self::listen('all', $path, $callback);
        }
        
        public static function delete(string $path, callable $callback) {
            return self::listen('delete', $path, $callback);
        }

        public static function get(string $path, callable $callback) {
            return self::listen('get', $path, $callback);
        }

        public static function options(string $path, callable $callback) {
            return self::listen('options', $path, $callback);
        }

        public static function patch(string $path, callable $callback) {
            return self::listen('patch', $path, $callback);
        }

        public static function post(string $path, callable $callback) {
            return self::listen('post', $path, $callback);
        }

        public static function put(string $path, callable $callback) {
            return self::listen('put', $path, $callback);
        }

        public static function update(string $path, callable $callback) {
            return self::listen('update', $path, $callback);
        }
    }