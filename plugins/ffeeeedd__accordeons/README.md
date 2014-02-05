ffeeeedd__accordeons
====================

Une extension pour ffeeeedd--sass basée sur [jQuery Simple Tabs](https://github.com/bluety/simpleTabs), pour créer un groupe d’accordéons facilement. Le script référence a été largement modifié, afin de prendre en compte les structures ARIA recommandées, rendre le contenu correctement sans javascript et être accessible au clavier.

Mode d'emploi
-------------

Cette extension ajoute deux «shortcodes» :
* `[accordeons]`…`[/accordeons]`
* `[accordeon titre="…"]`…`[/accordeon]`

Le premier est indispensable pour regrouper les accordéons. Le second permet de définir autant d’accordéons que nécessaire, en précisant un titre pour chacun.

Et c’est tout !

Personnalisation
----------------

Comme à l’accoutumée, les styles sont personnalisables directement dans `ffeeeedd--sass`. Vous pouvez éventuellement modifier le balisage dans le fichier `PHP` de l’extension, mais c’est à vos risques et périls.


Ce projet est sous licence [MIT](http://opensource.org/licenses/MIT "The MIT licence") et [CC BY 3.0 FR] (http://creativecommons.org/licenses/by/3.0/fr/ "Explications de la licence").
*Copyright (c) 2013 Gaël Poupard*
