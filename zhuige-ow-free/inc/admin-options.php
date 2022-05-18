<?php if (!defined('ABSPATH')) {
    die;
} // Cannot access directly.

$prefix = 'zhuige-theme-ow-free';

//分类信息
$cats = get_categories([]);
$categories = [];
foreach ($cats as $cat) {
    $categories[$cat->term_id] = $cat->name;
}

//
// Create options
//
CSF::createOptions($prefix, array(
    'framework_title' => '追格企业官网主题（开源版） <small>by <a href="https://www.zhuige.com" target="_blank" title="追格">www.zhuige.com</a></small>',
    'menu_title' => '追格官网主题',
    'menu_slug'  => 'zhuige-theme-ow-free',
    'menu_position' => 2,
    'show_bar_menu' => false,
    'show_sub_menu' => false,
    'footer_credit' => 'Thank you for creating with <a href="https://www.zhuige.com/" target="_blank">追格</a>',
    'menu_icon' => 'dashicons-layout',
));

$content = '欢迎使用追格企业官网主题（开源版）! <br/><br/> 微信客服：jianbing2011 (加开源群、问题咨询、项目定制、购买咨询) <br/><br/> <a href="https://www.zhuige.com" target="_blank">更多免费产品</a>';
if (stripos($_SERVER["REQUEST_URI"], 'zhuige-theme-ow-free')) {
    $res = wp_remote_get("https://www.zhuige.com/api/ad/wordpress?id=zhuige_theme_ow_free", ['timeout' => 1, 'sslverify' => false]);
    if (!is_wp_error($res) && $res['response']['code'] == 200) {
        $data = json_decode($res['body'], TRUE);
        if ($data['code'] == 1) {
            $content = $data['data'];
        }
    }
}

//
// 概要
//
CSF::createSection($prefix, array(
    'title'  => '概要',
    'icon'   => 'fas fa-rocket',
    'fields' => array(

        array(
            'type'    => 'content',
            'content' => $content,
        ),

    )
));

//
// 基础设置
//
CSF::createSection($prefix, array(
    'title' => '基础设置',
    'icon'  => 'fas fa-cubes',
    'fields' => array(

        array(
            'id'      => 'site_logo',
            'type'    => 'media',
            'title'   => 'LOGO设置',
            'library' => 'image',
        ),

        array(
            'id'      => 'site_favicon',
            'type'    => 'media',
            'title'   => 'favicon',
            'subtitle' => '.ico格式',
            'library' => 'image',
        ),
    )
));

//
// 首页设置
//

// 首页设置
CSF::createSection($prefix, array(
    'id'    => 'home',
    'title' => '首页设置',
    'icon'  => 'fas fa-home',
    'fields' => array(

        array(
            'id'     => 'home_slide',
            'type'   => 'group',
            'title'  => '幻灯片',
            'fields' => array(
                array(
                    'id'       => 'link',
                    'type'     => 'text',
                    'title'    => '链接',
                    'default'  => 'https://www.zhuige.com',
                ),
                array(
                    'id'      => 'image',
                    'type'    => 'media',
                    'title'   => '图片',
                    'library' => 'image',
                ),
                array(
                    'id'    => 'switch',
                    'type'  => 'switcher',
                    'title' => '开启/停用',
                    'default' => '1'
                ),
            ),
        ),

        array(
            'id'    => 'home_slide_switch',
            'type'  => 'switcher',
            'title' => '幻灯片',
            'subtitle' => '开启/停用',
            'default' => '1'
        ),

        array(
            'id'     => 'home_about',
            'type'   => 'fieldset',
            'title'  => '关于我们',
            'fields' => array(
                array(
                    'id'    => 'title',
                    'type'  => 'text',
                    'title' => '标题',
                ),
                array(
                    'id'    => 'content',
                    'type'  => 'wp_editor',
                    'title' => '内容',
                ),
                array(
                    'id'    => 'switch',
                    'type'  => 'switcher',
                    'title' => '开启/停用',
                    'default' => '1'
                ),
            ),
        ),

        array(
            'id'     => 'home_goods',
            'type'   => 'fieldset',
            'title'  => '产品服务',
            'fields' => array(
                array(
                    'id'    => 'title',
                    'type'  => 'text',
                    'title' => '标题',
                ),
                array(
                    'id'    => 'ids',
                    'type'  => 'text',
                    'title' => '文章ID',
                    'subtitle' => '英文逗号分隔',
                ),
                array(
                    'id'    => 'switch',
                    'type'  => 'switcher',
                    'title' => '开启/停用',
                    'default' => '1'
                ),
            ),
        ),

        array(
            'id'    => 'home_news_switch',
            'type'  => 'switcher',
            'title' => '新闻动态',
            'subtitle' => '开启/停用',
            'default' => '1'
        ),

        array(
            'id'    => 'home_feedback_switch',
            'type'  => 'switcher',
            'title' => '留言反馈',
            'subtitle' => '开启/停用',
            'default' => '1'
        ),


        array(
            'id'     => 'home_friends',
            'type'   => 'group',
            'title'  => '合作伙伴',
            'fields' => array(
                array(
                    'id'          => 'title',
                    'type'        => 'text',
                    'title'       => '标题',
                    'placeholder' => '标题'
                ),
                array(
                    'id'      => 'image',
                    'type'    => 'media',
                    'title'   => '图片',
                    'library' => 'image',
                ),
                array(
                    'id'       => 'link',
                    'type'     => 'text',
                    'title'    => '链接',
                    'default'  => 'https://www.zhuige.com',
                ),
                array(
                    'id'    => 'switch',
                    'type'  => 'switcher',
                    'title' => '开启/停用',
                    'default' => '1'
                ),
            ),
        ),

        array(
            'id'    => 'home_friends_switch',
            'type'  => 'switcher',
            'title' => '合作伙伴',
            'subtitle' => '开启/停用',
            'default' => '1'
        ),
    )
));


CSF::createSection($prefix, array(
    'title'       => '公司动态',
    'icon'        => 'fas fa-globe-asia',
    'fields'      => array(

        array(
            'id'      => 'news_background',
            'type'    => 'media',
            'title'   => '背景',
            'library' => 'image',
        ),

    )
));

$pages = get_pages();
$pageOptions = [];
$about_doc_nav_default = [];
foreach ($pages as $page) {
    $template = get_post_meta($page->ID, '_wp_page_template', true);
    if ($template== 'page-about.php') {
        $pageOptions[$page->ID] = $page->post_title;
        $about_doc_nav_default[] = $page->ID;
    }
}
CSF::createSection($prefix, array(
    'title'       => '关于我们',
    'icon'        => 'fas fa-user-tie',
    'fields'      => array(

        array(
            'id'      => 'about_background',
            'type'    => 'media',
            'title'   => '背景',
            'library' => 'image',
        ),

        array(
            'id'          => 'about_doc_nav',
            'type'        => 'select',
            'title'       => '文档导航',
            'chosen'      => true,
            'multiple'    => true,
            'sortable'    => true,
            // 'ajax'        => true,
            // 'options'     => 'pages',
            'placeholder' => 'Select pages',
            'options'     => $pageOptions,
            'default'     => $about_doc_nav_default,
        ),
    )
));


CSF::createSection($prefix, array(
    'title'       => '留言反馈',
    'icon'        => 'fab fa-whatsapp',
    'fields'      => array(

        array(
            'id'      => 'feedback_background',
            'type'    => 'media',
            'title'   => '背景',
            'library' => 'image',
        ),

    )
));

//
// 页脚设置
//
CSF::createSection($prefix, array(
    'title' => '页脚设置',
    'icon'  => 'fas fa-copyright',
    'fields' => array(

        array(
            'id'    => 'footer_copyright',
            'type'  => 'wp_editor',
            'title' => '页脚版权',
        ),

        array(
            'id'       => 'footer_statistics',
            'type'     => 'code_editor',
            'title'    => '网站统计',
            'settings' => array(
                'theme'  => 'dracula',
                'mode'   => 'javascript',
            ),
            'default' => '',
        ),
    )
));

//
// SEO设置
//
CSF::createSection($prefix, array(
    'title' => 'SEO设置',
    'icon'  => 'fas fa-bolt',
    'fields' => array(

        array(
            'id'          => 'site_title',
            'type'        => 'text',
            'title'       => '网站标题',
            'placeholder' => '网站标题'
        ),

        array(
            'id'          => 'site_keyword',
            'type'        => 'text',
            'title'       => '首页关键词',
            'placeholder' => '首页关键词',
            'after'    => '<p>请用英文逗号分割.</p>',
        ),

        array(
            'id'          => 'site_description',
            'type'        => 'textarea',
            'title'       => '首页描述',
            'placeholder' => '首页描述',
        ),

    )
));

//
// 备份
//
CSF::createSection($prefix, array(
    'title'       => '主题备份',
    'icon'        => 'fas fa-shield-alt',
    'fields'      => array(

        array(
            'type' => 'backup',
        ),

    )
));
