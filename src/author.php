<?php get_header(); ?>
<div id="container">
	<div id="content">
	    <div id="content-inner">
			<?php the_post(); ?>
			<h1 class="page-title author">
				<?php 
				printf( __( 'Articles by <span class="vcard">%s</span>', THEME_NAME ), 
						"<a class='url fn n' href='$authordata->user_url' title='$authordata->display_name' rel='me'>$authordata->display_name</a>" 
						); ?>
			</h1>
			<?php
			$authordesc = $authordata->user_description;
			if ( !empty($authordesc) ) {
				echo apply_filters( 'archive_meta', '<div class="archive-meta">' . $authordesc . '</div>' ); 
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