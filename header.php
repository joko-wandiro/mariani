<?php
$phantasmacode_theme_settings_vars= get_option('phantasmacode_theme_settings_vars');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>
<head>
<meta charset="utf-8">
<title><?php wp_title( '', true, 'right' ); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
<![endif]-->
<!-- Fav and touch icons -->
<script><?php echo $phantasmacode_theme_settings_vars['google_analytics']['code']; ?></script>
<?php wp_head(); ?>
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
		<a class="" href="<?php echo esc_url( home_url( '/' ) ); ?>" 
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
				<?php wp_nav_menu(array('theme_location' => 'primary', 'container' => '', 
				'menu_id'=>'menu', 'menu_class'=>'nav', 'walker'=>new PHC_Mariani_Bootstrap_Walker_Nav_Menu)); ?>
				</div><!-- /.nav-collapse -->
				</div>
			</div><!-- /navbar-inner -->
		</div>
		</div>
	</div>
</div>
</div>
<!-- End Header Section -->
	