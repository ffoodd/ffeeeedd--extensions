<?php
/**
 * Plugin Name: ffeeeedd__dialogue
 * Plugin URI: https://github.com/ffoodd/ffeeeedd--extensions/tree/master/plugins/ffeeeedd__dialogue
 * Description: Ajoute un script pour gérer des fenêtres modales.
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
*/


/* == @section Chargement des fichiers de traduction ==================== */
function ffeeeedd__dialogue_init() {
  load_plugin_textdomain( 'ffeeeedd--dialogue', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
}
add_action( 'plugins_loaded', 'ffeeeedd__dialogue_init' );
