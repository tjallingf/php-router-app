<?php 
    use Router\Config; 
    $omitted_props = $props->omit(['to']); 
?>
<a href="<?= Config::get('router.baseUrl'); ?>/<?= trim($props->to, '/'); ?>" <?= $omitted_props; ?>>
    <?= $props->children; ?>
</a>