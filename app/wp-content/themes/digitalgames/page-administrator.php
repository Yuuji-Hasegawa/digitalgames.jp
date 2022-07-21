<?php get_header();?>
<div class="c-inner-wrap">
    <dl class="c-table">
        <dt class="c-table__title">屋号</dt>
        <dd class="c-table__content">
            <?php echo get_vars('company', 'name');?>
        </dd>
        <dt class="c-table__title">代表者</dt>
        <dd class="c-table__content">
            長谷川 雄治（2010年卒）
        </dd>
        <dt class="c-table__title">設立</dt>
        <dd class="c-table__content">
            2013年4月26日
        </dd>
        <dt class="c-table__title">所在地</dt>
        <dd class="c-table__content">
            〒<?php echo get_vars('company', 'zip');?>
            <?php echo get_vars('company', 'address');?>
        </dd>
        <dt class="c-table__title">事業内容</dt>
        <dd class="c-table__content">
            <?php echo get_service_list();?>
        </dd>
    </dl>
</div>
<?php get_footer();
