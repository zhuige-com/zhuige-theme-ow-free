<?php
/*
Template Name: 追格-留言反馈
*/
?>

<?php get_header(); ?>

<!--主内容区-->
<div class="zhuige-main-body zhugie-header-fix zhuige-gray">

	<!--顶部大标题-->
	<div class="zhuige-main-title pb-30">
		<div class="zhuige-main-title-text">
			<h1>留言反馈</h1>
			<p>Feedback</p>
		</div>
		<?php
			$background = zhuige_theme_ow_free_option('feedback_background');
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

			<!-- 留言表单 -->
			<div class="zhuige-feed-form">
				<div class="zhuige-form-line d-flex">
					<label>姓名:</label>
					<input type="text" placeholder="" class="input-username">
				</div>
				<div class="row d-flex flex-nowrap justify-content-between">
					<div class="md-6">
						<div class="zhuige-form-line d-flex">
							<label>电话:</label>
							<input type="text" placeholder="" class="input-phone">
						</div>
					</div>
					<div class="md-6">
						<div class="zhuige-form-line d-flex">
							<label>E-mail:</label>
							<input type="text" placeholder="" class="input-email">
						</div>
					</div>
				</div>
				<div class="zhuige-form-height-line d-flex">
					<label>请输入留言内容:</label>
					<textarea placeholder="" class="input-content"></textarea>
				</div>
				<div class="zhuige-form-btn d-flex pb-10">
					<button type="submit">提交</button>
				</div>
				<!-- <div class="zhuige-form-tips p-10">
					<i class="fa fa-check-circle"></i>
					<text>提交成功</text>
				</div> -->
			</div>

		</div>
	</div>

</div>

<?php get_footer(); ?>