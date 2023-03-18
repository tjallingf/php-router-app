<?php
    // Require Composer autoloader
    require(__DIR__.'/../vendor/autoload.php');

    use Tjall\Router\Router;
    use Tjall\Router\Lib;
    
    require_once '../routes/include.php';

    Router::run(
        json_decode(file_get_contents(Lib::joinPaths(dirname(__DIR__), '/app_config.json')), true)
    );
