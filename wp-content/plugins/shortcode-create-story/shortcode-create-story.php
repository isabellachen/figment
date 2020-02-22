<?php
/*
Plugin Name: Shortcode Create Story
Description: Inserts Markdown editor and submit button to a post
*/

add_shortcode('figment_create_story', 'figment_create_story_shortcode');

function figment_create_story_shortcode()
{
  $categories = get_categories([
    'hide_empty' => 0,
  ]);
  $categoriesElems = '';
  foreach ($categories as $category) {
    $value = esc_html($category->name);
    $name = ucfirst($value);
    $categoriesElems .= "<option value='${value}'>${name}</option>";
  }

  return '
    <input type="text" id="storyTitle" name="story-title">
    <select id="storyCategories" name="storyCategories">'
    . $categoriesElems .
    '</select>
    <textarea id="simpleMdeContainer" form="simpleMdeForm" name="simpleMdeContainer"></textarea>
    <form id="simpleMdeForm">
      <input type="submit">
    </form>
  ';
}

add_action('wp_enqueue_scripts', 'figment_enqueue_create_story_script');
function figment_enqueue_create_story_script()
{
  wp_register_style('font_awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css');
  wp_register_style('simple_mde_css', 'https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css');
  wp_enqueue_style('font_awesome');
  wp_enqueue_style('simple_mde_css');

  wp_enqueue_script('simple_mde_js', 'https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js');
  wp_enqueue_script('init_simple_mde', plugin_dir_url(__FILE__) . '/init-simple-mde.js', ['simple_mde_js'], false, true);
  wp_enqueue_script('create_story_script', plugin_dir_url(__FILE__) . '/shortcode-create-story.js', ['jquery', 'simple_mde_js', 'init_simple_mde'], false, true);

  wp_localize_script('create_story_script', 'scriptVars', [
    'endpoint' => esc_url_raw(rest_url('wp/v2/posts/')),
    'nonce' => wp_create_nonce('wp_rest')
  ]);
}
