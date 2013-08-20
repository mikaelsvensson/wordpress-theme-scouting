<?php get_header(); ?>
<div id="container">
    <?php if (nackasmu_is_mobile()) { get_sidebar(); } ?>
	<div id="content">
    	<div id="content-inner">
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
					<div class="entry-content">
						<?php the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', THEME_NAME )  ); ?>
						<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', THEME_NAME ) . '&after=</div>') ?>
					</div>
	                <div class="entry-meta">
	                    <?php include( "include-entry-meta.php" ); ?>
                        <?php include( "include-entry-meta-catsandtags.php" ); ?>
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