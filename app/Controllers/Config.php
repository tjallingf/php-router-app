<?php 
    namespace Tjall\Router\Controllers;

    use Tjall\Router\Helpers\Arr;

    class Config {
        public static array $data = [];

        public static function init() {
            self::$data = json_decode(file_get_contents(root_dir() . '/storage/config.json'), true) ?? [];
        }

        public static function get(string $path) {
            return Arr::getPath(self::$data, $path);
        }
    }
?>