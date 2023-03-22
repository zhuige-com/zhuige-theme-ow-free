<?php
if (!defined('ABSPATH')) {
	die;
} // Cannot access directly.
?>

<!--页脚-->
<!--导航右侧附加功能H5-->
<div class="zhuige-nav-side d-flex flex-nowrap zhuige-nav-mobile">
	<ul class="zhuige-nav-list justify-content-center">
		<li class="<?php echo (is_home() ? 'nav-activ' : ''); ?>"><a href="/">首页</a></li>
		<li class="<?php echo (strpos($_SERVER['REQUEST_URI'], '/news') === false ? '' : 'nav-activ'); ?>"><a href="/news">公司动态</a></li>
		<li class="<?php echo (strpos($_SERVER['REQUEST_URI'], '/about') === false ? '' : 'nav-activ'); ?>"><a href="/about">关于我们</a></li>
		<li class="<?php echo (strpos($_SERVER['REQUEST_URI'], '/feedback') === false ? '' : 'nav-activ'); ?>"><a href="/feedback">留言反馈</a></li>
	</ul>
</div>

<footer>
	<!--页脚版权-->
	<div class="container d-flex flex-nowrap-md flex-wrap-xs justify-content-between-md justify-content-center-xs">
		<div class="zhuige-footer-copy">
			<?php
			$footer_copyright = zhuige_theme_ow_free_option('footer_copyright');
			echo $footer_copyright ? $footer_copyright : '请在后台设置版权信息';
			?>
		</div>
		<div class="zhuige-footer-links d-flex">
			<span>
				主题设计
				<a href="https://www.zhuige.com" target="_blank" title="追格">追格（zhuige.com）</a>
			</span>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

<div id="toTop">
	<img alt="picture loss" src="<?php echo get_stylesheet_directory_uri() . '/images/toTop.png'; ?>" />
</div>

<div style="display: none;">
	<script>
		<?php echo zhuige_theme_ow_free_option('footer_statistics'); ?>
	</script>
</div>

</body>
</html>