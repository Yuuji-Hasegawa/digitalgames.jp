<?php
if (function_exists('wpcf7_add_form_tag')) {
    add_action('wpcf7_init', 'wpcf7_add_form_tag_pp_acceptance');
    function wpcf7_add_form_tag_pp_acceptance()
    {
        wpcf7_add_form_tag(
            'pp_acceptance',
            'wpcf7_pp_acceptance_form_tag_handler'
        );
    }
    function wpcf7_pp_acceptance_form_tag_handler($tag)
    {
        $validation_error = wpcf7_get_validation_error('pp-acceptance');
        $class = wpcf7_form_controls_class('acceptance');
        if ($validation_error) {
            $class .= ' wpcf7-not-valid';
        }
        if ($tag->has_option('invert')) {
            $class .= ' invert';
        }
        $atts = array(
            'class' => trim($class),
        );
        $wrap_class = 'o-grid o-grid:accept';
        $item_atts = array();
        $item_atts['class'] = 'c-checkbtn';
        $item_atts['type'] = 'checkbox';
        $item_atts['name'] = 'pp-acceptance';
        $item_atts['value'] = '1';
        $item_atts['tabindex'] = $tag->get_option('tabindex', 'signed_int', true);
        if ($validation_error) {
            $item_atts['aria-invalid'] = 'true';
            $item_atts['aria-describedby'] = wpcf7_get_validation_error_reference(
                'pp-acceptance'
            );
        } else {
            $item_atts['aria-invalid'] = 'false';
        }
        $item_atts = wpcf7_format_atts($item_atts);
        $content = '<a class="c-link c-link:inline" target="_blank" rel="noopener" href="' . home_url('/privacy-policy') . '">プライバシーポリシー</a>に同意する';
        $html = sprintf('<label class="' . $wrap_class . '"><input %1$s />' . $content . '</label>', $item_atts);
        $atts = wpcf7_format_atts($atts);
        $html = sprintf(
            '<span class="wpcf7-form-control-wrap" data-name="%1$s"><span %2$s>%3$s</span>%4$s</span>',
            sanitize_html_class('pp-acceptance'),
            $atts,
            $html,
            $validation_error
        );
        return $html;
    }
    /* Validation filter */
    add_filter('wpcf7_validate_pp_acceptance', 'wpcf7_pp_acceptance_validation_filter', 10, 2);
    function wpcf7_pp_acceptance_validation_filter($result, $tag)
    {
        if (! wpcf7_pp_acceptance_as_validation()) {
            return $result;
        }
        $name = 'pp-acceptance';
        $value = (! empty($_POST[$name]) ? 1 : 0);
        $invert = $tag->has_option('invert');
        if ($invert and $value or ! $invert and ! $value) {
            $result->invalidate($tag, wpcf7_get_message('accept_terms'));
        }
        return $result;
    }
    /* Acceptance filter */
    add_filter('wpcf7_pp_acceptance', 'wpcf7_pp_acceptance_filter', 10, 2);
    function wpcf7_pp_acceptance_filter($accepted, $submission)
    {
        $tags = wpcf7_scan_form_tags(array( 'type' => 'pp_acceptance' ));
        foreach ($tags as $tag) {
            $name = 'pp-acceptance';
            if (empty($name)) {
                continue;
            }
            $value = (! empty($_POST[$name]) ? 1 : 0);
            $content = empty($tag->content) ? (string) reset($tag->values) : $tag->content;
            $content = trim($content);
            if ($value and $content) {
                $submission->add_consent($name, $content);
            }
            $invert = $tag->has_option('invert');
            if ($invert and $value or ! $invert and ! $value) {
                $accepted = false;
            }
        }
        return $accepted;
    }
    add_filter('wpcf7_form_class_attr', 'wpcf7_pp_acceptance_form_class_attr', 10, 1);
    function wpcf7_pp_acceptance_form_class_attr($class)
    {
        if (wpcf7_pp_acceptance_as_validation()) {
            return $class . ' wpcf7-acceptance-as-validation';
        }
        return $class;
    }
    function wpcf7_pp_acceptance_as_validation()
    {
        if (! $contact_form = wpcf7_get_current_contact_form()) {
            return false;
        }
        return $contact_form->is_true('acceptance_as_validation');
    }
    add_filter('wpcf7_mail_tag_replaced_acceptance', 'wpcf7_pp_acceptance_mail_tag', 10, 4);
    function wpcf7_pp_acceptance_mail_tag($replaced, $submitted, $html, $mail_tag)
    {
        $form_tag = $mail_tag->corresponding_form_tag();
        if (! $form_tag) {
            return $replaced;
        }
        if (! empty($submitted)) {
            $replaced = __('Consented', 'contact-form-7');
        } else {
            $replaced = __('Not consented', 'contact-form-7');
        }
        $content = empty($form_tag->content) ? (string) reset($form_tag->values) : $form_tag->content;
        if (! $html) {
            $content = wp_strip_all_tags($content);
        }
        $content = trim($content);
        if ($content) {
            $replaced = sprintf(
                /* translators: 1: 'Consented' or 'Not consented', 2: conditions */
                _x(
                    '%1$s: %2$s',
                    'mail output for acceptance checkboxes',
                    'contact-form-7'
                ),
                $replaced,
                $content
            );
        }
        return $replaced;
    }
    /* Tag generator */
    add_action('wpcf7_admin_init', 'wpcf7_add_tag_generator_pp_acceptance', 35, 0);
    function wpcf7_add_tag_generator_pp_acceptance()
    {
        $tag_generator = WPCF7_TagGenerator::get_instance();
        $tag_generator->add(
            'pp_acceptance',
            __('プライバシーポリシー同意ボタン', 'contact-form-7'),
            'wpcf7_tag_generator_pp_acceptance'
        );
    }
    function wpcf7_tag_generator_pp_acceptance($contact_form, $args = '')
    {
        $args = wp_parse_args($args, array());
        $type = 'pp_acceptance';
        $description = __("Generate a form-tag for an acceptance checkbox. For more details, see %s.", 'contact-form-7'); ?>
<div class="insert-box">
    <input type="text" name="<?php echo $type; ?>" class="tag code"
        readonly="readonly" onfocus="this.select()" />
    <div class="submitbox">
        <input type="button" class="button button-primary insert-tag"
            value="<?php echo esc_attr(__('Insert Tag', 'contact-form-7')); ?>" />
    </div>
</div>
<?php
    }
}
