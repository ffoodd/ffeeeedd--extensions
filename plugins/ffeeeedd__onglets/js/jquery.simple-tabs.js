;(function($) {
  /*
   * jQuery JavaScript Plugin
   * Name: Simple Tabs Plugin
   * Version: 1.0.0
   *
   * TYR Théo-Maxime
   * http://integrateur-web.pro
   *
   * https://github.com/bluety/simpleTabs
   */

  $.fn.tabs = function() {
    return $(this).each(function() {
      var $el = $(this),
          // On récupère tous les éléments onglets (tab) et leur contenu (tabpanel)
          $tabs = $el.find('[data-role="tab"]'),
          $panels = $el.find('[data-role="panel"]'),
          // On crée le groupe d’onglets (tablist) puis on lui adjoint les onglets (tab)
          $nav = $('<div role="tablist">').append( $tabs ),
          // On crée un conteneur pour regrouper les onglets
          $bloc = $('<div class="tabpanel">').append( $panels );

      var initialise = function () {
        // En premier lieu les onglets (tab) sont tous inactifs
        $tabs.attr('role', 'tab').attr('aria-selected', 'false').attr('tabindex', '-1').addClass('action--able');
        // Pour chacun, la valeur de data-controls sert à ajouter l’attribut aria-controls
        $tabs.each(function() {
          $controls = $(this).data('controls');
          $(this).attr('aria-controls', $controls);
        });
        // Les contenus (tabpanel) sont également désactivés dans un premier temps
        $panels.attr('role', 'tabpanel').attr('aria-expanded', 'false').attr('aria-hidden', 'true');
        // On récupère aussi data-label pour remplir aria-labbelledby
        $panels.each(function() {
          $label = $(this).data('label');
          $(this).attr('aria-labelledby', $label);
        });
        // Puis les premiers de chaque type sont activés.
        $tabs.first().attr('aria-selected', 'true').attr('tabindex', '0').removeClass('action--able');
        $panels.first().attr('aria-expanded', 'true').attr('aria-hidden', 'false');
        // Et on génère tout ce petit monde en HTML
        $el.prepend($nav).append($bloc);
        // On manipule la hauteur une première fois
        $max = $panels.first().outerHeight();
        $('.tabpanel').css( 'min-height', $max );
      }
      initialise();

      // Au clic sur un onglet (tab)
      $tabs.on('click', function(e) {
        e.preventDefault();
        // On donne le focus à l’onglet cliqué
        $(this).focus();
        var $self = $(this),
            // On récupère l’ID du contenu qu’il contrôle
            $index = $self.data('controls');
        // Puis on désactive tous les onglets (tab) et leurs contenus (tabpanel)
        $tabs.attr('aria-selected', 'false').attr('tabindex', '-1').addClass('action--able');
        $panels.attr('aria-expanded', 'false').attr('aria-hidden', 'true');
        // On active l’onglet cliqué (tab) ainsi que son contenu associé (tabpanel)
        $self.attr('aria-selected', 'true').attr('tabindex', '0').removeClass('action--able');
        $('#' + $index ).attr('aria-expanded', 'true').attr('aria-hidden', 'false');
        // On récupère la hauteur du contenu cible (tabpanel)
        $height = $('#' + $index ).outerHeight();
        // Et on l’attribue au contenant
        $('.tabpanel').css( 'min-height', $height );
      });

      // Le contrôle au clavier est basique : la pression sur les touches spécifiée du clavier imite le comportement au clic
      $tabs.on('keydown', function(ev) {
        ev.preventDefault();
        // Si on appuie sur «Entrée» ou «Espace»
        if ((ev.which == 13) || (ev.which == 32)) {
          $(this).click();
        }
        // Si on appuie sur «Bas» ou «Droite»
        if ((ev.which == 40) || (ev.which == 39)) {
          // L’onglet suivant (tab) est visé
          $(this).next().click();
        }
        // Si on appuie sur «Haut» ou «Gauche»
        if ((ev.which == 38) || (ev.which == 37)) {
          // L’onglet précédent (tab) est visé
          $(this).prev().click();
        }
        // Si on appuie sur «Début»
        if (ev.which == 36) {
          // Le premier accordéon (tab) est visé
          $tabs.first().click();
        }
        // Si on appuie sur «Fin»
        if (ev.which == 35) {
          // Le premier accordéon (tab) est visé
          $tabs.last().click();
        }
      });
    });
  };

})(jQuery);

jQuery(document).ready(function($){
  /* On initie Simple Tabs */
  $('[data-function="tabs"]').tabs();
});
