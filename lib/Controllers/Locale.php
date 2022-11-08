<?php 
    namespace Tjall\App\Controllers;

    use Tjall\App\Controllers\Config;
    use Tjall\App\Exceptions\DisabledControllerException;

    class Locale {
        public static string $locale;
        public static array $translations = [];

        public static function init($locale) {
            self::$locale = $locale;
            self::$translations = self::getTranslations();
        }

        public static function translate($key, $replacements = []) {
            if(!Config::get('controllers.locale.enabled'))
                throw new DisabledControllerException(__CLASS__);

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

        protected static function getTranslations() {
            $pattern = join_paths(root_dir(), 'storage/app/locale/*.json');
            $files = glob($pattern);

            $translations = [];

            foreach ($files as $file) {
                $locale = pathinfo($file, PATHINFO_FILENAME);

                $translations[$locale] = json_decode(file_get_contents($file), true);
            }
            
            return $translations;
        }
    }