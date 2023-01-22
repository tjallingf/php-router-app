<?php 
    // Code in this file is run on every request.
    use Router\Router;
    use Router\Middleware;
    use Router\Response;
    use ExtendRouter\Request;
    use MyApp\Models\UserModel;

    // Because the config is set to override the Router\Request class 
    // with our own ExtendRouter\Request class, we can now add new
    // methods and properties to that class. These can be used inside
    // of middlewares and the route handler.
    Router::use(Middleware::mapRequest('set_user', function(Request $req, Response $res) {
        // You would probably want to hook this up to a database. 
        $req->user = new UserModel([
            'first_name' => 'John',
            'last_name'  => 'Doe',
            'settings' => [
                'counter_theme' => 'dark'
            ]
        ]);
    }));

    // Example of how to add something to the Request->$data object.
    // This can be done with the default Router\Request class, and
    // could also be combined with the middleware above.
    Router::use(Middleware::mapRequest('check_auth', function(Request $req, Response $res) {
        if($req->user instanceof UserModel)
            $res->data->authenticated = true;
    }));