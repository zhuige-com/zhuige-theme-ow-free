/**
 * 追格企业官网主题（开源版）由追格（www.zhuige.com）开发的一款免费开源的WordPress主题，专为企业建站而设计。
 */

jQuery(document).ready(function ($) {
    /** 返回顶部 start */
    $(window).scroll(function (event) {
        let scrollTop = $(this).scrollTop();
        if (scrollTop == 0) {
            $("#toTop").hide();
        } else {
            $("#toTop").show();
        }
    });

    $("#toTop").click(function (event) {
        $("html,body").animate(
            { scrollTop: "0px" },
            666
        )
    });
    /** 返回顶部 end */

    $('.zhuige-form-btn').click(function (event) {
        // layer.msg('1');
        $.post("/wp-admin/admin-ajax.php", {
            action: 'zhuige_theme_ow_free_feedback',
            username: $('.input-username').val(),
            phone: $('.input-phone').val(),
            email: $('.input-email').val(),
            content: $('.input-content').val()
        }, function (data) {
            if (data.code == 0) {
                layer.alert('客服会尽快回访您');
                setTimeout(() => {
                    window.location.href = '/';
                }, 2000)
            } else {
                layer.msg(data.error);
            }
        });
    });
});