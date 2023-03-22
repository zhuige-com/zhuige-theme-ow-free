<?php
if (!defined('ABSPATH')) {
	die;
} // Cannot access directly.
?>

<?php get_header(); ?>

<!--主内容区-->
<div class="zhuige-main-body zhugie-header-fix zhuige-gray">
	<?php if (have_posts()) : the_post();
		zhuige_theme_ow_free_update_post_view_count();
	?>
		<!--顶部大标题-->
		<div class="zhuige-main-title mb-30">
			<div class="zhuige-main-title-text">
				<h1><?php the_title(); ?></h1>
				<p>
					<cite><?php echo get_the_time('Y年m月d日'); ?></cite>/
					<cite>浏览 <?php zhuige_theme_ow_free_post_detail_view_count(); ?></cite>
				</p>
			</div>
			<?php
			$background = zhuige_theme_ow_free_option('news_background');
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

				<!--面包屑-->
				<div class="zhuige-breadcrumb d-flex align-items-center mb-20">
					<a href="/" title="">首页</a>
					<i class="fa fa-angle-right"></i>
					<a href="/news" title="">公司动态</a>
					<i class="fa fa-angle-right"></i>
					<a href="#" title="">文章详情</a>
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