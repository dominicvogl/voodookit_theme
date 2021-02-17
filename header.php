<!DOCTYPE html>
<html class="no-js" lang="<?php echo get_locale(); ?>">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title><?php wp_title('-', true, 'right'); ?></title>

    <?php wp_head(); ?>

</head>

<?php
$body_classes[] = 'voodookit';
if(WP_DEBUG) {
	$body_classes[] = 'debug';
}
?>

<body <?php body_class(implode(' ', $body_classes)); ?> data-slideout-ignore>

<!-- Module, Navigation + Logo -->

<?php
// render mobile slideout navigation
do_action('voodookit_do_slideout');

echo '<div class="js-slideout-panel">';

// render site header with logo an desktop navigation
do_action('voodookit_do_before_header');
do_action('voodookit_do_header');
