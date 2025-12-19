<?php
// Init autoload
$autoload = __DIR__ . '/vendor/autoload.php';
if (is_readable($autoload)) {
    require_once $autoload;
}

//
add_action('after_setup_theme', function (): void {
    (new \Wptest\Theme\Theme())->boot();
});