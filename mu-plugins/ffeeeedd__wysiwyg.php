<?php
/*
Plugin Name: ffeeeedd--WYSIWYG
Description: Améliore le WYSIWYG pour faciliter la création de contenu accessible.
Version: 29 01 2014
*/

/**
  * @note : Le WYSIWYG est personnalisé pour éviter les erreurs de saisie de contenu inaccessible ou contre-productif.
  * @see see http://wiki.moxiecode.com/index.php/TinyMCE:Control_reference
  * @author Hugo Baeta
  * @see http://hugobaeta.com
  */

/* ----------------------------- */
/* Sommaire */
/* ----------------------------- */
/*
  == Ajouts d’extensions TinyMCE
  == Amélioration du WYSIWYG de base
*/


/* == @section Ajouts d’extensions TinyMCE ====================
 * @note Vous pouvez ajouter d’autres plugins TinyMCE
 * @see http://www.tinymce.com/wiki.php/TinyMCE3x:Buttons/controls
 */
function ffeeeedd__plugins() {
  $plugins = array( 'xhtmlxtras' );
  $plugins_array = array();
  foreach ( $plugins as $plugin ) {
    $plugins_array[ $plugin ] = content_url( '/mu-plugins/ffeeeedd__wysiwyg/tinymce_plugins/', __FILE__) . $plugin . '/editor_plugin.js';
  }
  return $plugins_array;
}
add_filter( 'mce_external_plugins', 'ffeeeedd__plugins' );


/* == @section Amélioration du WYSIWYG de base ==================== */
function ffeeeedd__wysiwyg( $boutons ) {
  $boutons['theme_advanced_blockformats'] = 'p,h2,h3,h4,pre';
  $boutons['theme_advanced_disable'] = 'underline,justifyfull,strikethrough,forecolor,justifyleft,justifycenter,justifyright,media,wp_adv,hr,wp_more,wp_help';
  $boutons['theme_advanced_buttons1'] = 'undo,redo,formatselect,bold,italic,sub,sup,|,bullist,numlist,blockquote,cite,abbr,|,outdent,indent,|,link,unlink,|,|,charmap,|,pasteword,removeformat,|,wp_fullscreen';
  $boutons['theme_advanced_buttons2'] = '';
  $boutons['paste_text_use_dialog'] = "false";
  $boutons['paste_auto_cleanup_on_paste'] = "true";
  return $boutons;
}
add_filter('tiny_mce_before_init', 'ffeeeedd__wysiwyg');
