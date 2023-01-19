<?php use Router\Helpers\Config; ?>
<html lang="en" class="h-100">
<Head title="Home" />
<body class="h-100">
    <div class="h-100 container justify-content-center align-items-center d-flex">
        <div class="d-flex flex-column">
            <a href="<?= Config::get('router.baseUrl'); ?>/app?theme=dark" class="btn btn-primary">Open app in Dark theme</a>
            <a href="<?= Config::get('router.baseUrl'); ?>/app" class="small text-center">Use Light theme instead</a>
        </div>
    </div>
</body>
</html>