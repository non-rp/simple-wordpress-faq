<?php
extract($args);
?>
    <div class="accordion__item" data-accordion-item>
        <div class="accordion__header" data-accordion-header>
            <?php echo $index . ' ' . get_the_title(); ?>
        </div>
        <div class="accordion__body" data-accordion-body>
            <div class="accordion__wrapper">
                <div class="accordion__content">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
<?php
