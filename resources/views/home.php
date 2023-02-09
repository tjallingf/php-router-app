<?php 
    $greeting = 'Hi';
    $last_visit = ($props->last_visit > 0 ? $props->last_visit : null);
    
    // Use a different greeting if the last visit occured at most 4 hours ago
    if(isset($last_visit) && (time() - $last_visit) > 4 * 60 * 60) {
        $greeting = 'Welcome back';
    }

    $last_visit_message = $last_visit 
        ? 'You\'ve last visited this page '.(time()-$last_visit).' seconds ago.'
        : 'You\'ve not visited this page before.';
?>
<html lang="en" class="h-100">
<Head title="Home" />
<body class="h-100">
    <div class="h-100 container justify-content-center align-items-center d-flex flex-column">
        <h4 class="mb-1"><?= $greeting; ?>, <b><?= $props->user->getFirstName(); ?></b>!</h4>
        <p><?= $last_visit_message; ?></p>
        <Link to="/counter" class="btn btn-primary mb-1 d-block">
            Open counter
        </Link>
    </div>
</body>
</html>