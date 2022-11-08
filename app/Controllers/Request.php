<?php 
    namespace Tjall\App\Controllers;

    use Tjall\App\Models\User;

    class Request {
        public static string $url;
        public static string $method;
        public static array $params;
        public static array $query;
        public static $user;
        public static $body;

        public static function init(string $url, array $listener, array $params) {
            self::$url = $url;
            self::$method = $listener['method'];
            self::$params = $params;
            self::$query = $_GET;
            self::$body = $_POST;
            
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