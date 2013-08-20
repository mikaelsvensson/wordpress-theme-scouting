<div id="comments" class="<?php print !nackasmu_option_is_true( NACKASMU_OPTION_PRINTCOMMENTS ) ? 'hide-comments-on-print' : '' ; ?>"><?php /* Run some checks for bots and password protected posts */ ?>
<?php
$req = get_option('require_name_email'); // Checks if fields are required.
if ( 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']) ) {
	die ( 'Please do not load this page directly. Thanks!' );
}
if ( ! empty($post->post_password) ) {
	if ( $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password ) {
		printf( '<div class="nopassword">%s</div>', __('This post is password protected. Enter the password to view any comments.', THEME_NAME));
		print "</div>"; // Close .comments
		return;
	}
}
?>

<?php /* See IF there are comments and do the comments stuff! */ ?>
<?php if ( have_comments() ) : ?>

	<?php /* Count the number of comments and trackbacks (or pings) */
	$ping_count = $comment_count = 0;
	foreach ( $comments as $comment ) {
		get_comment_type() == "comment" ? ++$comment_count : ++$ping_count;
	}
	?>

	<?php /* IF there are comments, show the comments */ ?>
	<?php if ( ! empty($comments_by_type['comment']) ) : ?>
	
		<div id="comments-list" class="comments">
			<h3><?php printf($comment_count > 1 ? __('<span>%d</span> Comments', THEME_NAME) : __('<span>One</span> Comment', THEME_NAME), $comment_count) ?></h3>
		
		<?php /* If there are enough comments, build the comment navigation  */ ?>
		<?php
		$total_pages = get_comment_pages_count();
		if ( $total_pages > 1 ) : ?>
			<div id="comments-nav-above" class="comments-navigation">
			<div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
			</div>
		<?php endif; ?>
		<?php /* An ordered list of our custom comments callback, custom_comments(), in functions.php   */ ?>
		<ol>
		<?php wp_list_comments('type=comment&callback=nackasmu_custom_comments'); ?>
		</ol>
		
		<?php /* If there are enough comments, build the comment navigation */ ?>
		<?php
		$total_pages = get_comment_pages_count();
		if ( $total_pages > 1 ) : ?>
			<div id="comments-nav-below" class="comments-navigation">
			<div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
			</div>
		<?php endif; ?>
		</div>
	
	<?php endif; /* if ( $comment_count ) */ ?>

	<?php /* If there are trackbacks(pings), show the trackbacks  */ ?>
	<?php if ( ! empty($comments_by_type['pings']) ) : ?>
	
		<div id="trackbacks-list" class="comments">
		<h3><?php printf($ping_count > 1 ? __('<span>%d</span> Trackbacks', THEME_NAME) : __('<span>One</span> Trackback', THEME_NAME), $ping_count) ?></h3>
		
		<?php /* An ordered list of our custom trackbacks callback, custom_pings(), in functions.php   */ ?>
		<ol>
		<?php wp_list_comments('type=pings&callback=nackasmu_custom_pings'); ?>
		</ol>
		
		</div>
	
	<?php endif /* if ( $ping_count ) */ ?>
<?php endif /* if ( $comments ) */ ?>

<?php /* If comments are open, build the respond form */ ?>
<?php if ( 'open' == $post->comment_status ) : ?>
	<div id="respond">
		<h3><?php comment_form_title( __('Post a Comment', THEME_NAME), __('Post a Reply to %s', THEME_NAME) ); ?></h3>
	
		<div id="cancel-comment-reply"><?php cancel_comment_reply_link() ?></div>
	
	<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
		<p id="login-req"><?php printf(__('You must be <a href="%s" title="Log in">logged in</a> to post a comment.', THEME_NAME),
		get_option('siteurl') . '/wp-login.php?redirect_to=' . get_permalink() ) ?></p>
	
	<?php else : ?>
		<div class="formcontainer">
		
		
			<form id="commentform"
				action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php"
				method="post">
				<?php if ( $user_ID ) : ?>
					<p id="login">
					<?php 
					$text_loggedinas = __('Logged in as %s', THEME_NAME);
					$text_username = wp_specialchars($user_identity, true);
					$profile_url = get_option('siteurl') . '/wp-admin/profile.php'; 
					$html_profilelink = sprintf('<a href="%s" title="%s">%s</a>',
					       $profile_url,
                           sprintf($text_loggedinas, $text_username),
                           $text_username);
					$html_loggedinas = sprintf($text_loggedinas, $html_profilelink);
					  
					printf('<span class="loggedin">%1$s.</span> <span class="logout"><a href="%2$s" title="%3$s">%4$s</a>?</span>' ,
					       $html_loggedinas,
	                       wp_logout_url(get_permalink()),
	                       __( 'Log out of this account' , THEME_NAME),
	                       __( 'Log out' , THEME_NAME));
					?>
					</p>
				<?php else : ?>
				
					<p id="comment-notes"><?php _e('Your email is <em>never</em> published nor shared.', THEME_NAME) ?>
					<?php if ($req) _e('Required fields are marked <span class="required">*</span>', THEME_NAME) ?></p>
				
					<div id="form-section-author" class="form-section">
					<div class="form-label"><label for="author"><?php _e('Name', THEME_NAME) ?></label>
					<?php if ($req) _e('<span class="required">*</span>', THEME_NAME) ?></div>
					<div class="form-input"><input id="author" name="author" type="text"
						value="<?php echo $comment_author ?>" size="30" maxlength="20"
						tabindex="3" /></div>
					</div>
				
					<div id="form-section-email" class="form-section">
					<div class="form-label"><label for="email"><?php _e('Email', THEME_NAME) ?></label>
					<?php if ($req) _e('<span class="required">*</span>', THEME_NAME) ?></div>
					<div class="form-input"><input id="email" name="email" type="text"
						value="<?php echo $comment_author_email ?>" size="30" maxlength="50"
						tabindex="4" /></div>
					</div>
				
					<div id="form-section-url" class="form-section">
					<div class="form-label"><label for="url"><?php _e('Website', THEME_NAME) ?></label></div>
					<div class="form-input"><input id="url" name="url" type="text"
						value="<?php echo $comment_author_url ?>" size="30" maxlength="50"
						tabindex="5" /></div>
					</div>
				<?php endif /* if ( $user_ID ) */ ?>
				
				<div id="form-section-comment" class="form-section">
				<div class="form-label"><label for="comment"><?php _e('Comment', THEME_NAME) ?></label></div>
				<div class="form-textarea"><textarea id="comment" name="comment"
					cols="45" rows="8" tabindex="6"></textarea></div>
				</div>
			
				<div id="form-allowed-tags" class="form-section">
				<p><span><?php _e('You may use these HTML tags and attributes:', THEME_NAME) ?></span>
				<code><?php echo allowed_tags(); ?></code></p>
				</div>
			
				<?php do_action('comment_form', $post->ID); ?>
			
				<div class="form-submit"><input id="submit" name="submit" type="submit"
					value="<?php _e('Post Comment', THEME_NAME) ?>" tabindex="7" /><input
					type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" /></div>
			    <div>
				    <?php comment_id_fields(); ?> <?php /* Just … end everything. We're done here. Close it up. */ ?>
			    </div>
			
			</form>
		</div>
	<?php endif /* if ( get_option('comment_registration') && !$user_ID ) */ ?>
	</div>
<?php endif /* if ( 'open' == $post->comment_status ) */ ?>
</div>