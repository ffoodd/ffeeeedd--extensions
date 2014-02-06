ffeeeedd__onglets
===================

Une extension pour ffeeeedd--sass qui permet d’afficher une liste de liens de partage vers les principaux réseaux sociaux, ainsi qu’un lien pour envoyer par mail et un lien pour imprimer l’article.

Mode d'emploi
-------------

Cette extension crée simplement la fonction `ffeeeedd__partage();`, qu’il vous suffit de placer dans `single.php` du thème enfant `ffeeeedd--sass` - de préférence dans la balise `<footer>`.

*Pensez à vérifier son existence afin de ne pas générer d’erreur :*

```php
if( function_exists( 'ffeeeedd__partage' ) ) {
  ffeeeedd__partage();
}
```

Une évolution prochaine sera d’ouvrir ces liens de partage dans une fenêtre modale plutôt que dans un nouvel onglet, mais la question de l’accessibilité se pose encore.


Personnalisation
----------------

Aucun style n’est prévu : il s’agit d’une liste non ordonnée par défaut. Vous êtes libre de personnaliser le balisage dans le fichier `PHP`, et d’adapter les styles à votre convenance.

Si d’aventures vous désirez utiliser des pictogrammes, n’oubliez pas que `ffeeeedd--sass` dispose d’un partiel `sprites.scss` qui permet de générer un sprite en `.png` et les classes utiles automatiquement, en fonction des images `.png` présentes dans le dossier `/img/ffeeeedd--sprite/`.

Ce projet est sous licence [MIT](http://opensource.org/licenses/MIT "The MIT licence") et [CC BY 3.0 FR](http://creativecommons.org/licenses/by/3.0/fr/ "Explications de la licence").
*Copyright (c) 2013 Gaël Poupard*
