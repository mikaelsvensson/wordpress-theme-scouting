<?php
if ( nackasmu_multichoiceoption_is_set( NACKASMU_OPTION_ENTRYUTILITIES , NACKASMU_OPTIONVALUE_ENTRYUTILITIES_COMMENTANDPINGTRACKBACKLINKS ) ) {
                    printf( __( 'Follow any comments here with the <a href="%2$s" title="Comments RSS to %1$s" rel="alternate" type="application/rss+xml">RSS feed for this post</a>. ', THEME_NAME ),
                            the_title_attribute('echo=0'),
                            comments_rss() );
                    if ( ('open' == $post->comment_status) && ('open' == $post->ping_status) ) { // Comments and trackbacks open
                        printf( __( '<a class="comment-link" href="#respond" title="Post a comment">Post a comment</a> or leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', THEME_NAME ), get_trackback_url() );
                    } elseif ( !('open' == $post->comment_status) && ('open' == $post->ping_status) ) { // Only trackbacks open
                        printf( __( 'Comments are closed, but you can leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', THEME_NAME ), get_trackback_url() );
                    } elseif ( ('open' == $post->comment_status) && !('open' == $post->ping_status) ) { // Only comments open
                        _e( 'Trackbacks are closed, but you can <a class="comment-link" href="#respond" title="Post a comment">post a comment</a>.', THEME_NAME );
                    } elseif ( !('open' == $post->comment_status) && !('open' == $post->ping_status) ) { // Comments and trackbacks closed
                        _e( 'Both comments and trackbacks are currently closed.', THEME_NAME );
                    }
}
?>