<?php get_header(); ?>
<div id="container">
    <?php get_sidebar(); ?>
	<div id="content">
	    <div id="content-inner">
			<div id="post-0" class="post error404 not-found">
				<h1 class="entry-title"><?php _e( 'Page Not Found', THEME_NAME ); ?></h1>
				<div class="entry-content">
					<p><?php _e( 'Apologies, but we were unable to find what you were looking for. Perhaps searching will help?', THEME_NAME ); ?></p>
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>