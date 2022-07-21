<?php

add_theme_support('post-thumbnails');
add_action('init', 'remove_block_editor_options');
function remove_block_editor_options()
{
    remove_post_type_support('post', 'excerpt');  // 抜粋
    remove_post_type_support('post', 'trackbacks');// トラックバック
    remove_post_type_support('post', 'author');// 作成者
    remove_post_type_support('post', 'comments');// コメント
    remove_post_type_support('post', 'page-attributes'); // 表示順
    remove_post_type_support('post', 'post-formats');// 投稿フォーマット
    remove_post_type_support('page', 'page-attributes');
    remove_post_type_support('page', 'excerpt');  // 抜粋
    remove_post_type_support('page', 'trackbacks');// トラックバック
    remove_post_type_support('page', 'author');// 作成者
    remove_post_type_support('page', 'comments');// コメント
    remove_post_type_support('page', 'page-attributes'); // 表示順
}
add_action('init', 'create_post_type');
function create_post_type()
{
    register_post_type(
        'news',
        array(
        'labels' => array(
            'name' => 'お知らせ',
            'singular_name' => 'お知らせ',
            'add_new_item' => 'お知らせの新規追加',
            'edit_item' => 'お知らせの編集'
        ),
        'hierarchical' => false,
        'public' => true,
        'menu_position' =>10,
        'has_archive' => true,
        'menu_icon'   => 'dashicons-format-aside',
        'rewrite' => array('with_front' => false),
        'supports' => array('title','editor')
        )
    );
    register_post_type(
        'person',
        array(
        'labels' => array(
            'name' => '卒業生/教員/関係者',
            'singular_name' => '卒業生/教員/関係者',
            'add_new_item' => '卒業生/教員/関係者の新規追加',
            'edit_item' => '卒業生/教員/関係者の編集'
        ),
        'hierarchical' => false,
        'public' => true,
        'menu_position' =>11,
        'has_archive' => true,
        'menu_icon'   => 'dashicons-id',
        'rewrite' => array('with_front' => false),
        'supports' => array('title','thumbnail')
        )
    );
    register_post_type(
        'company',
        array(
        'labels' => array(
            'name' => '事業者/企業',
            'singular_name' => '事業者/企業',
            'add_new_item' => '事業者/企業の新規追加',
            'edit_item' => '事業者/企業の編集'
        ),
        'hierarchical' => false,
        'public' => true,
        'menu_position' =>12,
        'has_archive' => true,
        'menu_icon'   => 'dashicons-building',
        'rewrite' => array('with_front' => false),
        'supports' => array('title','thumbnail')
        )
    );
}
function custom_post_type_link($link, $post)
{
    if ($post->post_type === 'news') {
        return home_url('/news/' . $post->ID);
    } elseif ($post->post_type === 'person') {
        return home_url('/person/' . $post->ID);
    } elseif ($post->post_type === 'company') {
        return home_url('/company/' . $post->ID);
    } else {
        return $link;
    }
}
add_filter('post_type_link', 'custom_post_type_link', 1, 2);
function news_rewrite_rules_array($rules)
{
    $new_rewrite_rules = array(
      'news/([0-9]+)/?$' => 'index.php?post_type=news&p=$matches[1]',
    );
    return $new_rewrite_rules + $rules;
}
add_filter('rewrite_rules_array', 'news_rewrite_rules_array');
function person_rewrite_rules_array($rules)
{
    $new_rewrite_rules = array(
      'person/([0-9]+)/?$' => 'index.php?post_type=person&p=$matches[1]',
    );
    return $new_rewrite_rules + $rules;
}
add_filter('rewrite_rules_array', 'person_rewrite_rules_array');
function company_rewrite_rules_array($rules)
{
    $new_rewrite_rules = array(
      'company/([0-9]+)/?$' => 'index.php?post_type=company&p=$matches[1]',
    );
    return $new_rewrite_rules + $rules;
}
add_filter('rewrite_rules_array', 'company_rewrite_rules_array');
function post_has_archive($args, $post_type)
{
    if ('post' == $post_type) {
        $args['rewrite'] = true;
        $args['has_archive'] = esc_attr('post');
    }
    return $args;
}
add_filter('register_post_type_args', 'post_has_archive', 10, 2);

function change_post_menu_label()
{
    global $menu;
    global $submenu;
    $menu[5][0] = esc_attr('コンテンツ');
    $submenu['edit.php'][5][0] = esc_attr('コンテンツ一覧');
    $submenu['edit.php'][10][0] = '新しい' . esc_attr('コンテンツ');
    $submenu['edit.php'][16][0] = 'タグ';
}

function change_post_object_label()
{
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = esc_attr('コンテンツ');
    $labels->singular_name = esc_attr('コンテンツ');
    $labels->add_new = _x('追加', esc_attr('コンテンツ'));
    $labels->add_new_item = esc_attr('コンテンツ') . 'の新規追加';
    $labels->edit_item = esc_attr('コンテンツ') . 'の編集';
    $labels->new_item = '新規' . esc_attr('コンテンツ');
    $labels->view_item = esc_attr('コンテンツ') . 'を表示';
    $labels->search_items = esc_attr('コンテンツ') . 'を検索';
    $labels->not_found = 'コンテンツが見つかりませんでした';
    $labels->not_found_in_trash = 'ゴミ箱にコンテンツは見つかりませんでした';
}
add_action('init', 'change_post_object_label');
add_action('admin_menu', 'change_post_menu_label');

function add_my_box()
{
    $addtype = array( 'post', 'page', 'news', 'person', 'company' );
    add_meta_box('meta_info', 'SEO', 'meta_info_form', $addtype, 'normal');
    add_meta_box('person_info', '人物情報', 'person_info_form', 'person', 'normal');
    add_meta_box('company_info', '企業情報', 'company_info_form', 'company', 'normal');
}
add_action('admin_menu', 'add_my_box');

function meta_info_form()
{
    global $post;
    $keywords = get_post_meta($post->ID, 'meta_keywords', true);
    $description = get_post_meta($post->ID, 'meta_description', true); ?>
<h3 style="font-size: 14px; margin: 0 0 8px;">キーワード</h3>
<input type="text" name="meta_keywords"
    value="<?php echo esc_html($keywords); ?>"
    style="width: 100%;margin: 0 0 8px;" />
<p style="color:#666; font-size: 13px; line-height: 1.68; margin: 0">キーワードが複数ある場合はコンマで区切ってください</p>
<h3 style="font-size: 14px; margin: 8px 0;padding: 8px 0 0;border-top:1px solid #ccd0d4;">ディスクリプション（抜粋兼用） <span
        style="color:#666; font-size: 13px">※200文字以上は省略されます。</span></h3>
<textarea id="meta_description" name="meta_description" rows="1" cols="40"
    style="width: 100%; height: 60px"><?php echo htmlspecialchars($description); ?></textarea>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        var maxcount = 200;
        $('#meta_description').after(
            '<p style=\"color:#666; font-size: 13px; margin: 0\">文字数: <span id=\"description-count\"></span></p>'
        );
        $('#description-count').text($('#meta_description').val().replace(/\s+/g, '').length);
        if ($('#meta_description').val().replace(/\s+/g, '').length > maxcount) {
            $('#description-count').css('color', '#f00');
        } else {
            $('#description-count').css('color', '#666');
        }
        $('#meta_description').bind("keydown keyup keypress change", function() {
            $('#description-count').text($('#meta_description').val().replace(/\s+/g, '').length);
            if ($(this).val().replace(/\s+/g, '').length > maxcount) {
                $('#description-count').css('color', '#f00');
            } else {
                $('#description-count').css('color', '#666');
            }
        });
        $('.categorychecklist>li:first-child, .cat-checklist>li:first-child').before(
            '<p style="font-size: 14px; margin: 0 0 8px;">※ 複数選んでも、表示は1つです。</p>');
    });
</script>
<?php
}

function person_info_form()
{
    global $post;
    $person_type = get_post_meta($post->ID, 'person_type', true);
    $person_company = get_post_meta($post->ID, 'person_company', true);
    $person_job = get_post_meta($post->ID, 'person_job', true);
    $person_year = get_post_meta($post->ID, 'person_year', true);
    $person_fb = get_post_meta($post->ID, 'person_fb', true);
    $person_tw = get_post_meta($post->ID, 'person_tw', true);
    $person_insta = get_post_meta($post->ID, 'person_insta', true);
    $person_url = get_post_meta($post->ID, 'person_url', true); ?>
<h3 style="font-size: 14px; margin: 0 0 8px;">分類</h3>
<input type="text" name="person_type"
    value="<?php echo esc_html($person_type); ?>"
    style="width: 100%;margin: 0 0 8px;" />
<p style="color:#666; font-size: 13px; line-height: 1.68; margin: 0">卒業生、教員、他学科のいずれかを記載してください</p>
<h3 style="font-size: 14px; margin: 8px 0;padding: 8px 0 0;border-top:1px solid #ccd0d4;">所属</h3>
<input type="text" name="person_company"
    value="<?php echo esc_html($person_company); ?>"
    style="width: 100%;margin: 0 0 8px;" />
<h3 style="font-size: 14px; margin: 8px 0;padding: 8px 0 0;border-top:1px solid #ccd0d4;">肩書き/役職</h3>
<input type="text" name="person_job"
    value="<?php echo esc_html($person_job); ?>"
    style="width: 100%;margin: 0 0 8px;" />
<h3 style="font-size: 14px; margin: 8px 0;padding: 8px 0 0;border-top:1px solid #ccd0d4;">入学年次</h3>
<input type="text" name="person_year"
    value="<?php echo esc_html($person_year); ?>"
    style="width: 100%;margin: 0 0 8px;" placeholder="例）2020" />
<p style="color:#666; font-size: 13px; line-height: 1.68; margin: 0">卒業生の場合は入力してください</p>
<h3 style="font-size: 14px; margin: 8px 0;padding: 8px 0 0;border-top:1px solid #ccd0d4;">Facebook</h3>
<input type="text" name="person_fb"
    value="<?php echo esc_html($person_fb); ?>"
    style="width: 100%;margin: 0 0 8px;" placeholder="例）https://www.facebook.com/xxxxxx" />
<h3 style="font-size: 14px; margin: 8px 0;padding: 8px 0 0;border-top:1px solid #ccd0d4;">Twitter</h3>
<input type="text" name="person_tw"
    value="<?php echo esc_html($person_tw); ?>"
    style="width: 100%;margin: 0 0 8px;" placeholder="例）https://twitter.com/xxxxxx" />
<h3 style="font-size: 14px; margin: 8px 0;padding: 8px 0 0;border-top:1px solid #ccd0d4;">instagram</h3>
<input type="text" name="person_insta"
    value="<?php echo esc_html($person_insta); ?>"
    style="width: 100%;margin: 0 0 8px;" placeholder="例）https://www.instagram.com/xxxxxxx" />
<h3 style="font-size: 14px; margin: 8px 0;padding: 8px 0 0;border-top:1px solid #ccd0d4;">その他のURL</h3>
<input type="text" name="person_url"
    value="<?php echo esc_html($person_url); ?>"
    style="width: 100%;margin: 0 0 8px;" placeholder="例）https://examples.com" />
<?php
}
function company_info_form()
{
    global $post;
    $company_owner = get_post_meta($post->ID, 'company_owner', true);
    $company_type = get_post_meta($post->ID, 'company_type', true);
    $company_zip = get_post_meta($post->ID, 'company_zip', true);
    $company_address = get_post_meta($post->ID, 'company_address', true);
    $company_mail = get_post_meta($post->ID, 'company_mail', true);
    $company_url = get_post_meta($post->ID, 'company_url', true);
    $company_service = get_post_meta($post->ID, 'company_service', true); ?>
<h3 style="font-size: 14px; margin: 0 0 8px;">代表者</h3>
<input type="text" name="company_owner"
    value="<?php echo esc_html($company_owner); ?>"
    style="width: 100%;margin: 0 0 8px;" />
<h3 style="font-size: 14px;margin: 8px 0;padding: 8px 0 0;border-top:1px solid #ccd0d4;">業種</h3>
<input type="text" name="company_type"
    value="<?php echo esc_html($company_type); ?>"
    style="width: 100%;margin: 0 0 8px;" />
<h3 style="font-size: 14px;margin: 8px 0;padding: 8px 0 0;border-top:1px solid #ccd0d4;">郵便番号</h3>
<input type="text" name="company_zip"
    value="<?php echo esc_html($company_zip); ?>"
    placeholder="例)000-0000" style="width: 100%;margin: 0 0 8px;" />
<h3 style="font-size: 14px;margin: 8px 0;padding: 8px 0 0;border-top:1px solid #ccd0d4;">所在地</h3>
<input type="text" name="company_address"
    value="<?php echo esc_html($company_address); ?>"
    style="width: 100%;margin: 0 0 8px;" />
<h3 style="font-size: 14px;margin: 8px 0;padding: 8px 0 0;border-top:1px solid #ccd0d4;">連絡先</h3>
<input type="text" name="company_mail"
    value="<?php echo esc_html($company_mail); ?>"
    placeholder="例)info@examples.com" style="width: 100%;margin: 0 0 8px;" />
<p style="color:#666; font-size: 13px; line-height: 1.68; margin: 0">メールアドレスを入力ください</p>
<h3 style="font-size: 14px;margin: 8px 0;padding: 8px 0 0;border-top:1px solid #ccd0d4;">URL</h3>
<input type="text" name="company_url"
    value="<?php echo esc_html($company_url); ?>"
    style="width: 100%;margin: 0 0 8px;" />
<h3 style="font-size: 14px; margin: 8px 0;padding: 8px 0 0;border-top:1px solid #ccd0d4;">事業内容</h3>
<textarea id="company_service" name="company_service" rows="1" cols="40"
    style="width: 100%; height: 60px"><?php echo htmlspecialchars($company_service); ?></textarea>
<p style="color:#666; font-size: 13px; line-height: 1.68; margin: 0">コンマが行ごとの区切りになります。</p>
<?php
}
function save_meta_info($post_id)
{
    if (isset($_POST['meta_keywords'])) {
        update_post_meta($post_id, 'meta_keywords', $_POST['meta_keywords']);
    } else {
        delete_post_meta($post_id, 'meta_keywords');
    }
    if (isset($_POST['meta_description'])) {
        update_post_meta($post_id, 'meta_description', $_POST['meta_description']);
    } else {
        delete_post_meta($post_id, 'meta_description');
    }
    if (isset($_POST['person_type'])) {
        update_post_meta($post_id, 'person_type', $_POST['person_type']);
    } else {
        delete_post_meta($post_id, 'person_type');
    }
    if (isset($_POST['person_company'])) {
        update_post_meta($post_id, 'person_company', $_POST['person_company']);
    } else {
        delete_post_meta($post_id, 'person_company');
    }
    if (isset($_POST['person_job'])) {
        update_post_meta($post_id, 'person_job', $_POST['person_job']);
    } else {
        delete_post_meta($post_id, 'person_job');
    }
    if (isset($_POST['person_year'])) {
        update_post_meta($post_id, 'person_year', $_POST['person_year']);
    } else {
        delete_post_meta($post_id, 'person_year');
    }
    if (isset($_POST['person_fb'])) {
        update_post_meta($post_id, 'person_fb', $_POST['person_fb']);
    } else {
        delete_post_meta($post_id, 'person_fb');
    }
    if (isset($_POST['person_tw'])) {
        update_post_meta($post_id, 'person_tw', $_POST['person_tw']);
    } else {
        delete_post_meta($post_id, 'person_tw');
    }
    if (isset($_POST['person_insta'])) {
        update_post_meta($post_id, 'person_insta', $_POST['person_insta']);
    } else {
        delete_post_meta($post_id, 'person_insta');
    }
    if (isset($_POST['person_url'])) {
        update_post_meta($post_id, 'person_url', $_POST['person_url']);
    } else {
        delete_post_meta($post_id, 'person_url');
    }
    if (isset($_POST['company_owner'])) {
        update_post_meta($post_id, 'company_owner', $_POST['company_owner']);
    } else {
        delete_post_meta($post_id, 'company_owner');
    }
    if (isset($_POST['company_type'])) {
        update_post_meta($post_id, 'company_type', $_POST['company_type']);
    } else {
        delete_post_meta($post_id, 'company_type');
    }
    if (isset($_POST['company_zip'])) {
        update_post_meta($post_id, 'company_zip', $_POST['company_zip']);
    } else {
        delete_post_meta($post_id, 'company_zip');
    }
    if (isset($_POST['company_address'])) {
        update_post_meta($post_id, 'company_address', $_POST['company_address']);
    } else {
        delete_post_meta($post_id, 'company_address');
    }
    if (isset($_POST['company_mail'])) {
        update_post_meta($post_id, 'company_mail', $_POST['company_mail']);
    } else {
        delete_post_meta($post_id, 'company_mail');
    }
    if (isset($_POST['company_url'])) {
        update_post_meta($post_id, 'company_url', $_POST['company_url']);
    } else {
        delete_post_meta($post_id, 'company_url');
    }
    if (isset($_POST['company_service'])) {
        update_post_meta($post_id, 'company_service', $_POST['company_service']);
    } else {
        delete_post_meta($post_id, 'company_service');
    }
}
add_action('save_post', 'save_meta_info');
