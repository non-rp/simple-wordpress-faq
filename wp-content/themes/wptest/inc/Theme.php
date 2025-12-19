<?php

namespace Wptest\Theme;

use Wptest\Theme\PostTypes\FaqCpt;
use Wptest\Theme\CLI\SeedFaq;
use Wptest\Theme\CLI\SeedPageTemplates;
use Wptest\Theme\Ajax\FaqAjax;


final class Theme
{
    public function boot(): void
    {
        $this->setup();

        ThemeAssets::register();
        FaqCpt::register();
        FaqAjax::register();

        if (defined('WP_CLI') && WP_CLI) {
            SeedFaq::register();
            SeedPageTemplates::register();
        }
    }

    private function setup(): void
    {
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');

        register_nav_menus([
            'primary' => 'Primary',
        ]);
    }
}