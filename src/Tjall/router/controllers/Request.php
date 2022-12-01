<?php
    namespace Tjall\Router\Controllers;

    use Tjall\Router\Models\UrlModel;
    use Tjall\Lib\Controllers\Middleware;
    use Tjall\Lib\Controllers\Locale;
    use Tjall\Lib\Controllers\Config;

    class Request {
        const BODY_SEPERATOR = "\r\n";

        protected static array $listener;
        protected static UrlModel $url;
        public static array $body = [];
        public static array $params = [];
        public static string $method;
        public static array $user;

        public static function init(array $listener, UrlModel $url, string $method) {
            self::$listener = $listener;
            self::$url = $url;

            self::$body = $_POST ?? self::parseBody(file_get_contents('php://input'));
            self::$params = self::$url->parseParameters(self::$listener['template']);
            self::$method = $method;

            if(Config::find('controllers.user.enabled'))
                self::$user = @Middleware::find('User')::find($_SESSION['user_username'] ?? '') 
                    ?? @Middleware::find('User')::find('__GUEST__') 
                    ?? [];

            if(Config::find('controllers.locale.enabled'))
                Locale::select(@self::$user['settings']['locale'] ?? '');

            return __CLASS__;
        }

        public static function getParams() {
            return self::$params;
        }

        public static function getParam(string $name) {
            return @self::getParams()[$name];
        }

        public function getMethod() {
            return self::$method;
        }

        public static function getBody() {
            return self::$body;
        }

        public static function getUser() {
            return self::$user;
        }

        protected static function parseBody(string $body): array {
            // Return empty array if the body is empty
            if(empty($body)) return [];

            // Try to use json_decode()
            $data = @json_decode($body, true);
            if($data) return $data;
            
            // Try to use parse_str()
            @parse_str($body, $data);
            if($data) return $data;

            return [];
        }
    }