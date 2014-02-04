;(function($) {
  /*
   * jQuery JavaScript Plugin
   * Name: Simple accordion Plugin
   * Version: 1.0.0
   *
   * @author Gaël Poupard
   */

  $.fn.accordions = function() {
    return $(this).each(function() {
      var $el = $(this),
          $list = $el.find('[data-job="tablist"]'),
          // On récupère tous les éléments accordéons (tab)
          $tabs = $el.find('[data-job="tab"]'),
          // Et leur contenu (tabpanel)
          $panels = $el.find('[data-job="panel"]');

      var initialise = function () {
        // On ajoute le premier rôle ARIA
        $list.attr('role', 'tablist');
        // En premier lieu les accordéons (tab) sont tous inactifs
        $tabs.attr('role', 'tab').attr('aria-selected', 'false').attr('tabindex', '-1');
        // Pour chacun, la valeur de data-controls sert à ajouter l’attribut aria-controls
        $tabs.each(function() {
          $controls = $(this).data('controls');
          $(this).attr('aria-controls', $controls);
        });
        // Les contenus (tabpanel) sont également désactivés dans un premier temps
        $panels.attr('role', 'tabpanel').attr('aria-expanded', 'false').attr('aria-hidden', 'true');
        // On récupère également data-label pour remplir aria-labbelledby
        $panels.each(function() {
          $label = $(this).data('label');
          $(this).attr('aria-labelledby', $label);
        });
      }
      initialise();

      // Au clic sur un accordéon (tab)
      $tabs.on('click', function(e) {
        e.preventDefault();
        // On donne le focus à l’accordéon cliqué
        $(this).focus();
        if( $(this).attr('aria-selected') == 'true'){
          // On désactive tous les accordéons (tab) et leurs contenus (tabpanel)
          $tabs.attr('aria-selected', 'false').attr('tabindex', '-1');
          $panels.attr('aria-expanded', 'false').attr('aria-hidden', 'true');
        } else {
          var $self = $(this),
              // On récupère l’ID du contenu qu’il contrôle
              $index = $self.data('controls');
          // Puis on désactive tous les accordéons (tab) et leurs contenus (tabpanel)
          $tabs.attr('aria-selected', 'false').attr('tabindex', '-1');
          $panels.attr('aria-expanded', 'false').attr('aria-hidden', 'true');
          // Enfin on active l’accordéon cliqué (tab) ainsi que son contenu associé (tabpanel)
          $self.attr('aria-selected', 'true').attr('tabindex', '0');
          $('[id=' + $index + ']').attr('aria-expanded', 'true').attr('aria-hidden', 'false');
        }
      });

      // Le contrôle au clavier est basique : la pression sur les touches spécifiée du clavier imite le comportement au clic
      $tabs.on('keydown', function(ev) {
        ev.preventDefault();
        // Si on appuie sur «Entrée» ou «Espace»
        if ((ev.which == 13) || (ev.which == 32)) {
          $(this).click();
        }
        // Si on appuie sur «Début»
        if (ev.which == 36) {
          // Le premier accordéon (tab) est visé
          $tabs.first('[data-job="tab"]').click();
        }
        // Si on appuie sur «Fin»
        if (ev.which == 35) {
          // Le premier accordéon (tab) est visé
          $tabs.last('[data-job="tab"]').click();
        }
      });
    });
  };

})(jQuery);

jQuery(document).ready(function($){
  /* On initie Simple Tabs */
  $('[data-job="tablist"]').accordions();
});
