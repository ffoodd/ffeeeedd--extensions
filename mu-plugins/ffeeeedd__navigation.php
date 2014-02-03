<?php
/**
 * Plugin Name: ffeeeedd__navigation
 * Plugin URI: https://github.com/ffoodd/ffeeeedd--extensions/tree/master/plugins/ffeeeedd__navigation
 * Description: À utiliser si besoin d’un sous-menu. Basé sur le plugin jQuery «Superfish».
 * Version: 0.1
 * Author: Gaël Poupard
 * Author URI: http://www.ffoodd.fr
 */
if (!defined('ABSPATH')) die();

function ffeeeedd__navigation() {
  wp_enqueue_script(
    'superfish',
    content_url( 'mu-plugins/ffeeeedd__navigation/js/jquery.ffeeeedd-navigation.min.js', __FILE__ ),
    array( 'jquery' ),
    null,
    true
  );
}
add_action('wp_enqueue_scripts', 'ffeeeedd__navigation');
