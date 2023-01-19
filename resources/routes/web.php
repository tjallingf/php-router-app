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

    Route::get('/test', function($req, $res) {
        return $res->send(Views::find('test', [
            'theme' => $req->getQuery('theme')
        ]));
    });

    Route::get('/out', function($req, $res) {
        return $res->redirect('/app', false);
    });