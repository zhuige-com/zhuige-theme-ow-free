<?php

/*
 * 追格企业官网主题（开源版）由追格（www.zhuige.com）开发的一款免费开源的WordPress主题，专为企业建站而设计。
 */

function zhuige_theme_ow_free_sql_build() {
    global $wpdb;

    $charset_collate = '';
    if (!empty($wpdb->charset)) {
        $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
    }

    if (!empty($wpdb->collate)) {
        $charset_collate .= " COLLATE {$wpdb->collate}";
    }

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    //官网 反馈
    $table_ow_feedback = $wpdb->prefix . 'zhuige_theme_ow_free_feedback';
    $sql = "CREATE TABLE IF NOT EXISTS `$table_ow_feedback` (
        `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
        `username` varchar(100) NOT NULL COMMENT '用户名',
        `phone` varchar(100) NOT NULL COMMENT '电话',
        `email` varchar(100) NOT NULL COMMENT 'E-mail',
        `content` text NOT NULL COMMENT '内容',
        `createtime` int(11) NOT NULL COMMENT '创建时间',
      PRIMARY KEY (`id`)
    ) $charset_collate;";
    dbDelta($sql);
}

add_action('load-themes.php', 'zhuige_theme_ow_free_sql_build');
