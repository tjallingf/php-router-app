<?php 
    use Tjall\Router\Controllers\Component; 
    use Tjall\Router\Controllers\Locale;
?>
<!DOCTYPE html>
<html lang="en">
<?php Component::include('head'); ?>
<body>
    <?php Component::include('nav'); ?>
    <main>
        <p><b><?php echo(Locale::translate('view.about.field.name.title')); ?></b>: <?php echo($_name); ?></p>
        <small><?php echo(Locale::translate('view.about.field.name.note')); ?></small>
    </main>
</body>
</html>