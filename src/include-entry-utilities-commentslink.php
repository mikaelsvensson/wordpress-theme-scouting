<?php if ( nackasmu_multichoiceoption_is_set( NACKASMU_OPTION_ENTRYUTILITIES , NACKASMU_OPTIONVALUE_ENTRYUTILITIES_COMMENTANDPINGTRACKBACKLINKS ) ) { ?>
    <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', THEME_NAME ), __( '1 comment', THEME_NAME ), __( '% comments', THEME_NAME ) ) ?></span>
<?php } ?>