<?php get_header(); ?>
<div id="container">
    <?php get_sidebar(); ?>
	<div id="content">
	    <div id="content-inner">
			<?php the_post(); ?>
	        <h1 class="page-title">
	        	<?php _e( 'Articles in category ', THEME_NAME ) ?>
	        	<span><?php single_cat_title() ?></span>
	        </h1>
	        <?php $categorydesc = category_description(); if ( !empty($categorydesc) ) echo apply_filters( 'archive_meta', '<div class="archive-meta">' . $categorydesc . '</div>' ); ?>
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
                            <span class="catsandtags-links">
								<?php if ( $nackasmu_categories = nackasmu_categories(', ') ) { ?>
									<span class="cat-links"><?php printf( __( 'Also posted in %s', THEME_NAME ), $nackasmu_categories ) ?>.</span>
								<?php } ?>
								<?php the_tags( '<span class="tag-links"><span class="entry-utility-prep entry-utility-prep-tag-links">' . __('Tagged ', THEME_NAME ) . '</span>', ", ", '.</span>' ) ?>
							</span>
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
</div>
<?php get_footer(); ?>