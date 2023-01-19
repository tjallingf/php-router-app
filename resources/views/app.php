<?php 
    $available_themes = [
        // Theme - Text color - Background color
        'light' => ['#222222', '#ffffff'], 
        'dark'  => ['#ffffff', '#111111']
    ];

    if(!isset($available_themes[$_PROPS['theme']]))
        $_PROPS['theme'] = array_key_first($available_themes);
?>
<html lang="en">
<Head title="App" include-app />
<body data-theme="<?= $_PROPS['theme']; ?>">
    <div id="root">Loading app...</div>
    <style>
        body {
            color: <?= $available_themes[$_PROPS['theme']][0] ?>;
            background-color: <?= $available_themes[$_PROPS['theme']][1] ?>;
        }
    </style>
</body>
</html>