<?php if ( nackasmu_multichoiceoption_is_set( NACKASMU_OPTION_ENTRYMETADATA , NACKASMU_OPTIONVALUE_ENTRYMETADATA_AUTHOR ) ) { ?>
	<span class="meta-prep meta-prep-author"><?php _e('By ', THEME_NAME ); ?></span>
	<span class="author vcard"><a class="url fn n" href="<?php echo get_author_link( false, $authordata->ID, $authordata->user_nicename ); ?>" title="<?php printf( __( 'View all posts by %s', THEME_NAME ), $authordata->display_name ); ?>"><?php the_author(); ?></a></span>.
<?php } ?>
<?php if ( nackasmu_multichoiceoption_is_set( NACKASMU_OPTION_ENTRYMETADATA , NACKASMU_OPTIONVALUE_ENTRYMETADATA_PUBLISHINGDATE ) ) { ?>
	<span class="meta-prep meta-prep-entry-date"><?php _e('Published ', THEME_NAME ); ?></span>
	<span class="entry-date"><abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO') ?>"><?php the_time( get_option( 'date_format' ) ); ?></abbr></span>.
<?php } ?>
