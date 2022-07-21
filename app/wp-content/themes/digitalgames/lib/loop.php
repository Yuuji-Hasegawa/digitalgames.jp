<?php

function get_front_news()
{
    $output = '';
    $args = array(
        'post_type' => 'news',
        'posts_per_page' => 5,
        'orderby' => 'date',
        'order' => 'DESC',
        'no_found_rows' => true
    );
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) {
        $output = '<ul class="o-stack o-stack:news">';
        while ($the_query->have_posts()) {
            $the_query->the_post();
            $output .= '<li class="o-switcher o-switcher:news"><time datetime="' . get_the_time('Y-m-d') . '">' . get_the_time('Y.m.d') . '</time><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
        }
        $output .= '</ul>';
        wp_reset_postdata();
        $output .= '<a href="' . home_url('/news') .'"class="c-btn c-btn:more">More</a>';
    }
    if ($output) {
        return $output;
    } else {
        return '<p class="c-inner-wrap">お知らせはまだありません。</p>';
    }
}
function get_related_person()
{
    global $post;
    $output = '';
    $args = array(
        'post_type' => 'person',
        'posts_per_page' => 10,
        'no_found_rows' => true,
        'orderby' => 'rand',
        'post__not_in' => array($post->ID),
    );
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) {
        $output = '<h3 class="c-min-heading">その他の卒業生 / 教員 / 関係者</h3><aside class="o-switcher o-switcher:twoFive u-mb-m">';
        while ($the_query->have_posts()) {
            $the_query->the_post();
            $output .= '<a class="o-stack o-stack:prof" href="' . get_the_permalink() .'"><picture class="o-frame o-frame:square o-frame:round">';
            if (has_post_thumbnail()) {
                $output .= '<img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="' . get_the_post_thumbnail_url(get_the_ID(), 'full') .'" decoding="async" alt="" width="100%" height="100%" />';
            } else {
                $output .= '<source data-srcset="' . get_template_directory_uri() . '/img/profile.avif" type="image/avif" /><source data-srcset="' . get_template_directory_uri() . '/img/profile.webp" type="image/webp" /><img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="' . get_template_directory_uri() . '/img/profile.png" alt="" />';
            }
            $output .= '</picture><span class="c-person-name">' . get_the_title() . '</span></a>';
        }
        wp_reset_postdata();
        $output .= '</aside><a href="' . home_url('/person') . '" class="c-btn c-btn:more">More</a>';
    }
    if ($output) {
        return $output;
    }
}
function get_related_company()
{
    global $post;
    $output = '';
    $args = array(
        'post_type' => 'company',
        'posts_per_page' => 4,
        'no_found_rows' => true,
        'orderby' => 'rand',
        'post__not_in' => array($post->ID),
    );
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) {
        $output = '<h3 class="c-min-heading">その他の事業者 / 企業</h3><aside><ul class="o-switcher o-switcher:halfQuart u-mb-m">';
        while ($the_query->have_posts()) {
            $the_query->the_post();
            $type = get_post_meta($post->ID, 'company_type', true);
            $type ? $type = $type . '業' : $type = 'その他';
            $zip = get_post_meta($post->ID, 'company_zip', true);
            $zip ? $zip = '〒' . $zip : $zip = '〒???-????';
            $address = get_post_meta($post->ID, 'company_address', true);
            $address ? $address : $address = '???';
            $output .= '<li class="o-stack o-stack:companyItem"><a class="c-company-img" href="' . get_the_permalink() .'">' . get_thumb() . '</a>';
            $output .= '<dl class="o-stack o-stack:companyInner"><dt class="c-company-name"><a class="c-company-name__link" href="' . get_the_permalink() . '">' . get_the_title() . '</a></dt><dd class="o-stack o-stack:companyDetail">';
            $output .= '<span class="c-company-cat">' . $type . '</span>' . $zip . '<br />' . $address;
            $output .= '</dd><span class="c-person-name">' . get_the_title() . '</span></a></li>';
        }
        wp_reset_postdata();
        $output .= '</ul></aside><a href="' . home_url('/company') . '" class="c-btn c-btn:more">More</a>';
    }
    if ($output) {
        return $output;
    }
}
