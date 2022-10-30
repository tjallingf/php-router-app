<?php 
    namespace Tjall\Router\Controllers;

    class View {
        public static function get(string $__filename, array $__data = []) {
            $__path = root_dir() . "/views/{$__filename}.php";
            
            if(!is_file($__path))
                exit("Cannot find view '{$__filename}'.");

            // Declare variables for inside the script
            $__user = (Request::class)::getUser();
            
            $__data['lang'] = str_replace('_', '-', @$__user['settings']['locale']);
            $__data['view'] = $__filename;
            $__data['user'] = $__user;
            foreach ($__data as $__key => $__value) {
                $__name = '_'.$__key;
                $$__name = $__value;
            }

            // Get view
            ob_start();
            include($__path);
            $output = ob_get_contents();
            ob_end_clean();
            return $output;
        }
    }
?>