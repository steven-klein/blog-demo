<?php
/**
 * The template part for displaying posts in listings
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <header>
		<h1><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h1>
	</header>

  <?php the_excerpt(); ?>

</article>
