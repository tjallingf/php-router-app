<?php 
    namespace Tjall\Router\Controllers;

    class Locale {
        public static string $locale = '';
        public static array $translations = [];

        public static function init($locale) {
            self::$locale = $locale;
            self::$translations = self::getTranslations();
        }

        public static function translate($key, $replacements = []) {
            $translation = @self::$translations[self::$locale][$key];

            if(!$translation)
                return $key;

            if(count($replacements)) {
                for ($i=count($replacements); $i >= 0; $i--) { 
                    $translation = str_replace("%$i", $replacements[$i], $translation);
                }
            }

            return $translation;
        }

        public static function getTranslations() {
            $pattern = root_dir() . "/storage/locale/*.json";
            $files = glob($pattern);

            $translations = [];

            foreach ($files as $file) {
                $locale = pathinfo($file, PATHINFO_FILENAME);

                $translations[$locale] = json_decode(file_get_contents($file), true);
            }
            
            return $translations;
        }
    }