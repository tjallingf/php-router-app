<?php 
    use Tjall\Lib\Controllers\Route;
    use Tjall\Lib\Controllers\View;

    Route::get('/', function($req, $res) {
        return $res::send(View::get('index'));
    });

    Route::get('/about', function($req, $res) {
        return $res::send(View::get('about', [
            'name' => 'John Doe', 
            'description' => 'This data is passed from the router!' 
        ]));
    });
?>