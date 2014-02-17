ffeeeedd__diaporama
===================

Une extension pour ffeeeedd--sass basée sur [Cycle2](http://jquery.malsup.com/cycle2/), pour créer un diaporama animé facilement.

Référence(s) utile(s) :
* [Notice AcceDe Web](http://wiki.accede-web.com/notices/interfaces-riches-javascript/carrousels-slideshows)

Mode d'emploi
-------------

L’extension s’installe comme d’habitude. Une fois activée, un nouvel item de menu intitulé «Diaporama» fera son apparition juste après les articles. La gestion du contenu repose sur WordPress, vous devriez donc vous y retrouver facilement.

En ajoutant la fonction `ffeeeedd__diaporama();` dans votre template (à priori `front-page.php`, mais vous êtes libres `;p`) le diaporama s’affichera automatiquement.

L’intérêt de cycle2 réside également dans le fait de pouvoir s’en resservir dans d’autres contextes : si vous désirez faire défiler une liste d’éléments (boucle d’articles par exemple), vous pourrez tout simplement ajouter la classe `cycle-slideshow` sur le conteneur principal et définir via les data-attributs tous les paramètres utiles. Il faudra seulement s’assurer que le javascript est bien disponible.

Personnalisation
----------------

Ça ne vous aura pas échappé, l’intérêt de ce projet est d’installer de simples briques : à vous de construire le mur !

Dans cette extension, vous pouvez manipuler la taille des images et le `HTML` de sortie comme dans n’importe quel thème WordPress. Le fichier `PHP` est à priori parfaitement lisible. Vous pourrez y manipuler les différents attributs de paramétrages de cycle2.

De plus, l’intitulé utilisé pour la ré-écriture des URLs est personnalisable, comme pour n’importe quel type d’articles personnalisé.

Une note sur l’utilisation de cette extension : aucun `CSS` n’est ajouté via ce plugin, mais un fichier `.scss` basique est disponible dans le thème enfant «ffeeeedd--sass», dans le dossier `sass/partials/vendors`. Vous pouvez le compiler en CSS natif ou l’importer dans votre projet sass si vous ne désirez pas utiliser ffeeeedd--sass `:-)`.

Ce projet est sous licence [MIT](http://opensource.org/licenses/MIT "The MIT licence") et [CC BY 3.0 FR](http://creativecommons.org/licenses/by/3.0/fr/ "Explications de la licence").
*Copyright (c) 2013 Gaël Poupard*
