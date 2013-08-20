<?php get_header(); ?>
<div id="container">
    <?php if (nackasmu_is_mobile()) { get_sidebar(); } ?>
	<div id="content">
	    <div id="content-inner">
			<?php the_post(); ?>
	        <h1 class="page-title">
	        	<?php _e( 'Articles tagged ', THEME_NAME ) ?>
	        	<span><?php single_tag_title() ?></span>
	        </h1>
			<?php rewind_posts(); ?>
			<?php if (nackasmu_is_multipage()) { ?>
				<div id="nav-above" class="navigation">
					<div class="nav-previous"><?php next_posts_link(__( '<span class="meta-nav">&laquo;</span> Older posts', THEME_NAME )) ?></div>
					<div class="nav-next"><?php previous_posts_link(__( 'Newer posts <span class="meta-nav">&raquo;</span>', THEME_NAME )) ?></div>
				</div>
			<?php } ?>
			<?php while (have_posts() ) { the_post(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h2 class="entry-title">
						<a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', THEME_NAME), the_title_attribute('echo=0') ); ?>" rel="bookmark">
							<?php the_title(); ?>
						</a>
					</h2>
					<div class="entry-summary">
						<?php the_excerpt( __( 'Continue reading <span class="meta-nav">&raquo;</span>', THEME_NAME ) ); ?>
					</div>
	                <div class="entry-meta">
	                    <?php include( "include-entry-meta.php" ); ?>
						<?php if ( nackasmu_multichoiceoption_is_set( NACKASMU_OPTION_ENTRYMETADATA , NACKASMU_OPTIONVALUE_ENTRYMETADATA_CATSANDTAGS ) ) { ?>
							<span class="cat-links"><span class="entry-utility-prep entry-utility-prep-cat-links"><?php _e( 'Posted in ', THEME_NAME ); ?></span><?php echo get_the_category_list(', '); ?>.</span>
							<?php if ( $nackasmu_tags = nackasmu_tags(', ') ) { ?>      
								<span class="tag-links"><?php printf( __( 'Also tagged %s', THEME_NAME ), $nackasmu_tags ) ?>.</span>
							<?php } ?>
						<?php } ?>
	                </div>
					<div class="entry-utility">
                        <?php include( "include-entry-utilities-commentslink.php" ); ?>
						
						<?php include( "include-entry-utilities-editlink.php" ); ?>
					</div>
				</div>
			<?php } ?>
			<?php if (nackasmu_is_multipage()) { ?>
				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php next_posts_link(__( '<span class="meta-nav">&laquo;</span> Older posts', THEME_NAME )) ?></div>
					<div class="nav-next"><?php previous_posts_link(__( 'Newer posts <span class="meta-nav">&raquo;</span>', THEME_NAME )) ?></div>
				</div>
			<?php } ?>
	   </div>
	</div>
	<?php if (!nackasmu_is_mobile()) { get_sidebar(); } ?>
</div>
<?php get_footer(); ?>