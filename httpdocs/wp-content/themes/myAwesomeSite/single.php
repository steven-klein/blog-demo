<?php
/**
 * The template for displaying all single posts and attachments
 */

get_header(); ?>

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the single post content template.
			get_template_part( 'partials/content', 'single' );
    ?>
    <nav id="post-navigation" class="post-navigation">
    <?php
      // Previous/next post navigation.
      the_post_navigation([
        'next_text' => 'Next Post',
        'prev_text' => 'Previous Post',
      ]);
    ?>
    </nav>
    <?php
			// End of the loop.
		endwhile;
		?>

<?php get_footer(); ?>
