<?php
$phantasmacode_theme_settings_vars= get_option('phantasmacode_theme_settings_vars');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>
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
<script>
<?php echo $phantasmacode_theme_settings_vars['google_analytics']['code']; ?>
</script>
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="<?php echo IMAGES; ?>favicon.png">
</head>
<body <?php body_class( $class ); ?>>
<?php
if ( ! isset( $content_width ) ) $content_width = 900;
#wp_link_pages();
?>
<!-- Start Header Section -->
<div class="full-block black border-bottom">
<div class="container" id="header">
	<div class="row-fluid">
		<div class="span3">
		<div id="logo">
		<a class="" href="<?php echo get_home_url(); ?>" 
		title="<?php echo __('Phantasmacode', PHANTASMACODE_THEME); ?>">
		<?php
		$image_src= wp_get_attachment_image_src($phantasmacode_theme_settings_vars['image_url'], 'post-large');
		if( $image_src ){
		?>
		<img src="<?php echo $image_src[0]; ?>" alt="" height="54" />
		<?php
		}else{
		?>
		<img src="<?php echo PHANTASMACODE_IMAGES . "logo.png"; ?>" 
		alt="<?php echo __('Phantasmacode', PHANTASMACODE_THEME); ?>" height="54" />
		<?php
		}
		?>
		</a>
		</div>
		</div>
		<div class="span9">
		<div class="top navbar">
			<div class="navbar-inner">
				<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</a>
				<div class="nav-collapse collapse navbar-responsive-collapse">
				<?php wp_nav_menu(array('theme_location' => 'Primary Navigation', 'menu'=>'Primary', 'container' => '', 
				'menu_id'=>'menu', 'menu_class'=>'nav', 'walker'=>new Bootstrap_Walker_Nav_Menu)); ?>
				</div><!-- /.nav-collapse -->
				</div>
			</div><!-- /navbar-inner -->
		</div>
		</div>
	</div>
</div>
</div>
<!-- End Header Section -->
	