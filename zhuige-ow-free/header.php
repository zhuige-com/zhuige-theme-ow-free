<?php
if (!defined('ABSPATH')) {
	die;
} // Cannot access directly.
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.1.1">
	<title><?php zhuige_theme_ow_free_seo_title() ?></title>
	<?php wp_head(); ?>
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>?ver=<?php echo filemtime(get_stylesheet_directory() . '/style.css') ?>">
	<!-- <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.14.0/css/all.min.css" rel="stylesheet" />
	<link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.14.0/css/v4-shims.min.css" rel="stylesheet" /> -->
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/fontawesome-free@5.14.0.all.min.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/fontawesome-free@5.14.0.v4-shims.min.css">
</head>

<body>

	<header>

		<!--主导航-->
		<nav class="container d-flex flex-nowrap align-items-center justify-content-between-md justify-content-center-xs">
			<a href="<?php echo home_url() ?>" class="logo d-flex align-items-center">
				<?php zhuige_theme_ow_free_site_logo() ?>
				<span><?php bloginfo('name') ?></span>
			</a>

			<!--导航右侧附加功能-->
			<div class="zhuige-nav-side d-flex flex-nowrap">
				<div class="zhuige-nav">
					<ul class="zhuige-nav-list">
						<?php
						$menus = zhuige_theme_ow_free_option('home_menu');
						if (is_array($menus) && count($menus) > 0) {
							foreach ($menus as $menu) {
								$target = ($menu['target'] ? ' target="_blank"' : '');
								echo '<li class="' . zhuige_ow_free_menu_active($menu['link']). '"><a href="'. $menu['link']. '" ' . $target . '>'. $menu['title']. '</a></li>';
							}
						} else {
						?>
							<li class="<?php echo zhuige_ow_free_menu_active(home_url()); ?>"><a href="<?php echo home_url() ?>">首页</a></li>
							<li class="<?php echo zhuige_ow_free_menu_active(home_url('/news')); ?>"><a href="<?php echo home_url('/news') ?>">公司动态</a></li>
							<li class="<?php echo zhuige_ow_free_menu_active(home_url('/about')); ?>"><a href="<?php echo home_url('/about') ?>">关于我们</a></li>
							<li class="<?php echo zhuige_ow_free_menu_active(home_url('/feedback')); ?>"><a href="<?php echo home_url('/feedback') ?>">留言反馈</a></li>
							<li><a href="https://www.zhuige.com/product.html?cat=23" target="_blank">更多开源主题</a></li>
						<?php
						}
						?>
					</ul>
				</div>
			</div>
		</nav>

	</header>