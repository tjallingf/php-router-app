<?php 
    namespace Tjall\Lib\Controllers;

    use Tjall\Lib\Models\User;

    class Request {
        protected static string $url;
        protected static string $method;
        protected static array $params;
        protected static array $query;
        protected static $user;
        protected static $body;

        public static function init(string $url, array $listener, array $params) {
            self::$url = $url;
            self::$method = $listener['method'];
            self::$params = $params;
            self::$query = $_GET;
            self::$body = $_POST;
            
            if(Config::get('controllers.user.enabled'))
                self::$user = @User::find($_SESSION['user_username'] ?? 'default') ?? @User::find('default');
        
            return __CLASS__;
        }

        public static function getParam($id) {
            return @self::$params[$id];
        }
        
        public static function getQuery($id) {
            return @self::$query[$id];
        }
        
        public static function getBody() {
            return self::$body;
        }

        public static function getUser() {
            return self::$user;
        }
    }