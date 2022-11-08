<?php 
    namespace Tjall\App\Controllers;

    class Component {
        public static function include(string $filename, array $data = []) {
            $path = root_dir() . "/components/{$filename}.php";
            
            if(!is_file($path))
                exit("Cannot find component '{$filename}'.");
           
            $req = Request::class;
            $data['user'] = $req::getUser();
            // Declare variables for inside the script
            foreach ($data as $key => $value) {
                $name = '_'.$key;
                $$name = $value;
            }

            ob_start();
            include($path);
            $output = ob_get_contents();
            ob_end_clean();

            echo($output);

            return __CLASS__;
        }
    }
?>