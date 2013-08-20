<?php
if ( nackasmu_multichoiceoption_is_set( NACKASMU_OPTION_ENTRYUTILITIES , NACKASMU_OPTIONVALUE_ENTRYUTILITIES_EDITLINK ) ) {
    edit_post_link( __( 'Edit', THEME_NAME ), '<span class="edit-link">', '.</span> ' );
}
?>