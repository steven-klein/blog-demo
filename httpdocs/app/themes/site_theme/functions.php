<?php
// Load common, fields, and cpt's
include_once STYLESHEETPATH . '/inc/common.php';
include_once STYLESHEETPATH . '/inc/fields/load.php';
include_once STYLESHEETPATH . '/inc/cpt/cpt.php';

// include our contact form functions.
require_once get_stylesheet_directory() . "/inc/contactForm.php";

 // add primary site navigation
add_action("after_setup_theme", "themeSetupThemeCapabilities", 10);
function themeSetupThemeCapabilities() {
  add_shortcode("theme-recent-posts", "themeRecentPosts");
}

// shortcode for post lists.
function themeRecentPosts($atts) {
  // default attributes for this shortcode.
  $attributes = shortcode_atts([
    "number" => 3
  ], $atts);

  // get the most recent posts, validating the user entered number attribute
  $recent_posts = wp_get_recent_posts([
    'numberposts' => (is_numeric($attributes["number"]) && $attributes["number"] <= 10) ? $attributes["number"] : 10,
    'orderby' => 'post_date',
    'order' => 'DESC',
    'post_type' => 'post',
    'post_status' => 'publish'
  ], OBJECT);

  // start the output buffer to capture html.
  ob_start();

  // get the shortcode template
  include( locate_template('partials/content-shortcode-recent.php') );

  // the template processed the output so we can reset the query and postdata.
  wp_reset_query();
  wp_reset_postdata();

  // return captured html as a string.
  return ob_get_clean();
}
