<?php
/* Template Name: FAQ plugin shortcode */

get_header();
?>

<h1><?php the_title(); ?></h1>

<?php
echo do_shortcode('[faq_list ids="22,20,24,21"]');

get_footer();