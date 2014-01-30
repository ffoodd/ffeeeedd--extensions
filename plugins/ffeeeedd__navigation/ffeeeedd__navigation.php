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

wp_enqueue_script(
  'superfish',
  plugins_url( 'js/jquery.ffeeeedd-navigation.min.js', __FILE__ ),
  array( 'jquery' ),
  null,
  true
);
