<?php
define('PHC_THEME_ID_SCRIPT', "phantasmacode_theme");
define("PHC_THEME_MENU_CAPABILITY", "manage_options");
define("PHC_THEME_MENU_SLUG_SETTINGS", PHC_THEME_ID_SCRIPT . "_settings");
define("PHC_THEME_MENU_TITLE_SETTINGS", __("Theme Options", PHANTASMACODE_THEME));
	
add_action('admin_menu', 'phantasmacode_theme_create_menu_settings');
function phantasmacode_theme_create_menu_settings(){
	$function= "phantasmacode_theme_settings_page";
	// Create Theme Options Page
	add_theme_page(PHC_THEME_MENU_TITLE_SETTINGS, PHC_THEME_MENU_TITLE_SETTINGS, PHC_THEME_MENU_CAPABILITY, 
	PHC_THEME_MENU_SLUG_SETTINGS, $function);
	
	add_action('admin_init', 'phantasmacode_theme_register_settings');
}

function phantasmacode_theme_register_settings(){
	register_setting('phantasmacode_theme_settings_page_vars', 
	'phantasmacode_theme_settings_vars');
}

function phantasmacode_theme_settings_page(){
	global $wp_scripts;
	wp_enqueue_media();
	wp_enqueue_style(PHC_THEME_ID_SCRIPT . '_theme_options_css', PHANTASMACODE_JS_PATH . "admin/theme-options.css");
	wp_enqueue_script(PHC_THEME_ID_SCRIPT . '_theme_options_js', PHANTASMACODE_JS_PATH . "admin/theme-options.js", 
	array("jquery-ui-sortable", "jquery-ui-accordion", "jquery-ui-tabs"));
	
	$phantasmacode_theme_settings_vars= get_option('phantasmacode_theme_settings_vars');
	if( ! empty($phantasmacode_theme_settings_vars) ){
		extract($phantasmacode_theme_settings_vars);
	}
	$image_url= (isset($image_url)) ? $image_url : "";
?>
	<div class="wrap" id="<?php echo PHC_THEME_ID_SCRIPT; ?>">
	<?php screen_icon('generic'); ?>
	<h2><?php echo PHC_THEME_MENU_TITLE_SETTINGS; ?></h2>
	<!-- Start Banner -->
	<ul id="banners">
	<li><a href="#url"><img src="<?php echo PHANTASMACODE_IMAGES_BANNER . "banner_donation.png"; ?>" /></a></li>
	<li class="or"><img src="<?php echo PHANTASMACODE_IMAGES_BANNER . "banner_or.png"; ?>" /></li>
	<li><a href="#url"><img src="<?php echo PHANTASMACODE_IMAGES_BANNER . "banner_opencart.png"; ?>" /></a></li>
	<li><a href="#url"><img src="<?php echo PHANTASMACODE_IMAGES_BANNER . "banner_documentation.png"; ?>" /></a></li>
	</ul>
	<!-- End Banner -->
	<form method="POST" action="options.php">
	<?php settings_fields('phantasmacode_theme_settings_page_vars'); ?>
	<div id="tabs">
	<ul>
	<li><a href="#tabs-general"><?php _e("General", PHANTASMACODE_THEME); ?></a></li>
	<li><a href="#tabs-social-media"><?php _e("Social Media", PHANTASMACODE_THEME); ?></a></li>
	<li><a href="#tabs-google-analytics-code"><?php _e("Google Analytics", PHANTASMACODE_THEME); ?></a></li>
	</ul>
	<div id="tabs-general">
		<div class="phantasmacode_theme_loscolores-image">
		<?php
		$image_src= wp_get_attachment_image_src($image_url, 'post-large');
		if( $image_src ){
		?>
		<img src="<?php echo $image_src[0]; ?>" alt="" />
		<?php
		}else{
		?>
		<img src="<?php echo PHANTASMACODE_IMAGES . "no_image.jpg"; ?>" 
		alt="<?php esc_attr_e("No Image", PHANTASMACODE_THEME); ?>" />
		<?php
		}
		?>
		</div>	
		<div>
		<input type="hidden" name="phantasmacode_theme_settings_vars[image_url]" 
		value="<?php echo (isset($image_url)) ? $image_url : ""; ?>" />
		<input type="button" value="<?php esc_attr_e("Select Image", PHANTASMACODE_THEME); ?>" 
		class="upload_image_button button-secondary" />
		</div>
	</div>
	<div id="tabs-social-media">
	<table class="form-table">
	<tr valign="top">
	    <th scope="row">
		<div><?php _e("RSS"); ?></div>
		</th>
	    <td>
		<?php
		$checked= "";
		if( isset($social_media['rss']['display']) && ! empty($social_media['rss']['display']) ){
			$checked= "checked=\"checked\"";
		}
		?>
		<input type="checkbox" name="phantasmacode_theme_settings_vars[social_media][rss][display]" 
		id="phantasmacode_theme_settings_vars[social_media][rss][display]" <?php echo $checked; ?> value="1" />		
		<label for="phantasmacode_theme_settings_vars[social_media][rss][display]"><?php _e("Show", PHANTASMACODE_THEME); ?>
		</label>
	   	</td>
   	</tr>	
	<tr valign="top">
	    <th scope="row">
		<div><?php _e("Facebook"); ?></div>
		</th>
	    <td>
		<input type="text" name="phantasmacode_theme_settings_vars[social_media][facebook][url]" 
		value="<?php echo (isset($social_media['facebook']['url'])) ? $social_media['facebook']['url'] : ""; ?>" />
		<?php
		$checked= "";
		if( isset($social_media['facebook']['display']) && ! empty($social_media['facebook']['display']) ){
			$checked= "checked=\"checked\"";
		}
		?>
		<input type="checkbox" name="phantasmacode_theme_settings_vars[social_media][facebook][display]" 
		id="phantasmacode_theme_settings_vars[social_media][facebook][display]" <?php echo $checked; ?> value="1" />		
		<label for="phantasmacode_theme_settings_vars[social_media][facebook][display]"><?php _e("Show", PHANTASMACODE_THEME); ?>
		</label>
	   	</td>
   	</tr>
	<tr valign="top">
	    <th scope="row">
		<div><?php _e("Twitter"); ?></div>
		</th>
	    <td>
		<?php
		$checked= "";
		if( isset($social_media['twitter']['display']) && ! empty($social_media['twitter']['display']) ){
			$checked= "checked=\"checked\"";
		}
		?>		
		<input type="text" name="phantasmacode_theme_settings_vars[social_media][twitter][url]" 
		value="<?php echo (isset($social_media['twitter']['url'])) ? $social_media['twitter']['url'] : ""; ?>" />
		<input type="checkbox" name="phantasmacode_theme_settings_vars[social_media][twitter][display]" 
		id="phantasmacode_theme_settings_vars[social_media][twitter][display]" <?php echo $checked; ?> value="1" />		
		<label for="phantasmacode_theme_settings_vars[social_media][twitter][display]"><?php _e("Show", PHANTASMACODE_THEME); ?>
		</label>		
	   	</td>
   	</tr>	
	</table>
	</div>
	<div id="tabs-google-analytics-code">
	<table class="form-table">
	<tr valign="top">
	    <th scope="row">
		<div><?php _e("Google Analytics Code"); ?></div>
		</th>
	    <td>
		<textarea name="phantasmacode_theme_settings_vars[google_analytics][code]"><?php echo (isset($google_analytics['code'])) ? $google_analytics['code'] : ""; ?></textarea>
	   	</td>
   	</tr>
	</table>
	</div>
	</div>
	<div class="btn-group-controls">
	<input type="submit" name="save" 
	value="<?php esc_attr_e("Save"); ?>" class="button-primary" />
	</div>
	</form>
	</div>
<?php
}
?>