<?php
/*
Template Name: 追格-关于我们
*/
?>

<?php get_header(); ?>

<!--主内容区-->
<div class="zhuige-main-body zhugie-header-fix zhuige-gray">
	<?php
	$page_ids = zhuige_theme_ow_free_option('about_doc_nav');
	if (!$page_ids || empty($page_ids)) {
		$pages = get_pages();
		foreach ($pages as $page) {
			$template = get_post_meta($page->ID, '_wp_page_template', true);
			if ($template == 'page-about.php') {
				$page_ids[] = $page->ID;
			}
		}
	}
	$args = [
		'post__in' => $page_ids,
		'orderby' => 'post__in',
		'posts_per_page' => -1,
		'post_type' => ['page'],
	];

	$the_post_id = get_the_ID();

	$query = new WP_Query();
	$result = $query->query($args);
	?>
	<?php if (have_posts()) : the_post(); ?>
		<div class="zhuige-main-title pb-30">
			<!--顶部大标题-->
			<div class="zhuige-main-title-text">
				<h1><?php the_title(); ?></h1>
				<p>About</p>
			</div>
			<?php
			$background = zhuige_theme_ow_free_option('about_background');
			if ($background && $background['url']) {
				$background = $background['url'];
			} else {
				$background = get_template_directory_uri() . '/images/single_header.png';
			}
			?>
			<img src="<?php echo $background; ?>" alt="" />
		</div>

		<div class="zhuige-main-cont">
			<div class="container">

				<!--tab导航-->
				<div class="zhuige-single-nav zhuige-block p-20 mb-10">
					<div class="zhuige-nav">
						<ul class="zhuige-nav-list justify-content-center">
							<?php
							foreach ($result as $post) {
								$cls = ($post->ID == $the_post_id ? 'nav-activ' : '');
								echo '<li class="' . $cls . '"><a href="' . get_permalink($post->ID) . '">' . $post->post_title . '</a></li>';
							}
							?>
						</ul>
					</div>
				</div>

				<!--主内容区-->
				<div class="zhuige-main-text pb-30">
					<div class="zhuige-block p-20">
						<?php the_content(); ?>
					</div>
				</div>
			</div>

		</div>
	<?php endif; ?>
</div>

<?php get_footer(); ?>