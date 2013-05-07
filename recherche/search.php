<?php
/**
 * Page recherche
 * @author        Gaël Poupard
 * @link          www.ffoodd.fr
 *
 * @note Amélioration trouvée sur GeekPress
 * @see http://www.geekpress.fr/wordpress/astuce/mettre-en-evidence-les-termes-dans-les-resultats-de-recherche-725/
 * @author Jonathan Buttigieg
 *
 * En savoir plus : http://codex.wordpress.org/Template_Hierarchy
 *
 * @package       WordPress
 * @subpackage    ffeeeedd
 * @since         ffeeeedd 1.0
 */
get_header(); ?>

<?php if ( have_posts() ) : ?>

  <h2><?php echo 'Recherche : ' . get_search_query() . '' ; ?></h2>

  <ol>
    <?php while ( have_posts() ) : the_post();
    $keys = implode('|', explode(' ', get_search_query()));
    $title = preg_replace('/('.$keys .')/iu', '<mark class="search-term inbl">\0</mark>', get_the_title());
    $excerpt = preg_replace('/('.$keys .')/iu', '<mark class="search-term inbl">\0</mark>', get_the_excerpt());
    ?>
    <li class="mb2">
      <article itemscope itemtype="http://schema.org/Article">
        <h3 itemprop="name"><a href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark" itemprop="url"><?php echo $title ?></a></h3>

        <p itemprop="UserComments"><?php comments_number( '0', '1', '% ' ); ?></p>
        <a href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title_attribute(); ?>" itemprop="image"><?php the_post_thumbnail(); ?></a>
        <time datetime="<?php the_time( 'j-F-Y' ); ?>" pubdate itemprop="datePublished"><?php the_date(); ?></time>
        <p itemprop="description"><?php echo $excerpt; ?></p>

        <footer>
          <?php ffeeeedd__meta(); ?>
        </footer>
      </article>
    </li>
    <?php endwhile; ?>
  </ol>

  <?php ffeeeedd_pagination(); ?>

  <?php else : ?>
  <h2><?php echo __('Aucun article ne répond à votre critère de recherche', 'ffeeeedd'); ?>.</h2>
  <p><?php echo __('Vous pouvez relancer une recherche', 'ffeeeedd'); ?> :</p>
  <?php get_search_form(); ?>
  <?php endif; ?>

<?php get_footer(); ?>
