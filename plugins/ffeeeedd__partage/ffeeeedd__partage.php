<?php
/**
 * Plugin Name: ffeeeedd__partage
 * Plugin URI: https://github.com/ffoodd/ffeeeedd--extensions/tree/master/plugins/ffeeeedd__partage
 * Description: Ajout et gestion d’une fonction de partage sur les réseaux sociaux.
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
  == Création de la fonction
*/


/* == @section Chargement des fichiers de traduction ==================== */
function ffeeeedd__partage_init() {
  load_plugin_textdomain( 'ffeeeedd--partage', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
}
add_action( 'plugins_loaded', 'ffeeeedd__partage_init' );


/* == @section Création de la fonction ====================
 * @note Si vous voulez ajouter d’autres réseaux sociaux :
 * @see http://www.crea-fr.com/blog/15-liens-de-partage-pour-les-reseaux-sociaux/
 */
function ffeeeedd__partage() {
  global $post;
  if( is_singular( 'post' ) ) {
    $link = esc_url( get_permalink() );
    echo '
    <ul class="print-hidden">
      <li>
        <a href="http://twitter.com/home?status=' . $link . '"
          target="_blank"
          title="' . __( 'New window', 'ffeeeedd--partage' ) . '"
          rel="nofollow">' . __( 'Share on', 'ffeeeedd--partage' ) . ' Twitter</a>
      </li>
      <li>
        <a href="http://www.facebook.com/sharer.php?u=' . $link . '&t=' . esc_attr( $post->post_title ) . '"
          target="_blank"
          title="' . __( 'New window', 'ffeeeedd--partage' ) . '"
          rel="nofollow">' . __( 'Share on', 'ffeeeedd--partage' ) . ' Facebook</a>
      </li>
      <li>
        <a href="https://plus.google.com/share?url=' . $link . '"
          target="_blank"
          title="' . __( 'New window', 'ffeeeedd--partage' ) . '"
          rel="nofollow">' . __( 'Share on', 'ffeeeedd--partage' ) . ' Google+</a>
      </li>
      <li>
        <a href="mailto:?subject=' . esc_attr( $post->post_title ) . '?body=' . $link . '"
          rel="nofollow">' . __( 'Email to a friend', 'ffeeeedd--partage' ) . '</a>
      </li>
      <li>
        <a class="js-visible"
          href="javascript:window.print()"
          target="_blank"
          rel="nofollow">' . __( 'Print this post', 'ffeeeedd--partage' ) . '</a>
          <strong class="js-hidden">' . __( 'In order to print this post, please use the following keyboard shortcut: <kbd>Ctrl + P</kbd>', 'ffeeeedd--partage' ) . '</strong>
      </li>
    </ul>';
  }
}
