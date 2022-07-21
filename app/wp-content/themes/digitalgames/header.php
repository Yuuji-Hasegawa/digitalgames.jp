<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head
    prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# <?php echo get_ogp_type();?>: http://ogp.me/ns/<?php echo get_ogp_type();?>#">
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.defer = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer',
            '<?php echo get_vars('site', 'gtm');?>'
        );
    </script>
    <!-- End Google Tag Manager -->
    <meta
        charset="<?php bloginfo('charset');?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
    <link rel="preload"
        href="<?php echo get_template_directory_uri();?>/fonts/Alata-Regular.woff2"
        as="font" type="font/woff2" crossorigin />
    <?php wp_head();?>
</head>

<body <?php body_class();?>>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe
            src="https://www.googletagmanager.com/ns.html?id=<?php echo get_vars('site', 'gtm');?>"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <header class="o-container o-container:header">
        <a href="<?php echo home_url();?>" class="c-logo">
            digitalgames.jp
        </a>
        <button class="c-menu-btn" type="button" aria-label="menu close" aria-controls="headMenu" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                <path
                    d="M0 96C0 78.33 14.33 64 32 64H416C433.7 64 448 78.33 448 96C448 113.7 433.7 128 416 128H32C14.33 128 0 113.7 0 96zM0 256C0 238.3 14.33 224 32 224H416C433.7 224 448 238.3 448 256C448 273.7 433.7 288 416 288H32C14.33 288 0 273.7 0 256zM416 448H32C14.33 448 0 433.7 0 416C0 398.3 14.33 384 32 384H416C433.7 384 448 398.3 448 416C448 433.7 433.7 448 416 448z"
                    fill="currentColor"></path>
            </svg>
        </button>
    </header>
    <div class="c-sidebar" id="sidebar" aria-hidden="true">
        <button class="c-menu-btn c-menu-btn:sidebar" type="button" aria-label="menu close" aria-controls="headMenu"
            aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                <path
                    d="M0 96C0 78.33 14.33 64 32 64H416C433.7 64 448 78.33 448 96C448 113.7 433.7 128 416 128H32C14.33 128 0 113.7 0 96zM0 256C0 238.3 14.33 224 32 224H416C433.7 224 448 238.3 448 256C448 273.7 433.7 288 416 288H32C14.33 288 0 273.7 0 256zM416 448H32C14.33 448 0 433.7 0 416C0 398.3 14.33 384 32 384H416C433.7 384 448 398.3 448 416C448 433.7 433.7 448 416 448z"
                    fill="currentColor"></path>
            </svg>
        </button>
        <nav class="o-stack o-stack:sidebar">
            <a class="c-link c-link:menu"
                href="<?php echo home_url('/aboutus');?>">
                当サイトについて
            </a>
            <a class="c-link c-link:menu"
                href="<?php echo home_url('/post');?>">
                コンテンツ
            </a>
            <a class="c-link c-link:menu"
                href="<?php echo home_url('/person');?>">
                卒業生 / 教員 / 関係者
            </a>
            <a class="c-link c-link:menu"
                href="<?php echo home_url('/company');?>">
                事業者 / 企業
            </a>
            <a class="c-link c-link:menu"
                href="<?php echo home_url('/inquiry');?>">
                お問い合わせ
            </a>
        </nav>
    </div>
    <div class="c-sidebar-bg"></div>
    <main>
        <?php echo get_page_title();
if (!is_front_page()) {
    echo get_breadcrumb();
}?>
        <div class="o-container o-container:inner">