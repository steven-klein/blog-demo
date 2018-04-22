<?php
/**
 * The template part for displaying a message that posts cannot be found
 */
?>

  <article class="no-results not-found">

    <header>
      <h1>Nothing Found</h1>
    </header>

      <?php if ( is_search() ) : ?>

        <p>Sorry, but nothing matched your search terms. Please try again with some different keywords.</p>

      <?php else : ?>

        <p>It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.</p>

      <?php endif; ?>

      <?php get_search_form(); ?>

  </article>
