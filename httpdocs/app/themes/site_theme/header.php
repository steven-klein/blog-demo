<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
  <script>
    (function(){
    	var obj = document.getElementsByTagName('html')[0];
    	obj.className = obj.className.replace('no-js', 'js');
    })();
  </script>
</head>
<body <?php body_class(); ?>>
  <main>
    <header role="banner">
      <h1><?php echo bloginfo( 'name' );?></h1>
    </header>
    <?php if ( has_nav_menu( 'primary' ) ) : ?>
    <nav role="navigation">
      <?php
        wp_nav_menu( array(
          'theme_location' => 'primary',
          'menu_class'     => 'primary-menu',
        ));
      ?>
    </nav>
    <?php endif; ?>
    <section role="main">
