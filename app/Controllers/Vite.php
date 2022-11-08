<?php 
    namespace Tjall\App\Controllers;

    use Tjall\App\Controllers\Config;

    class Vite {
        protected static bool $injected = false;

        public static function script(string $filepath) {
            // The port at which Vite runs
            $port = Config::get('vite.server.port');

            if(@Config::get('development') === true) {
                self::safeInject();
                $src = "http://localhost:{$port}/{$filepath}";
                return "<script src=\"{$src}\" type=\"module\" defer></script>";
            } else {
                $src = self::getPublicLocation($filepath);
                return "<script src=\"{$src}\" defer></script>";
            }
        }

        public static function stylesheet(string $filepath) {
            // In development mode, scripts take care of the stylesheets
            // as well, so they only have to be rendered in production.

            if(@Config::get('development') !== true) {
                $src = self::getPublicLocation($filepath);
                return "<link rel=\"stylesheet\" href=\"{$src}\" />";
            }
        }

       /**
        * Returns the public location of a script or stylesheet
        * 
        * @param string $filepath The local path of the file
        * 
        * @return string The public location of the file.
        */
        protected static function getPublicLocation(string $filepath): string {
            // Vite adds some hexadecimal characters in the filename, 
            // use glob to find the file matching `$filepath`.
            $filename = pathinfo($filepath, PATHINFO_FILENAME);
            $fileext = pathinfo($filepath, PATHINFO_EXTENSION);
            $type = ($fileext == 'js' ? 'script' : 'stylesheet');
            $local_src = @glob(join_paths(root_dir(), "/public/dist/{$filename}.*.{$fileext}"))[0];

            // Throw an error of no file was found
            if(!$local_src)
                return "<script>console.error('Cannot find {$type} \"{$filepath}\".');</script>";

            // Turn the local location into the public location
            $public_src = str_replace_first(join_paths(root_dir(), '/public/'), '', $local_src);

            return $public_src;
        }

        
       /**
        * Injects a script into the page that imports the
        * react-refresh runtime if it has not yet been imported.
        * 
        * @return Vite.
        */
        protected static function safeInject() {
            if(self::$injected)
                return;

            self::$injected = true;
            
            echo('
                <script type="module">
                    import RefreshRuntime from "http://localhost:'.Config::get('vite.server.port').'/@react-refresh"
                    RefreshRuntime.injectIntoGlobalHook(window)
                    window.$RefreshReg$ = () => {}
                    window.$RefreshSig$ = () => (type) => type
                    window.__vite_plugin_react_preamble_installed__ = true
                </script>
            ');

            return __CLASS__;
        }
    }
?>