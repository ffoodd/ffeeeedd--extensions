;(function($) {
  /* Simple Tabs Plugin 1.0.0
   * @author Théo-Maxime
   * @see http://integrateur-web.pro
   * @see https://github.com/bluety/simpleTabs

   * @note Modifié par mes soins pour transporter le focus en même temps que le scroll visuel
   * @author Gaël Poupard
   * @see https://www.twitter.com/ffoodd_fr
   */
  $.fn.tabs = function() {
    return $(this).each(function() {
      var $el = $(this),
          $tabs = $el.find('[data-role="tab"]'),
          $panels = $el.find('[data-role="panel"]'),
          $nav = $('<div role="tablist">').append( $tabs ),
          $bloc = $('<div role="tabpanel">').append( $panels ),
          $fnHash = ( $el.data('hash') === true ) ? true : false,
          $eq = $(this).attr('id');
          $prefix = ( $el.data('prefix') ) ? $el.data('prefix') : 'tab-';

      var initialise = function () {
        ( $fnHash && window.location.hash ) ? $eq = window.location.hash.split('#' + $prefix + $eq ) : true ;
        ( !$tabs.eq($eq).length ) ? $eq = 0 : false ;
        $tabs.attr('role', 'tab').attr('aria-selected', 'false').attr('tabindex', '-1');
        $panels.attr('aria-expanded', 'false').attr('aria-hidden', 'true');
        $tabs.eq($eq).attr('aria-selected', 'true').attr('tabindex', '0');
        $panels.eq($eq).attr('aria-expanded', 'true').attr('aria-hidden', 'false');
        $el.prepend($nav).append($bloc);
      }
      initialise();

      $tabs.on('click', function(e) {
        e.preventDefault();
        var $self = $(this),
            $index = $self.attr('aria-controls');

        $tabs.attr('aria-selected', 'false').attr('tabindex', '-1');
        $panels.attr('aria-expanded', 'false').attr('aria-hidden', 'true');
        $self.attr('aria-selected', 'true').attr('tabindex', '0');
        $('[id=' + $index + ']').attr('aria-expanded', 'true').attr('aria-hidden', 'false');
        ( $fnHash ) ? window.location.hash = $prefix + $index : false ;
      });
    });
  };

})(jQuery);

jQuery(document).ready(function($){
  $('[data-function="tabs"]').tabs();
  $maxHeight = Math.max.apply(null, $('[data-role="panel"]').map(function () {
    return $(this).outerHeight();
  }).get());
  $("[role=tabpanel]").css("min-height", $maxHeight );
});
