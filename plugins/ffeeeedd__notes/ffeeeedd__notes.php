<?php
/**
 * Plugin Name: ffeeeedd__notes
 * Plugin URI: https://github.com/ffoodd/ffeeeedd--extensions/tree/master/plugins/ffeeeedd__notes
 * Description: Ajout et gestion d’un shortcode pour créer des notes de bas de page.
 * Version: 0.1
 * Author: Gaël Poupard
 * Author URI: http://www.ffoodd.fr
 */
if ( !defined( 'ABSPATH' ) ) die();

/* ----------------------------- */
/* Sommaire */
/* ----------------------------- */
/*
  == Chargement des fichiers de traduction
  == Création de la liste des notes de bas de page
  == Création d’un shortcode pour afficher les liens vers les notes de bas de page
  == Injection du javascript
*/


/* == @section Chargement des fichiers de traduction ==================== */
function ffeeeedd__notes_init() {
  load_plugin_textdomain( 'ffeeeedd--notes', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
}
add_action( 'plugins_loaded', 'ffeeeedd__notes_init' );


/* == @section Création de la liste des notes de bas de page ==================== */
function ffeeeedd__notes() {
    global $post;
    if( has_shortcode( $post->post_content, 'note' ) ) {
      $liste = '<ol class="m-reset pt2 pb2">';
      $original_content = do_shortcode( $post->post_content );
      $sup = "/<sup aria-describedby=\"(.*?)\" id=\"(.*?)\" data-note=\"(.*?)\">(.*?)<\/sup>/i";
      preg_match_all( $sup, $original_content, $notes );
      $chiffre = 0;
      foreach( $notes[3] as $k=>$r  ) {
        $chiffre++;
        $liste .= '<li role="note" id="note-' . esc_attr( $chiffre ) . '">' . $r . '&nbsp;<a class="scroll print-hidden" href="' . get_permalink( $post->ID ) . '#lien-' . esc_attr( $chiffre ) . '" title="' . __( 'Resume', 'ffeeeedd--notes' ) . '"><span aria-hidden="true">[&rarr;]</span></a></li>';
      }
      $liste .= '</ol>';
      echo $liste;
    }
  }


/* == @section Création d’un shortcode pour afficher les liens vers les notes de bas de page ==================== */
function ffeeeedd__notes__shortcode( $atts ) {
  extract( shortcode_atts( array(
    'chiffre' => '',
    'contenu' => '',
  ), $atts ) );
  global $post;
  return '<sup aria-describedby="note-' . esc_attr( $chiffre ) . '" id="lien-' . esc_attr( $chiffre ) . '" data-note="' . esc_attr( $contenu ) . '"><a class="scroll print-hidden" href="' . get_permalink( $post->ID ) . '#note-' . esc_attr( $chiffre ) . '" title="' . esc_attr( $contenu ) . '">[' . $chiffre . ']</a></sup>';
}
add_shortcode( 'note', 'ffeeeedd__notes__shortcode' );


/* == @section Injection du javascript ==================== */
function ffeeeedd__notes__js() {
  if( wp_script_is( 'ffeeeedd-scroll', 'enqueued' ) ) {
    return;
  } elseif( is_singular( 'post' ) ) {
    wp_register_script(
      'ffeeeedd-scroll',
      plugins_url( 'js/ffeeeedd-scroll.min.js', __FILE__ ),
      array(),
      null,
      true
    );
    wp_enqueue_script( 'ffeeeedd-scroll' );
  }
}
add_action( 'wp_enqueue_scripts', 'ffeeeedd__notes__js' );
