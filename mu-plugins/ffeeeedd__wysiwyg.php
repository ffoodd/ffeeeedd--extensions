<?php
/*
Plugin Name: ffeeeedd--WYSIWYG
Description: Améliore le WYSIWYG pour faciliter la création de contenu accessible.
Version: 18 04 2014
*/

/**
  * @note Le WYSIWYG est personnalisé pour éviter les erreurs de saisie de contenu inaccessible ou contre-productif.
  * @see see http://wiki.moxiecode.com/index.php/TinyMCE:Control_reference
  * @author Hugo Baeta
  * @see http://hugobaeta.com
  */

/* ----------------------------- */
/* Sommaire */
/* ----------------------------- */
/*
  == Création d'une extension personnalisée TinyMCE
    -- Ajouter l’option « Abréviation » à tinyMCE
    -- Ajouter un bouton « Abréviation »
  == Amélioration du WYSIWYG de base
*/


/* == @section Création d'une extension personnalisée TinyMCE ====================
 * @see https://www.gavick.com/magazine/adding-your-own-buttons-in-tinymce-4-editor.html
 */
function ffeeeedd__plugins() {
  global $typenow;
  if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
    return;
  }
  add_filter( 'mce_external_plugins', 'ffeeeedd__plugin' );
  add_filter( 'mce_buttons', 'ffeeeedd__button' );
}

/* -- @subsection Ajouter l’option « Abréviation » à tinyMCE -------------------- */
function ffeeeedd__plugin( $plugin_array ) {
  $plugin_array['ffeeeedd__plugins'] = content_url( '/mu-plugins/ffeeeedd__wysiwyg/boutons.js' );
  return $plugin_array;
}

/* -- @subsection Ajouter un bouton « Abréviation » -------------------- */
function ffeeeedd__button( $bouton ) {
  array_push( $bouton, 'abbr' );
  return $bouton;
}

add_action( 'admin_head', 'ffeeeedd__plugins' );


/* == @section Amélioration du WYSIWYG de base ==================== */
function ffeeeedd__wysiwyg( $boutons ) {
  $boutons['block_formats'] = 'Paragraphe=p;Titre 2=h2;Titre 3=h3;Titre 4=h4;Pre=pre';
  $boutons['toolbar1'] = 'undo,redo,formatselect,bold,italic,sub,sup,|,bullist,numlist,blockquote,cite,abbr,|,outdent,indent,|,link,unlink,|,|,charmap,|,removeformat,|,wp_fullscreen';
  $boutons['toolbar2'] = '';
  $boutons['paste_as_text'] = true;
  return $boutons;
}

add_filter( 'tiny_mce_before_init', 'ffeeeedd__wysiwyg' );
