<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper" class="hfeed">
    <div id="container">
    <main id="content">
    <section class="error-404">
        <div class="error-404-info">
            <div class="error-404-info__wrapp">
                <h1 class="error-404-info__number">404</h1>
                <h2 class="error-404-info__text">Страница не найдена</h2>
                <a href="<?= get_site_url() ?>" class="c-btn-primary error-404-info__link">На главную</a>
            </div>
        </div>
        <div class="error-404__caption"></div>
    </section>
    </main>
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>
