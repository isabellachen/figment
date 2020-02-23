<?php

/**
 * Template part for displaying user own stories
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage McLuhan Child
 * @since 1.0.0
 */
?>

<?php
$current_user = wp_get_current_user();
$current_user_id = $current_user->ID;
$query = new WP_Query(array('author' => $current_user_id));

if (is_user_logged_in()) :
  if ($query->have_posts()) :
    while ($query->have_posts()) :
      $query->the_post();
      /**
       * The User Registration Plugin uses a filter to modify the title of the $post global 
       * the_title and get_the_title() returns the title of the tab, not the current post
       * We have to explicitly assign the title to use this template-part in the Profile page
       */
      $post_title = $post->post_title;
?>
      <article class="full-article">
        <h2><?php echo $post_title; ?></h2>
        <?php the_excerpt(); ?>
      </article>

<?php endwhile;
  endif;
else :
  echo '<p>Log into view your stories.</p>';
  echo do_shortcode("[user_registration_form id='28']");
endif;
