<?php
/*
Plugin Name: Esperluette améliorée
Description: Le contenu et le titre sont filtrés pour remplacer les esperluettes par une balise permettant de styler spécifiquement les esperluettes.
Version: 29 01 2014
*/

/**
  * @note : Pensez à incorporer le CSS correspondant d’une manière ou d’une autre.
  * @note : Je suggère d’importer le fichier partiel .scss dans votre CSS principale.
  * @note : Si vous utilisez «ffeeeedd--sass», vous pouvez soit l’ajouter à l’import principal, soit en coller le contenu dans le partiel «_typographie.scss» (que je recommande).
  */

// Permet d'utiliser la meilleure esperluette disponible dans les titres
function esperluette__titre( $title ) {
  $amp = '&amp;';
  $amp2 = '<span class="amp">&amp;</span>';
  $title = str_replace( $amp, $amp2, $title );
  return $title;
}
add_filter( 'the_title', 'esperluette__titre' );

// Permet d'utiliser la meilleure esperluette disponible dans le contenu
function esperluette__contenu( $content ){
  $amp = '&amp;';
  $amp2 = '<span class="amp">&amp;</span>';
  $content = str_replace( $amp, $amp2, $content );
  return $content;
}
add_filter( 'the_content', 'esperluette__contenu' );
