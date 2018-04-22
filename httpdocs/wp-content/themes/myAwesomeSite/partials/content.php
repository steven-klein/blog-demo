<?php
/**
 * The template part for displaying posts in listings
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <header>
		<h1><?php the_title(); ?></h1>
	</header>

  <?php the_excerpt(); ?>

  <p>
    <a href="<?php echo esc_url( get_permalink() ); ?>" title="Read Full Article: <?php echo the_title(); ?>">Read More</a>
  </p>

</article>
