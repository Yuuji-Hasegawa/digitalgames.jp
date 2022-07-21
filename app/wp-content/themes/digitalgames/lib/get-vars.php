<?php

function get_thumb()
{
    global $post;
    $output = '<picture class="o-frame">';
    if (has_post_thumbnail()) {
        $output .= '<img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="' . get_the_post_thumbnail_url($post->ID, 'full') . '" decoding="async" alt="" width="100%" height="100%" alt="" />';
    } else {
        $output .= '
            <source data-srcset="' . get_template_directory_uri() . '/img/thumb.avif" type="image/avif" />
                    <source data-srcset="' . get_template_directory_uri() . '/img/thumb.webp" type="image/webp" />
                    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                        data-src="' . get_template_directory_uri() . '/img/thumb.png" alt="" />';
    }
    $output .= '</picture>';
    return $output;
}
function get_ogp_type()
{
    is_single() ? $og_type = 'article' : $og_type = 'website';
    return $og_type;
}
/* shortcode */
function shortcode_url()
{
    return home_url();
}
add_shortcode('url', 'shortcode_url');

function shortcode_templateurl()
{
    return get_template_directory_uri();
}
add_shortcode('template_url', 'shortcode_templateurl');

function get_post_cat()
{
    global $post;
    $output = "";
    $cat = get_the_category($post->ID);
    if ($cat && !is_wp_error($cat)) {
        $output = '<a class="c-link c-link:bottomCat" href="' . get_category_link($cat[0]->term_id) . '"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
        <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
        <path
            d="M147.8 192H480V144C480 117.5 458.5 96 432 96h-160l-64-64h-160C21.49 32 0 53.49 0 80v328.4l90.54-181.1C101.4 205.6 123.4 192 147.8 192zM543.1 224H147.8C135.7 224 124.6 230.8 119.2 241.7L0 480h447.1c12.12 0 23.2-6.852 28.62-17.69l96-192C583.2 249 567.7 224 543.1 224z"
            fill="currentColor" />
    </svg>' . $cat[0]->cat_name . '</a>';
    }
    if ($output) {
        return $output;
    }
}
function get_loop_cat()
{
    global $post;
    $output = "";
    $cat = get_the_category($post->ID);
    if ($cat && !is_wp_error($cat)) {
        $output = '<span class="c-topic-cat">' . $cat[0]->cat_name . '</span>';
    }
    if ($output) {
        return $output;
    }
}
function get_post_tags()
{
    global $post;
    $output = "";
    $tags = wp_get_object_terms($post->ID, 'post_tag');
    if ($tags && ! is_wp_error($tags)) {
        $output = '<div class="o-cluster">';
        foreach ($tags as $tagname) {
            $output .= '<a href="' . get_term_link($tagname) . '" rel="tag" class="c-link c-link:tag">' . $tagname->name . '</a>';
        }
        $output .= '</div>';
    }
    if ($output) {
        return $output;
    }
}
function my_human_time_diff($from, $to = '')
{
    if (empty($to)) {
        $to = time();
    }
    $diff = (int) abs($to - $from);
    // 条件: 3600秒 = 1時間以下なら (元のまま)
    if ($diff <= 3600) {
        $mins = round($diff / 60);
        if ($mins <= 1) {
            $mins = 1;
        }
        $since = sprintf(_n('%s min', '%s mins', $mins), $mins);
    }
    // 条件: 86400秒 = 24時間以下かつ、3600秒 = 1時間以上なら (元のまま)
    elseif (($diff <= 86400) && ($diff > 3600)) {
        $hours = round($diff / 3600);
        if ($hours <= 1) {
            $hours = 1;
        }
        $since = sprintf(_n('%s hour', '%s hours', $hours), $hours);
    }
    // 条件: 604800秒 = 7日以下かつ、86400秒 = 24時間以上なら (条件追加)
    elseif (($diff <= 604800) && ($diff > 86400)) {
        $days = round($diff / 86400);
        if ($days <= 1) {
            $days = 1;
        }
        $since = sprintf(_n('%s day', '%s days', $days), $days);
    }
    // 条件: 2678400秒 = 31日以下かつ、2678400秒 = 7日以上なら (条件追加)
    elseif (($diff <= 2678400) && ($diff > 604800)) {
        $weeks = round($diff / 604800);
        if ($weeks <= 1) {
            $weeks = 1;
        }
        $since = sprintf(_n('%s週間', '%s週間', $weeks), $weeks);
    }
    // 条件: 31536000秒 = 365日以下かつ、2678400秒 = 31日以上なら (条件追加)
    elseif (($diff <= 31536000) && ($diff > 2678400)) {
        $months = round($diff / 2678400);
        if ($months <= 1) {
            $months = 1;
        }
        $since = sprintf(_n('約%sヶ月', '約%sヶ月', $months), $months);
    }
    // 条件: 31536000秒 = 365日以上なら (条件追加)
    elseif ($diff >= 31536000) {
        $years = round($diff / 31536000);
        if ($years <= 1) {
            $years = 1;
        }
        $since = sprintf(_n('約%s年', '約%s年', $years), $years);
    }
    return $since;
}

function get_vars($parent = '', $child = '')
{
    $json = file_get_contents(get_template_directory() . '/lib/setting.json');
    $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
    $arr = json_decode($json, true);
    $output = $arr[$parent][$child];
    if ($output) {
        return $output;
    }
}
function get_service_list()
{
    $services = get_vars('company', 'service');
    $output = '';
    if ($services) {
        $output = '<ul class="c-list">';
        for ($i = 0; $i < count($services); $i++) {
            $output .= '<li>' . $services[$i] . '</li>';
        }
        $output .= '<li>その他、上記に係る業務</li></ul>';
    }
    if ($output) {
        return $output;
    }
}
