<?php
    use Tjall\Lib\Controllers\Middleware;
    use Tjall\Router\Controllers\Route;
    use Tjall\Router\Controllers\Response;
    use Tjall\Router\Controllers\Request;
    use Tjall\Router\Controllers\User;
    use Tjall\Lib\Controllers\Config;

    include_once(__DIR__.'/helpers.php');
    require(__DIR__.'/../vendor/autoload.php');

    // Load routes
    require_all(root_dir().'/resources/routes/');

    define('APP_CONFIG_FILE', join_paths(root_dir(), 'app.json'));
    define('APP_VITE_SRC_DIR', str_replace('\\', '/', realpath(join_paths(root_dir(), Config::find('vite.rootDir'), Config::find('vite.srcDir')))));
    define('APP_VITE_OUT_DIR', str_replace('\\', '/', realpath(join_paths(root_dir(), Config::find('vite.rootDir'), Config::find('vite.outDir')))));

    // Define middlewares
    Middleware::update('Route', Route::class);
    Middleware::update('Response', Response::class);
    Middleware::update('Request', Request::class);
    Middleware::update('User', User::class);

    // Load app.php
    if(file_exists(root_dir().'/app.php'))
        require(root_dir().'/app.php');

    $request_uri = '/'.trim(str_replace(relative_root_dir(), '', $_SERVER['REQUEST_URI']), '/');

    Middleware::find('Route')::handleRequest(
        $_SERVER['REQUEST_METHOD'],
        $request_uri
    );

