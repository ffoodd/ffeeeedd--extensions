ffeeeedd__onglets
===================

Une extension pour ffeeeedd--sass basée sur [jQuery Simple Tabs](https://github.com/bluety/simpleTabs), pour créer une boîte à onglets facilement. Le script référence a été largement modifié, afin de prendre en compte les structures ARIA recommandées, rendre le contenu correctement sans javascript et être accessible au clavier.

Mode d'emploi
-------------

Cette extension ajoute deux «shortcodes» :
* `[onglets]`…`[/onglets]`
* `[onglet titre="…"]`…`[/onglet]`

Le premier est indispensable pour générer la boîte à onglets : c’est sur cet élément que le javascript est intialisé. Le second permet de définir autant d’onglets que nécessaire, en précisant un titre.

Et c’est tout !

Personnalisation
----------------

Comme à l’accoutumée, les styles sont personnalisables directement dans `ffeeeedd--sass`. Vous pouvez éventuellement modifier le balisage dans le fichier `PHP` de l’extension, mais c’est à vos risques et périls.

Ce projet est sous licence [MIT](http://opensource.org/licenses/MIT "The MIT licence") et [CC BY 3.0 FR] (http://creativecommons.org/licenses/by/3.0/fr/ "Explications de la licence").
*Copyright (c) 2013 Gaël Poupard*
