<?php
    if(!isset($_SERVER['REQUEST_METHOD']) || !isset($_SERVER['REQUEST_URI']))
        return;
    
    // ------- CONFIG ------- \\
    const PREROUTER_CONFIG = [
        'fallback_app'          => 'main',
        'app_not_found_message' => 'App not found.'
    ];

    // ------- PREROUTER ------- \\
    $app_name = strtok(trim($_SERVER['REQUEST_URI'], '/'), '/');

    if(!app_require_index($app_name)) {
        if(!app_require_index(PREROUTER_CONFIG['fallback_app'])) {
            http_response_code(404);
            header('content-type: application/json');
            exit(json_encode(['error' => PREROUTER_CONFIG['app_not_found_message']]));
        }
    }

    // ------- FUNCTIONS ------- \\
    function app_get_dir(string $app_name): string {
        $app_dir = __DIR__.'/'.$app_name;
        return $app_dir;
    }

    function app_require_index(string $app_name): bool {
        $app_dir = app_get_dir($app_name);
        $app_index_file = $app_dir.'/public/index.php';

        if(!file_exists($app_index_file)) return false;
        
        require($app_index_file);

        return true;
    }