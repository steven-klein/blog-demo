<?php
/**
 * The main template file
 */

get_header(); ?>

  <?php if ( have_posts() ) : ?>

    <?php if ( is_home() && ! is_front_page() ) : ?>
      <h1><?php single_post_title(); ?></h1>
    <?php endif; ?>

    <?php
    // Start the loop.
    while ( have_posts() ) : the_post();

      get_template_part( 'partials/content', get_post_format() );

    // End the loop.
    endwhile;

    // posts pagination
    the_posts_pagination( array(
      'prev_text'          => 'Previous page',
      'next_text'          => 'Next page',
    ));

  // If no content, include the "No posts found" template.
  else :
    get_template_part( 'partials/content', 'none' );

  endif;
  ?>

<?php get_footer(); ?>
