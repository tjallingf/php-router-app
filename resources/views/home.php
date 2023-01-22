<?php use Router\Config; ?>
<html lang="en" class="h-100">
<Head title="Home" />
<body class="h-100">
    <div class="h-100 container justify-content-center align-items-center d-flex flex-column">
        <h4 class="mb-4">Welcome <b><?= $_PROPS['user']->getName(); ?></b>!</h4>
        <a href="<?= Config::get('router.baseUrl'); ?>/counter" class="btn btn-primary mb-1 d-block">
            Open counter
        </a>
    </div>
</body>
</html>