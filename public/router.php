<?php 
    use Tjall\App\Controllers\Route;
    use Tjall\App\Helpers\Url;
    use Tjall\App\Controllers\Config;

    require_once(__DIR__.'/../app/autoload.php');

    $relative_url = Url::makeRelative(Url::strip($_SERVER['REQUEST_URI'], false), @Config::get('root') ?? '');

    return Route::answer(
        strtolower($_SERVER['REQUEST_METHOD']),
        $relative_url,
        [
            'locale' => @$locale ?? null,
            'permission_level' => 0,
            'json' => false
        ]
    );