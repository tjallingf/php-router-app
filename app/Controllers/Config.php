<?php 
    namespace Tjall\App\Controllers;

    use Tjall\App\Helpers\Arr;
    use Tjall\App\Controllers\Storage;

    class Config {
        public static array $data = [];

        public static function init() {
            self::$data = Storage::loadJSON('app/config');
        }

        public static function get(string $path) {
            return Arr::getPath(self::$data, $path);
        }
    }
?>