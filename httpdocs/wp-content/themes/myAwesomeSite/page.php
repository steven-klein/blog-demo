<?php
/**
 * The template for displaying single pages
 */

get_header(); ?>

  <?php
  // Start the loop.
  while ( have_posts() ) : the_post();

    // Include the page content template.
    get_template_part( 'partials/content', 'page' );

    // End of the loop.
  endwhile;
  ?>

<?php get_footer(); ?>
