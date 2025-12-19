<?php

namespace FaqListShortcode\Plugin;

final class Assets
{
    public static string $dist_uri;
    public static string $dist_path;

    public static function register(): void
    {
        self::$dist_uri = Plugin::get_plugin_url() . 'dist/';
        self::$dist_path = Plugin::get_plugin_dir() . 'dist/';

        add_action('wp_enqueue_scripts', [self::class, 'enqueue']);
    }

    public static function enqueue(): void
    {
        wp_enqueue_script(
            'faq-list-shortcode-app',
            self::asset_uri('app', 'js'),
            [],
            self::asset_version('app', 'js'),
            true);

        wp_enqueue_style(
            'faq-list-shortcode-style',
            self::asset_uri('style', 'css'),
            [],
            self::asset_version('style', 'css')
        );
    }

    public static function asset_uri(string $file_name, string $file_ext): ?string
    {
        $file = self::asset_file($file_name, $file_ext);

        return $file ? self::$dist_uri . $file : null;
    }

    // Check which file exists according to prod or dev build
    public static function asset_file(string $file_name, string $file_ext): string
    {
        $min = "{$file_name}.min.{$file_ext}";
        $plain = "{$file_name}.{$file_ext}";

        if(file_exists(self::$dist_path . $min)) {
            return $min;
        }

        return $plain;
    }

    public static function asset_version(string $file_name, string $file_ext): ?string
    {
        $file = self::asset_file($file_name, $file_ext);

        return $file ? filemtime(self::$dist_path . $file  ) : null;
    }
}