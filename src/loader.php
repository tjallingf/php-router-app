<?php
    // Require Composer autoloader
    require(__DIR__.'/../vendor/autoload.php');

    use Router\Helpers\Loader;
    use Router\Lib;
    
    // Determines the root directory of the project
    $root_dir = dirname(__DIR__);

    // Load config from app_config.json file
    $config = @json_decode(file_get_contents($root_dir.'/app_config.json'), true) ?? [];

    Loader::load($root_dir, $config);
    
    if(file_exists(Lib::getRootDir().'/app.php'))
        require(Lib::getRootDir().'/app.php');