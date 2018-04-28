<?php
/**
 * The template used for the recent posts shortcode.
 * @scoped array $recent_posts
 * @scoped array $attributes
 */
?>
<?php if( $recent_posts !== false ): ?>
  <ul>
    <?php foreach( $recent_posts as $recent_post ): setup_postdata( $GLOBALS['post'] =& $recent_post ); // https://codex.wordpress.org/Function_Reference/setup_postdata ?>
    <li>
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
    </li>
    <?php endforeach; ?>
  </ul>
<?php endif;

