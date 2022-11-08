<?php 
    use Tjall\Router\Controllers\Route;
    use Tjall\Router\Helpers\Url;
    use Tjall\Router\Controllers\Config;

    require_once(__DIR__.'/../app/autoload.php');

    $url = Url::makeRelative(Url::strip($_SERVER['REQUEST_URI'], false), @Config::get('root') ?? '');

    return Route::answer(
        strtolower($_SERVER['REQUEST_METHOD']),
        $url,
        [
            'locale' => @$locale ?? null,
            'permission_level' => 0,
            'json' => false
        ]
    );