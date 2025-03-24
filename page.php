<?php get_header(); ?>

<?php

while (have_posts()) {
    the_post(); ?>

    <div>
        <h2>
            <a href="<?php the_permalink() ?>"></a>

            <div class="content">
                <?php the_content() ?>
            </div>
        </h2>
    </div>

    <?php
}
?>