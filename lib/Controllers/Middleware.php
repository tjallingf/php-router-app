<?php 
    namespace Tjall\Lib\Controllers;

    class Middleware {
        protected static $middlewares = [
            'Locale' => 'Tjall\Lib\Controllers\Locale',
            'Request'     => 'Tjall\Lib\Controllers\Request',
            'Response'    => 'Tjall\Lib\Controllers\Response',
            'Route'       => 'Tjall\Lib\Controllers\Route',
            'StaticAsset' => 'Tjall\Lib\Controllers\StaticAsset'
        ];

        public static function use(string $middleware_id, string $use_class) {
            if(!isset(self::$middlewares[$middleware_id]))
                throw new \Exception("Invalid middleware id: '{$middleware_id}'. Use Tjall\Lib\Controllers\Middleware\list() to get a list of possible middleware ids.");

            self::$middlewares[$middleware_id] = $use_class;
        }

        public static function get(string $middleware_id) {
            if(!isset(self::$middlewares[$middleware_id]))
                throw new \Exception("Invalid middleware id: '{$middleware_id}'. Use Tjall\Lib\Controllers\Middleware\list() to get a list of possible middleware ids.");
        
            return self::$middlewares[$middleware_id];
        }

        public static function list() {
            return self::$middlewares;
        }
    }
?>