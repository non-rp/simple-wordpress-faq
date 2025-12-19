<?php
$index = isset($args['index']) ? (int) $args['index'] : 0;

$title = wp_strip_all_tags(get_the_title());

$answer = get_the_content(null, false);
$answer = wp_strip_all_tags($answer);
$answer = trim(preg_replace('/\s+/', ' ', $answer));
?>

<div class="accordion__item" data-accordion-item itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
    <meta itemprop="name" content="<?php echo esc_attr($title); ?>">

    <div class="accordion__header" data-accordion-header>
        <?php echo esc_html($index . ' ' . get_the_title()); ?>
    </div>

    <div class="accordion__body" data-accordion-body itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
        <meta itemprop="text" content="<?php echo esc_attr($answer); ?>">

        <div class="accordion__wrapper">
            <div class="accordion__content">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</div>

