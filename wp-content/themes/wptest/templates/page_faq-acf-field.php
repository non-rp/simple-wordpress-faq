<?php
/* Template Name: FAQ ACF field */

get_header();

$faq_posts = get_field("faq_posts");
$index = 1;

$schema_items = [];
?>
    <h1><?php the_title(); ?></h1>
<?php
    if ($faq_posts) { ?>
        <div class="accordion" data-accordion>
            <?php
            foreach ($faq_posts as $post) {
                setup_postdata($post);

                if (get_post_status(get_the_ID()) !== 'publish') {
                    continue;
                }

                $title = wp_strip_all_tags(get_the_title());

                $answer = get_the_content();
                $answer = wp_strip_all_tags($answer);
                $answer = trim(preg_replace('/\s+/', ' ', $answer));

                $schema_items[] = [
                        '@type' => 'Question',
                        'name' => $title,
                        'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => $answer,
                        ],
                ];

                get_template_part('template-parts/content', 'faq_plugin', ['index' => $index]);
                $index++;
            }
            wp_reset_postdata();
            ?>
        </div>
        <?php
        if (!empty($schema_items)) {
            $schema = [
                    '@context' => 'https://schema.org',
                    '@type' => 'FAQPage',
                    'mainEntity' => $schema_items,
            ];

            echo '<script type="application/ld+json">' .
                    wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) .
                    '</script>';
        }
    }

get_footer();