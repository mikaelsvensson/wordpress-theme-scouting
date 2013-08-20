<?php
if ( nackasmu_multichoiceoption_is_set( NACKASMU_OPTION_ENTRYUTILITIES , NACKASMU_OPTIONVALUE_ENTRYUTILITIES_BOOKMARKPERMALINK ) ) {
                    printf( __( 'Bookmark the <a href="%1$s" title="Permalink to %2$s" rel="bookmark">permalink</a>. ', THEME_NAME ),
                            get_permalink(),
                            the_title_attribute('echo=0') );
}
?>