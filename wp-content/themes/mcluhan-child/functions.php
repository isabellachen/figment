<?php

/**
 * There is a but in the parent theme that prevents the child's css from taking precedence.
 * We have to manually dequeue the parent's style.css and load the child's.
 * Because of this we import the parent's css with @import in the child's style.css.
 */
function remove_parent_css()
{
  wp_dequeue_style('mcluhan-style');
  wp_deregister_style('mcluhan-style');
}
add_action('wp_enqueue_scripts', 'remove_parent_css', 20);


function add_child_css()
{
  wp_register_style('mcluhan-shild-style', get_stylesheet_directory_uri() . '/style.css', 'mcluhan-fonts');
  wp_enqueue_style('mcluhan-shild-style');
}
add_action('wp_enqueue_scripts', 'add_child_css');
