<?php get_header(); if (have_posts()):?>
<ul class="o-stack o-stack:news">
    <?php while (have_posts()): the_post();?>
    <li class="o-switcher o-switcher:news">
        <time
            datetime="<?php the_time('Y-m-d')?>"><?php the_time('Y.m.d');?></time>
        <a href="<?php the_permalink();?>"><?php the_title();?></a>
    </li>
    <?php endwhile;?>
</ul>
<?php endif;
echo get_pagination(); get_footer();
