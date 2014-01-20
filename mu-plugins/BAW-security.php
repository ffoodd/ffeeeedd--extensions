<?php
/*
Plugin Name: Forcer des valeurs absolues par sécurité
Author: Julio Potier
AuthorURI: http://boiteaweb.fr
*/

// Forcer l'adresse email admin
add_filter( 'option_admin_email', '_option_admin_email' );
function _option_admin_email( $value ) {
  return 'votre@email.fr'; // valeur à modifier
}

// Forcer l'impossibilité de s'inscrire
add_filter( 'pre_option_users_can_register', '_option_users_can_register' );
function _option_users_can_register( $value ) {
    return '0';
}

// Forcer le rôle par défaut sur "Abonné"
add_filter( 'pre_option_default_role', 'baw_option_default_role' );
function baw_option_default_role( $value ) {
    return 'subscriber';
}
