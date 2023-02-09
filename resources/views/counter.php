<?php 
    $available_themes = [
        // Theme - Text color - Background color
        'light' => ['#222222', '#ffffff'], 
        'dark'  => ['#ffffff', '#111111']
    ];

    $use_theme = $props->user->getSetting('counter_theme');

    if(!isset($available_themes[$use_theme]))
        $use_theme = array_key_first($available_themes);
?>
<html lang="en">
<Head title="Counter" include-counter />
<body data-theme="<?= $use_theme; ?>">
    <div id="root">Loading counter...</div>
    <style>
        body {
            color: <?= $available_themes[$use_theme][0] ?>;
            background-color: <?= $available_themes[$use_theme][1] ?>;
        }
    </style>
</body>
</html>