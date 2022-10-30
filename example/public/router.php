<?php 
    use Tjall\Router\Controllers\Route;
    use Tjall\Router\Helpers\Url;

    require_once(__DIR__.'/../app/autoload.php');

    return Route::answer(
        strtolower($_SERVER['REQUEST_METHOD']),
        Url::fromRoot(Url::strip($_SERVER['REQUEST_URI'], false), 'public'),
        [
            'locale' => @$locale ?? null,
            'permission_level' => 0,
            'json' => false
        ]
    );
?>