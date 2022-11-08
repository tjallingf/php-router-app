<?php 
    use Tjall\App\Controllers\Route;
    use Tjall\App\Controllers\View;

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