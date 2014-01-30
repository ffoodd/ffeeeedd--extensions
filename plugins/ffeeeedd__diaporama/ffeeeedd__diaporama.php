<?php
/**
 * Plugin Name: ffeeeedd__diaporama
 * Plugin URI: https://github.com/ffoodd/ffeeeedd--extensions/tree/master/plugins
 * Description: Ajout et gestion d’un diaporama animé. Il faut inclure la fonction ffeeeedd__diaporama() à l’endroit ou vous voulez voir appareaitre le diaporama.
 * Version: 0.1
 * Author: Gaël Poupard
 * Author URI: http://www.ffoodd.fr
 */
if (!defined('ABSPATH')) die();

/* == @section Chargement des fichiers de traduction ==================== */
function ffeeeedd__diaporama_init() {
  load_plugin_textdomain( 'ffeeeedd__diaporama', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
}
add_action( 'plugins_loaded', 'ffeeeedd__diaporama_init' );


/* == @section Création du type d’articles ==================== */
/**
  * @author Gaël Poupard
  * @see https://twitter.com/ffoodd_fr
  */
function ffeeeedd__diaporamas() {
  $labels = array(
    'name'                => _x( 'Slideshow', 'Post Type General Name', 'ffeeeedd__diaporama' ),
    'singular_name'       => _x( 'Slide', 'Post Type Singular Name', 'ffeeeedd__diaporama' ),
    'menu_name'           => __( 'Slideshow', 'ffeeeedd__diaporama' ),
    'all_items'           => __( 'All slides', 'ffeeeedd__diaporama' ),
    'view_item'           => __( 'View slide', 'ffeeeedd__diaporama' ),
    'add_new_item'        => __( 'Add slide', 'ffeeeedd__diaporama' ),
    'add_new'             => __( 'New slide', 'ffeeeedd__diaporama' ),
    'edit_item'           => __( 'Edit slide', 'ffeeeedd__diaporama' ),
    'update_item'         => __( 'Update slide', 'ffeeeedd__diaporama' ),
    'search_items'        => __( 'Search slides', 'ffeeeedd__diaporama' ),
    'not_found'           => __( 'No slide found', 'ffeeeedd__diaporama' ),
    'not_found_in_trash'  => __( 'No slide in trash', 'ffeeeedd__diaporama' )
  );
  $args = array(
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
    'capability_type'     => 'post'
  );
  register_post_type( 'ffeeeedd__diaporamas', $args );
}
add_action( 'init', 'ffeeeedd__diaporamas', 0 );


/* == @section Gestion des images ==================== */
/**
  * @author Gaël Poupard
  * @see https://twitter.com/ffoodd_fr
  * @note Dimensions personnalisables : à répercuter sur le CSS.
  */
if( function_exists( 'add_image_size' ) ) {
  add_image_size( 'diaporama', 980, 430, true );
}


/* == @section Création du contexte d’affichage ==================== */
/**
  * @author Gaël Poupard
  * @see https://www.ffoodd.fr
  */
if( ! function_exists( 'ffeeeedd__diaporama' ) ) {
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
    if( $diaporamas->have_posts() ) {
      $counter = 0; ?>
      <section class="ffeeeedd--diaporamas" aria-labelledby="section-diaporama">
        <span class="visually-hidden" id="section-diaporama">Diaporama</span>
        <div class="cycle-slideshow"
             data-cycle-slides="> article"
             data-cycle-fx="scrollHorz"
             data-cycle-timeout="5000"
             data-cycle-manual-speed="500"
             data-cycle-pause-on-hover="true">

            <?php while( $diaporamas->have_posts() ) {
            $diaporamas->the_post();
            $counter++; ?>
            <article class="ffeeeedd--diaporama">
              <?php if ( has_post_thumbnail() ) {
                the_post_thumbnail( 'diaporama', array( 'alt' => '') );
              } ?>

              <aside class="wp-caption w-100 pa1">
                <p class="wp-caption-text entry-title h3-like"><?php the_title(); ?></p>
                <p class="wp-caption-text"><?php echo get_the_content(); ?></p>
                <a href="<?php the_permalink(); ?>">
                  <?php _e( 'Read more', 'ffeeeedd__diaporama' ); ?>
                  <span class="visually-hidden">
                    <?php _e( 'about', 'ffeeeedd__diaporama' ); ?> «<?php the_title(); ?>»
                  </span>
                </a>
              </aside>
            </article>
            <?php } wp_reset_postdata(); ?>
          </div>

          <?php // @note On ne charge le script et les contrôles que s’il y a plus d’un item
          if( $counter > 1 ) {
              wp_enqueue_script(
                'cycle2',
                plugins_url( 'js/jquery.cycle2.js', __FILE__ ),
                array( 'jquery' ),
                null,
                true
              ); ?>
          <div class="ffeeeedd--controles js-visible">
            <button data-cycle-cmd="prev"
                    data-cycle-context=".cycle-slideshow"
                    title="<?php _e( 'Previous', 'ffeeeedd__diaporama' ); ?>">
              <span class="visually-hidden">
                <?php _e( 'Previous', 'ffeeeedd__diaporama' ); ?>
              </span>
              <span aria-hidden="true">&lt;</span>
            </button>
            <button data-cycle-cmd="pause"
                    data-cycle-context=".cycle-slideshow"
                    title="<?php _e( 'Pause', 'ffeeeedd__diaporama' ); ?>">
              <span class="visually-hidden">
                <?php _e( 'Pause', 'ffeeeedd__diaporama' ); ?>
              </span>
              <span aria-hidden="true">&#124;&#124;</span>
            </button>
            <button data-cycle-cmd="resume"
                    data-cycle-context=".cycle-slideshow"
                    title="<?php _e( 'Play', 'ffeeeedd__diaporama' ); ?>">
              <span class="visually-hidden">
                <?php _e( 'Play', 'ffeeeedd__diaporama' ); ?>
              </span>
              <span aria-hidden="true">&#9658;</span>
            </button>
            <button data-cycle-cmd="next"
                    data-cycle-context=".cycle-slideshow"
                    title="<?php _e( 'Next', 'ffeeeedd__diaporama' ); ?>">
              <span class="visually-hidden">
                <?php _e( 'Next', 'ffeeeedd__diaporama' ); ?>
              </span>
              <span aria-hidden="true">&gt;</span>
            </button>
          </div>
          <?php } ?>

        </section><!-- .ffeeeedd--diaporama -->
      <?php } wp_reset_query();
  }
}
