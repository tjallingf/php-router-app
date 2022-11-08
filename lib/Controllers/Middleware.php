<?php 
    namespace Tjall\App\Controllers;

    class Middleware {
        protected static $middlewares = [
            'Response' => 'Tjall\App\Controllers\Response',
            'Request'  => 'Tjall\App\Controllers\Request'
        ];

        public static function use(string $middleware_id, string $use_class) {
            if(!isset(self::$middlewares[$middleware_id]))
                throw new \Exception("Invalid middleware id: '{$middleware_id}'. Use Tjall\App\Controllers\Middleware\list() to get a list of possible middleware ids.");

            self::$middlewares[$middleware_id] = $use_class;
        }

        public static function get(string $middleware_id) {
            if(!isset(self::$middlewares[$middleware_id]))
                throw new \Exception("Invalid middleware id: '{$middleware_id}'. Use Tjall\App\Controllers\Middleware\list() to get a list of possible middleware ids.");
        
            return self::$middlewares[$middleware_id];
        }

        public static function list() {
            return self::$middlewares;
        }
    }
?>