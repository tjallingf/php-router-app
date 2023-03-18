<?php
    // Require Composer autoloader
    require(__DIR__.'/../vendor/autoload.php');

    use Tjall\Router\Router;
    use Tjall\Router\Lib;
    
    Router::run(
        json_decode(file_get_contents(Lib::joinPaths(dirname(__DIR__), '/app_config.json')), true)
    );
