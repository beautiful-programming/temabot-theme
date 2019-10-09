<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper" class="hfeed">
    <header id="header" class="main-header">
        <div class="main-header__wrapp">
            <a href="<?= get_site_url() ?>" class="main-header-logo" aria-label="TemaBot" title="TemaBot">
                <img src="<?= get_template_directory_uri() . '/assets/img/logo.png' ?>" alt="temabot logo | whatsapp бот" class="main-header-logo__img">
            </a>
            <nav class="main-header-nav">
                <ul class="main-header-nav__list">
                    <li class="main-header-nav__item"><a href="<?= get_site_url() . '/login' ?>" class="main-header-nav__link">Вход</a></li>
                    <li class="main-header-nav__item"><a href="<?= get_site_url() . '/register' ?>" class="main-header-nav__link">Регистрация</a></li>
                </ul>
            </nav>
            <a href="tel:+79233549440" class="main-header__tel">8 (923) 354-94-40</a>
        </div>
    </header>
    <div id="container">