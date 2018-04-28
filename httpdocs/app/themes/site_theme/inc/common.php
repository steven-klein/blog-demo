<?php
/**
 * inc/common.php
 * I'm the most common settings and additional helpers needed for this project.
 * Adjust settings as neccessary.  See the docs for additional helpers.
 *
 * Additional helpers not included here: ThumbnailSupport, InfoBoxes, Analytics.
 *
 * https://bitbucket.org/brkstn/brkstnwptoolbox
 */

use brkstn\Themes\Helper as ThemeHelper;
ThemeHelper::enableHelper();

/**
 * PROJECT DEFAULTS
 */
ThemeHelper::setHelper('addBodyClasses', true);
ThemeHelper::setHelper('cleanTitle', true);
ThemeHelper::setHelper('stripHead', true);
ThemeHelper::setHelper('disableRSS', false);
ThemeHelper::setHelper('excerptMore', '...');
ThemeHelper::setHelper('excerptLength', 55);
ThemeHelper::setHelper('imageDefaultLinkType', 'none');
ThemeHelper::setHelper('themeFunctions', true);
ThemeHelper::setHelper('stripEditorPastes', true);
ThemeHelper::setHelper('addEditorStylesheet', true);
ThemeHelper::setHelper('navMenus', [
    'main-menu' => 'Main navigation menu - at the top of the site.',
]);

/**
 * ENABLE and CONFIGURE ACF FIELDS with a site options page.
 * Define fields in fields/options.php
 */
ThemeHelper::addHelper('fields');
ThemeHelper::getHelper('fields')->enableAdminAccess(WP_DEBUG);
ThemeHelper::getHelper('fields')->addOptionsPage([
    'page_title' => 'Site Options',
    'menu_title' => 'Site Options',
    'menu_slug' => '',
    'capability' => 'edit_posts',
    'position' => 40,
    'parent_slug' => '',
    'icon_url' => false,
    'redirect' => true,
    'post_id' => 'options',
    'autoload' => true
]);

 /**
  * CONTROL DEFAULT MEDIA SIZES
  */
 ThemeHelper::addHelper('mediaSizes', [
     'thumbnail_size_w' => 300,
     'thumbnail_size_h' => 300,
     'thumbnail_crop' => true,
     'medium_size_w' => 620,
     'medium_size_h' => 620,
     'large_size_w' => 1280,
     'large_size_h' => 1280
 ]);

 /**
  * GALLERY SETTINGS
  */
 ThemeHelper::addHelper('galleries',
     ['link' => 'file',
     'size' => 'thumbnail',
     'columns' => 0
     ],
     false,
     'large'
 );

 /**
  * EDITORS - create a new default editor that has fewer options.
  */
 ThemeHelper::addHelper('editors', 'default', [
     'toolbar1' => 'formatselect,bold,italic,underline,strikethrough,blockquote,hr,bullist,numlist,indent,outdent,alignleft,aligncenter,alignright,link,unlink,charmap,pastetext,removeformat,undo,redo,fullscreen',
 	'block_formats' => 'Paragraph=p;Header=h3'
 ], null, false);
 ThemeHelper::getHelper('editors')->setDefault('default');
