<?php get_header();?>
<div class="c-inner-wrap">
    <header class="o-cluster u-mb-m">
        <time
            datetime="<?php the_time('Y-m-d')?>"
            class="o-has-icon o-has-icon:time">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc.-->
                <path
                    d="M96 32C96 14.33 110.3 0 128 0C145.7 0 160 14.33 160 32V64H288V32C288 14.33 302.3 0 320 0C337.7 0 352 14.33 352 32V64H400C426.5 64 448 85.49 448 112V160H0V112C0 85.49 21.49 64 48 64H96V32zM448 464C448 490.5 426.5 512 400 512H48C21.49 512 0 490.5 0 464V192H448V464z"
                    fill="currentColor" />
            </svg>
            <?php the_time('Y.m.d')?>
        </time>
        <time
            datetime="<?php the_modified_time('Y-m-d'); ?>"
            class="o-has-icon o-has-icon:time">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc.-->
                <path
                    d="M468.9 32.11c13.87 0 27.18 10.77 27.18 27.04v145.9c0 10.59-8.584 19.17-19.17 19.17h-145.7c-16.28 0-27.06-13.32-27.06-27.2c0-6.634 2.461-13.4 7.96-18.9l45.12-45.14c-28.22-23.14-63.85-36.64-101.3-36.64c-88.09 0-159.8 71.69-159.8 159.8S167.8 415.9 255.9 415.9c73.14 0 89.44-38.31 115.1-38.31c18.48 0 31.97 15.04 31.97 31.96c0 35.04-81.59 70.41-147 70.41c-123.4 0-223.9-100.5-223.9-223.9S132.6 32.44 256 32.44c54.6 0 106.2 20.39 146.4 55.26l47.6-47.63C455.5 34.57 462.3 32.11 468.9 32.11z"
                    fill="currentColor" />
            </svg>
            <?php the_modified_time('Y.m.d'); ?>
        </time>
    </header>
    <article class="c-entry u-mb-m">
        <?php the_content();?>
    </article>
    <div class="c-input-copy">
        <input id="shareURL" class="c-input c-input:share" type="text"
            value="<?php echo esc_url(get_permalink($post->ID));?>"
            readonly="true" />
        <button id="shareBtn" class="c-btn c-btn:copy">コピー</button>
    </div>
    <footer class="o-stack o-stack:s">
        <h3 class="c-min-heading c-min-heading:newsBottom">この記事のお問い合わせ先</h3>
        <p>
            <b>運営窓口</b>
            <br />
            〒567-0005 茨木市五日市2-17-4
            <br />
            Email:
            <a href="mailto:info@digitalgames.jp" target="_blank" rel="noopener">info@digitalgames.jp
            </a>
            <br />
            <a
                href="<?php echo home_url('/inquiry');?>">お問い合わせフォームはこちらから
            </a>
        </p>
    </footer>
</div>
<?php get_footer();
