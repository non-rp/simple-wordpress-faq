<?php

namespace FaqListShortcode\Plugin\Shortcodes;

class FaqShortcode
{
    public static function init(): void
    {
        add_action('init', [self::class, 'add_shortcode']);
    }

    public static function add_shortcode(): void
    {
        add_shortcode('faq_list', [self::class, 'faq_list_shortcode_render']);
    }

    public static function faq_list_shortcode_render($atts): mixed
    {
        $atts = apply_filters('faq_list_shortcode_atts', $atts);
        $atts = shortcode_atts([
            'ids' => '',
        ], (array) $atts, 'faq_list');

        $ids_raw = (string) $atts['ids'];
        if ($ids_raw === '') {
            return '';
        }

        $ids = array_values(array_filter(array_map('absint', preg_split('/\s*,\s*/', $ids_raw))));
        if (!$ids) {
            return '';
        }

        $q = new \WP_Query([
            'post_type'      => 'faq',
            'post_status'    => 'publish',
            'post__in'       => $ids,
            'orderby'        => 'post__in',
            'posts_per_page' => count($ids),
            'no_found_rows'  => true,
        ]);

        if (!$q->have_posts()) {
            wp_reset_postdata();
            return '';
        }

        ob_start();

        echo '<div class="accordion" data-accordion itemscope itemtype="https://schema.org/FAQPage">';

        $index = 1;

        while ($q->have_posts()) {
            $q->the_post();

            get_template_part('template-parts/content', 'faq_shortcode', [
                'index' => $index,
            ]);

            $index++;
        }

        echo '</div>';

        wp_reset_postdata();

        return (string) ob_get_clean();
    }
}