<?php get_header(); ?>
<div id="container">
    <?php if (nackasmu_is_mobile()) { get_sidebar(); } ?>
	<div id="content">
	    <div id="content-inner">
	        <?php nackasmu_get_breadcrumbs();?>
			<?php if ( nackasmu_is_multipage() ) { ?>
				<div id="nav-above" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">&laquo;</span> %title' ) ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">&raquo;</span>' ) ?></div>
				</div>
			<?php } ?>
			<?php the_post(); /* Why should this call be necessary? */ ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h1 class="entry-title">
					<?php the_title(); ?>
				</h1>
				<div class="entry-content">
					<?php the_content(); ?>
					<div style="clear: both"></div>
					
					<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', THEME_NAME ) . '&after=</div>') ?>
				</div>
                <div class="entry-meta">
                    <?php include( "include-entry-meta.php" ); ?>
					<?php 
                    if ( nackasmu_multichoiceoption_is_set( NACKASMU_OPTION_ENTRYMETADATA , NACKASMU_OPTIONVALUE_ENTRYMETADATA_CATSANDTAGS ) ) {
                        print '<span class="catsandtags-links">';
						printf( __( 'This entry was posted in %1$s%2$s.', THEME_NAME ),
								get_the_category_list(', '),
								get_the_tag_list( __( ' and tagged ', THEME_NAME ), ', ', '' )  );
						print '</span>';
                    }
					?>
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
			<?php if ( nackasmu_is_multipage() ) { ?>
				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">&laquo;</span> %title' ) ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">&raquo;</span>' ) ?></div>
				</div>
			<?php } ?>
			<?php comments_template('', true); ?>
		</div>
	</div>
	<?php if (!nackasmu_is_mobile()) { get_sidebar(); } ?>
</div>
<?php get_footer(); ?>