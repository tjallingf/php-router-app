<?php 
    use Tjall\Lib\Controllers\Component; 
    use Tjall\Lib\Controllers\Locale;
?>
<!DOCTYPE html>
<html lang="en">
<?php Component::include('head'); ?>
<body>
    <?php Component::include('nav'); ?>
    <main>
        <?php echo(Locale::translate('view.index.sample_content')); ?>
    </main>
    <div id="root"></div>
</body>
</html>