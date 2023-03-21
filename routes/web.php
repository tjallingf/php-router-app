<?php
    use Tjall\Router\Router;
    use Tjall\Router\Http\Response;
    use Tjall\Router\Http\Request;
    use Tjall\Router\View;

    Router::group(function() {
        Router::get('/', function($req, $res) {
            $res->send(View::get('home'));
        });

        Router::get('/', function($req, $res) {
            $res->redirect('/counter');
        });

        Router::get('/counter', function(Request $req, Response $res) {
            $res->send(View::get('counter', [
                'theme' => 'dark'
            ]));
        });
    })->before(function(Request $req, Response $res) {
        $req->user = 3;
    })->after(function(Request $req, Response $res) {
        $res->header('jalo', 4);
    });
