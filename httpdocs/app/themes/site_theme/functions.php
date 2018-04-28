<?php
// Load common, fields, and cpt's
include_once STYLESHEETPATH . '/inc/common.php';
include_once STYLESHEETPATH . '/inc/fields/load.php';
include_once STYLESHEETPATH . '/inc/cpt/cpt.php';

// Load additional functions, actions, and filters here.
/**
 * MyAwesomeSite functions.php
 */

// include our contact form functions.
require_once get_stylesheet_directory() . "/inc/contactForm.php";

 // add primary site navigation
add_action("after_setup_theme", "themeSetupThemeCapabilities", 10);
function themeSetupThemeCapabilities() {
  register_nav_menu( "primary", "Primary navigation menu in the header." );
  add_shortcode("theme-recent-posts", "themeRecentPosts");
}

// enqueue css/js assets
add_action("wp_enqueue_scripts", "themeScripts", 10);
function themeScripts() {
    $version = get_bloginfo("version");

    /* Register our styles ------------------------------------------------------*/
    wp_enqueue_style("app", get_stylesheet_directory_uri() . "/assets/css/app.css", null, $version, null);

    /* Register our scripts ------------------------------------------------------*/
    wp_enqueue_script("jquery-validate", get_stylesheet_directory_uri() . "/assets/js/jquery.validate.js", ["jquery"], $version, true);
    wp_enqueue_script("app", get_stylesheet_directory_uri() . "/assets/js/app.js", ["jquery", "jquery-validate"], $version, true);
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

// change the number of words in an excerpt
add_filter('excerpt_length', 'theme_excerpt_length', 999, 1);
function theme_excerpt_length($length) {
  return 35;
}

// change the tail of the excerpt
add_filter('excerpt_more', 'theme_excerpt_more', 999, 2);
function theme_excerpt_more($more) {
  return "...";
}

