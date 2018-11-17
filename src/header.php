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
          href="<?php bloginfo('stylesheet_url'); ?>?<?=filemtime(dirname( __FILE__ ) . '/style.css')?>"/>
    <link rel="stylesheet"
          type="text/css"
          media="screen and (min-width: 768px)"
          href="<?php bloginfo('stylesheet_directory'); ?>/style-device-large.css?<?=filemtime(dirname( __FILE__ ) . '/style-device-large.css')?>"/>
    <link rel="stylesheet"
          type="text/css"
          media="screen and (max-width: 767px)"
          href="<?php bloginfo('stylesheet_directory'); ?>/style-device-small.css?<?=filemtime(dirname( __FILE__ ) . '/style-device-small.css')?>"/>

    <?php if (is_singular()) wp_enqueue_script('comment-reply'); ?>

    <?php wp_head(); ?>

    <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>"
          title="<?php printf(__('%s latest posts', THEME_NAME), wp_specialchars(get_bloginfo('name'), 1)); ?>"/>
    <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>"
          title="<?php printf(__('%s latest comments', THEME_NAME), wp_specialchars(get_bloginfo('name'), 1)); ?>"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
</head>


<body>
<?php if (trim(nackasmu_get_option(NACKASMU_OPTION_FACEBOOKURL)) || nackasmu_multichoiceoption_is_set(NACKASMU_OPTION_ENTRYMETADATA, NACKASMU_OPTIONVALUE_ENTRYMETADATA_SHAREONFACEBOOK)) { ?>
    <div id="fb-root"></div>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/sv_SE/sdk.js#xfbml=1&version=v2.0";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
<?php } ?>

<div id="wrapper" class="hfeed">
    <div id="header">
        <div id="master"></div>
        <div id="branding">
            <div id="blog-title">
                <span><a href="<?php bloginfo('url') ?>/" title="<?php bloginfo('name') ?>"
                         rel="home"><?php bloginfo('name') ?></a><span class="blog-title-comma">,</span></span>
            </div>
            <?php if (is_home() || is_front_page()) { ?>
                <div id="blog-description">
                    <?php bloginfo('description') ?>
                </div>
            <?php } else { ?>
                <h1 id="blog-description">
                    <?php bloginfo('description') ?>
                </h1>
            <?php } ?>
        </div>
        <?php if (is_active_sidebar(THEME_WIDGETAREA_HEADER_ID)) { ?>
            <div id="widget-area-header" class="widget-area">
                <?php dynamic_sidebar(THEME_WIDGETAREA_HEADER_ID); ?>
            </div>
        <?php } ?>
        <div id="access">
            <div class="skip-link"><a href="#content"
                                      title="<?php _e('Skip to content', THEME_NAME) ?>"><?php _e('Skip to content', THEME_NAME) ?></a>
            </div>
        </div>
    </div>
    <div id="main">