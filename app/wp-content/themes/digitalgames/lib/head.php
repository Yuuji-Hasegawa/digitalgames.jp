<?php

add_theme_support('title-tag');
function set_my_title()
{
    if (is_404()) {
        $my_title = '見つかりませんでした';
    } elseif (is_archive()) {
        if (is_post_type_archive('news')) {
            $my_title = 'お知らせ';
        } elseif (is_post_type_archive('person')) {
            $my_title = '卒業生/教員/関係者';
        } elseif (is_post_type_archive('company')) {
            $my_title = '事業者/企業';
        } elseif (is_category()) {
            $my_title = single_cat_title('', false);
        } elseif (is_tag()) {
            $my_title = '#' . single_tag_title('', false);
        } else {
            $my_title = 'コンテンツ';
        }
    } else {
        $my_title = get_the_title();
    }
    return $my_title;
}
function meta_title()
{
    $title = set_my_title();
    if (!is_front_page()) {
        $meta_title = $title . ' | ' . get_bloginfo('name');
    } else {
        $meta_title = get_bloginfo('name');
    }
    return $meta_title;
}
add_filter('pre_get_document_title', 'meta_title');

function get_page_title()
{
    global $post;
    $css = '';
    is_front_page() ? $css = 'c-page-heading c-page-heading:front' : $css = 'c-page-heading';
    $output = '<h1 class="' . $css . '">';
    if (is_front_page()) {
        $output .= '<span class="c-page-heading__font-large">';
        $output .= "dg's reunion";
        $output .= '</span><span class="c-page-heading__font-small">non official meeting</span>';
    } elseif (is_404()) {
        $output .= '<span class="c-page-heading__font-large">Not Found.</span><span class="c-page-heading__font-small">見つかりませんでした。</span>';
    } elseif (is_page()) {
        if (is_page('privacy-policy')) {
            $output .= '<span class="c-page-heading__font-large">Privacy Policy</span><span class="c-page-heading__font-small">' . get_the_title() .'</span>';
        } elseif (is_page('aboutus')) {
            $output .= '<span class="c-page-heading__font-large">About Us</span><span class="c-page-heading__font-small">' . get_the_title() .'</span>';
        } else {
            $output .= '<span class="c-page-heading__font-large">' . ucfirst($post->post_name) . '</span><span class="c-page-heading__font-small">' . get_the_title() .'</span>';
        }
    } elseif (is_archive()) {
        if (is_post_type_archive('news')) {
            $output .= '<span class="c-page-heading__font-large">News</span><span class="c-page-heading__font-small">お知らせ</span>';
        } elseif (is_post_type_archive('person')) {
            $output .= '<span class="c-page-heading__font-large">Person</span><span class="c-page-heading__font-small">卒業生 / 教員 / 関係者</span>';
        } elseif (is_post_type_archive('company')) {
            $output .= '<span class="c-page-heading__font-large">Company</span><span class="c-page-heading__font-small">事業者 / 企業</span>';
        } elseif (is_category()) {
            $output .= '<span class="c-page-heading__font-large">Category</span><span class="c-page-heading__font-small">' . single_cat_title('', false) . '</span>';
        } elseif (is_tag()) {
            $output .= '<span class="c-page-heading__font-large">Tag</span><span class="c-page-heading__font-small">#' . single_tag_title('', false) . '</span>';
        } else {
            $output .= '<span class="c-page-heading__font-large">Post</span><span class="c-page-heading__font-small">コンテンツ</span>';
        }
    } elseif (is_single()) {
        if ('news' == get_post_type()) {
            $output .= '<span class="c-page-heading__font-large">News</span><span class="c-page-heading__font-small">' . get_the_title($post->ID) . '</span>';
        } elseif ('person' == get_post_type()) {
            $output .= '<span class="c-page-heading__font-large">Person</span><span class="c-page-heading__font-small">' . get_the_title($post->ID) . '</span>';
        } elseif ('company' == get_post_type()) {
            $output .= '<span class="c-page-heading__font-large">Company</span><span class="c-page-heading__font-small">' . get_the_title($post->ID) . '</span></li>';
        } elseif (is_attachment()) {
            $output .= '<span class="c-page-heading__font-large">Attachment</span><span class="c-page-heading__font-small">'. '添付ファイル：' . wp_title('', false) . '</span>';
        } else {
            $output .= '<span class="c-page-heading__font-large">Post</span><span class="c-page-heading__font-small">' . get_the_title($post->ID) . '</span>';
        }
    }
    $output .= '</h1>';
    return $output;
}
function my_robots()
{
    if ('0' != get_option('blog_public')) {
        if (is_page() || is_single() || is_singular() || is_home()) {
            $robots = 'index, follow';
        } elseif (is_paged() || is_tag() || is_date() || is_archive() || is_category() || is_tax()) {
            $robots = 'noindex, follow';
        } elseif (is_search() || is_404() || is_attachment()) {
            $robots = 'noindex, nofollow';
        }
        return '<meta name="robots" content="' . $robots .'">';
    }
}
function get_my_canonical()
{
    global $post;
    $canonical = '';
    if (is_404()) {
        $protocol = empty($_SERVER["HTTPS"]) ? "http://" : "https://";
        $canonical = esc_url($protocol. $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
    } elseif (is_single() || is_page()) {
        $canonical = esc_url(get_permalink($post->ID));
    } elseif (is_archive()) {
        if (is_post_type_archive('news')) {
            $canonical = esc_url(home_url('/news'));
        } elseif (is_post_type_archive('person')) {
            $canonical = esc_url(home_url('/person'));
        } elseif (is_post_type_archive('company')) {
            $canonical = esc_url(home_url('/company'));
        } elseif (is_category()) {
            $cat = get_queried_object();
            $canonical = esc_url(get_category_link($cat->term_id));
        } else {
            $canonical = esc_url(home_url('/post'));
        }
    } else {
        $canonical = home_url();
    }
    return $canonical;
}
function my_keywords()
{
    global $post;
    $keywords = '';
    $base_keywords = get_vars('site', 'keywords');
    if ($base_keywords) {
        $keywords .= $base_keywords[0];
        for ($i = 1; $i < count($base_keywords); $i++) {
            $keywords .= ',' . $base_keywords[$i];
        }
    }
    if (is_single() || is_page()) {
        $add_keywords = get_post_meta($post->ID, 'meta_keywords', true);
        if ($add_keywords) {
            $keywords .= ',' . $add_keywords;
        }
    }
    return $keywords;
}
function my_description()
{
    global $post;
    $output = '';
    if (is_single() || is_page()) {
        $meta_description = esc_html(get_post_meta($post->ID, 'meta_description', true));
        if (!empty($meta_description)) {
            if (mb_strlen($meta_description, 'UTF-8') > 200) {
                $output = mb_substr($meta_description, 0, 200, 'UTF-8') . '……';
            } else {
                $output = $meta_description;
            }
        } else {
            get_vars('site', 'description') ? $output = get_vars('site', 'description') : $output = get_bloginfo('description');
        }
    } else {
        get_vars('site', 'description') ? $output = get_vars('site', 'description') : $output = get_bloginfo('description');
    }
    return $output;
}
function my_ogp()
{
    global $post;
    $img_url = '';
    if (is_single() || is_page()) {
        $ogp_title = esc_html(get_the_title($post->ID));
    } else {
        $ogp_title = get_bloginfo('name');
    }
    if (is_single() || is_page()) {
        if (has_post_thumbnail()) {
            $img_url = get_the_post_thumbnail_url($post->ID, 'full');
        }
    }
    if (!$img_url) {
        $img_url = get_template_directory_uri() . '/img/ogp.png';
    }
    $ogp = '<meta property="og:locale" content="ja_JP">';
    $ogp .= '<meta property="og:description" content="' . my_description() . '">';
    $ogp .= '<meta property="og:type" content="' . get_ogp_type() . '">';
    $ogp .= '<meta property="og:title" content="'. $ogp_title . '">';
    $ogp .= '<meta property="og:url" content="' . get_my_canonical() . '">';
    $ogp .= '<meta property="og:site_name" content="' . get_vars('site', 'name') . '">';
    $ogp .= '<meta property="og:image" content="' . $img_url . '">';
    $ogp .= '<meta name="twitter:card" content="summary_large_image">';
    $ogp .= '<meta name="twitter:site" content="@digitalgamesJP">';
    $ogp .= '<meta name="twitter:description" content="' . my_description() . '">';
    $ogp .= '<meta name="twitter:title" content="' . $ogp_title . '">';
    $ogp .= '<meta name="twitter:creator" content="@kamenwriter01">';
    $ogp .= '<meta name="twitter:image:src" content="' . $img_url . '">';
    return $ogp;
}
function add_head()
{
    $inserts = '<meta content="telephone=no" name="format-detection" />';
    $inserts .= '<meta content="address=no" name="format-detection" />';
    $inserts .= '<meta name="keywords" content="' . my_keywords() . '" />';
    $inserts .= '<meta name="description" content="' . my_description() . '" />';
    $inserts .= my_robots();
    $inserts .= '<link rel="canonical" href="' . get_my_canonical() . '">';
    $inserts .= my_ogp();
    $inserts .= '<link rel="icon" href="' . get_template_directory_uri() . '/favicon.ico" />';
    $inserts .= '<link rel="apple-touch-icon" sizes="180×180" href="' .  home_url() . '/pwa/icons/icon-180x180.png" />';
    $inserts .= '<meta name="theme-color" content="' . get_vars('site', 'theme') . '" />';
    $inserts .= '<link rel="manifest" href="' . home_url() . '/manifest.json" />';
    $inserts .= '<meta name="apple-mobile-web-app-title" content="' . get_vars('site', 'name') . '">';
    $inserts .= '<meta name="apple-mobile-web-app-capable" content="yes">';
    $inserts .= '<meta name="apple-mobile-web-app-status-bar-style" content="default">';
    $inserts .= '<link rel="apple-touch-icon-precomposed" href="' . home_url() . '/pwa/icons/icon-512x512.png" />';
    echo $inserts;
}
add_action('wp_head', 'add_head');
