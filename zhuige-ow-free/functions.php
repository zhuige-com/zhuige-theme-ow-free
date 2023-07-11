<?php

/**
 * 追格企业官网主题（开源版）由追格（www.zhuige.com）开发的一款免费开源的WordPress主题，专为企业建站而设计。
 * 文档：https://www.zhuige.com/product/gwztfree.html
 * gitee：https://gitee.com/zhuige_com/zhuige_theme_ow_free
 * github：https://github.com/zhuige-com/zhuige-theme-ow-free
 */

 if (!defined('ABSPATH')) {
     die;
 } // Cannot access directly.

require_once TEMPLATEPATH . '/inc/codestar-framework/codestar-framework.php';
require_once TEMPLATEPATH . '/inc/admin-options.php';
require_once TEMPLATEPATH . '/inc/zhuige-market.php';
require_once TEMPLATEPATH . '/inc/zhuige-pages.php';
require_once TEMPLATEPATH . '/inc/zhuige-dashboard.php';
require_once TEMPLATEPATH . '/inc/zhuige-feedback.php';
require_once TEMPLATEPATH . '/inc/zhuige-sql.php';
require_once TEMPLATEPATH . '/inc/zhuige-ajax.php';

/**
 * 移除图片的宽高属性
 */
add_filter('post_thumbnail_html', 'remove_width_attribute', 10);
add_filter('image_send_to_editor', 'remove_width_attribute', 10);
function remove_width_attribute($html)
{
    $html = preg_replace('/(width|height)="\d*"\s/', "", $html);
    return $html;
}

/**
 * 开启特色图功能
 */
if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
}

// 在init action处注册脚本，可以与其它逻辑代码放在一起
function zhuige_theme_ow_free_theme_init()
{
    $url = get_template_directory_uri();

    // 注册脚本
    wp_register_script('lib-script', $url . '/js/lib/lb.js', [], '0.3');
    wp_register_script('lib-layer', $url . '/js/layer/layer.js', ['jquery'], '1.0', false);
    wp_register_script('jq-footer-script', $url . '/js/zhuige.footer.js', ['jquery', 'lib-layer'], '0.3', true);

    // 其它需要在init action处运行的脚本
}
add_action('init', 'zhuige_theme_ow_free_theme_init');


function zhuige_theme_ow_free_scripts()
{
    //全局加载js脚本
    wp_enqueue_script('jquery');
    wp_enqueue_script('lib-script');
    wp_enqueue_script('jq-footer-script');
}
add_action('wp_enqueue_scripts', 'zhuige_theme_ow_free_scripts');

/**
 *  清除谷歌字体 
 */
function zhuige_theme_ow_free_remove_open_sans_from_wp_core()
{
    wp_deregister_style('open-sans');
    wp_register_style('open-sans', false);
    wp_enqueue_style('open-sans', '');
}
add_action('init', 'zhuige_theme_ow_free_remove_open_sans_from_wp_core');

/**
 * 清除wp_head无用内容 
 */
function zhuige_theme_ow_free_remove_dns_prefetch($hints, $relation_type)
{
    if ('dns-prefetch' === $relation_type) {
        return array_diff(wp_dependencies_unique_hosts(), $hints);
    }
    return $hints;
}
function zhuige_theme_ow_free_remove_laji()
{
    remove_action('wp_head', 'wp_generator'); //移除WordPress版本
    remove_action('wp_head', 'rsd_link'); //移除离线编辑器开放接口
    remove_action('wp_head', 'wlwmanifest_link'); //移除离线编辑器开放接口
    remove_action('wp_head', 'index_rel_link'); //去除本页唯一链接信息
    remove_action('wp_head', 'feed_links', 2); //移除feed
    remove_action('wp_head', 'feed_links_extra', 3); //移除feed
    remove_action('wp_head', 'rest_output_link_wp_head', 10); //移除wp-json链
    remove_action('wp_head', 'print_emoji_detection_script', 7); //头部的JS代码
    remove_action('wp_head', 'wp_print_styles', 8); //emoji载入css
    remove_action('wp_head', 'rel_canonical'); //rel=canonical
    add_filter('wp_resource_hints', 'zhuige_theme_ow_free_remove_dns_prefetch', 10, 2); //头部加载DNS预获取（dns-prefetch）
}
add_action('init', 'zhuige_theme_ow_free_remove_laji');


function zhuige_theme_ow_free_setup()
{
    //关键字
    add_action('wp_head', 'zhuige_theme_ow_free_seo_keywords');

    //页面描述 
    add_action('wp_head', 'zhuige_theme_ow_free_seo_description');

    //网站图标
    add_action('wp_head', 'zhuige_theme_ow_free_seo_favicon');
}
add_action('after_setup_theme', 'zhuige_theme_ow_free_setup');

add_action('admin_init', 'zhuige_theme_ow_free_on_admin_init');
add_action('admin_menu', 'zhuige_theme_ow_free_add_admin_menu', 20);
function zhuige_theme_ow_free_add_admin_menu()
{
    add_submenu_page('zhuige-theme-ow-free', '', '安装文档', 'manage_options', 'zhuige_theme_ow_free_setup', 'zhuige_theme_ow_free_handle_external_redirects');
    add_submenu_page('zhuige-theme-ow-free', '', '专业版主题', 'manage_options', 'zhuige_theme_ow_free_upgrade', 'zhuige_theme_ow_free_handle_external_redirects');
}

function zhuige_theme_ow_free_on_admin_init()
{
    zhuige_theme_ow_free_handle_external_redirects();
}

function zhuige_theme_ow_free_handle_external_redirects()
{
	$page = isset($_GET['page']) ? $_GET['page'] : '';

    if ('zhuige_theme_ow_free_setup' === $page) {
        wp_redirect('https://www.zhuige.com/docs/gwztfree');
        die;
    }

    if ('zhuige_theme_ow_free_upgrade' === $page) {
        wp_redirect('https://www.zhuige.com/product/gwzt.html');
        die;
    }
}

/**
 * 缩略图
 */
function zhuige_theme_ow_free_thumbnail_src()
{
    global $post;
    return zhuige_theme_ow_free_thumbnail_src_d($post->ID, $post->post_content);
}

function zhuige_theme_ow_free_thumbnail_src_d($post_id, $post_content)
{
    $post_thumbnail_src = '';
    if (has_post_thumbnail($post_id)) {    //如果有特色缩略图，则输出缩略图地址
        $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');
        if (is_array($thumbnail_src) && count($thumbnail_src) > 0) {
            $post_thumbnail_src = $thumbnail_src[0];
        }
    } 
    
    if (empty($post_thumbnail_src)) {
        ob_start();
        ob_end_clean();
        $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post_content, $matches);
        if ($matches && isset($matches[1]) && isset($matches[1][0])) {
            $post_thumbnail_src = $matches[1][0];   //获取该图片 src
        }
    };

    if (empty($post_thumbnail_src)) {
        $post_thumbnail_src = get_stylesheet_directory_uri() . '/images/zhuige.png';
    }

    return $post_thumbnail_src;
}

/**
 * 设置项的值
 */
$zhuige_options = null;
function zhuige_theme_ow_free_option($key, $default = false)
{
    global $zhuige_options;
    if (!$zhuige_options) {
        $zhuige_options = get_option('zhuige-theme-ow-free');
    }

    if (isset($zhuige_options[$key])) {
        return $zhuige_options[$key];
    }

    return $default;
}

/**
 * 设置文章浏览量
 */
function zhuige_theme_ow_free_update_post_view_count()
{
    global $post;
    $post_views = (int) get_post_meta($post->ID, "views", true);
    if (!update_post_meta($post->ID, 'views', ($post_views + 1))) {
        add_post_meta($post->ID, 'views', 1, true);
    }
}

/**
 * 详情-浏览数
 */
function zhuige_theme_ow_free_post_detail_view_count()
{
    global $post;
    $count = get_post_meta($post->ID, "views", true);
    if (!$count) {
        $count = 0;
    }
    echo $count;
}

/**
 * 首页产品服务
 */
function zhuige_theme_ow_free_home_goods()
{
    $home_goods = zhuige_theme_ow_free_option('home_goods');
    if (!$home_goods) {
        $home_goods = [
            'title' => '产品服务',
            'ids' => '1',
            'switch' => '1'
        ];
    }

    if (!$home_goods['switch']) {
        return false;
    }

    if (empty($home_goods['ids'])) {
        return false;
    }

    $args = [
        'post__in' => explode(',', $home_goods['ids']),
        'orderby' => 'post__in',
        'posts_per_page' => -1,
        'ignore_sticky_posts' => 1
    ];

    $goods_list = [];
    $query = new WP_Query();
    $result = $query->query($args);
    foreach ($result as $post) {
        $thumbnail = zhuige_theme_ow_free_thumbnail_src_d($post->ID, $post->post_content);
        $goods_list[] = [
            'id' => $post->ID,
            'title' => $post->post_title,
            'thumbnail' => $thumbnail
        ];
    }

    if (empty($goods_list)) {
        echo '3';
        return false;
    }

    $list = [];
    for ($i = 0; $i < count($goods_list); $i++) {
        $item = [$goods_list[$i]];

        $i++;
        if ($i < count($goods_list)) {
            $item[] = $goods_list[$i];
        }

        $i++;
        if ($i < count($goods_list)) {
            $item[] = $goods_list[$i];
        }

        $i++;
        if ($i < count($goods_list)) {
            $item[] = $goods_list[$i];
        }

        $list[] = $item;
    }

    return [
        'title' => $home_goods['title'],
        'list' => $list
    ];
}

/* ---- SEO start ---- */
//标题
function zhuige_theme_ow_free_seo_title()
{
    $site_title = zhuige_theme_ow_free_option('site_title');
    if (is_home() && !empty($site_title)) {
        echo $site_title;
    } else {
        global $page, $paged;
        wp_title('-', true, 'right');

        // 添加网站标题.
        bloginfo('name');

        // 如果有必要，在标题上显示一个页面数.
        if ($paged >= 2 || $page >= 2) {
            echo ' - ' . sprintf('第%s页', max($paged, $page));
        }
    }
}

//关键字
function zhuige_theme_ow_free_seo_keywords()
{
    global $s, $post;
    $keywords = '';
    if (is_single()) {
        if (get_the_tags($post->ID)) {
            foreach (get_the_tags($post->ID) as $tag) $keywords .= $tag->name . ', ';
        }
        foreach (get_the_category($post->ID) as $category) $keywords .= $category->cat_name . ', ';
        $keywords = substr_replace($keywords, '', -2);
    } elseif (is_home()) {
        $keywords = zhuige_theme_ow_free_option('site_keyword');
    } elseif (is_tag()) {
        $keywords = single_tag_title('', false);
    } elseif (is_category()) {
        $keywords = single_cat_title('', false);
    } elseif (is_search()) {
        $keywords = esc_html($s, 1);
    } else {
        $keywords = trim(wp_title('', false));
    }
    if ($keywords) {
        echo "<meta name=\"keywords\" content=\"$keywords\">\n";
    }
}

//描述
function zhuige_theme_ow_free_seo_description()
{
    global $s, $post;
    $description = '';
    $blog_name = get_bloginfo('name');
    if (is_singular()) {
        if (!empty($post->post_excerpt)) {
            $text = $post->post_excerpt;
        } else {
            $text = $post->post_content;
        }
        $description = trim(str_replace(array("\r\n", "\r", "\n", "　", " "), " ", str_replace("\"", "'", strip_tags($text))));
        if (!($description)) $description = $blog_name . "-" . trim(wp_title('', false));
    } elseif (is_home()) {
        $description = zhuige_theme_ow_free_option('site_description');
    } elseif (is_tag()) {
        $description = $blog_name . "'" . single_tag_title('', false) . "'";
    } elseif (is_category()) {
        $description = trim(strip_tags(category_description()));
    } elseif (is_archive()) {
        $description = $blog_name . "'" . trim(wp_title('', false)) . "'";
    } elseif (is_search()) {
        $description = $blog_name . ": '" . esc_html($s, 1) . "' 的搜索結果";
    } else {
        $description = $blog_name . "'" . trim(wp_title('', false)) . "'";
    }
    $description = mb_substr($description, 0, 220, 'utf-8');
    echo "<meta name=\"description\" content=\"$description\">\n";
}
/* ---- SEO end ---- */

/**
 * 站点LOGO
 */
function zhuige_theme_ow_free_site_logo()
{
    $logo = zhuige_theme_ow_free_option('site_logo');
    if ($logo && $logo['url']) {
        $logo_url = $logo['url'];
    } else {
        $logo_url = get_stylesheet_directory_uri() . '/images/logo.png';
    }

    echo '<img alt="picture loss" src="' . $logo_url . '" alt="' . get_bloginfo('name') . '" />';
}

/**
 * favicon
 */
function zhuige_theme_ow_free_seo_favicon()
{
    $favicon = zhuige_theme_ow_free_option('site_favicon');
    if ($favicon && $favicon['url']) {
        echo '<link rel="shortcut icon" type="image/x-icon" href="' . $favicon['url'] . '" />';
    } else {
        echo '';
    }
}

/**
 * 分页
 */
function zhuige_theme_ow_free_custom_pagenavi($custom_query, $range = 4)
{
    global $paged, $wp_query;
    // if (!$max_page) {
    $max_page = $custom_query->max_num_pages;
    // }
    echo "<div class='zhui-pagination'>";
    if ($max_page > 1) {
        if (!$paged) {
            $paged = 1;
        }
        if ($paged != 1) {
            echo "<a href='" . get_pagenum_link(1) . "' class='' title='跳转到首页'>首页</a>";
        }
        previous_posts_link('上一页');
        if ($max_page > $range) {
            if ($paged < $range) {
                for ($i = 1; $i <= ($range + 1); $i++) {
                    echo "<a href='" . get_pagenum_link($i) . "'";
                    if ($i == $paged) echo " class='zhui-page-on'";
                    echo ">$i</a>";
                }
            } elseif ($paged >= ($max_page - ceil(($range / 2)))) {
                for ($i = $max_page - $range; $i <= $max_page; $i++) {
                    echo "<a href='" . get_pagenum_link($i) . "'";
                    if ($i == $paged) echo " class='zhui-page-on'";
                    echo ">$i</a>";
                }
            } elseif ($paged >= $range && $paged < ($max_page - ceil(($range / 2)))) {
                for ($i = ($paged - ceil($range / 2)); $i <= ($paged + ceil(($range / 2))); $i++) {
                    echo "<a href='" . get_pagenum_link($i) . "'";
                    if ($i == $paged) echo " class='zhui-page-on'";
                    echo ">$i</a>";
                }
            }
        } else {
            for ($i = 1; $i <= $max_page; $i++) {
                echo "<a href='" . get_pagenum_link($i) . "'";
                if ($i == $paged) echo " class='zhui-page-on'";
                echo ">$i</a>";
            }
        }
        next_posts_link('下一页', $max_page);
        if ($paged != $max_page) {
            echo "<a href='" . get_pagenum_link($max_page) . "' class='' title='跳转到最后一页'>尾页</a>";
        }
        // echo '<span>共[' . $max_page . ']页</span>';
    }
    echo "</div>";
}
