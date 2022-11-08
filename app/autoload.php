<?php
    use Tjall\App\Controllers\Config;
    use Tjall\App\Controllers\Locale;
    use Tjall\App\Controllers\StaticAsset;

    // -------------------------- //
    //          COMPOSER          //
    // -------------------------- //

    // Throw an error if the Composer autoloader does not exist
    if(!file_exists(__DIR__.'/../vendor/autoload.php'))
        throw new Exception('Please install the dependencies using `composer install`, before running the application');

    // Require the Composer autoloader
    require_once(__DIR__.'/../vendor/autoload.php');

    // -------------------------- //
    //           CONFIG           //
    // -------------------------- //
    
    // Initialize config controller
    Config::init();

    // -------------------------- //
    //           USER          //
    // -------------------------- //

    // Start session
    if(Config::get('controllers.user.enabled')) {
        session_start();
    }

    // -------------------------- //
    //             APP            //
    // -------------------------- //

    // Require /app.php if it exists
    if(file_exists(root_dir() . '/app.php'))
        require_once(root_dir() . '/app.php');

    // -------------------------- //
    //        STATIC ASSETS       //
    // -------------------------- //

    // Start session
    if(Config::get('controllers.staticasset.enabled')) {
        StaticAsset::init(trim(str_replace('\\', '/', Config::get('controllers.staticasset.directory')), '/'));
    }

    // -------------------------- //
    //           ROUTES           //
    // -------------------------- //

    // Require routes
    if(@Config::get('controllers.route.enabled')) {
        require_all(root_dir() . '/routes/');
    }

    // -------------------------- //
    //           LOCALE           //
    // -------------------------- //

    if(Config::get('controllers.locale.enabled')) {
        // Get list of available locales
        $available_locales = @Config::get('controllers.locale.available_locales') ?? [];

        if(@count($available_locales) == 0)
            throw new Exception('No available locales were defined');

        $locale = in_array(@$_COOKIE['locale'], $available_locales) ? $_COOKIE['locale'] : @Config::get('controllers.locale.default_locale');

        // Initialize locale controller
        Locale::init($locale);
    }