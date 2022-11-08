<?php 
    namespace Tjall\Router\Controllers;

    use Tjall\Router\Controllers\Response;
    use Tjall\Router\Controllers\Request;
    use Tjall\Router\Helpers\Url;
    use Tjall\Router\Helpers\Error;

    class Route {
        private static $listeners = [];

        public static function listen(string $method, string $url, callable $callback, array $options = []) {
            $url = Url::strip($url, false);
            $method = strtolower($method);
            $parts = Url::getParts($url);

            $listener = [
                'method' => $method,
                'url' => $url,
                'parts' => $parts,
                'callback' => $callback,
                'options' => $options
            ];

            array_push(self::$listeners, $listener);

            return $listener;
        }

        public static function answer(string $method, string $url, array $options = []) {
            $listener = self::findListener($method, $url);
            
            if(!isset($listener)) {
                $res = Response::class;
                $res::init(['json' => true]);
                return $res::throw(404, 'quizlet')::end();
            }

            $merged_options = array_merge($options, $listener['options']);
            
            $res = Response::class;
            $res::init($merged_options);

            $req = Request::class;
            $params = Url::getParams($url, $listener['parts']);
            $req::init($url, $listener, $params);

            // Throw a 403 (Forbidden) error if the user doesn't 
            // have the required permission level
            if(isset($merged_options['permission_level']) && !(@$req::getUser()['permission_level'] >= $merged_options['permission_level']))
                return $res::throw(403);

            if($merged_options['json']) {
                set_error_handler(function ($errno, $errstr, $errfile, $errline) use($res) {
                    if (!(error_reporting() & $errno)) return;

                    return $res::throw(Error::asArray($errno, $errstr, $errfile, $errline));
                });
            }
            
            call_user_func($listener['callback'], $req, $res);

            if($merged_options['json']) {
                restore_error_handler();
            }

            $res::end();
        }
   
        public static function findListener(string $method, string $request_url) {
            $request_url = Url::strip($request_url, false);
            $found_listener = null;

            foreach(self::$listeners as $listener) {
                if($listener['method'] != 'any' && $listener['method'] != $method)
                    continue;

                if(!str_contains($listener['url'], '/:')) {
                    if($listener['url'] == $request_url) {
                        $found_listener = $listener;
                        break;
                    }

                    continue;
                }

                if(Url::getParams($request_url, $listener['parts']) === false)
                    continue;
                    
                $found_listener = $listener;
                break;
            };

            return $found_listener;
        }
        
        public static function get(string $url, callable $callback, array $options = []) {
            return self::listen('get', $url, $callback, $options);
        }

        public static function post(string $url, callable $callback, array $options = []) {
            return self::listen('post', $url, $callback, $options);
        }

        public static function delete(string $url, callable $callback, array $options = []) {
            return self::listen('delete', $url, $callback, $options);
        }

        public static function patch(string $url, callable $callback, array $options = []) {
            return self::listen('patch', $url, $callback, $options);
        }

        public static function put(string $url, callable $callback, array $options = []) {
            return self::listen('put', $url, $callback, $options);
        }

        public static function any(string $url, callable $callback, array $options = []) {
            return self::listen('any', $url, $callback, $options);
        }
    }