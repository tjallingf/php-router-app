<?php 
    namespace Tjall\Lib\Controllers;

    use Tjall\Lib\Controllers\Config;

    class Vite {
        protected static bool $hasInjected = false;

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
            
            if(@Config::get('development') === true) {
                self::safeInject();
            } else {
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
        protected static function getPublicLocation(string $filepath) {
            // Vite adds some hexadecimal characters in the filename, 
            // use glob to find the file matching `$filepath`.
            $filename = pathinfo($filepath, PATHINFO_FILENAME);
            $file_ext = pathinfo($filepath, PATHINFO_EXTENSION);
            $local_src = @glob(join_paths(root_dir(), "/public/static/dist/{$filename}.*.{$file_ext}"))[0];

            // Return if no file was found
            if(!isset($local_src))
                $local_src = join_paths(root_dir(), $filepath);

            // Turn the local location into the public location
            $public_src = str_replace_first(join_paths(root_dir(), 'public'), '', $local_src);

            return $public_src;
        }

        
       /**
        * Injects a script into the page that imports the
        * react-refresh runtime if it has not yet been imported.
        * 
        * @return Vite.
        */
        protected static function safeInject() {
            if(self::$hasInjected)
                return;

            self::$hasInjected = true;
            
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