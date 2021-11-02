<?php get_header(); ?>

<!--主内容区-->
<div class="zhuige-main-body zhugie-header-fix">

	<div class="zhuige-main-title">
		<!--顶部大标题-->
		<div class="zhuige-main-title-text">
			<h1>公司动态</h1>
			<p>News</p>
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

	<div class="container">
		<div class="zhuige-article-list pt-30">

			<?php
			$query_args = ['post_type' => 'post'];
			if (isset($paged) && $paged > 0) {
				$query_args['offset'] = ($paged - 1) * 10;
			}
			$the_query = new WP_Query($query_args);
			if ($the_query->have_posts()) {
				while ($the_query->have_posts()) {
					$the_query->the_post();
					$thumbnail = zhuige_theme_ow_free_thumbnail_src(); ?>
					<div class="zhuige-article-list-block d-flex align-items-center">
						<div class="zhuige-article-list-block-img">
							<a href="<?php the_permalink() ?>" target="_blank"><img alt="" src="<?php echo $thumbnail; ?>"></a>
						</div>
						<div class="zhuige-article-list-block-text">
							<a href="<?php the_permalink() ?>" target="_blank">
								<h6><?php the_title() ?></h6>
								<div><?php echo wp_trim_words(strip_tags(apply_filters('the_content', $post->post_content)), 100, '...'); ?></div>
								<p class="mt-10">
									<cite><?php echo get_the_time('Y年m月d日'); ?></cite>/
									<cite>浏览 <?php zhuige_theme_ow_free_post_detail_view_count(); ?></cite>
								</p>
							</a>
						</div>
					</div>
			<?php }
			} else {
				echo '一篇文章也没有';
			}

			?>
		</div>
	</div>

	<!-- 分页 -->
	<?php
	zhuige_theme_ow_free_custom_pagenavi($the_query);
	wp_reset_postdata();
	?>

</div>

<?php get_footer(); ?>