<?php
/*
Plugin Name: Évite les accents dans le nom des médias
Description: Trouvée sur http://geekpress.fr via @boiteaweb
Version: 21 02 2013
*/

/* @see http://www.geekpress.fr/wordpress/astuce/suppression-accents-media-1903/ */
add_filter('sanitize_file_name', 'remove_accents' );

/* @see https://github.com/Darklg/WPUtilities/blob/master/wp-content/mu-plugins/wpu_ux_tweaks.php#L57 */
add_filter( 'sanitize_file_name', 'ffeeeedd__filename' );
function ffeeeedd__filename( $string ) {
  $string = strtolower( $string );
  $string = preg_replace( '/[^a-z0-9-_\.]+/', '', $string );
  return $string;
}
