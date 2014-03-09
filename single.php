<?php get_header(); ?>

<!-- Start Content Section -->
<div class="container" id="content">
	<div class="row-fluid">
		<!-- Start SideBar -->
		<div class="span3">
		<?php get_sidebar(); ?>
		</div>
		<!-- End SideBar -->
		<!-- Start Content - Articles -->
		<div class="span9">
		<?php if( have_posts() ){ ?>
			<div class="wrapper-posts" id="articles">
			<?php 
			global $wp_query;
			$ct= 1;
			$number_of_posts= $wp_query->post_count;
			while( have_posts() ){
				the_post();
				$post= get_post();
			?>
				<div class="post">
				<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<?php 
				$categories_list= "";
				if ( is_object_in_taxonomy( get_post_type(), 'category' ) ){ // Hide category text when not supported 
					// translators: used between list items, there is a space after the comma 
					$categories_list = get_the_category_list( __( ', ', PHANTASMACODE_THEME) );
					if ( $categories_list ){
						$categories_list= sprintf ( __( 'in %s', PHANTASMACODE_THEME), $categories_list );
					}
				} // End if is_object_in_taxonomy( get_post_type(), 'category' ) 
				?>
				<p class="post-by">
				<?php
				$post_by = __('by %1$s on %2$s %3$s with %4$s', PHANTASMACODE_THEME);
				printf($post_by, get_the_author(), esc_html(get_the_date()), $categories_list, 
				buffer_output("comments_popup_link"));
				?>
				</p>
				<div class="content"><?php the_content(); ?></div>
				<?php 
				if ( is_object_in_taxonomy( get_post_type(), 'post_tag' ) ){
				// Hide tag text when not supported 
				// translators: used between list items, there is a space after the comma 
				$tags_list = get_the_tag_list( '', __( ', ', PHANTASMACODE_THEME ) );
				if ( $tags_list ){
				?>
				<div id="tag-links">
				<?php 
				printf( __( '<span class="%1$s">tagged</span> %2$s', PHANTASMACODE_THEME ), 'tagged', $tags_list );
				?>
				</div>
				<?php 
					}// End if $tags_list 
				} // End if is_object_in_taxonomy( get_post_type(), 'post_tag' ) 
				?>						
				<?php comments_template( '', true ); ?>
				</div>
			<?php
				$ct++;
			}
			?>
			</div>
		<?php }
		else{ ?>
			<div>
			<p><?php _e('No posts were found. Sorry!', PHANTASMACODE_THEME); ?></p>
			</div>
		<?php } ?>		
		</div>
		<!-- End Content - Articles -->
	</div>
</div>
<!-- End Content Section -->

<?php get_footer(); ?>