ffeeeedd__sommaire
==================

Cette extension permet de créer un sommaire pour les articles : il répertorie tous les titres de niveau 2, récupère leur contenu, leur affuble un identifiant reprenant leur contenu, et génère une liste ordonnée de liens ciblant les ancres correspondantes nouvellement crées. Le scroll vers les ancres est animé via javascript, et le focus est transporté sur la cible. Vous pouvez ainsi naviguer au clavier facilement grâce à ce sommaire.

Mode d'emploi
-------------

Une fois l’extension installée, vous pouvez l’utiliser de deux façons :
1 . Ajouter dans `single.php` ou dans `sidebar.php` la fonction `ffeeeedd__sommaire();`;
2 . Créer un widget et inclure le shortcode `[sommaire]`. Vous pouvez également inclure le shortcode dans le contenu de l’article, mais l’intérêt semble limité.

*Si vous utilisez la première méthode, pensez à vérifier l’existence de la fonction afin de ne pas générer d’erreur :*

```php
if( function_exists( 'ffeeeedd__sommaire' ) ) {
  ffeeeedd__sommaire();
}
```

Personnalisation
----------------

Un seul fichier javascript est utilisé, ne dépendant pas de jQuery. Vous pouvez y modifier la vitesse d’éxécution de l’animation au scroll. Vous pouvez aussi y personnaliser le sélecteur utilisé pour déclencher l’animation, mais il faudra alors penser à le modifier en conséquence dans le `PHP` également (lignes 31 et 59, en l’état actuel).

*Attention : ce fichier peut également être utilisé par l’extension `ffeeeedd__notes`. Les réglages que vous modifierez auront donc un impact sur cette autre extension.*

Dans le fichier `PHP`, vous pouvez également modifier le niveau de titre utilisé pour générer le sommaire (ligne 40). Il s’agit d’une expression régulière, donc si vous vous y connaissez vous pouvez même la personnaliser afin d’obtenir un sommaire à plusieurs niveaux, indenté.

Ce projet est sous licence [MIT](http://opensource.org/licenses/MIT "The MIT licence") et [CC BY 3.0 FR](http://creativecommons.org/licenses/by/3.0/fr/ "Explications de la licence").
*Copyright (c) 2013 Gaël Poupard*
