<?php get_header(); ?>
<div id="container">
    <?php get_sidebar(); ?>
	<div id="content">
        <div id="content-inner">
			<?php the_post(); ?>
			<?php
			$page_title = ""; 
			$page_subtitle = "";
			if ( is_day() ) {
				$page_title = __( 'Daily Archives', THEME_NAME );
				$page_subtitle = get_the_time(get_option('date_format'));
			} elseif ( is_month() ) {
				$page_title = __( 'Monthly Archives', THEME_NAME );
				$page_subtitle = get_the_time('F Y');
			} elseif ( is_year() ) {
				$page_title = __( 'Yearly Archives', THEME_NAME );
				$page_subtitle = get_the_time('Y');
			} elseif ( isset($_GET['paged']) && !empty($_GET['paged']) ) {
				$page_title = __( 'Blog Archives', THEME_NAME );
			}
			
			if ( $page_title != "" && $page_subtitle != "") {
				printf( '<h1 class="page-title">%s: <span>%s</span></h1>', $page_title, $page_subtitle);
			} elseif ( $page_title != "") {
				printf( '<h1 class="page-title">%s</h1>', $page_title);
			}
			?>
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
</div>
<?php get_footer(); ?>