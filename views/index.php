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
        <?php echo(Locale::translate('view.index.sample_content')); ?>
    </main>
</body>
</html>