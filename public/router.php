<?php 
    use Tjall\Lib\Controllers\Middleware;
    use Tjall\Lib\Controllers\Config;
    use Tjall\Lib\Helpers\Url;

    require_once(__DIR__.'/../lib/autoload.php');

    $relative_url = Url::makeRelative(Url::strip($_SERVER['REQUEST_URI'], false), @Config::get('root') ?? '');

    return Middleware::get('Route')::answer(
        strtolower($_SERVER['REQUEST_METHOD']),
        $relative_url,
        [
            'locale' => @$locale ?? null,
            'permission_level' => 0,
            'json' => false
        ]
    );