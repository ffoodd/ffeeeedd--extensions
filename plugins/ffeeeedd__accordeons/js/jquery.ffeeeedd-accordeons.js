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
        // Pour chacun, la valeur de data-controls sert à ajouter l’attribut aria-controls
        $tabs.each(function() {
          $this = $(this);
          $this.attr({
            'role': 'tab',
            'aria-selected': 'false',
            'aria-expanded': 'false',
            'tabindex': '-1',
            'aria-controls': $this.find('a').attr('href').replace('#', '')
          });
          $this.removeAttr('data-job');
        });

        // Les contenus (tabpanel) sont également désactivés dans un premier temps
        // On récupère également data-label pour remplir aria-labbelledby
        $panels.each(function() {
          $this = $(this);
          $this.attr({
            'role': 'tabpanel',
            'aria-hidden': 'true',
            'aria-labelledby': $this.data('label')
          });
          $this.removeAttr('data-job data-label');
        });
      }
      initialise();

      // Au clic sur un accordéon (tab)
      $tabs.on('click', function(e) {
        e.preventDefault();

        if( $(this).attr('aria-selected') == 'true'){
          // On désactive tous les accordéons (tab) et leurs contenus (tabpanel)
          $tabs.attr({
            'aria-selected': 'false',
            'aria-expanded': 'false',
            'tabindex': '-1'
          });
          $panels.attr('aria-hidden', 'true');
        } else {
          var $self = $(this);
          // On récupère l’ID du contenu qu’il contrôle
          $index = $self.find('a').attr('href');

          // Puis on désactive tous les accordéons (tab) et leurs contenus (tabpanel)
          $tabs.attr({
            'aria-selected': 'false',
            'aria-expanded': 'false',
            'tabindex': '-1'
          });
          $panels.attr('aria-hidden', 'true');

          // Enfin on active l’accordéon cliqué (tab) ainsi que son contenu associé (tabpanel)
          $self.attr({
            'aria-selected': 'true',
            'aria-expanded': 'true',
            'tabindex': '0'
          });
          $($index).attr('aria-hidden', 'false');
        }
      });
    });
  };

})(jQuery);

jQuery(document).ready(function($){
  /* On initie Simple Tabs */
  $('[data-job="tablist"]').accordions();
});
