<?php 
    namespace Tjall\Lib\Controllers;

    class Middleware {
        protected static $middlewares = [];
        
        public static function update(string $id, string $class) {
            self::$middlewares[$id] = $class;
        }

        public static function find(string $id) {
            if(!isset(self::$middlewares[$id]))
                throw new \Exception("No midlleware was set for '{$id}'.");

            return self::$middlewares[$id];
        }
    }
?>