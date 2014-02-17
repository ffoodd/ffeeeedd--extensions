<?php
/**
 * Plugin Name: ffeeeedd__accordeons
 * Plugin URI: https://github.com/ffoodd/ffeeeedd--extensions/tree/master/plugins/ffeeeedd__accordeons
 * Description: Ajout et gestion d’un shortcode pour créer un groupe d’accordéons accessible.
 * Version: 0.1
 * Author: Gaël Poupard
 * Author URI: http://www.ffoodd.fr
 */
if ( !defined( 'ABSPATH' ) ) die();

/* ----------------------------- */
/* Sommaire */
/* ----------------------------- */
/*
  == Création des shortcodes
  == Injection du javascript
*/


/* == @section Création des shortcodes ==================== */
/**
  * @author Gaël Poupard
  * @see https://twitter.com/ffoodd_fr
  */
function ffeeeedd__shortcode__accordeons( $atts, $content = null ) {
  return '<div
    data-job="tablist"
    class="ffeeeedd__accordeons">' . do_shortcode( $content ) . '
  </div>';
}
add_shortcode( 'accordeons', 'ffeeeedd__shortcode__accordeons' );

function ffeeeedd__shortcode__accordeon( $atts, $content = null ) {
  extract( shortcode_atts( array(
    'titre' => 'Titre manquant',
  ), $atts ) );
  $label = sanitize_html_class( sanitize_title( strtolower( $titre ) ) );
  return '<h3
    data-job="tab"
    class="h6-like"
    id="' . esc_attr( $label ) . '-titre">
      <a href="#' . esc_attr( $label ) . '">' . $titre . '</a>
    </h3>
  <div
    data-job="panel"
    data-label="' . esc_attr( $label ) . '-titre"
    id="' . esc_attr( $label ) . '"
    class="w-100">
      <div class="pa1">' . do_shortcode( $content ) . '</div>
  </div>';
}
add_shortcode( 'accordeon', 'ffeeeedd__shortcode__accordeon' );


/* == @section Injection du javascript ==================== */
/**
  * @author Gaël Poupard
  * @see https://twitter.com/ffoodd_fr
  */
function ffeeeedd__accordeons() {
  global $post;
  if( has_shortcode( $post->post_content, 'accordeons') ) {
    wp_enqueue_script(
      'ffeeeedd-accordeons',
      plugins_url( 'js/jquery.ffeeeedd-accordeons.min.js', __FILE__ ),
      array( 'jquery' ),
      null,
      true
    );
  }
}
add_action( 'wp_enqueue_scripts', 'ffeeeedd__accordeons' );
