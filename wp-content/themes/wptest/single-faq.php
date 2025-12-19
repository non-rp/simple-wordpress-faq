<?php
/**
 * The template for displaying single post FAQ custom post type
 */

get_header();

while ( have_posts() ) :
    the_post();

    get_template_part( 'template-parts/content', get_post_type() );
endwhile;

get_footer();
