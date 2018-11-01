<div id="sidebar">
	<div id="sidebar-opaque">
		<?php if ( is_active_sidebar( THEME_WIDGETAREA_ABOVEMENU_ID )) { ?>
			<div id="widget-area-abovemenu" class="widget-area">
				<?php dynamic_sidebar( THEME_WIDGETAREA_ABOVEMENU_ID ); ?>
			</div>
		<?php } ?>

        <?php
//        wp_nav_menu(
//            array(
//                'menu' => 'primary',
//                'container_class' => 'my_extra_menu_class',
//                'depth' => 2,
//                'link_before' => '<span class="screen-reader-text">',
//                'link_after' => '</span>',
//            )
//        );
        ?>
		
		<?php
        wp_page_menu(array(
            'sort_column' => 'menu_order',
            'show_home'   => true,
            'link_before' => '',
            'link_after'  => '' ));
		?>
		<div id="sidebar-after-menu"></div>
		
		<?php if ( is_active_sidebar( THEME_WIDGETAREA_BELOWMENU_ID )) { ?>
			<div id="widget-area-belowmenu" class="widget-area">
				<?php dynamic_sidebar( THEME_WIDGETAREA_BELOWMENU_ID ); ?>
			</div>
		<?php } ?>
	</div>
	<div id="sidebar-transparent">
		<?php if ( is_active_sidebar( THEME_WIDGETAREA_BELOWSIDEBAR_ID )) { ?>
			<div id="widget-area-belowsidebar" class="widget-area">
				<?php dynamic_sidebar( THEME_WIDGETAREA_BELOWSIDEBAR_ID ); ?>
			</div>
		<?php } ?>
		<?php if ( trim(nackasmu_get_option( NACKASMU_OPTION_FACEBOOKURL ) )) { ?>
			<div class="widget-area" style="text-align: center">
                <div class="fb-like" data-href="<?= nackasmu_get_option( NACKASMU_OPTION_FACEBOOKURL ) ?>" data-layout="button" data-action="like" data-show-faces="true" data-share="false"></div>
            </div>
		<?php } ?>
	</div>
</div>