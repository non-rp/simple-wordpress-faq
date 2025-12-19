<?php
/**
 * Plugin Name: FAQ list shortcode
 * Description: Shortcode [faq_list ids="1,2,3"]
 * Version: 1.0.0
 */

defined('ABSPATH') || exit;

// Init autoload
$autoload = __DIR__ . '/vendor/autoload.php';
if (is_readable($autoload)) {
    require_once $autoload;
}

new \FaqListShortcode\Plugin\Plugin(__FILE__);

