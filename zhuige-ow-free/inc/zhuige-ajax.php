<?php

/**
 * 追格企业官网主题（开源版）由追格（www.zhuige.com）开发的一款免费开源的WordPress主题，专为企业建站而设计。
 */

/**
 * 点赞功能
 */
add_action('wp_ajax_nopriv_zhuige_theme_ow_free_feedback', 'zhuige_theme_ow_free_feedback');
add_action('wp_ajax_zhuige_theme_ow_free_feedback', 'zhuige_theme_ow_free_feedback');
function zhuige_theme_ow_free_feedback()
{
    header("Content-Type: application/json");

    $username = isset($_POST["username"]) ? sanitize_text_field(wp_unslash($_POST["username"])) : '';
    $phone = isset($_POST["phone"]) ? sanitize_text_field(wp_unslash($_POST["phone"])) : '';
    $email = isset($_POST["email"]) ? sanitize_text_field(wp_unslash($_POST["email"])) : '';
    $content = isset($_POST["content"]) ? sanitize_text_field(wp_unslash($_POST["content"])) : '';

    if (empty($username)) {
        echo json_encode(['code' => 1, 'error' => '请填写姓名']);
        die;
    }

    if (empty($phone)) {
        echo json_encode(['code' => 1, 'error' => '请填写电话']);
        die;
    }

    if (empty($email)) {
        echo json_encode(['code' => 1, 'error' => '请填写Email']);
        die;
    }

    if (empty($content)) {
        echo json_encode(['code' => 1, 'error' => '请填写留言内容']);
        die;
    }

    global $wpdb;
    $table_feedback = $wpdb->prefix . 'zhuige_theme_ow_free_feedback';

    $wpdb->insert($table_feedback, [
        'username' => $username,
        'phone' => $phone,
        'email' => $email,
        'content' => $content,
        'createtime' => time()
    ]);

    echo json_encode(['code' => 0]);
    die;
}

