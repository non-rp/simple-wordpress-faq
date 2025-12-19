<?php

namespace Wptest\Theme\Ajax;

use JetBrains\PhpStorm\NoReturn;
use WP_Query;

class FaqAjax
{
    public static function register(): void
    {
        add_action('wp_ajax_faq_load', [self::class, 'ajax_handler']);
        add_action('wp_ajax_nopriv_faq_load', [self::class, 'ajax_handler']);
    }

    #[NoReturn]
    public static function ajax_handler(): void
    {
        $args = [
            'post_type'      => 'faq',
            'posts_per_page' => -1,
            'orderby'        => [
                'title' => 'ASC'
            ],
        ];

        $query = new WP_Query($args);
        $index = 1;
        ob_start();

        if ($query->have_posts()) { ?>
            <div class="accordion" data-accordion>
                <?php
                    while ($query->have_posts()) {
                        $query->the_post();
                        get_template_part('template-parts/content', 'faq_ajax', ['index' => $index]);
                        $index++;
                    }
                ?>
            </div>
            <?php
        }

        echo ob_get_clean();

        wp_reset_postdata();
        wp_die();
    }
}