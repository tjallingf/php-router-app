<?php
    use Tjall\Router\Controllers\Config;
    use Tjall\Router\Controllers\Locale;

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
    //             APP            //
    // -------------------------- //

    // Require app.php if it exists
    if(file_exists(__DIR__.'/../app.php'))
        require_once(__DIR__.'/../app.php');

    // -------------------------- //
    //           SESSION          //
    // -------------------------- //

    // Start session
    session_start();

    // -------------------------- //
    //           ROUTES           //
    // -------------------------- //

    // Require routes
    if(@Config::get('controllers.route.enabled') !== false)
        require_all(__DIR__.'/../routes/');

    // -------------------------- //
    //           LOCALE           //
    // -------------------------- //

    // Get list of available locales
    $available_locales = @Config::get('controllers.locale.available_locales') ?? [];

    if(@count($available_locales) == 0)
        throw new Exception('No available locales were defined');

    $locale = in_array(@$_COOKIE['locale'], $available_locales) ? $_COOKIE['locale'] : @Config::get('controllers.locale.default_locale');

    // Initialize locale controller
    Locale::init($locale);
?>