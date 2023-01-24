<?php
    use Router\Route;
    use Router\View;
    use Router\Response;
    use ExtendRouter\Request as ExtRequest;
    use Router\Middleware;
    use Router\Tests\Data\Pictures;

    Route::get('/', function(ExtRequest $req, Response $res) {
        return $res->send(View::get('home', [
            'user' => $req->user,
            'last_visit' => intval($req->getCookie('last_visit')?->getValue())
        ]));
    })->use(Middleware::mapResponse('last_visit_cookie', function(ExtRequest $req, Response $res) {
        $res->sendCookie($res->createCookie('last_visit', time()));
    }));

    Route::get('/counter', function(ExtRequest $req, Response $res) {
        return $res->send(View::get('counter', [
            'user' => $req->user
        ]));
    });

    // Use classes to create api routes
    Route::api('/api/pictures', Pictures::class, [ 'index' => 'get', 'find' => 'getOne' ]);