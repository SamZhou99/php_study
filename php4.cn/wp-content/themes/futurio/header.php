<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <script src="/wp-content/themes/player.js?ver=20181230"></script>
        <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php wp_head(); ?>
    </head>
    <body id="blog" <?php body_class(); ?>>
        <?php wp_body_open(); ?>
        <?php do_action('futurio_header_body'); ?>
        <div class="page-wrap">
