<?php 
    namespace Tjall\Lib\Controllers;

    class Component {
        public static function find(string $name, array $data = []): string {
            $path = join_paths(root_dir(), "resources/components/$name.php");
            
            if(!is_file($path))
                throw new \Exception("Cannot find component '{$name}'.");
            
            $data['name'] = $name;

            return self::render($path, $data);
        }

        protected static function render(string $__path, array $__data): string {
            // The $_COMPONENT variable can be used inside the component
            $_COMPONENT = $__data;

            ob_start();
            include($__path);
            $output = ob_get_contents();
            ob_end_clean();

            echo($output);

            return __CLASS__;
        }
    }
?>