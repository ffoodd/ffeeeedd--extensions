ffeeeedd__notes
===============

Cette extension permet de créer des notes de bas de page dans les articles, chacune permettant de consulter la note complète à l’aide d’une ancre et d’une animation au scroll. Le focus est traznsporté afin de permettre la navigation au clavier : sur chaque note, un lien permet de reprendre la lecture et transporte à nouveau le focus.

Mode d'emploi
-------------

Une fois l’extension installée, vous pouvez l’utiliser en ajoutant dans `single.php` (ou dans `sidebar.php`, par exemple) la fonction `ffeeeedd__notes();`.

*Pensez à vérifier son existence afin de ne pas générer d’erreur :*

```php
if( function_exists( 'ffeeeedd__notes' ) ) {
  ffeeeedd__notes();
}
```

Personnalisation
----------------

Un seul fichier javascript est utilisé, ne dépendant pas de jQuery. Vous pouvez y modifier la vitesse d’éxécution de l’animation au scroll. Vous pouvez aussi y personnaliser le sélecteur utilisé pour déclencher l’animation, mais il faudra alors penser à le modifier en conséquence dans le `PHP` également (lignes 41 et 56, en l’état actuel).

*Attention : ce fichier peut également être utilisé par l’extension `ffeeeedd__sommaire`. Les réglages que vous modifierez auront donc un impact sur cette autre extension.*


Ce projet est sous licence [MIT](http://opensource.org/licenses/MIT "The MIT licence") et [CC BY 3.0 FR](http://creativecommons.org/licenses/by/3.0/fr/ "Explications de la licence").
*Copyright (c) 2013 Gaël Poupard*
