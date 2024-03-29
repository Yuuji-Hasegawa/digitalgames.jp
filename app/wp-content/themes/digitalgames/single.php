<?php get_header();
if (have_posts()):?>
<div class="c-inner-wrap">
    <header class="o-grid o-grid:headAuthor">
        <a href="#authorInfo">
            <picture class="o-frame o-frame:square">
                <source
                    srcset="<?php echo get_template_directory_uri();?>/img/hasegawa.avif"
                    type="image/avif" />
                <source
                    srcset="<?php echo get_template_directory_uri();?>/img/hasegawa.webp"
                    type="image/webp" />
                <img src="<?php echo get_template_directory_uri();?>/img/hasegawa.jpg"
                    loading="lazy" decoding="async" alt="" width="100%" height="100%" />
            </picture>
        </a>
        <div class="o-stack o-stack:xxs">
            <a class="c-link" href="#authorInfo">長谷川 雄治</a>
            <div class="o-cluster o-cluster:xs">
                <time class="o-has-icon o-has-icon:time"
                    datetime="<?php the_time('Y-m-d')?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc.-->
                        <path
                            d="M96 32C96 14.33 110.3 0 128 0C145.7 0 160 14.33 160 32V64H288V32C288 14.33 302.3 0 320 0C337.7 0 352 14.33 352 32V64H400C426.5 64 448 85.49 448 112V160H0V112C0 85.49 21.49 64 48 64H96V32zM448 464C448 490.5 426.5 512 400 512H48C21.49 512 0 490.5 0 464V192H448V464z"
                            fill="currentColor" />
                    </svg>
                    <?php the_time('Y.m.d')?>
                </time>
                <time class="o-has-icon o-has-icon:time"
                    datetime="<?php the_modified_time('Y-m-d'); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc.-->
                        <path
                            d="M468.9 32.11c13.87 0 27.18 10.77 27.18 27.04v145.9c0 10.59-8.584 19.17-19.17 19.17h-145.7c-16.28 0-27.06-13.32-27.06-27.2c0-6.634 2.461-13.4 7.96-18.9l45.12-45.14c-28.22-23.14-63.85-36.64-101.3-36.64c-88.09 0-159.8 71.69-159.8 159.8S167.8 415.9 255.9 415.9c73.14 0 89.44-38.31 115.1-38.31c18.48 0 31.97 15.04 31.97 31.96c0 35.04-81.59 70.41-147 70.41c-123.4 0-223.9-100.5-223.9-223.9S132.6 32.44 256 32.44c54.6 0 106.2 20.39 146.4 55.26l47.6-47.63C455.5 34.57 462.3 32.11 468.9 32.11z"
                            fill="currentColor" />
                    </svg>
                    <?php the_modified_time('Y.m.d'); ?>
                </time>
            </div>
        </div>
    </header>
    <?php while (have_posts()): the_post();?>
    <div class="u-mb-m">
        <?php echo get_thumb();?>
    </div>
    <article class="c-entry">
        <?php the_content();?>
    </article>
    <?php endwhile;?>
    <div class="o-stack o-stack:xxs">
        <?php echo get_post_cat();
    echo get_post_tags()?>
    </div>
    <div class="c-input-copy">
        <input id="shareURL" class="c-input c-input:share" type="text"
            value="<?php echo esc_url(get_permalink($post->ID));?>"
            readonly="true" />
        <button id="shareBtn" class="c-btn c-btn:copy">コピー</button>
    </div>
    <footer id="authorInfo" class="o-switcher o-switcher:author">
        <div class="c-author-pict">
            <picture class="o-frame o-frame:square">
                <source
                    srcset="<?php echo get_template_directory_uri();?>/img/hasegawa.avif"
                    type="image/avif" />
                <source
                    srcset="<?php echo get_template_directory_uri();?>/img/hasegawa.webp"
                    type="image/webp" />
                <img src="<?php echo get_template_directory_uri();?>/img/hasegawa.jpg"
                    loading="lazy" decoding="async" alt="" width="100%" height="100%" />
            </picture>
        </div>
        <dl class="o-stack o-stack:xs">
            <dt class="c-author-name">
                長谷川 雄治
            </dt>
            <dd>
                昭和63年生まれ。<br />
                大阪電気通信大学 総合情報学部 デジタルゲーム学科（2010年）卒業。<br />
                2013年から仮面ライターとしてWeb制作に従事。<br />
                アマチュアの物書きとして、執筆活動のほか、言語や人間社会、記号論を理系、文系の両方の立場から考えるのも最近の趣味。
                <div class="o-cluster o-cluster:sns">
                    <a href="https://www.facebook.com/yuuji.hasegawa" class="c-link c-link:sns" target="_blank"
                        rel="noopener" aria-label="go to Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                            <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path
                                d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"
                                fill="currentColor" />
                        </svg>
                    </a>
                    <a href="https://twitter.com/kamenwriter01" class="c-link c-link:sns" target="_blank" rel="noopener"
                        aria-label="go to Twitter">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path
                                d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"
                                fill="currentColor" />
                        </svg>
                    </a>
                    <a href="https://www.instagram.com/kamenwriter/" class="c-link c-link:sns" target="_blank"
                        rel="noopener" aria-label="go to instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path
                                d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"
                                fill="currentColor" />
                        </svg>
                    </a>
                    <a href="https://kamenwriter.com/" class="c-link c-link:sns" target="_blank" rel="noopener"
                        aria-label="go to kamenwriter.com">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                            <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path
                                d="M172.5 131.1C228.1 75.51 320.5 75.51 376.1 131.1C426.1 181.1 433.5 260.8 392.4 318.3L391.3 319.9C381 334.2 361 337.6 346.7 327.3C332.3 317 328.9 297 339.2 282.7L340.3 281.1C363.2 249 359.6 205.1 331.7 177.2C300.3 145.8 249.2 145.8 217.7 177.2L105.5 289.5C73.99 320.1 73.99 372 105.5 403.5C133.3 431.4 177.3 435 209.3 412.1L210.9 410.1C225.3 400.7 245.3 404 255.5 418.4C265.8 432.8 262.5 452.8 248.1 463.1L246.5 464.2C188.1 505.3 110.2 498.7 60.21 448.8C3.741 392.3 3.741 300.7 60.21 244.3L172.5 131.1zM467.5 380C411 436.5 319.5 436.5 263 380C213 330 206.5 251.2 247.6 193.7L248.7 192.1C258.1 177.8 278.1 174.4 293.3 184.7C307.7 194.1 311.1 214.1 300.8 229.3L299.7 230.9C276.8 262.1 280.4 306.9 308.3 334.8C339.7 366.2 390.8 366.2 422.3 334.8L534.5 222.5C566 191 566 139.1 534.5 108.5C506.7 80.63 462.7 76.99 430.7 99.9L429.1 101C414.7 111.3 394.7 107.1 384.5 93.58C374.2 79.2 377.5 59.21 391.9 48.94L393.5 47.82C451 6.731 529.8 13.25 579.8 63.24C636.3 119.7 636.3 211.3 579.8 267.7L467.5 380z"
                                fill="currentColor" />
                        </svg>
                    </a>
                </div>
            </dd>
        </dl>
    </footer>
</div>
<?php endif;
get_footer();
?>