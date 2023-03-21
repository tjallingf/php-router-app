<?php
    use Tjall\Router\Router;
    use Tjall\Router\Http\Response;
    use Tjall\Router\Http\Request;
    use Tjall\Router\View;
    use Tjall\Router\Http\Cookie;

    Router::group(function() {
        Router::get('/', function($req, $res) {
            $res->send(View::get('home'));
        });

        Router::get('/counter', function(Request $req, Response $res) {
            $res->send(View::get('counter', [
                'theme' => 'dark'
            ]));
        });
    });
