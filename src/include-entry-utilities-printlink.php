<?php
if ( nackasmu_is_setting_enabled( NACKASMU_OPTION_ENTRYUTILITIES , 'entryutilities_printlink' ) ) {
    printf( '<span class="print-link"><a class="post-print-link" href="javascript:void(0);" onclick="window.print(); return false;">%s</a>.</span>', __( 'Print page' , THEME_NAME ) );
}
?>