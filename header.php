<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<?php if( is_single() ){ ?>
	<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<?php } else { ?>
    <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#">
<?php } ?>

    <meta charset="<?php bloginfo( 'charset' );?>">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Bricks&Uk">
    <meta name="format-detection" content="telephone=no">
    <?php get_template_part( 'includes/content', 'meta' ); ?>
    <link rel="shortcut icon" href="<?php echo THEME; ?>/assets/img/favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo THEME; ?>/assets/img/apple-touch-icon.png">
    <!-- FONTS -->
     
    <!--- styles -->

    <?php wp_head(); ?>
</head>

<body>