<?php
/*
Plugin Name: Évite les accents dans le nom des médias
Description: Trouvée sur http://geekpress.fr via @boiteaweb // @see http://www.geekpress.fr/wordpress/astuce/suppression-accents-media-1903/
Version: 21 02 2013
*/
add_filter('sanitize_file_name', 'remove_accents' );