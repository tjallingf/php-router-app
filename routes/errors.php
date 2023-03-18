<?php
    use Tjall\Router\Router;
    use Tjall\Router\Request;
    use Tjall\Router\Response;
    use Tjall\Router\Http\Status;

    Router::error(Status::NOT_FOUND, function(Request $req, Response $res) {
        $res->json([ 'error' => 'Not found.' ]);
    });