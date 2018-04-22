<?php
/**
 * MyAwesomeSite functions.php
 */

// include our contact form functions.
require_once get_stylesheet_directory() . "/includes/contactForm.php";

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
function themeRecentPosts() {

}
