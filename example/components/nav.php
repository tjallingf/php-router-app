<?php 
    use Tjall\Router\Controllers\Locale; 
    use Tjall\Router\Controllers\Config;
?>
<div class="nav">
    <ul class="nav__items nav__items--navigation">
        <li class="nav__item nav__item--locale">
            <a href="/" class="nav__item__link"><?php echo(Locale::translate('view.index.title')); ?></a>
        </li>
        <li class="nav__item nav__item--locale">
            <a href="/about/" class="nav__item__link"><?php echo(Locale::translate('view.about.title')); ?></a>
        </li>
    </ul>
    <ul class="nav__items nav__items--locale">
        <?php foreach(Config::get('controllers.locale.available_locales') as $locale) : ?>
        <?php $country = substr($locale, -2, 2); ?>
        <li class="nav__item nav__item--locale">
            <button onclick="setLocale('<?php echo($locale); ?>');"><img src="/static/images/flags/<?php echo($country); ?>.svg" alt="Flag of <?php echo($country); ?>"></button>
        </li>
        <?php endforeach; ?>
    </ul>
</div>