<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php
        $siteTitle = get_bloginfo('name') . ', ' . get_bloginfo('description');

        if (is_single()) {
            print "$siteTitle - ";
            single_post_title();
        } elseif (is_home() || is_front_page()) {
            print $siteTitle;
            nackasmu_get_page_number();
        } elseif (is_page()) {
            print "$siteTitle - ";
            single_post_title('');
        } elseif (is_search()) {
            print "$siteTitle - ";
            print __('Articles related to ', THEME_NAME) . wp_specialchars($s);
            nackasmu_get_page_number();
        } elseif (is_404()) {
            print $siteTitle;
        } else {
            print "$siteTitle - ";
            wp_title(' ');
            nackasmu_get_page_number();
        }
        ?></title>

    <link rel="stylesheet"
          type="text/css"
          href="<?= get_stylesheet_directory_uri() ?>/style.css?<?=filemtime(dirname( __FILE__ ) . '/style.css')?>"/>

    <link rel="stylesheet"
          type="text/css"
          href="<?= get_stylesheet_directory_uri() ?>/style-plugins.css?<?=filemtime(dirname( __FILE__ ) . '/style-plugins.css')?>"/>

    <?php if (is_singular()) wp_enqueue_script('comment-reply'); ?>

    <?php wp_head(); ?>

    <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>"
          title="<?php printf(__('%s latest posts', THEME_NAME), wp_specialchars(get_bloginfo('name'), 1)); ?>"/>
    <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>"
          title="<?php printf(__('%s latest comments', THEME_NAME), wp_specialchars(get_bloginfo('name'), 1)); ?>"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
</head>


<body>
<div id="nackasmu-header-container">
    <div class="nackasmu-content-wrapper">
        <div id="nackasmu-logo">
            <?php nackasmu_print_logo(); ?>
        </div>
        <nav id="site-menu-button">
            <button aria-expanded="false" aria-controls="menu">
                <div id="site-menu-button-icon">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </button>
            <div id="access">
                <div class="skip-link"><a href="#content" title="<?php _e('Skip to content', THEME_NAME) ?>"><?php _e('Skip to content', THEME_NAME) ?></a></div>
            </div>
        </nav>
    </div>
</div>
<div class="wrapper" class="hfeed">
    <nav id="site-menu">
        <?php if ( is_active_sidebar( THEME_WIDGETAREA_ABOVEMENU_ID )) { ?>
			<div id="widget-area-abovemenu" class="widget-area">
				<?php dynamic_sidebar( THEME_WIDGETAREA_ABOVEMENU_ID ); ?>
			</div>
		<?php } ?>
        <div class="site-menu-container">
            <?php
            wp_page_menu(array(
                'sort_column' => 'menu_order',
                'show_home'   => true,
                // 'container' => 'nav',
                // 'menu_class' => 'navigation',
                // 'before' => '<div class="navigation-menu-container" hidden><ul>',
                // 'after' => '</ul></div>',
                'link_before' => '',
                'link_after'  => '' ));
            ?>
        </div>
		<?php if ( is_active_sidebar( THEME_WIDGETAREA_BELOWMENU_ID )) { ?>
			<div id="widget-area-belowmenu" class="widget-area">
				<?php dynamic_sidebar( THEME_WIDGETAREA_BELOWMENU_ID ); ?>
			</div>
		<?php } ?>
    </nav>
    <div id="main">