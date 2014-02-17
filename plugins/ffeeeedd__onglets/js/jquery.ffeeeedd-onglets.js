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
          $nav = $('<div role="tablist">').append( $tabs );

      var initialise = function () {
        // En premier lieu les onglets (tab) sont tous inactifs
        // Pour chacun, la valeur de data-controls sert à ajouter l’attribut aria-controls
        $tabs.each(function() {
          $this = $(this);
          $this.attr({
            'role': 'tab',
            'aria-selected': 'false',
            'aria-controls': $this.find('a').attr('href').replace('#', '')
          });
          $this.removeAttr('data-role');
        });

        // Les contenus (tabpanel) sont également désactivés dans un premier temps
        // On récupère aussi data-label pour remplir aria-labbelledby
        $panels.each(function() {
          $this = $(this);
          $this.attr({
            'role': 'tabpanel',
            'aria-expanded': 'false',
            'aria-hidden': 'true',
            'tabindex': '-1',
            'aria-labelledby': $this.data('label')
          });
          $this.removeAttr('data-role data-label');
        });

        // Puis les premiers de chaque type sont activés.
        $tabs.first().attr('aria-selected', 'true');
        $panels.first().attr({
          'aria-expanded': 'true',
          'aria-hidden': 'false',
          'tabindex': '0'
        });

        // Et on génère tout ce petit monde en HTML
        $el.prepend($nav).append($panels);
      }
      initialise();

      // Au clic sur un onglet (tab)
      $tabs.on('click', function(e) {
        e.preventDefault();
        var $self = $(this);
        // On récupère l’ID du contenu qu’il contrôle
        $index = $self.find('a').attr('href');

        // Puis on désactive tous les onglets (tab) et leurs contenus (tabpanel)
        $tabs.attr('aria-selected', 'false');
        $panels.attr({
          'aria-expanded': 'false',
          'aria-hidden': 'true',
          'tabindex': '-1'
        });

        // On active l’onglet cliqué (tab) ainsi que son contenu associé (tabpanel)
        $self.attr('aria-selected', 'true');
        $($index).attr({
          'aria-expanded': 'true',
          'aria-hidden': 'false',
          'tabindex':'0'
        }).focus();
      });
    });
  };

})(jQuery);

jQuery(document).ready(function($){
  /* On initie Simple Tabs */
  $('[data-function="tabs"]').tabs();
});
