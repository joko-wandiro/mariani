<?php
/**
 * The template for displaying Comments.
 */
if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title"><?php echo __('Comments'); ?></h2>

		<ol class="commentlist">
			<?php #wp_list_comments( array( 'callback' => 'twentytwelve_comment', 'style' => 'ol' ) ); ?>
			<?php #wp_list_comments(array('style'=>'ol')); ?>
			<?php 
			
			wp_list_comments(array('style'=>'ol', 'callback'=>'phantasmacode_comment', 'avatar_size'=>64)); 
			?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<h1 class="assistive-text section-heading"><?php _e( 'Comment navigation'); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments') ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;') ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<?php
		/* If there are no comments and comments are closed, let's leave a note.
		 * But we only want the note on posts and pages that had comments in the first place.
		 */
		if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.'); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php 
	$aria_req= ( isset($aria_req) ) ? $aria_req : "";
	
	$args = array(
	'id_form'=>'commentform',
	'class_submit'=>'btn',
	'id_submit'=>'submit',
	'title_reply'=>__('Leave a Comment'),
	'title_reply_to'=>__('Leave a Reply to %s'),
	'cancel_reply_link'=>__('Cancel Reply'),
	'label_submit'=>__('Post Comment'),
	'comment_field' =>  
	'<div class="control-group">' . 
	'<label class="control-label" for="comment">' . __('Comment') . '</label>' . 
	'<div class="controls">' . 
	'<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>' . 
	'</div>' . 
	'</div>',
	'must_log_in' => '<p class="must-log-in">' .
	sprintf(
	__( 'You must be <a href="%s">logged in</a> to post a comment.' ),
	wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
	) . '</p>',
	'logged_in_as' => '<p class="logged-in-as">' .
	sprintf(
	__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),
	admin_url( 'profile.php' ),
	$user_identity,
	wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
	) . '</p>',
	'comment_notes_before' => '',
	'comment_notes_after' => '',
	'fields' => apply_filters( 'comment_form_default_fields', array(
		'author' =>
		'<div class="control-group">' . 
		'<label class="control-label" for="author">' . __('Name') . ' <span class="required">*</span></label>' . 
		'<div class="controls">' . 
		'<input type="text" id="author" name="author" value="' . 
		esc_attr(  $commenter['comment_author'] ) .'" size="30"' . $aria_req . ' / placeholder="">' . 
		'</div>' . 
		'</div>',
		'email' =>
		'<div class="control-group">' . 
		'<label class="control-label" for="email">' . __('Email') . ' <span class="required">*</span></label>' . 
		'<div class="controls">' . 
		'<input type="text" id="email" name="email" value="' . 
		esc_attr(  $commenter['comment_author_email'] ) .'" size="30"' . $aria_req . ' / placeholder="">' . 
		'</div>' . 
		'</div>',
		'url' =>
		'<div class="control-group">' . 
		'<label class="control-label" for="url">' . __('Website') . '</label>' . 
		'<div class="controls">' . 
		'<input type="text" id="url" name="url" value="' . 
		esc_attr(  $commenter['comment_author_url'] ) .'" size="30"' . $aria_req . ' / placeholder="">' . 
		'</div>' . 
		'</div>',
		)
	),
	);
	comment_form($args, $post->ID);
	?>

</div><!-- #comments .comments-area -->