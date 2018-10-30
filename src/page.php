<?php get_header(); ?>
<div id="container">
    <?php get_sidebar(); ?>
	<div id="content">
        <div id="content-inner">
		    <?php nackasmu_get_breadcrumbs();?>
			<?php the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h1 class="entry-title">
					<?php the_title(); ?>
				</h1>
				<div class="entry-content">
					<?php the_content(); ?>
	                <div style="clear: both"></div>
					
					<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', THEME_NAME ) . '&after=</div>') ?>
					
	                <?php nackasmu_print_child_pages($post->ID); ?>
	
				</div>
                <div class="entry-meta">
				    <?php include( "include-entry-meta.php" ); ?>
				</div>
				<div class="entry-utility">
					<?php
					include( "include-entry-utilities-bookmarklink.php" );
					include( "include-entry-utilities-commentsandtrackbacks.php" );
					include( "include-entry-utilities-editlink.php" );
					include( "include-entry-utilities-printlink.php" );
					?>
				</div>
			</div>
			<?php comments_template('', true); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>