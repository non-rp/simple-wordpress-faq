<?php

namespace FaqListShortcode\Plugin;

final class Plugin
{
    private static string $dir;
    private static string $url;
   public function __construct($file)
   {

       self::$dir  = plugin_dir_path($file);
       self::$url  = plugin_dir_url($file);

       \FaqListShortcode\Plugin\Assets::register();
       \FaqListShortcode\Plugin\Shortcodes\FaqShortcode::init();
   }

    public static function get_plugin_dir(): string
    {
        return self::$dir;
    }

    public static function get_plugin_url(): string
    {
        return self::$url;
    }
}
