ffeeeedd__navigation
====================

Une extension pour ffeeeedd--sass basée sur [Superfish](https://github.com/joeldbirch/superfish/), pour créer un sous-menu déroulant accessible facilement.

Il gère très bien la navigation au survol et au clavier, et se dégrade correctement en l’absence de javascript.

Référence(s) utile(s) :
* [Notice AcceDe Web](http://wiki.accede-web.com/notices/interfaces-riches-javascript/menus-deroulants)

Mode d'emploi
-------------

C’est un «mu-plugin» (pour «Must Use plugin»). Glissez le dans votre dossier mu-plugins (que vous devez créer s’il n’existe pas encore, au même niveau que le dossier plugin) et il sera activé directement.

Cette extension se contente d’ajouter à la queue des scripts WordPress le fichier compilé et minifié correspondant au sous-menu. Il contient :
* `jquery.hover-intent.js`
* `jquery.superfish.js`
* `jquery.ffeeeedd-navigation.js`

L’initialisation se fait dans ce dernier fichier : un sélecteur est utilisé pour cibler la navigation. Par défaut j’ai choisi `#nav>ul` car cela correspond à l’implémentation type de mon thème ffeeeedd et de ses thèmes enfants. Ces trois fichiers ne sont pas chargés, mais présents en guise de documentation et pour permettre leur personnalisation si le besoin s’en fait sentir. De plus les crédits des auteurs ainsi que leurs commentaires respectifs sont indispensables pour qui voudra comprendre le fonctionnement.

Le sélectionneur qui initie le script est personnalisable très simplement en remplaçant ce sélecteur, directement dans le fichier `jquery.ffeeeedd-navigation.min.js`.

Une note sur l’utilisation de cette extension : aucun `CSS` n’est ajouté via ce plugin, mais un fichier `.scss` basique est disponible dans le thème enfant «ffeeeedd--sass», dans le dossier `sass/partials/vendors`. Vous pouvez le compiler en CSS natif ou l’importer dans votre projet sass si vous ne désirez pas utiliser ffeeeedd--sass `:-)`.


Ce projet est sous licence [MIT](http://opensource.org/licenses/MIT "The MIT licence") et [CC BY 3.0 FR](http://creativecommons.org/licenses/by/3.0/fr/ "Explications de la licence").
*Copyright (c) 2013 Gaël Poupard*
