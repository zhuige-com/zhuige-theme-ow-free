<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<title><?php zhuige_theme_ow_free_seo_title() ?></title>
	<?php wp_head(); ?>
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>?ver=1">
	<link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.14.0/css/all.min.css" rel="stylesheet" />
	<link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.14.0/css/v4-shims.min.css" rel="stylesheet" />
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
						<li class="<?php echo (is_home() ? 'nav-activ' : ''); ?>"><a href="/">首页</a></li>
						<li class="<?php echo (strpos($_SERVER['REQUEST_URI'], '/news') === false ? '' : 'nav-activ'); ?>"><a href="/news">公司动态</a></li>
						<li class="<?php echo (strpos($_SERVER['REQUEST_URI'], '/about') === false ? '' : 'nav-activ'); ?>"><a href="/about">关于我们</a></li>
						<li class="<?php echo (strpos($_SERVER['REQUEST_URI'], '/feedback') === false ? '' : 'nav-activ'); ?>"><a href="/feedback">留言反馈</a></li>
					</ul>
				</div>
			</div>
		</nav>

	</header>