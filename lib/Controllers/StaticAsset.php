<?php
    namespace Tjall\Lib\Controllers;

    use Exception;
    use Tjall\Lib\Exceptions\DisabledControllerException;
    use Tjall\Lib\Controllers\Config;
    use Tjall\Lib\Helpers\Url;

    // Load list of mime types
    require(join_paths(root_dir(), '/storage/app/mime_types.php'));

    class StaticAsset {
        protected static $absolute_directory;
        protected static $relative_directory;

        public static function init(string $relative_directory) {
            $absolute_directory = join_paths(root_dir(), 'public', $relative_directory);
            if(!is_dir($absolute_directory))
                throw new Exception("Directory for static assets ($absolute_directory) does not exist.");

            self::$relative_directory = $relative_directory;
            self::$absolute_directory = $absolute_directory;
        }
        
        public static function getFilename(string $url) {
            if(!Config::get('controllers.staticasset.enabled'))
                throw new DisabledControllerException(__CLASS__);

            $url = ltrim($url, '/\\');

            // Check if the requested file is in the
            // directory used for static assets
            if(str_starts_with($url, self::$relative_directory)) {
                $relative_url = Url::makeRelative($url, self::$relative_directory);
                $filename = join_paths(self::$absolute_directory, $relative_url);
                return $filename;
            }

            return null;
        }

        public static function getContentType(string $filename) {
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            
            if(isset(APP_MIME_TYPES[$extension]))
                return APP_MIME_TYPES[$extension];

            $content_type = 'application/octet-stream';
            foreach (APP_MIME_TYPES as $extensions => $type) {
                if(strpos($extensions, $extension.',') !== false || strpos($extensions, ','.$extension) !== false) {
                    $content_type = $type;
                    break;
                }
            }

            return $content_type;
        }
    }