<?php

/**
 * 追格企业官网主题（开源版）由追格（www.zhuige.com）开发的一款免费开源的WordPress主题，专为企业建站而设计。
 */

if (!defined('ABSPATH')) {
    die;
} // Cannot access directly.

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

/**
 * 市场相关
 */
add_action('wp_ajax_nopriv_zhuige_market_event', 'zhuige_market_event');
add_action('wp_ajax_zhuige_market_event', 'zhuige_market_event');
function zhuige_market_event()
{
    $action = isset($_POST["zgaction"]) ? sanitize_text_field(wp_unslash($_POST["zgaction"])) : '';

    if ($action == 'get_list') { // 查询产品
        $cat = isset($_POST["cat"]) ? (int)($_POST["cat"]) : 0;
        $params = [];
        if ($cat) {
            $params['cat'] = $cat;
        }

        $free = isset($_POST["free"]) ? sanitize_text_field($_POST["free"]) : '';
        if ($free !== '') {
            $params['free'] = $free;
        }

        $init = isset($_POST["init"]) ? (int)($_POST["init"]) : 0;
        if ($init == 1) {
            $params['init'] = $init;
        }

        $response = wp_remote_post("https://www.zhuige.com/api/market/list", array(
            'method'      => 'POST',
            'body'        => $params
        ));

        if (is_wp_error($response) || $response['response']['code'] != 200) {
            wp_send_json_error();
        }

        $data = json_decode($response['body'], TRUE);
        $datadata = $data['data'];

        if ($data['code'] == 1) {
            wp_send_json_success($datadata);
        } else {
            wp_send_json_error();
        }
    }

    die;
}

/**
 * 首页弹框
 */
add_action('wp_ajax_nopriv_zhuige_home_pop_ad', 'zhuige_home_pop_ad');
add_action('wp_ajax_zhuige_home_pop_ad', 'zhuige_home_pop_ad');
function zhuige_home_pop_ad()
{
    $last_home_ad_pop_time = isset($_COOKIE['last_home_ad_pop_time']) ? $_COOKIE['last_home_ad_pop_time'] : false;
    if ($last_home_ad_pop_time && $last_home_ad_pop_time > time()) {
        wp_send_json_success(['pop' => 0]);
        die;
    }

    $home_ad_pop = zhuige_theme_ow_free_option('home_ad_pop');
    if ($home_ad_pop && $home_ad_pop['switch'] && $home_ad_pop['image'] && $home_ad_pop['image']['url']) {
        $data = [
            'pop' => 1,
            'image' => $home_ad_pop['image']['url'],
            'link' => $home_ad_pop['link'],
        ];

        $expire = time() + (int)$home_ad_pop['interval'] * 3600;
        setcookie('last_home_ad_pop_time', $expire, $expire);

        wp_send_json_success($data);
    } else {
        wp_send_json_success(['pop' => 0]);
    }

    die;
}