<?php
/**
 * Plugin Name: ffeeeedd__sommaire
 * Plugin URI: https://github.com/ffoodd/ffeeeedd--extensions/tree/master/plugins/ffeeeedd__sommaire
 * Description: Ajout et gestion d’un shortcode pour créer un sommaire.
 * Version: 0.1
 * Author: Gaël Poupard
 * Author URI: http://www.ffoodd.fr
 */
if (!defined('ABSPATH')) die();

/* ----------------------------- */
/* Sommaire */
/* ----------------------------- */
/*
  == Chargement des fichiers de traduction
  == Création du patron
  == Ajout d’un filtre sur le contenu
  == Création du sommaire
  == Création d’un shortcode pour afficher le sommaire
  == Permet l'utilisation de shortcodes dans les sidebars
  == Injection du javascript
*/


/* == @section Chargement des fichiers de traduction ==================== */
function ffeeeedd__sommaire_init() {
  load_plugin_textdomain( 'ffeeeedd__sommaire', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
}
add_action( 'plugins_loaded', 'ffeeeedd__sommaire_init' );


/* == @section Création du patron ==================== */
/**
  * @author Willy Bahuaud
  * @see https://twitter.com/willybahuaud
  * @see http://wabeo.fr/blog/sommaire-article-wordpress/
  * @note Légèrement modifiée par mes soins, afin d’inclure un smoothscroll, des URLs absolues ainsi qu’un lien de retour en haut de page.
  */
function ffeeeedd__sommaire__patron( $matches ) {
  global $post;
  return '<h' . $matches[1] . $matches[2] . ' id="' .sanitize_title( $matches[3] ) . '">' . $matches[3] . ' <a href="' . get_permalink( $post->ID ) . '#toc" class="scroll print-hidden" title="' . __( 'Back to the table of content', 'ffeeeedd__sommaire' ) . '"><span aria-hidden="true">⤴</span></a></h' . $matches[4] . '>';
}


/* == @section Ajout d’un filtre sur le contenu ==================== */
function ffeeeedd__sommaire__ancres( $content ) {
  if( is_singular( 'post' ) ) {
    global $post;
    $pattern = "/<h([3])(.*?)>(.*?)<\/h([3])>/i";
    $content = preg_replace_callback( $pattern, 'ffeeeedd__sommaire__patron', $content );
    return $content;
  } else {
    return $content;
  }
}
add_filter( 'the_content', 'ffeeeedd__sommaire__ancres', 12 );


/* == @section Création du sommaire ==================== */
function ffeeeedd__sommaire( $echo = false ) {
  global $post;
  $obj = '<ol id="toc" class="print-hidden">';
  $original_content = $post->post_content;
  // On récupère les titres
  $patt = "/<h3(.*?)>(.*?)<\/h3>/i";
  preg_match_all( $patt, $original_content, $results );
  // On génère les liens
  foreach( $results[2] as $k=>$r ) {
    $obj .= '<li><a href="' . get_permalink( $post->ID ) . '#' . sanitize_title( $r ) . '" class="scroll">' . $r . '</a></li>';
  }
  $obj .= '<li><a href="' . get_permalink( $post->ID ) . '#comments" class="scroll">' . __( 'Comments', 'ffeeeedd__sommaire' ) . '</a></li></ol>';
  if ( $echo ) {
    echo $obj;
  } else {
    return $obj;
  }
}


/* == @section Création d’un shortcode pour afficher le sommaire ==================== */
add_shortcode( 'sommaire','ffeeeedd__sommaire' );


/* == @section Permet l'utilisation de shortcodes dans les sidebars ==================== */
add_filter('widget_text', 'do_shortcode');


/* == @section Injection du javascript ==================== */
function ffeeeedd__sommaire__js() {
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
add_action( 'wp_enqueue_scripts', 'ffeeeedd__sommaire__js' );
