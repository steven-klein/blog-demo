<?php
/**
 * example.php
 * I'm an example custom post type.  Load me to see your new (sortable) custom post type called "example"
 * NOTE:  I'm not included yet in cpt/cpt.php - Uncomment me there.
 *
 * I'll have the following settings.
 * Sortable Post Type
 * Support for archive pages and single pages
 * An Image size of 500 x 500 called "example"
 * A menu icon that is a hammer
 * Support for a Title, Content Editor, and Featured Images.
 * Support for Featured Images
 * A custom editor that is bare bones with no support for the Media Button
 *
 * Additionally you can use the infoboxes helper to add help boxes to the admin for this post type.
 */

use brkstn\Themes\Helper as ThemeHelper;
use brkstn\PostTypes\CustomPostTypeSortable;

// Theme Helpers for example
ThemeHelper::addHelper('imageSize', 'example', 500, 500, true);
ThemeHelper::addHelper('thumbnailSupport', "example");
ThemeHelper::addHelper('editors', 'example', [], 'example', false);

// Example CPT definition
$cpt_example = new CustomPostTypeSortable(["example", "Examples"], [
    'labels' => [
        'name'               => 'Examples',
        'singular_name'      => 'Example',
        'menu_name'          => 'Examples',
        'name_admin_bar'     => 'Example',
        'add_new'            => 'Add Example',
        'add_new_item'       => 'Add New Example',
        'new_item'           => 'New Example',
        'edit_item'          => 'Edit Example',
        'view_item'          => 'View Example',
        'all_items'          => 'All Example',
        'search_items'       => 'Search Examples',
        'parent_item_colon'  => 'Parent Example:',
        'not_found'          => 'No Examples found.',
        'not_found_in_trash' => 'No Examples found in Trash.'
    ],
    'menu_icon' 			=> 'dashicons-hammer',
    'public'				=> true,
    'publicly_queryable' 	=> true,
    'has_archive'			=> true,
    'supports' 				=> array('title', 'editor', 'thumbnail')
]);

// An action to ensure that my archive pages show all example posts without pagination.
add_action( 'pre_get_posts', 'examples_get_all' );
function examples_get_all($query) {
    if ( is_admin() || ! $query->is_main_query() )
        return;

    if ( is_post_type_archive( 'example' ) ) {
        $query->set( 'posts_per_page', -1 );
        return;
    }
}
