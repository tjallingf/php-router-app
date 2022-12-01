<?php 
    namespace Tjall\Lib\Controllers;

    class View {
        public static function find(string $name, array $data = []): string {
            $path = join_paths(root_dir(), "resources/views/$name.php");
            
            if(!is_file($path))
                throw new \Exception("Cannot find view '{$name}'.");
            
            $data['name'] = $name;

            return self::render($path, $data);
        }

        protected static function render(string $__path, array $__data): string {
            // The $_VIEW variable can be used inside the view
            $_VIEW = $__data;

            ob_start();
            include($__path);
            $output = ob_get_contents();
            ob_end_clean();

            return $output;
        }
    }
?>