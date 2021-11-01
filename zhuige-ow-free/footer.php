<!--页脚-->
<footer>
	<!--页脚版权-->
	<div class="container d-flex justify-content-between">
		<div class="zhuige-footer-copy">
			<?php
			$footer_copyright = zhuige_theme_ow_free_option('footer_copyright');
			echo $footer_copyright ? $footer_copyright : '请在后台设置版权信息';
			?>
		</div>
		<div class="zhuige-footer-links d-flex">
			<span>
				主题设计
				<a href="https://www.zhuige.com" title="追格">追格（zhuige.com）</a>
			</span>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
<div id="toTop">
	<img  alt="picture loss" src="<?php echo get_stylesheet_directory_uri() . '/images/toTop.png'; ?>" />
</div>

<div style="display: none;">
	<script>
		<?php echo zhuige_theme_ow_free_option('footer_statistics'); ?>
	</script>
</div>
</body>
</html>