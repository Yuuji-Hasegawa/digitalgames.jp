<?php get_header(); if (have_posts()):?>
<ul class="o-switcher o-switcher:halfQuart u-mb-m">
    <?php while (have_posts()): the_post();?>
    <li class="o-stack o-stack:companyItem">
        <a class="c-company-img" href="<?php the_permalink();?>">
            <?php echo get_thumb();?>
        </a>
        <dl class="o-stack o-stack:companyInner">
            <dt class="c-company-name">
                <a class="c-company-name__link"
                    href="<?php the_permalink();?>">
                    <?php the_title();?>
                </a>
            </dt>
            <dd class="o-stack o-stack:companyDetail">
                <span class="c-company-cat">
                    <?php
                        $type = get_post_meta($post->ID, 'company_type', true);
        $output = '';
        $type ? $output = $type . '業' : $output = 'その他';
        echo $output;
        ?>
                </span>
                <?php
                    $zip = get_post_meta($post->ID, 'company_zip', true);
        $output = '';
        $zip ? $output = '〒' . $zip : $output = '〒???-????';
        echo $output;
        ?><br />
                <?php $address = get_post_meta($post->ID, 'company_address', true);
        $output = '';
        $address ? $output = $address : $output = '???';
        echo $output;?>
            </dd>
        </dl>
    </li>
    <?php endwhile;?>
</ul>
<?php endif;
echo get_pagination(); get_footer();
