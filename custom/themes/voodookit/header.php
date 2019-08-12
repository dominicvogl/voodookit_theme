<!DOCTYPE html>
<html class="no-js" lang="<?php echo get_locale(); ?>">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title><?php wp_title('-', true, 'right'); ?></title>

    <?php wp_head(); ?>

</head>

<body <?php body_class('voodookit'); ?>>

<!-- Module, Navigation + Logo -->

<?php

// render site header with logo an desktop navigation
do_action('voodookit_do_header');

// render mobile slideout navigation
do_action('voodookit_do_slideout');
