<?php
    use Router\Route;
    use Router\View;
    use Router\Response;
    use ExtendRouter\Request;

    Route::get('/', function(Request $req, Response $res) {
        return $res->send(View::get('home', [
            'user' => $req->user
        ]));
    });

    Route::get('/counter', function(Request $req, Response $res) {
        return $res->send(View::get('counter', [
            'user' => $req->user
        ]));
    });