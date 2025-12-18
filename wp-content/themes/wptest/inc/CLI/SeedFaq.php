<?php

namespace Wptest\Theme\CLI;
class SeedFaq
{
    public static function register(): void
    {
        \WP_CLI::add_command('wptest seed-faq', [self::class, 'run']);
    }

    public static function run(): void
    {
        $exists = get_posts([
            'post_type' => 'faq',
            'posts_per_page' => 1,
            'fields' => 'ids',
        ]);

        if ($exists) {
            \WP_CLI::warning('FAQ already exists');
            return;
        }

        $data = [
            ['FAQ One', 'Answer One', 'publish'],
            ['FAQ Two', 'Answer Two', 'publish'],
            ['FAQ Three', 'Answer Three', 'publish'],
            ['FAQ Draft A', 'Answer Draft', 'draft'],
            ['FAQ Draft B', 'Answer Draft', 'draft'],
        ];

        foreach ($data as [$title, $content, $status]) {
            wp_insert_post([
                'post_type' => 'faq',
                'post_title' => $title,
                'post_content' => $content,
                'post_status' => $status,
            ]);
        }

        \WP_CLI::success('FAQ seeded');
    }
}