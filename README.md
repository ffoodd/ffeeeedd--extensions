ffeeeedd--extensions
====================

Ce projet contient un ensemble d’extensions dont le but est de compléter le thème `ffeeeedd` et son thème enfant, `ffeeeedd--sass`.

Mode d'emploi
-------------

Commençons par le base : il existe des «plugins» et des «mu-plugins». Le «mu» signifie «Must Use» : ils sont donc sensiblement différents. Ils seront activés obligatoirement par leur simple présence dans le dossier «mu-plugins».

Pour en savoir plus sur les subtilités entre ces deux types d’extensions, je vous recommande la lecture de l’article [«Comment ajouter des astuces sur votre site ?»](http://boiteaweb.fr/ajouter-astuces-site-6606.html) par Julio Potier.

Personnalisation
----------------

Les extensions personnalisables le sont de deux façons :
* le balisage `HTML` et les fichiers javascript sont présents dans le dossier de l’extension. Inutile de préciser que vous devez savoir ce que vous faites avant de mettre les mains dans le cambouis !
* les styles sont déportés dans le thème enfant `ffeeeedd--sass`, dans un dossier intitulé «vendors». Les noms de ces fichiers sont parfaitement explicites. Ces derniers ne sont compilés dans le thème que si les variables correspondantes à l’activation de l’extension sont passées à `true` : à vous de changer ces variables selon vos besoins.

Et voilà !

Ce projet est sous licence [MIT](http://opensource.org/licenses/MIT "The MIT licence") et [CC BY 3.0 FR](http://creativecommons.org/licenses/by/3.0/fr/ "Explications de la licence").
*Copyright (c) 2013 Gaël Poupard*
