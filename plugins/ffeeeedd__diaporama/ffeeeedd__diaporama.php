<?php
/**
 * Plugin Name: ffeeeedd__diaporama
 * Plugin URI: https://github.com/ffoodd/ffeeeedd--extensions/tree/master/plugins/ffeeeedd__diaporama
 * Description: Ajout et gestion d’un diaporama animé. Il faut inclure la fonction ffeeeedd__diaporama() à l’endroit ou vous voulez voir apparaitre le diaporama.
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
  == Création du type d’articles
    -- Modification des permaliens à l’activation / désactivation
  == Gestion des images
  == Création du contexte d’affichage
    -- Paramétrage de la boucle
    -- Démarrage de la boucle
*/


/* == @section Chargement des fichiers de traduction ==================== */
function ffeeeedd__diaporama_init() {
  load_plugin_textdomain( 'ffeeeedd--diaporama', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
}
add_action( 'plugins_loaded', 'ffeeeedd__diaporama_init' );


/* == @section Création du type d’articles ==================== */
/**
  * @author Gaël Poupard
  * @see https://twitter.com/ffoodd_fr
  */
function ffeeeedd__diaporamas() {
  $labels = array(
    'name'                => __( 'Slides', 'ffeeeedd--diaporama' ),
    'singular_name'       => __( 'Slide', 'ffeeeedd--diaporama' ),
    'menu_name'           => __( 'Slides', 'ffeeeedd--diaporama' ),
    'all_items'           => __( 'All slides', 'ffeeeedd--diaporama' ),
    'view_item'           => __( 'View slide', 'ffeeeedd--diaporama' ),
    'add_new_item'        => __( 'Add slide', 'ffeeeedd--diaporama' ),
    'add_new'             => __( 'New slide', 'ffeeeedd--diaporama' ),
    'edit_item'           => __( 'Edit slide', 'ffeeeedd--diaporama' ),
    'update_item'         => __( 'Update slide', 'ffeeeedd--diaporama' ),
    'search_items'        => __( 'Search slides', 'ffeeeedd--diaporama' ),
    'not_found'           => __( 'No slide found', 'ffeeeedd--diaporama' ),
    'not_found_in_trash'  => __( 'No slide in trash', 'ffeeeedd--diaporama' )
  );
  $args = array(
    'label'               => __( 'Slides', 'ffeeeedd--diaporama' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions' ),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => false,
    'show_in_admin_bar'   => false,
    'menu_position'       => 5,
    'menu_icon'           => 'dashicons-format-gallery',
    'can_export'          => true,
    'has_archive'         => false,
    'exclude_from_search' => true,
    'publicly_queryable'  => true,
    'capability_type'     => 'post',
    'rewrite' => array( 'slug' => __( 'slides', 'ffeeeedd--diaporama' ) ),
  );
  register_post_type( 'ffeeeedd__diaporamas', $args );
}
add_action( 'init', 'ffeeeedd__diaporamas', 0 );

/* -- @subsection Modification des permaliens à l’activation / désactivation -------------------- */
/**
  * @see http://codex.wordpress.org/Function_Reference/register_post_type#Flushing_Rewrite_on_Activation
  */
function ffeeeedd__diaporamas_rewrite__flush() {
    ffeeeedd__diaporamas();
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'ffeeeedd__diaporamas_rewrite__flush' );


/* == @section Gestion des images ==================== */
/**
  * @author Gaël Poupard
  * @see https://twitter.com/ffoodd_fr
  * @note Dimensions personnalisables : à répercuter sur le CSS.
  */
if ( function_exists( 'add_image_size' ) ) {
  add_image_size( 'diaporama', 980, 430, true );
}


/* == @section Création du contexte d’affichage ==================== */
/**
  * @author Gaël Poupard
  * @see https://www.ffoodd.fr
  */
if ( ! function_exists( 'ffeeeedd__diaporama' ) ) {
  function ffeeeedd__diaporama() {

    /* -- @subsection Paramétrage de la boucle -------------------- */
    $diaporamas_args = array(
      'post_type' => 'ffeeeedd__diaporamas',
      'posts_per_page' => 3
    );
    $diaporamas = new WP_Query( $diaporamas_args );

    /* -- @subsection Démarrage de la boucle -------------------- */
    /**
      * @note Si on a des diaporamas :
      */
    if ( $diaporamas->have_posts() ) {
      $counter = 0; ?>
      <section class="section--diaporamas mw--site center clear" aria-labelledby="section-diaporama">
        <span class="visually-hidden" id="section-diaporama"><?php _e( 'Slideshow', 'ffeeeedd--diaporama' ); ?></span>

        <?php // @note On boucle une première fois pour incrémenter le compteur
        while( $diaporamas->have_posts() ) {
          $diaporamas->the_post();
          $counter++;
        }
        wp_reset_postdata();
        // @note On ne charge le script et les contrôles que s’il y a plus d’un item
        if ( $counter > 1 ) {
          wp_enqueue_script(
            'ffeeeedd-diaporama',
            plugins_url( 'js/jquery.ffeeeedd-diaporama.min.js', __FILE__ ),
            array( 'jquery' ),
            null,
            true
          ); ?>
          <div class="ffeeeedd--controles js-visible">
            <button class="ffeeeedd--precedent"
                    title="<?php _e( 'Previous', 'ffeeeedd--diaporama' ); ?>">
              <span class="visually-hidden">
                <?php _e( 'Previous', 'ffeeeedd--diaporama' ); ?>
              </span>
              <span aria-hidden="true">&lt;</span>
            </button>
            <button class="ffeeeedd--suivant"
                    title="<?php _e( 'Next', 'ffeeeedd--diaporama' ); ?>">
              <span class="visually-hidden">
                <?php _e( 'Next', 'ffeeeedd--diaporama' ); ?>
              </span>
              <span aria-hidden="true">&gt;</span>
            </button>
          </div>
        <?php } ?>

        <div class="ffeeeedd--diaporamas">

            <?php while ( $diaporamas->have_posts() ) {
            $diaporamas->the_post(); ?>
            <article class="ffeeeedd--diaporama w--site">
              <?php if ( has_post_thumbnail() ) {
                the_post_thumbnail( 'diaporama', array( 'alt' => '') );
              } ?>

              <aside class="wp-caption w-100 pa1">
                <p class="wp-caption-text entry-title h3-like"><?php the_title(); ?></p>
                <p class="wp-caption-text"><?php echo get_the_content(); ?></p>
                <a href="<?php the_permalink(); ?>">
                  <?php _e( 'Read more', 'ffeeeedd--diaporama' ); ?>
                  <span class="visually-hidden">
                    <?php _e( 'about', 'ffeeeedd--diaporama' ); ?> «<?php the_title(); ?>»
                  </span>
                </a>
              </aside>
            </article>
            <?php } wp_reset_postdata(); ?>
          </div>

        </section><!-- .ffeeeedd-diaporama -->
      <?php } wp_reset_query();
  }
}
