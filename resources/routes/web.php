<?php
    use Router\Helpers\Route;
    use Router\Helpers\Views;

    Route::get('/', function($req, $res) {
        return $res->send(Views::find('home'));
    });

    Route::get('/app', function($req, $res) {
        return $res->send(Views::find('app', [
            'theme' => $req->getQuery('theme')
        ]));
    });