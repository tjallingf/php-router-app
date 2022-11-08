<?php 
    namespace Tjall\Lib\Controllers;

    use Tjall\Lib\Helpers\Arr;
    use Tjall\Lib\Controllers\Storage;

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