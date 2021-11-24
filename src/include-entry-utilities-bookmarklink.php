<?php
if ( nackasmu_is_setting_enabled( NACKASMU_OPTION_ENTRYUTILITIES , 'entryutilities_bookmarkpermalink' ) ) {
                    printf( __( 'Bookmark the <a href="%1$s" title="Permalink to %2$s" rel="bookmark">permalink</a>. ', THEME_NAME ),
                            get_permalink(),
                            the_title_attribute('echo=0') );
}
?>