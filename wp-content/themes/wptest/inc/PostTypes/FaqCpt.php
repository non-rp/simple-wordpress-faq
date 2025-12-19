<?php

namespace Wptest\Theme\PostTypes;

final class FaqCpt
{
    private static array $labels = [
        'name' => 'FAQ',
        'singular_name' => 'FAQ',
    ];

    public static function register(): void
    {
        add_action('init', [self::class, 'registerPostType']);
    }

    public static function registerPostType(): void
    {
        register_post_type('faq', [
            'labels' => self::$labels,
            'public' => true,
            'show_in_rest' => true,
            'supports' => ['title', 'editor'],
            'rewrite' => ['slug' => 'faq'],
        ]);
    }
}