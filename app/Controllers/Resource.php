<?php 
    namespace Tjall\App\Controllers;

    class Resource {
        public static function include(string $path, bool $is_critical = false) {
            $ext = pathinfo($path, PATHINFO_EXTENSION);

            echo(self::getNode($path, $ext, $is_critical));

            return __CLASS__;
        }

        protected static function getNode(string $path, string $ext, bool $is_critical) {
            $public_path = self::getPublicPath($path, $ext);

            switch ($ext) {
                case 'css':
                    return "<link rel=\"stylesheet\" href=\"{$public_path}\" />";
                case 'js':
                    return "<script src=\"{$public_path}\"".($is_critical ? '' : ' defer')."></script>";
            }
        }

        protected static function getPublicPath($path, $ext) {
            if(str_starts_with($path, 'https://') || str_starts_with($path, 'http://') || str_starts_with($path, '//'))
                return $path;

            switch($ext) {
                case 'js': return '/static/js/' . $path;
                case 'css': return '/static/css/' . $path;
            }
        }
    }
?>