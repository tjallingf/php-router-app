<?php 
    namespace Tjall\Lib\Controllers;

    use Tjall\Lib\Controllers\Config;

    class Vite {
        protected static bool $preambleInjected = false;

        public static function findScript(string $filename): string {

            $url = self::resolveUrl($filename);

            if(Config::find('development'))
                return self::getPreambleCode()."<script src=\"$url\" type=\"module\"></script>";
                
            return "<script src=\"$url\"></script>";
        }

        public static function findStylesheet(string $filename): string {
            $url = self::resolveUrl($filename);

            if(Config::find('development'))
                self::getPreambleCode()."<link rel=\"stylesheet\" href=\"$url\"></link>";

            return "<link rel=\"stylesheet\" href=\"$url\"></link>";
        }

        protected static function getPreambleCode(): string {
            if(!self::$preambleInjected) {
                self::$preambleInjected = true;
                
                return ('
                    <script type="module">
                        import RefreshRuntime from "http://localhost:'.Config::find('vite.port').'/@react-refresh"
                        RefreshRuntime.injectIntoGlobalHook(window)
                        window.$RefreshReg$ = () => {}
                        window.$RefreshSig$ = () => (type) => type
                        window.__vite_plugin_react_preamble_installed__ = true
                    </script>
                ');
            }

            return '';
        }

        protected static function resolveUrl(string $filename): string {
            $filepath = self::resolveFilepath($filename); 

            if(Config::find('development')) {
                $domain = 'http://localhost:'.Config::find('vite.port');
                $file = ltrim(str_replace(APP_VITE_SRC_DIR, '', $filepath), '/');
            
                return "$domain/$file";
            } else {
                $file = join_paths(relative_root_dir(), str_replace(join_paths(root_dir(), 'public'), '', $filepath));
                
                return $file;
            }
        }

        protected static function resolveFilepath(string $filename): string {
            if(Config::find('development'))
                return join_paths(APP_VITE_SRC_DIR, $filename);

            // Generate pattern for file names to match,
            // because Vite puts a hash in the filename
            $basename = pathinfo($filename, PATHINFO_FILENAME);
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            $pattern = join_paths(APP_VITE_OUT_DIR, "{$basename}.*.{$extension}");

            $dist_files = glob($pattern, GLOB_NOSORT);

            if(count($dist_files) == 0)
                throw new \Exception("No distribution files found for file '{$filename}'");

            // Sort dest files by creation date, newest first
            usort($dist_files, function($a, $b) {
                return filemtime($b) - filemtime($a);
            });

            // Pick the newest file
            $dist_filename = $dist_files[0];

            return $dist_filename;
        }
    }
?>