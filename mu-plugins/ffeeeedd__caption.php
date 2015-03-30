<?php
/*
Plugin Name: Remplace le code généré par [caption]
Description: Le contenu est filtré pour remplacer le html généré pour les caption par du html5 sémantique. Astuce trouvée sur Reverie.
Version: 28 01 2014
*/

/**
  * @author Zhen Huang
  * @see http://themefortress.com/reverie/
  * @see https://github.com/milohuang/reverie/blob/master/lib/clean.php#LC151
  * @note On y ajoute les microdonnées qui vont bien.
  * @author Joost Kiens ( @joostkiens )
  * @see https://gist.github.com/JoostKiens/4477366
  * @note Et j’y ajoute les rôles et attributs Aria nécessaires
  * @see http://www.kloh.ch/craw2013-html5-aria-et-accessibilite-web-479
  */
  add_filter( 'img_caption_shortcode', 'ffeeeedd__caption', 10, 3 );
  function ffeeeedd__caption( $output, $attr, $content ) {
    if ( is_feed() ) {
      return $output;
    }
    $defaults = array(
      'id' => '',
      'align' => 'alignnone',
      'width' => '',
      'caption' => ''
    );
    $attr = shortcode_atts( $defaults, $attr );
    if ( 1 > (int) $attr['width'] || empty( $attr['caption'] ) ) {
      return $content;
    }
    $content = str_replace( '<img', '<img id="' . $attr['id'] . '" itemprop="contentURL" aria-describedby="wp-caption--' . $attr['id'] . '"', $content );
    $attributes = ' class="wp-caption pa1 ' . esc_attr( $attr['align'] ) . '"';
    $output = '<figure' . $attributes .' role="group" itemscope itemtype="http://schema.org/ImageObject">';
    $output .= do_shortcode( $content );
    $output .= '<figcaption class="wp-caption-text pt1 small" id="wp-caption--' . $attr['id'] . '" itemprop="description">' . $attr['caption'] . '</figcaption>';
    $output .= '</figure>';
    return $output;
  }
