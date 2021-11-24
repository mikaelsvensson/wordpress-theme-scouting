<?php if ( nackasmu_is_setting_enabled( NACKASMU_OPTION_ENTRYUTILITIES , 'entryutilities_commentandpingtrackbacklinks' ) ) { ?>
    <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', THEME_NAME ), __( '1 comment', THEME_NAME ), __( '% comments', THEME_NAME ) ) ?></span>
<?php } ?>