<?php
    use Tjall\Router\Controllers\Route;
    use Tjall\Lib\Controllers\View;

    Route::get('/', function($req, $res) {
        return $res::send(View::find('home'));
    });