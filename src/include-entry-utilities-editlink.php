<?php
if ( nackasmu_is_setting_enabled( NACKASMU_OPTION_ENTRYUTILITIES , 'entryutilities_editlink' ) ) {
    edit_post_link( __( 'Edit', THEME_NAME ), '<span class="edit-link">', '.</span> ' );
}
?>