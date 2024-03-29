<?php 
    use Tjall\Router\Context;
    use Tjall\Router\Vite;
    use Tjall\Router\Config;

    $themes = [
        // Theme - Text color - Background color
        'light' => ['#222222', '#ffffff'], 
        'dark'  => ['#ffffff', '#111111']
    ];

    $theme_id = Context::getOrFail('theme');
    $params = Context::getOrFail('params');
?>
<html lang="en">
<head>
    <title>Counter - <?= Config::get('name'); ?></title>
    
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Disables zooming as well -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Preconnects -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="" />
    <link rel="preconnect" href="https://cdn.jsdelivr.net" />

    <!-- Font: Lato -->
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet" />

    <!-- FontAwesome 6.2.0 -->
    <link href="https://cdn.jsdelivr.net/gh/hung1001/font-awesome-pro-v6@44659d9/css/all.min.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap 5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    
    <?= Vite::include(); ?>
</head>
<body data-theme="<?= $theme_id; ?>">
    <div id="root">Loading counter...</div>
    <div class="container-fluid">
        <p>Params: <?php echo(http_build_query(array_map(function($p) { return $p ?? 'NULL'; }, $params), '', '; ')); ?></p>
    </div>
    <style>
        body {
            color: <?= $themes[$theme_id][0] ?>;
            background-color: <?= $themes[$theme_id][1] ?>;
        }
    </style>
</body>
</html>