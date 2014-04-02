<?php get_header("404"); ?>

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

<?php get_footer("404"); ?>