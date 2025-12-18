<?php

namespace Wptest\Theme\CLI;

class SeedPageTemplates
{
    public static function register(): void
    {
        \WP_CLI::add_command('wptest seed-page-templates', [self::class, 'run']);
    }

    public static function run(): void
    {
        $data = [
            ['FAQ ACF field', 'templates/page_faq-acf-field.php'],
            ['FAQ AJAX', 'templates/page_faq-ajax.php'],
            ['FAQ plugin shortcode', 'templates/page_faq-plugin-shortcode.php'],
        ];

        foreach ($data as [$title, $template]) {

            $exists = get_posts([
                'post_type' => 'page',
                'name' => sanitize_title($title),
                'fields' => 'ids',
            ]);

            if ($exists) {
                \WP_CLI::warning("Page {$title} already exists");
                continue;
            }

            wp_insert_post([
                'post_type' => 'page',
                'post_title' => $title,
                'post_status' => 'publish',
                'page_template' => $template,
            ]);
        }

        \WP_CLI::success('Page templates seeded');
    }
}