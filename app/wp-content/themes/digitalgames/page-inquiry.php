<?php get_header();?>
<div class="c-inner-wrap">
    <p class="u-mb-m">掲載内容に関するご質問、ご要望などございましたら、下記のお問い合わせフォームから、お気軽にお寄せください。</p>
    <?php echo do_shortcode('[contact-form-7 id="5" title="お問い合わせ"]');?>
    <ul class="o-stack o-stack:announce">
        <li>調査等のため、返信にお時間を頂くことがございます。予めご了承ください。</li>
        <li>
            万が一、一週間経っても返信がない場合は大変お手数ですが、
            <a class="c-link c-link:inline"
                href="mailto:<?php echo get_vars('company', 'mail')['primary'];?>"
                target="_blank" rel="noopener">
                <?php echo get_vars('company', 'mail')['primary'];?>
            </a>
            までご連絡ください。
        </li>
    </ul>
</div>
<?php get_footer();
