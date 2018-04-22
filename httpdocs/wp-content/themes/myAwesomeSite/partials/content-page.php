<?php
/**
 * The template used for displaying page content
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <header>
		<h1><?php the_title(); ?></h1>
	</header>

  <?php the_content(); ?>

</article>
