
	</div>
	<div id="footer">
		<?php if ( is_active_sidebar( THEME_WIDGETAREA_FOOTER_ID )) { ?>
			<div id="widget-area-footer" class="widget-area">
				<?php dynamic_sidebar( THEME_WIDGETAREA_FOOTER_ID ); ?>
			</div>
		<?php } ?>
		<div id="colophon">
			<div id="site-info">&copy; <?php print date("Y"); ?> <?php bloginfo("name") ?>, <?php bloginfo("description") ?>.</div>
		</div>
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>
