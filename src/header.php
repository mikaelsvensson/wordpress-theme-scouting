<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
	<title><?php
	$siteTitle = get_bloginfo('name') . ', ' . get_bloginfo('description'); 
	
	if ( is_single() ) { 
        print "$siteTitle - "; 
	   single_post_title(); 
	} elseif ( is_home() || is_front_page() ) { 
		print $siteTitle; 
		nackasmu_get_page_number(); 
	} elseif ( is_page() ) { 
        print "$siteTitle - "; 
		single_post_title('');
	} elseif ( is_search() ) { 
        print "$siteTitle - "; 
        print __( 'Articles related to ', THEME_NAME ) . wp_specialchars($s);
        nackasmu_get_page_number(); 
	} elseif ( is_404() ) { 
        print $siteTitle; 
	} else { 
        print "$siteTitle - "; 
		wp_title(' '); 
		nackasmu_get_page_number(); 
	}
	?></title>
	
	<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
    
	<?php require_once(nackasmu_is_mobile() ? 'header-style-mobile.php' : 'header-style-desktop.php') ?>
	
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	
	<?php
	if (is_single() || is_page()) {
		if ($jsSrc = get_post_meta($post->ID, 'scouting-javascript-src', true)) {
			wp_enqueue_script( 'jquery' );
	        $jsSrcCounter = 0;
	        foreach (explode(' ', $jsSrc) as $value) {
	            $scriptName = 'scouting-custom-js-' . $jsSrcCounter;
				wp_deregister_script( $scriptName );
				wp_register_script( $scriptName, $value);
				wp_enqueue_script( $scriptName );
	            
	            $jsSrcCounter++;
	        }
		}
		if ($cssSrc = get_post_meta($post->ID, 'scouting-css-src', true)) {
	        $cssSrcCounter = 0;
	        foreach (explode(' ', $cssSrc) as $value) {
                $cssName = 'scouting-custom-css-' . $cssSrcCounter;
                wp_deregister_style( $cssName );
                wp_register_style( $cssName, $value);
                wp_enqueue_style( $cssName );
                
                $cssSrcCounter++;
            }
		}
	}
	?>	
	
	<?php wp_head(); ?>
	
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/style-contactform7.css" />
	
	<?php
	if (is_single() || is_page()) {
        if ($css = get_post_meta($post->ID, 'scouting-css', true)) {
            echo '<style type="text/css">'.$css.'</style>';
        }
        if ($js = get_post_meta($post->ID, 'scouting-javascript-ondomready', true)) {
			echo '
                <script type="text/javascript">
					jQuery.noConflict();
					(function($) {
						$(document).ready(function() { 
							var entryContentElement = $("div.entry-content").get(0);
							'.$js.'
						} );
					})(jQuery);
                </script>
                ';
		}
	}
	?>
	
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" title="<?php printf( __( '%s latest posts', THEME_NAME ), wp_specialchars( get_bloginfo('name'), 1 ) ); ?>" />
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', THEME_NAME ), wp_specialchars( get_bloginfo('name'), 1 ) ); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<meta content = "width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" name = "viewport" /> 
</head>


<body class="<?php echo nackasmu_is_mobile() ? 'client-mobile' : 'client-desktop' ?>">
<div id="wrapper" class="hfeed">
	<div id="header">
		<div id="master"></div>
		<div id="branding">
			<div id="blog-title">
				<span><a href="<?php bloginfo( 'url' ) ?>/" title="<?php bloginfo( 'name' ) ?>" rel="home"><?php bloginfo( 'name' ) ?></a><span class="blog-title-comma">,</span></span>
			</div>
			<?php if ( is_home() || is_front_page() ) { ?>
				<div id="blog-description">
					<?php bloginfo( 'description' ) ?>
				</div>
			<?php } else { ?>
				<h1 id="blog-description">
					<?php bloginfo( 'description' ) ?>
				</h1>
			<?php }?>
		</div>
		<?php if ( is_active_sidebar( THEME_WIDGETAREA_HEADER_ID )) { ?>
			<div id="widget-area-header" class="widget-area">
				<?php dynamic_sidebar( THEME_WIDGETAREA_HEADER_ID ); ?>
			</div>
		<?php } ?>
		<div id="access">
			<div class="skip-link"><a href="#content" title="<?php _e( 'Skip to content', THEME_NAME ) ?>"><?php _e( 'Skip to content', THEME_NAME ) ?></a></div>
		</div>
	</div>
	<div id="main">