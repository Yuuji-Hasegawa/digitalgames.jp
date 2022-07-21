<?php get_header(); $protocol = empty($_SERVER["HTTPS"]) ? "http://" : "https://";?>
<div class="o-container o-container:underPage">
    <div class="c-inner-wrap u-pt-l u-mb-l">
        <p>
            お探しのページは見つかりませんでした。
            <br />
            お探しのページ (URL: <?php echo esc_url($protocol. $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]); ?>)は、
        </p>
        <ul class="c-list c-list:404">
            <li>すでに削除されている</li>
            <li>公開期間が終わっている</li>
            <li>アクセスしたアドレスが異なっている</li>
        </ul>
        <p>などの理由で見つかりませんでした。</p>
        <p>
            引き続き、このサイトをご利用いただく場合は、<a class="c-link c-link:inline"
                href="<?php echo home_url();?>">トップページ</a>からお探しください。
        </p>
    </div>
</div>
<?php get_footer();
