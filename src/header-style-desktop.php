<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/style-desktop.css" />
<!-- http://weblogs.asp.net/wesleybakker/archive/2010/03/18/Remove-page-flicker-in-IE8.aspx -->     
<!--[if IE]>
    <style type="text/css">
        body {
            background-image: url("<?php bloginfo('stylesheet_directory'); ?>/design/theme_light/bg_small.jpg");
        } 
    </style>
    <meta http-equiv="Page-Exit" content="blendTrans(Duration=0.0)" />
    <meta http-equiv="Page-Exit" content="Alpha(opacity=100)" />
<![endif]-->

<!-- http://css-tricks.com/how-to-create-an-ie-only-stylesheet/ -->
<!--[if !IE]><!-->
    <style type="text/css">
        body {
            background-image: url("<?php bloginfo('stylesheet_directory'); ?>/design/theme_light/bg.jpg");
        } 
    </style>
<!--<![endif]-->
<!--[if lte IE 6]>
    <style type="text/css">
        #container {
            /*border-top: 1px solid red;*/
        }
        #notwimpy {
            display: none;
        }
        #sidebar {
            left: -14em;
            margin-left: -20px;
        }
    </style>
<![endif]-->