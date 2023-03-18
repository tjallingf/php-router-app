<?php
    use Tjall\Router\Router;
    use Tjall\Router\Response;
    use Tjall\Router\Request;
    use Tjall\Router\View;

    Router::get('/', function($req, $res) {
        $res->redirect('/counter');
    });

    Router::get('/counter', function(Request $req, Response $res) {
        $res->send(View::get('counter', [
            'theme' => 'dark'
        ]));
    });