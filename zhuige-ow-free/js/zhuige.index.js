/**
 * 追格企业官网主题（开源版）由追格（www.zhuige.com）开发的一款免费开源的WordPress主题，专为企业建站而设计。
 */

/**
 * 轮播选项
 */
{
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
}

jQuery(document).ready(function ($) {
    $.post("/wp-admin/admin-ajax.php",
        {
            action: 'zhuige_home_pop_ad'
        },
        function (data, status) {
            if (status != 'success' || !data.success) {
                return;
            }

            if (data.data.pop != 1) {
                return;
            }

            $('.home-ad-pop-image').on('load', function () {
                layer.open({
                    type: 1,
                    title: false,
                    closeBtn: 1,
                    area: ['auto'],
                    skin: 'layui-layer-noboxshade', //没有背景色没有边框阴影
                    shadeClose: true,
                    content: $('#home-ad-pop')
                });
            })

            $('.home-ad-pop-link').attr('href', data.data.link);
            $('.home-ad-pop-image').attr('src', data.data.image);
        });
});