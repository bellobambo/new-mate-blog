<?php

function my_theme_scripts()
{
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'my_theme_scripts');


function preload_winky_sans()
{
    echo '<link rel="preload" href="https://fonts.googleapis.com/css2?family=Winky+Sans:wght@400;700&display=swap" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">';
    echo '<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Winky+Sans:wght@400;700&display=swap"></noscript>';
}
add_action('wp_head', 'preload_winky_sans', 1);
?>