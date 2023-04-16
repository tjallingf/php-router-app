<?php
    $root = dirname(__FILE__, 2);

    // Require Composer autoloader
    require($root.'/vendor/autoload.php');

    use Tjall\Router\Router;
    use Tjall\Router\Lib;
    
    Router::run(
        json_decode(file_get_contents(Lib::joinPaths($root.'/app_config.json')), true)
    );
