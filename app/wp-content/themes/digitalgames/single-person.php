<?php get_header(); if (have_posts()):?>
<div class="c-content-wrap u-mb-l">
    <?php while (have_posts()): the_post();?>
    <div class="o-switcher o-switcher:author">
        <div class="c-author-pict c-author-pict:single">
            <picture class="o-frame o-frame:square o-frame:round">
                <?php
                    if (has_post_thumbnail()) {
                        echo '<img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="' . get_the_post_thumbnail_url($post->ID, 'full') .'" decoding="async" alt="" width="100%" height="100%" />';
                    } else {
                        echo '<source data-srcset="' . get_template_directory_uri() . '/img/profile.avif" type="image/avif" /><source data-srcset="' . get_template_directory_uri() . '/img/profile.webp" type="image/webp" /><img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="' . get_template_directory_uri() . '/img/profile.png" alt="" />';
                    }
        ?>
            </picture>
        </div>
        <dl class="o-stack o-stack:xs">
            <dt class="c-author-name c-author-name:single">
                <?php the_title();?>
            </dt>
            <dd>
                <dl class="c-person-list">
                    <dt class="c-person-list__title">
                        分類
                    </dt>
                    <dd class="c-person-list__content">
                        <?php
                            $type = get_post_meta($post->ID, 'person_type', true);
        $output = '';
        $type ? $output = $type : $output = '???';
        echo $output;
        ?>
                    </dd>
                    <dt class="c-person-list__title">
                        所属
                    </dt>
                    <dd class="c-person-list__content">
                        <?php
                            $company = get_post_meta($post->ID, 'person_company', true);
        $output = '';
        $company ? $output = $company : $output = '???';
        echo $output;
        ?>
                    </dd>
                    <dt class="c-person-list__title">
                        肩書き/役職
                    </dt>
                    <dd class="c-person-list__content">
                        <?php
                            $job = get_post_meta($post->ID, 'person_job', true);
        $output = '';
        $job ? $output = $job : $output = '???';
        echo $output;
        ?>
                    </dd>
                    <?php if ($type === '卒業生'):?>
                    <dt class="c-person-list__title">
                        入学年次
                    </dt>
                    <dd class="c-person-list__content">
                        <?php
                            $year = get_post_meta($post->ID, 'person_year', true);
                        $output = '';
                        $year ? $output = $year . '年' : $output = '????年';
                        echo $output;
                        ?>
                    </dd>
                    <?php endif;?>
                    <dt class="c-person-list__title">
                        連絡先（SNS）
                    </dt>
                    <dd class="c-person-list__content">
                        <?php
                            $url = get_post_meta($post->ID, 'person_url', true);
        $fb = get_post_meta($post->ID, 'person_fb', true);
        $tw = get_post_meta($post->ID, 'person_tw', true);
        $insta = get_post_meta($post->ID, 'person_insta', true);
        $sns = [];
        if ($fb) {
            $fbarray = array(
                'url' => esc_url($fb),
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc.--><path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z" fill="currentColor"/></svg>'
            );
            $sns[] = $fbarray;
        }
        if ($tw) {
            $twarray = array(
                'url' => esc_url($tw),
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc.--><path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z" fill="currentColor"/></svg>'
            );
            $sns[] = $twarray;
        }
        if ($insta) {
            $twarray = array(
                'url' => esc_url($insta),
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" fill="currentColor"></path></svg>'
            );
            $sns[] = $twarray;
        }
        if ($url) {
            $urlarray = array(
                'url' => esc_url($url),
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M172.5 131.1C228.1 75.51 320.5 75.51 376.1 131.1C426.1 181.1 433.5 260.8 392.4 318.3L391.3 319.9C381 334.2 361 337.6 346.7 327.3C332.3 317 328.9 297 339.2 282.7L340.3 281.1C363.2 249 359.6 205.1 331.7 177.2C300.3 145.8 249.2 145.8 217.7 177.2L105.5 289.5C73.99 320.1 73.99 372 105.5 403.5C133.3 431.4 177.3 435 209.3 412.1L210.9 410.1C225.3 400.7 245.3 404 255.5 418.4C265.8 432.8 262.5 452.8 248.1 463.1L246.5 464.2C188.1 505.3 110.2 498.7 60.21 448.8C3.741 392.3 3.741 300.7 60.21 244.3L172.5 131.1zM467.5 380C411 436.5 319.5 436.5 263 380C213 330 206.5 251.2 247.6 193.7L248.7 192.1C258.1 177.8 278.1 174.4 293.3 184.7C307.7 194.1 311.1 214.1 300.8 229.3L299.7 230.9C276.8 262.1 280.4 306.9 308.3 334.8C339.7 366.2 390.8 366.2 422.3 334.8L534.5 222.5C566 191 566 139.1 534.5 108.5C506.7 80.63 462.7 76.99 430.7 99.9L429.1 101C414.7 111.3 394.7 107.1 384.5 93.58C374.2 79.2 377.5 59.21 391.9 48.94L393.5 47.82C451 6.731 529.8 13.25 579.8 63.24C636.3 119.7 636.3 211.3 579.8 267.7L467.5 380z" fill="currentColor"/></svg>'
            );
            $sns[] = $urlarray;
        }
        if ($sns) {
            echo '<div class="o-cluster">';
            foreach ($sns as $elem) {
                echo '<a class="c-link c-link:personSns" href="' . $elem['url'] . '" target="_blank" rel="noopener">' . $elem['icon'] . '</a>';
            }
            echo '</div>';
        } else {
            echo '???';
        }
        ?>
                    </dd>
                </dl>
            </dd>
        </dl>
    </div>
    <?php endwhile;?>
</div>
<?php echo get_related_person(); endif;get_footer();
