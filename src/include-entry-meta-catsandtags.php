<?php if ( nackasmu_multichoiceoption_is_set( NACKASMU_OPTION_ENTRYMETADATA , NACKASMU_OPTIONVALUE_ENTRYMETADATA_CATSANDTAGS ) ) { ?>
    <span class="catsandtags-links">
	    <span class="cat-links"><span class="entry-utility-prep entry-utility-prep-cat-links"><?php _e( 'Posted in ', THEME_NAME ); ?></span><?php echo get_the_category_list(', '); ?>.</span>
	    <?php the_tags( '<span class="tag-links"><span class="entry-utility-prep entry-utility-prep-tag-links">' . __('Tagged ', THEME_NAME ) . '</span>', ", ", '.</span>' ) ?>
    </span>
<?php } ?>