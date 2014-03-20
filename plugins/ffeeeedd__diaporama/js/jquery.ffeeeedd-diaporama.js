;(function($) {

  /**
   * ffeeeedd__diaporama
   * @author Gaël Poupard
   * @see http://www.ffoodd.fr
   * @note Basé sur jQuery Simple Tabs Plugin
   * @author TYR Théo-Maxime
   * @see https://github.com/bluety/simpleTabs
   */

  $.fn.diaporamas = function() {
    return $(this).each(function() {
      var $el = $(this),
        // On récupère tous les diaporamas
        $diaporamas = $(this).find('.ffeeeedd--diaporama');

      var initialise = function () {
        // Les diaporamas sont placés « en attente »
        $diaporamas.not(':first').addClass('ffeeeedd--attente').attr('aria-hidden', 'true');
        $diaporamas.not(':first').find('a').attr('tabindex', '-1');
        // Le premier diaporama est activé
        $diaporamas.first().removeClass('ffeeeedd--attente').addClass('ffeeeedd--actif');
      }
      initialise();

      // Au clic sur bouton suivant
      $('.ffeeeedd--suivant').on('click', function(e) {
        e.preventDefault();

        // On identifie le diaporama inactif
        $inactif = $('.ffeeeedd--diaporamas').find('.ffeeeedd--inactif');
        // On le remet en attente
        $inactif.removeClass('ffeeeedd--inactif').addClass('ffeeeedd--attente').attr('aria-hidden', 'true');
        $inactif.find('a').attr('tabindex', '-1');

        // On identifie le diaporama actif
        $actif = $('.ffeeeedd--diaporamas').find('.ffeeeedd--actif');
        // On le désactive
        $actif.removeClass('ffeeeedd--actif').addClass('ffeeeedd--inactif').attr('aria-hidden', 'true');
        $actif.find('a').attr('tabindex', '-1');

        // On active son successeur s’il existe, et le premier diaporama dans le cas contraire
        if( $actif.next().is('.ffeeeedd--attente') ) {
          $actif.next().removeClass('ffeeeedd--attente').addClass('ffeeeedd--actif').removeAttr('aria-hidden').focus();
          $actif.next().find('a').removeAttr('tabindex');
        } else {
          $diaporamas.first().removeClass('ffeeeedd--attente').addClass('ffeeeedd--actif').focus();
          $diaporamas.first().find('a').removeAttr('tabindex');
        }

      });

      // Au clic sur bouton précédent
      $('.ffeeeedd--precedent').on('click', function(e) {
        e.preventDefault();

        // On identifie le diaporama actif
        $actif = $('.ffeeeedd--diaporamas').find('.ffeeeedd--actif');
        // On le replace en attente
        $actif.removeClass('ffeeeedd--actif').addClass('ffeeeedd--attente').attr('aria-hidden', 'true');
        $actif.find('a').attr('tabindex', '-1');

        // On identifie le diaporama inactif
        $inactif = $('.ffeeeedd--diaporamas').find('.ffeeeedd--inactif');
        // On l’active
        $inactif.removeClass('ffeeeedd--inactif').addClass('ffeeeedd--actif').removeAttr('aria-hidden').focus();
        $inactif.find('a').removeAttr('tabindex');

        // On désactive son prédécesseur
        if( $inactif.prev().is('.ffeeeedd--attente') ) {
          $inactif.prev().removeClass('ffeeeedd--attente').addClass('ffeeeedd--inactif').attr('aria-hidden', 'true');
          $inactif.prev().find('a').attr('tabindex', '-1');
        } else {
          $diaporamas.last().removeClass('ffeeeedd--attente').addClass('ffeeeedd--inactif').attr('aria-hidden', 'true');
          $diaporamas.last().find('a').attr('tabindex', '-1');
        }
      });
    });
  };

})(jQuery);

jQuery(document).ready(function($){
  $('.section--diaporamas').diaporamas();
});
