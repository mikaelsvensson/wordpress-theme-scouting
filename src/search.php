<?php get_header(); ?>
<div id="container">
	<div id="content">
	    <div id="content-inner">
			<?php if ( have_posts() ) { ?>
	    		<h1 class="page-title">
	    			<?php _e( 'Articles related to ', THEME_NAME ); ?>
	    			<span><?php the_search_query(); ?></span>
	    		</h1>
		    	<?php if (nackasmu_is_multipage()) { ?>
					<div id="nav-above" class="navigation">
						<div class="nav-previous"><?php next_posts_link(__( '<span class="meta-nav">&laquo;</span> Older posts', THEME_NAME )) ?></div>
						<div class="nav-next"><?php previous_posts_link(__( 'Newer posts <span class="meta-nav">&raquo;</span>', THEME_NAME )) ?></div>
					</div>
				<?php } ?>
	    		
				<?php while ( have_posts() ) { the_post(); ?>
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<h2 class="entry-title">
							<a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', THEME_NAME), the_title_attribute('echo=0') ); ?>" rel="bookmark">
								<?php the_title(); ?>
							</a>
						</h2>
						
						<div class="entry-summary">
							<?php the_excerpt( __( 'Continue reading <span class="meta-nav">&raquo;</span>', THEME_NAME )  ); ?>
							<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', THEME_NAME ) . '&after=</div>') ?>
						</div>
						
						<?php if ( $post->post_type == "post") { ?>
			                <div class="entry-meta">
			                    <?php include( "include-entry-meta.php" ); ?>
		                        <?php include( "include-entry-meta-catsandtags.php" ); ?>
			                </div>
						<?php } ?>
						<?php if ( $post->post_type == 'post' ) { ?>        
							<div class="entry-utility">
                                <?php include( "include-entry-utilities-commentslink.php" ); ?>
								
								<?php include( "include-entry-utilities-editlink.php" ); ?>
							</div>
						<?php } ?>    
					</div>
				<?php } ?>
				<?php if ( nackasmu_is_multipage() ) { ?>
					<div id="nav-below" class="navigation">
						<div class="nav-previous"><?php next_posts_link(__( '<span class="meta-nav">&laquo;</span> Older posts', THEME_NAME )) ?></div>
						<div class="nav-next"><?php previous_posts_link(__( 'Newer posts <span class="meta-nav">&raquo;</span>', THEME_NAME )) ?></div>
					</div>
				<?php } ?>  
	
			<?php } else { ?>
				<div id="post-0" class="post no-results not-found">
					<h1 class="entry-title">
						<?php _e( 'Nothing Found', THEME_NAME ) ?>
					</h1>
					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', THEME_NAME ); ?></p>
						<?php get_search_form(); ?>      
					</div><!– .entry-content –>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>