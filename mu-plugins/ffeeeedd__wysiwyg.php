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

