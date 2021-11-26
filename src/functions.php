<?php
define("THEME_NAME", "scouting");
define("THEME_NAME_PRETTY", "Scouting");

define("NACKASMU_OPTION_PRINTCOMMENTS", "print_comments");

define("NACKASMU_OPTION_ENTRYMETADATA", "entry_metadata");
define("NACKASMU_OPTIONVALUE_ENTRYMETADATA_AUTHOR", "Author");
define("NACKASMU_OPTIONVALUE_ENTRYMETADATA_PUBLISHINGDATE", "Publishing date");
define("NACKASMU_OPTIONVALUE_ENTRYMETADATA_EDITLINK", "Edit link");
define("NACKASMU_OPTIONVALUE_ENTRYMETADATA_CATSANDTAGS", "Categories and tags");

define("NACKASMU_OPTION_ENTRYUTILITIES", "entry_utilities");
define("NACKASMU_OPTIONVALUE_ENTRYUTILITIES_PRINTLINK", "Print link");
define("NACKASMU_OPTIONVALUE_ENTRYUTILITIES_BOOKMARKPERMALINK", "Bookmark permalink");
define("NACKASMU_OPTIONVALUE_ENTRYUTILITIES_COMMENTANDPINGTRACKBACKLINKS", "Comment and ping/trackback links");
define("NACKASMU_OPTIONVALUE_ENTRYUTILITIES_EDITLINK", "Edit link");


/* http://clark-technet.com/2010/01/wordpress-theme-options-framework-ver-2 */
require_once(TEMPLATEPATH . '/controlpanel.php');

define("THEME_WIDGETAREA_BEFOREWIDGET", '<div id="%1$s" class="widget-container %2$s">');
define("THEME_WIDGETAREA_AFTERWIDGET", '</div>');
define("THEME_WIDGETAREA_BEFORETITLE", '<h3 class="widget-title">');
define("THEME_WIDGETAREA_AFTERTITLE", '</h3>');
define("THEME_WIDGETAREA_ABOVEMENU_NAME", "Above Menu");
define("THEME_WIDGETAREA_ABOVEMENU_ID", "above_menu_widget_area");
define("THEME_WIDGETAREA_BELOWMENU_NAME", "Below Menu");
define("THEME_WIDGETAREA_BELOWMENU_ID", "below_menu_widget_area");
define("THEME_WIDGETAREA_FOOTER_NAME", "Footer");
define("THEME_WIDGETAREA_FOOTER_ID", "footer_widget_area");

//load_theme_textdomain( THEME_NAME, TEMPLATEPATH . '/languages' );

$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if ( is_readable($locale_file) ) {
	require_once($locale_file);
}

add_action( "init", "nackasmu_init_widgetareas" );

function nackasmu_adding_scripts() {
	wp_register_script('nackasmu_theme_script', get_template_directory_uri().'/menu.js', array(), filemtime(__DIR__ .'/menu.js'), true);
	wp_enqueue_script('nackasmu_theme_script');
}
	
add_action( 'wp_enqueue_scripts', 'nackasmu_adding_scripts' );  	

load_theme_textdomain( THEME_NAME );

$preset_widgets = array (
		THEME_WIDGETAREA_ABOVEMENU_ID  => array( 'recentposts' ),
		THEME_WIDGETAREA_BELOWMENU_ID  => array( 'pages' ),
		THEME_WIDGETAREA_FOOTER_ID  => array(  )
		);
if ( isset( $_GET['activated'] ) ) {
	update_option( 'sidebars_widgets', $preset_widgets );
}
// update_option( 'sidebars_widgets', NULL );

//function nackasmu_register_menus() {
//    register_nav_menus(
//        array(
//            'primary' => __( 'Main Menu' )
//        )
//    );    
//}
//add_action( 'init', 'nackasmu_register_menus' );

function nackasmu_get_page_number() {
	if ( get_query_var('paged') ) {
		print ' | ' . __( 'Page ' , THEME_NAME ) . get_query_var( 'paged' );
	}
}

function nackasmu_init_widgetareas() {
	register_sidebar( array (
			"name" => THEME_WIDGETAREA_ABOVEMENU_NAME,
			"id" => THEME_WIDGETAREA_ABOVEMENU_ID,
			"before_widget" => THEME_WIDGETAREA_BEFOREWIDGET,
			"after_widget" => THEME_WIDGETAREA_AFTERWIDGET,
			"before_title" => THEME_WIDGETAREA_BEFORETITLE,
			"after_title" => THEME_WIDGETAREA_AFTERTITLE,
			) );
	register_sidebar( array (
			"name" => THEME_WIDGETAREA_BELOWMENU_NAME,
			"id" => THEME_WIDGETAREA_BELOWMENU_ID,
			"before_widget" => THEME_WIDGETAREA_BEFOREWIDGET,
			"after_widget" => THEME_WIDGETAREA_AFTERWIDGET,
			"before_title" => THEME_WIDGETAREA_BEFORETITLE,
			"after_title" => THEME_WIDGETAREA_AFTERTITLE,
			) );
	register_sidebar( array (
			"name" => THEME_WIDGETAREA_FOOTER_NAME,
			"id" => THEME_WIDGETAREA_FOOTER_ID,
			"before_widget" => THEME_WIDGETAREA_BEFOREWIDGET,
			"after_widget" => THEME_WIDGETAREA_AFTERWIDGET,
			"before_title" => THEME_WIDGETAREA_BEFORETITLE,
			"after_title" => THEME_WIDGETAREA_AFTERTITLE,
			) );
}

function nackasmu_is_multipage() {
	global $wp_query;
	return $wp_query->max_num_pages > 1;
}

function nackasmu_custom_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	$GLOBALS['comment_depth'] = $depth;
	printf( '<li id="comment-%s" class="%s">', get_comment_ID(), implode(" ", get_comment_class()));
	print '<div class="comment-author vcard">';
	commenter_link();
	print '</div>';
	print '<div class="comment-content">';
	comment_text();
	print '</div>';

	print( '<div class="comment-meta">' );
    printf( __( 'Posted %1$s at %2$s' , THEME_NAME ) ,
            get_comment_date() ,
            get_comment_time() );
	print( '.' );
	if ($comment->comment_approved == '0') {
       printf( ' <span class="unapproved">%s.</span>' , __('Your comment is awaiting moderation' , THEME_NAME ) );
	}
	print( '</div>' );
	print( '<div class="comment-utilities">' );

    // echo the comment reply link
    if($args['type'] == 'all' || get_comment_type() == 'comment') {
        comment_reply_link(array_merge($args, array(
                'reply_text' => __( 'Reply to comment' , THEME_NAME ),
                'login_text' => __( 'Log in to reply.' , THEME_NAME ),
                'depth' => $depth,
                'before' => '<span class="comment-reply-link">',
                'after' => '.</span> '
                )));
    }
    if ( nackasmu_is_setting_enabled( NACKASMU_OPTION_ENTRYUTILITIES , 'entryutilities_editlink' ) ) {
		edit_comment_link(__( 'Edit' , THEME_NAME ),
				'<span class="edit-link">',
				'.</span> ');
    }
    if ( nackasmu_is_setting_enabled( NACKASMU_OPTION_ENTRYUTILITIES , 'entryutilities_bookmarkpermalink' ) ) {
		printf('<span class="permalink"><a href="#comment-%1$s" title="%2$s">%3$s</a>.</span> ',
			    get_comment_ID(),
			    __( 'Permalink to this comment' , THEME_NAME ),
			    __( 'Permalink' , THEME_NAME ) );
    }
	print( '</div>' );
}

function nackasmu_custom_pings($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	printf( '<li id="comment-%s" class="%s">', get_comment_ID(), implode(' ', get_comment_class()) );
	print '<div class="comment-author">' ;
	_e('By ', THEME_NAME);
	print get_comment_author_link();
	print '</div>';
	print '<div class="comment-content">';
	comment_text();
	print '</div>';
    print( '<div class="comment-meta">' );
    printf( __( 'Posted %1$s at %2$s' , THEME_NAME ) ,
            get_comment_date() ,
            get_comment_time() );
    if ($comment->comment_approved == '0') {
       printf( '<span class="unapproved">%s.</span>' , __('Your trackback is awaiting moderation' , THEME_NAME ) );
    }
    print '</div>';
	print( '<div class="comment-utilities">' );
	if ( nackasmu_is_setting_enabled( NACKASMU_OPTION_ENTRYUTILITIES , 'entryutilities_editlink' ) ) {
		edit_comment_link(__( 'Edit' , THEME_NAME ),
	            '<span class="edit-link">',
	            '.</span> ');
    }
	print '</div>';
}

function commenter_link() {
	$commenter = get_comment_author_link();
	if ( preg_match( '/<a[^>]* class=[^>]+>/', $commenter ) ) {
		$commenter = preg_replace( '/(<a[^>]* class=[\'"]?)/', '$1url ' , $commenter );
	} else {
		$commenter = preg_replace( '/(<a )\\//', '$1class="url "' , $commenter );
	}
	$avatar_email = get_comment_author_email();
	$avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, 80 ) );
	echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
}

function nackasmu_categories($glue) {
	$current_cat = single_cat_title( '', false );
	$separator = "\n";
	$cats = explode( $separator, get_the_category_list($separator) );
	foreach ( $cats as $i => $str ) {
		if ( strstr( $str, ">$current_cat<" ) ) {
			unset($cats[$i]);
			break;
		}
	}
	if ( empty($cats) ) {
		return false;
	}
	return trim(join( $glue, $cats ));
}

// For tag lists on tag archives: Returns other tags except the current one (redundant)
function nackasmu_tags($glue) {
	$current_tag = single_tag_title( '', '',  false );
	$separator = "\n";
	$tags = explode( $separator, get_the_tag_list( "", $separator, "" ) );
	foreach ( $tags as $i => $str ) {
		if ( strstr( $str, ">$current_tag<" ) ) {
			unset($tags[$i]);
			break;
		}
	}
	if ( empty($tags) ) {
		return false;
	}
	return trim(join( $glue, $tags ));
}

/**
 * http://www.itsananderson.com/2008/12/creating-breadcrumb-navigation-in-wordpress/
 */
function nackasmu_get_breadcrumbs() {
    global $post;

	if ( ! nackasmu_is_setting_enabled( NACKASMU_OPTION_ENTRYUTILITIES , 'entryutilities_breadcrumbs' ) ) {
		return '';
	}

    $separator = '  &rsaquo; '; // what to place between the pages

    echo "<div class='breadcrumbs'>";
    if ( is_page() ) {
        // bread crumb structure only logical on pages
        $trail = array($post); // initially $trail only contains the current page
        $parent = $post; // initially set to current post
        $show_on_front = get_option( 'show_on_front'); // does the front page display the latest posts or a static page
        $page_on_front = get_option( 'page_on_front' ); // if it shows a page, what page
        // while the current page isn't the home page and it has a parent
        while ( $parent->post_parent && !($parent->ID == $page_on_front && 'page') == $show_on_front ){
            $parent = get_post( $parent->post_parent ); // get the current page's parent
            array_unshift( $trail, $parent ); // add the parent object to beginning of array
        }
        if ( 'posts' == $show_on_front ) { // if the front page shows latest posts, simply display a home link
            echo "<span class='breadcrumb-item' id='breadcrumb-0'><a href='" . get_bloginfo('home') . "'>Hem</a></span>\n"; // home page link
        } else { // if the front page displays a static page, display a link to it
            $home_page = get_post( $page_on_front ); // get the front page object
            echo "<span class='breadcrumb-item' id='breadcrumb-{$home_page->ID}'><a href='" . get_bloginfo('home') . "'>$home_page->post_title</a></span>\n"; // home page link
            if( $trail[0]->ID == $page_on_front ) // if the home page is an ancestor of this page
                array_shift( $trail ); // remove the home page from the $trail because we've already printed it
        }
        foreach ( $trail as $page ) {
            // print the link to the current page in the foreach
            echo "<span class='breadcrumb-item' id='breadcrumb-{$page->ID}' >$separator\n";
            if ( $page->ID == $post->ID ) {
                echo $page->post_title;
			} else {
                echo "<a href='" . get_page_link( $page->ID ) . "'>{$page->post_title}</a>";
			}
            echo "</span>\n";
        }
    } else {
        // if what we're looking at isn't a page, simply display a home link
        echo "<span class='breadcrumb-item' id='breadcrumb-0'><a href='" . get_bloginfo('home') . "'>Hem</a></span>\n"; // home page link
        echo "<span class='breadcrumb-item' id='breadcrumb-{$post->ID}' >$separator\n";
        echo $post->post_title;
        echo "</span>\n";
    }
    echo "</div>";
}

function nackasmu_print_child_pages($id) {
    $args = array(
            "title_li" => "",
            "child_of" => $id,
            "echo" => 0);
	$children = wp_list_pages($args);
	if ( $children ) {
	   print '<div class="child-pages">';
	   print __( 'Further reading:', THEME_NAME );
	   print '<ul>';
	   print $children;
	   print '</ul>';
	   print '</div>';
	}
}

function nackasmu_theme_setup() {
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 400,
		'flex-width' => true,
	) );
}
add_action( 'after_setup_theme', 'nackasmu_theme_setup' );

function nackasmu_print_logo() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	if (is_numeric ($custom_logo_id)) {
		$custom_logo_url = wp_get_attachment_image_url( $custom_logo_id , 'full' );
		$link_content = sprintf('<img src="%s" alt="">', esc_url( $custom_logo_url ));
	} else {
		$link_content = sprintf('<div id="blog-title">%s</div>', get_bloginfo('name'));
		// Add blog description?
	}
	printf('<a href="%s/" title="%s" rel="home">%s</a>', get_bloginfo('url'), get_bloginfo('name'), $link_content);
}

?>