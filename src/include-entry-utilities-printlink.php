<?php
if ( nackasmu_multichoiceoption_is_set( NACKASMU_OPTION_ENTRYUTILITIES , NACKASMU_OPTIONVALUE_ENTRYUTILITIES_PRINTLINK ) ) {
    printf( '<span class="print-link"><a class="post-print-link" href="javascript:void(0);" onclick="window.print(); return false;">%s</a>.</span>', __( 'Print page' , THEME_NAME ) );
}
?>