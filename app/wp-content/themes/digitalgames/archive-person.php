<?php get_header(); if (have_posts()):?>
<div class="o-switcher o-switcher:twoFive u-mb-m">
    <?php while (have_posts()): the_post();?>
    <a href="<?php the_permalink();?>" class="o-stack o-stack:prof">
        <picture class="o-frame o-frame:square o-frame:round">
            <?php
                if (has_post_thumbnail()) {
                    echo '<img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="' . get_the_post_thumbnail_url($post->ID, 'full') .'" decoding="async" alt="" width="100%" height="100%" />';
                } else {
                    echo '<source data-srcset="' . get_template_directory_uri() . '/img/profile.avif" type="image/avif" /><source data-srcset="' . get_template_directory_uri() . '/img/profile.webp" type="image/webp" /><img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="' . get_template_directory_uri() . '/img/profile.png" alt="" />';
                }
        ?>
        </picture>
        <span class="c-person-name">
            <?php the_title();?>
        </span>
    </a>
    <?php endwhile;?>
</div>
<?php endif;
echo get_pagination(); get_footer();
