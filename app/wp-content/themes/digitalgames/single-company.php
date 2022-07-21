<?php get_header(); if (have_posts()):?>
<div class="c-content-wrap u-mb-l">
    <?php while (have_posts()): the_post();?>
    <div class="u-mb-m">
        <?php echo get_thumb();?>
    </div>
    <dl class="c-table">
        <dt class="c-table__title">代表者</dt>
        <dd class="c-table__content">
            <?php
                            $owner = get_post_meta($post->ID, 'company_owner', true);
        $output = '';
        $owner ? $output = $owner : $output = '???';
        echo $output;
        ?>
        </dd>
        <dt class="c-table__title">業種</dt>
        <dd class="c-table__content">
            <?php
                        $type = get_post_meta($post->ID, 'company_type', true);
        $output = '';
        $type ? $output = $type . '業' : $output = 'その他';
        echo $output;
        ?>
        </dd>
        <dt class="c-table__title">所在地</dt>
        <dd class="c-table__content">
            <?php
                    $zip = get_post_meta($post->ID, 'company_zip', true);
        $output = '';
        $zip ? $output = '〒' . $zip : $output = '〒???-????';
        echo $output;
        ?> <?php $address = get_post_meta($post->ID, 'company_address', true);
        $output = '';
        $address ? $output = $address : $output = '???';
        echo $output;?>
        </dd>
        <dt class="c-table__title">連絡先</dt>
        <dd class="c-table__content">
            <?php
                        $address = get_post_meta($post->ID, 'company_mail', true);
        $output = '';
        $address ? $output = '<a href="mailto:' . $address . '" target="_blank" rel="noopener">' . $address . '</a>' : $output = '???';
        echo $output;
        ?>
        </dd>
        <dt class="c-table__title">URL</dt>
        <dd class="c-table__content">
            <?php
                        $url = esc_url(get_post_meta($post->ID, 'company_url', true));
        $output = '';
        $url ? $output = '<a href="' . $url . '" target="_blank" rel="noopener">' . $url . '</a>' : $output = '???';
        echo $output;
        ?>
        </dd>
        <dt class="c-table__title">事業内容</dt>
        <dd class="c-table__content">
            <?php
                $service = get_post_meta($post->ID, 'company_service', true);
        if ($service) {
            $services = explode(",", $service);
            echo '<ul class="c-list">';
            for ($i = 0; $i < count($services); $i++) {
                echo '<li>' . $services[$i] . '</li>';
            }
            echo '<li>その他、上記に係る業務</li></ul>';
        } else {
            echo '???';
        }
        ?>
        </dd>
    </dl>
    <?php endwhile;?>
</div>
<?php echo get_related_company(); endif;get_footer();
