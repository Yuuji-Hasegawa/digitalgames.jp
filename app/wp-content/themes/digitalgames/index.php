<?php get_header();?>
<?php if (is_front_page()) {
    echo '<h2 class="c-heading">News</h2>';
    echo get_front_news();
    echo '</div>';
}?>
<div class="o-container o-container:inner">
    <h2 class="c-heading">Topics</h2>
    <?php if (have_posts()):?>
    <div class="o-stack o-stack:topics">
        <?php while (have_posts()): the_post();?>
        <a href="<?php the_permalink();?>"
            class="o-switcher o-switcher:media">
            <span class="c-media-pict">
                <?php echo get_thumb();?>
            </span>
            <span class="c-media-content">
                <dl class="o-stack o-stack:topicInner">
                    <dt class="c-topic-title">
                        <?php the_title();?>
                    </dt>
                    <dd class="o-stack o-stack:topicContent">
                        <span class="c-clip-txt">
                            <?php the_excerpt();?>
                        </span>
                        <?php echo get_loop_cat();?>
                        <time class="c-time"
                            datetime="<?php the_time('Y-m-d');?>">
                            <?php echo my_human_time_diff(get_post_time('U', true));?>前
                        </time>
                    </dd>
                </dl>
            </span>
        </a>
        <?php endwhile;?>
    </div>
    <?php else:?>
    <p class="c-inner-wrap">コンテンツはまだありません。</p>
    <?php endif; echo get_pagination();?>
    <?php get_footer();
