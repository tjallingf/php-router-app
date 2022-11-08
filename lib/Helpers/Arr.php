<?php
    namespace Tjall\App\Helpers;

    class Arr {
        public static function getPath(array $arr, string $path) {
            $path_exploded = explode('.', $path);

            $value = $arr;

            foreach ($path_exploded as $path_item) {
                $value = @$value[$path_item];
            }

            return $value;
        }
    }
?>