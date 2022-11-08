<?php 
    namespace Tjall\App\Controllers;

    class Storage {
        public static function storeJSON(string $filename, $key, $data) {           
            $contents = self::loadJSON($filename) ?? [];
            $contents[$key] = $data;

            file_put_contents(self::getFilepath($filename), json_encode($contents));
           
            return __CLASS__;
        }

        public static function loadJSON(string $filename, $key = null) {
            $filepath = self::getFilepath($filename);
            
            $contents = [];
            if(is_file($filepath))
                $contents = json_decode(file_get_contents($filepath), true);
           
            return (isset($key) ? @$contents[$key] : $contents);
        }

        protected static function getFilepath(string $filename): string {
            return join_paths(root_dir(), 'storage', $filename . '.json');
        }
    }
?>