<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>
<?php
/*
 * Print the <title> tag based on what is being viewed.
 */
global $page, $paged;

wp_title( '|', true, 'right' );

// Add the blog name.
bloginfo( 'name' );

// Add the blog description for the home/front page.
$site_description = get_bloginfo( 'description', 'display' );
if ( $site_description && ( is_home() || is_front_page() ) )
	echo " | $site_description";

// Add a page number if necessary:
if ( $paged >= 2 || $page >= 2 )
	echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

?>
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="<?php bloginfo('template_url'); ?>/js/html5.js"></script>
<![endif]-->
<!-- Fav and touch icons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="<?php echo IMAGES; ?>favicon.png">
</head>
<body>
<div class="container">
<div class="row-fluid">
	<div class="span12">
		<div class="page-not-found">
		<h1>404 Not Found</h1>
		<p>
		<?php _ex("Sorry, the page you’re looking for doesn’t exists.", "404 Not Found Page", PHANTASMACODE_THEME) ?>
		</p>
		<p>
		<?php _ex("Go Back to", "404 Not Found Page", PHANTASMACODE_THEME) ?>
		<a class="logo" href="<?php echo get_home_url(); ?>" 
		title="<?php echo _x('Home Page', "404 Not Found Page", PHANTASMACODE_THEME); ?>">
		<?php echo _x('Home Page', "404 Not Found Page", PHANTASMACODE_THEME); ?></a>.
		</p>
		</div>
	</div>
</div>
</div>
<?php
wp_footer();
?>
</body>
</html>