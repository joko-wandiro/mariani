<?php
/**
 * Advanced_Post widget class
 *
 * @since 1.0.0
 */
class PHC_Mariani_WP_Widget_Advanced_Post extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_advanced_entries', 'description' => 
		__( "The most recent posts on your site") );
		parent::__construct('advanced-posts', __('Advanced Posts'), $widget_ops);
		$this->alt_option_name = 'widget_advanced_entries';

		add_action( 'save_post', array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );
	}

	function widget($args, $instance){
		$cache = wp_cache_get('widget_advanced_posts', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts') : $instance['title'], 
		$instance, $this->id_base);
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) ){
 			$number = 10;
		}
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		$r= new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 
		'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true, 
		'category_name'=>$instance['category']) ) );
		if ($r->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul>
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>
			<li>
				<h2 class=""><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<p class="date-section">
				<?php strtoupper(the_time('d F Y')); ?>
				</p>
				<div class="image">
				<?php 
				if( has_post_thumbnail($post->ID) ){
					the_post_thumbnail($post->ID);
				}
				?>
				</div>
				<div class="desc">
				<?php the_excerpt(); ?>
				</div>
			</li>
		<?php endwhile; ?>
		</ul>
		<?php echo $after_widget; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_advanced_posts', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['category'] = strip_tags($new_instance['category']);
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = (bool) $new_instance['show_date'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_advanced_entries']) )
			delete_option('widget_advanced_entries');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('widget_advanced_posts', 'widget');
	}

	function form( $instance ) {
		$args= array('class'=>'categories');
		$categories = get_categories($args);
		$category= isset( $instance['category'] ) ? esc_attr( $instance['category'] ) : '';
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<select class="widefat" id="<?php echo $this->get_field_id('category'); ?>" 
		name="<?php echo $this->get_field_name('category'); ?>">
		<?php
		foreach( $categories as $item ){
			$extra_attr= "";
			if( $item->cat_name == $category ){
				$extra_attr= " selected=\"selected\"";
			}
		?>
		<option value="<?php echo $item->cat_name; ?>"<?php echo $extra_attr; ?>>
		<?php echo $item->cat_name; ?></option>
		<?php
		}
		?>
		</select>
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" 
		name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" 
		type="text" value="<?php echo $number; ?>" size="3" />
		</p>

<?php
	}
}

function phc_mariani_advanced_post_register_widgets() {
	register_widget('PHC_Mariani_WP_Widget_Advanced_Post');
}

add_action('widgets_init', 'phc_mariani_advanced_post_register_widgets');
?>