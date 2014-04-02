<!DOCTYPE html>
<html <?php language_attributes(); ?>
<head>
<meta charset="utf-8">
<title><?php wp_title( '', true, 'right' ); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="<?php get_template_directory_uri(); ?>/js/html5.js"></script>
<![endif]-->
<!-- Fav and touch icons -->
<script><?php echo $phantasmacode_theme_settings_vars['google_analytics']['code']; ?></script>
</head>
<body <?php body_class( $class ); ?>>