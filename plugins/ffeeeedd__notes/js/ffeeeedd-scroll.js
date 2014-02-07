  /*
   * Smooth scroll
   * @note Basé sur Smooth Scroll 2.3
   * @see Chris Ferdinandi
   * @link http://gomakethings.com
   * @author Gaël Poupard
   * @note Le script original est modifie entre autres pour transporter le focus avec le scroll, et donc être accessible au clavier.
   */

 (function() {

  'use strict';

  // Détection de capacité
  if ( 'querySelector' in document && 'addEventListener' in window && Array.prototype.forEach ) {

    // Fonction pour animer le scroll
    var smoothScroll = function (anchor, duration) {

      // Calcul de la distance et de la vitesse du scroll
      var startLocation = window.pageYOffset;
      var endLocation = anchor.offsetTop;
      var distance = endLocation - startLocation;
      var increments = distance/(duration/16);
      var stopAnimation;

      // Le scroll est incrémenté afin de savoir quand s’arrêter
      var animateScroll = function () {
        window.scrollBy(0, increments);
        stopAnimation();
      };

      // Si on va vers le bas
      if ( increments >= 0 ) {
        // L’animation s’arrête si l’ancre visée est atteinte ou si on est en bas de page
        stopAnimation = function () {
          var travelled = window.pageYOffset;
          if ( (travelled >= (endLocation - increments)) || ((window.innerHeight + travelled) >= document.body.offsetHeight) ) {
            clearInterval(runAnimation);
          }
        };
      }
      // Si on va vers le haut
      else {
        // L’animation s’arrête si l’ancre visée est atteinte ou si on est en haut de page
        stopAnimation = function () {
          var travelled = window.pageYOffset;
          if ( travelled <= (endLocation || 0) ) {
            clearInterval(runAnimation);
          }
        };
      }

      // On boucle sur l’animation
      var runAnimation = setInterval(animateScroll, 16);

    };

    // On définit le sélecteur qui enclenche le script
    var scrollToggle = document.querySelectorAll('.scroll');

    // Pour chaque item ciblé par le sélecteur
    [].forEach.call(scrollToggle, function (toggle) {

      // Quand on clique dessus
      toggle.addEventListener('click', function(e) {

        // On annule le comportement par défaut
        e.preventDefault();

        // On récupère la cible du lien, puis on calcule sa distance par rapport au haut de la page
        var dataID = toggle.getAttribute('href');
        var dataHash = dataID.split("#");
        var dataTarget = document.querySelector("#" + dataHash[1]);
        var dataSpeed = toggle.getAttribute('data-speed');
        var dataFocus = function() {
          window.location.hash = ("#" + dataHash[1]);
          dataTarget.focus();
        }

        // Si l’ancre visée existe
        if (dataTarget) {
          // On y va
          smoothScroll(dataTarget, dataSpeed || 500);
          setTimeout(dataFocus, dataSpeed || 500);
        }

      }, false);

    });

  }

 })();
