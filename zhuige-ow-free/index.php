
<?php
if (!defined('ABSPATH')) {
	die;
} // Cannot access directly.
?>

<?php get_header(); ?>

<?php
if (zhuige_theme_ow_free_option('home_slide_switch', '1')) :
	$home_slides = zhuige_theme_ow_free_option('home_slide');
	$slides = [];
	if (is_array($home_slides)) {
		foreach ($home_slides as $slide) {
			if ($slide['switch'] && $slide['image']['url']) {
				$slides[] = [
					'image' => $slide['image']['url'],
					'url' => $slide['link']
				];
			}
		}
	}
	if (empty($slides)) {
		$slides[] = [
			'image' => get_stylesheet_directory_uri() . '/images/zhuige.png',
			'url' => 'https://www.zhuige.com'
		];
	}
?>
	<div class="zhuige-header-block">
		<!--大图轮播-->
		<div class="zhuige-main-swiper">
			<div class="lb-box" id="lb-1">
				<!-- 轮播内容 -->
				<div class="lb-content">
					<?php foreach ($slides as $slide) { ?>
						<div class="lb-item">
							<a href="<?php echo $slide['url'] ?>" target="_blank">
								<img src="<?php echo $slide['image'] ?>" alt="picture loss">
							</a>
						</div>
					<?php } ?>
				</div>
				<!-- 轮播标志 -->
				<ol class="lb-sign">
					<?php
					for ($i = 1; $i < count($slides) + 1; $i++) {
						echo "<li>$i</li>";
					}
					?>
				</ol>
				<!-- 轮播控件 -->
				<div class="lb-ctrl left">
					<i class="fa fa-angle-left"></i>
				</div>
				<div class="lb-ctrl right">
					<i class="fa fa-angle-right"></i>
				</div>
			</div>
		</div>
	</div>
<?php endif ?>

<!--主内容区-->
<div class="zhuige-main-body">

	<!-- 关于我们 -->
	<?php
	$home_about = zhuige_theme_ow_free_option('home_about');
	$about_title = '';
	$about_content = '';
	if ($home_about && $home_about['switch']) {
		$about_title = $home_about['title'];
		$about_content = $home_about['content'];
	} else if (!$home_about) {
		$about_title = '关于我们';
		$about_content = '追格企业官网Free主题由追格（www.zhuige.com）开发的一款免费开源的WordPress主题，专为企业建站而设计。';
	}
	if ($about_title && $about_content) {
	?>
		<div class="zhuige-base-block pt-30 pb-30">
			<div class="container">
				<div class="zhuige-base-title">
					<h1><?php echo $about_title; ?></h1>
					<p>About</p>
				</div>
				<div class="zhuige-base-text-img">
					<p><?php echo $about_content; ?></p>
				</div>
			</div>
		</div>
	<?php } ?>

	<?php
	$home_goods = zhuige_theme_ow_free_home_goods();
	if ($home_goods) {
	?>
		<div class="zhuige-base-block zhuige-gray mb-30">
			<div class="container">
				<div class="zhuige-base-title">
					<h1><?php echo $home_goods['title']; ?></h1>
					<p>Product service</p>
				</div>
				<!--产品轮播-->
				<div class="zhuige-goods-swiper pb-20">
					<div class="lb-box" id="lb-2">

						<div class="lb-content">
							<?php foreach ($home_goods['list'] as $goods_list) { ?>
								<div class="lb-item">
									<div class="lb-prd row d-flex flex-nowrap justify-content-center">
										<?php foreach ($goods_list as $goods) { ?>
											<div class="zhuige-goods-block">
												<h6>
													<a href="<?php echo get_permalink($goods['id']) ?>" title="<?php echo $goods['title'] ?>"><?php echo $goods['title'] ?></a>
												</h6>
												<a href="<?php echo get_permalink($goods['id']) ?>" title="<?php echo $goods['title'] ?>">
													<img src="<?php echo $goods['thumbnail'] ?>" alt="" />
												</a>
											</div>
										<?php } ?>
									</div>
								</div>
							<?php } ?>
						</div>

						<!-- 轮播标志 -->
						<ol class="lb-sign">
							<?php
							for ($i = 1; $i < count($home_goods) + 1; $i++) {
								echo "<li>$i</li>";
							}
							?>
						</ol>

						<!-- 轮播控件 -->
						<div class="lb-ctrl left">
							<i class="fa fa-angle-left"></i>
						</div>
						<div class="lb-ctrl right">
							<i class="fa fa-angle-right"></i>
						</div>

					</div>
				</div>
			</div>
		</div>
	<?php } ?>

	<?php
	if (zhuige_theme_ow_free_option('home_news_switch', '1')) :
		$args = [
			'posts_per_page' => 4,
			'offset' => 0,
			'orderby' => 'date',
			'ignore_sticky_posts' => 1
		];
		$query = new WP_Query();
		$post_list = $query->query($args);

		$first = false;
		if ($post_list) {
			$first = array_shift($post_list);
		}

		if ($first) :
	?>
			<div class="zhuige-base-block">
				<div class="container">
					<div class="zhuige-base-title">
						<h1>新闻动态</h1>
						<p>News</p>
					</div>

					<!-- 新闻列表 -->
					<div class="zhuige-news row d-flex flex-nowrap-md flex-wrap-xs pb-20 mb-20">
						<div class="zhuige-news-side md-5 xs-12 mb-10">
							<div class="zhuige-img-news">
								<h5>
									<a href="<?php echo get_permalink($first->ID) ?>" target="_blank" title="<?php echo $first->post_title; ?>">
										<?php echo $first->post_title; ?>
									</a>
								</h5>
								<a href="<?php echo get_permalink($first->ID) ?>" target="_blank" title="<?php echo $first->post_title; ?>">
									<img src="<?php echo zhuige_theme_ow_free_thumbnail_src_d($first->ID, $first->post_content); ?>" alt="" />
								</a>
							</div>
						</div>

						<div class="zhuige-news-list md-7 xs-12">
							<?php foreach ($post_list as $post) { ?>
								<div class="zhuige-article-list-block d-flex align-items-center">
									<div class="zhuige-article-list-block-img">
										<a href="<?php echo get_permalink($post->ID) ?>" target="_blank" title="<?php echo $first->post_title; ?>">
											<img alt="" src="<?php echo zhuige_theme_ow_free_thumbnail_src_d($post->ID, $post->post_content); ?>">
										</a>
									</div>
									<div class="zhuige-article-list-block-text">
										<a href="<?php echo get_permalink($post->ID) ?>" target="_blank">
											<h6 class="mt-10 mb-10"><?php echo $post->post_title; ?></h6>
											<p>
												<cite><?php echo get_the_time('Y年m月d日'); ?></cite>
											</p>
										</a>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>

				</div>
			</div>
	<?php endif;
	endif; ?>

	<?php if (zhuige_theme_ow_free_option('home_feedback_switch', '1')) : ?>
		<div class="zhuige-base-block zhuige-gray mb-30">
			<div class="container">
				<div class="zhuige-base-title">
					<h1>留言反馈</h1>
					<p>Feedback</p>
				</div>

				<!-- 留言表单 -->
				<div class="zhuige-feed-form">
					<div class="zhuige-form-line d-flex">
						<label>姓名:</label>
						<input type="text" placeholder="请输入姓名" class="input-username">
					</div>
					<div class="row d-flex flex-nowrap-md flex-wrap-xs justify-content-between">
						<div class="md-6 xs-12">
							<div class="zhuige-form-line d-flex">
								<label>电话:</label>
								<input type="text" placeholder="请输入联系电话" class="input-phone">
							</div>
						</div>
						<div class="md-6 xs-12">
							<div class="zhuige-form-line d-flex">
								<label>E-mail:</label>
								<input type="text" placeholder="请输入Email" class="input-email">
							</div>
						</div>
					</div>
					<div class="zhuige-form-height-line d-flex flex-nowrap-md flex-wrap-xs">
						<label>请输入留言内容:</label>
						<textarea placeholder="您的留言对我们很重要" class="input-content"></textarea>
					</div>
					<div class="zhuige-form-btn d-flex pb-10">
						<button type="submit">提交</button>
					</div>
				</div>

			</div>
		</div>
	<?php endif; ?>

	<?php
	if (zhuige_theme_ow_free_option('home_friends_switch', '1')) :
		$home_friends = zhuige_theme_ow_free_option('home_friends');
		$friends = [];
		if (is_array($home_friends)) {
			foreach ($home_friends as $friend) {
				if ($friend['switch'] && $friend['image']['url']) {
					$friends[] = [
						'title' => $friend['title'],
						'image' => $friend['image']['url'],
						'url' => $friend['link']
					];
				}
			}
		}
		if (empty($friends)) {
			$friends[] = [
				'title' => '追格',
				'image' => get_stylesheet_directory_uri() . '/images/logo.png',
				'url' => 'https://www.zhuige.com'
			];
		}
	?>
		<div class="zhuige-base-block">
			<div class="container">
				<div class="zhuige-base-title">
					<h1>合作伙伴</h1>
					<p>Cooperation</p>
				</div>
				<!-- 合作伙伴 -->
				<div class="zhuige-cooperation d-flex flex-nowrap-md flex-wrap-xs justify-content-center mb-30">
					<?php foreach ($friends as $friend) { ?>
						<a href="<?php echo $friend['url']; ?>" target="_blank" title="<?php echo $friend['title']; ?>">
							<img src="<?php echo $friend['image']; ?>" alt="<?php echo $friend['title']; ?>" />
						</a>
					<?php } ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

</div>

<script>
	window.onload = function() {
		const options = {
			id: 'lb-1', // 轮播盒ID
			speed: 600, // 轮播速度(ms)
			delay: 3000, // 轮播延迟(ms)
			direction: 'left', // 图片滑动方向
			moniterKeyEvent: true, // 是否监听键盘事件
			moniterTouchEvent: true // 是否监听屏幕滑动事件
		}
		const lb = new Lb(options);
		lb.start();

		const options2 = {
			id: 'lb-2', // 轮播盒ID
			speed: 600, // 轮播速度(ms)
			delay: 3000, // 轮播延迟(ms)
			direction: 'left', // 图片滑动方向
			moniterKeyEvent: true, // 是否监听键盘事件
			moniterTouchEvent: true // 是否监听屏幕滑动事件
		}
		const lb2 = new Lb(options2);
		lb2.start();
	}
</script>

<?php get_footer(); ?>