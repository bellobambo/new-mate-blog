<?php

function my_theme_scripts()
{
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'my_theme_scripts');
?>