# eedomus_LightBerry
Script de contrôle du LightBerry depuis eedomus

NB : Script à installer sur serveur web/php autre que l'eedomus elle-même

Pour ceux qui ont un Lightberry (Ambilight sur Raspberry) contrôlé par Hyperion, 
il vous est possible de piloter les led à partir de requêtes http.

Les pré-requis donc :
- Un raspberry avec un lightberry, piloté par Hyperion : voir l'article de Maison et Domotique sur le sujet.
- L'accès autorisé en SSH sur votre raspberry
- le script php suivant en ayant au préalable saisi vos paramètres perso : ip, user/mdp ssh
- et donc la libssh2 de php sur le serveur qui l'héberge

Et il ne vous reste qu'à créer un actionneur http sous eedomus qui lance le script.
Vous pouvez créer une valeur par effet, par exemple : 
Alarme activée : http://IP/hyperion.php?effet=kr, et votre TV joue le radar rouge de K2000.
Alarme désactivée : http://IP/hyperion.php?effet=gmb
Le portail s'ouvre : http://IP/hyperion.php?effet=sb

Le script exécute via SSH l'applicaton hyperion-remote et envoie l'effet choisi en paramètre. 
Le Lightberry joue l'effet 5 secondes puis revient à l'état précédent le cas échéant.

Edit 1 : j'ai rajouté le paramètre de durée (en seconde) et l'effet Snake.
Pour avoir un serpent rouge qui fait le tour de la TV : http://IP/hyperion.php?effet=s&duree=10

Edit 2 : Possibilité d’arrêter le lightberry avant ou pendant un film : hyperion.php?effet=stop, 
cela positionne les led à black pour une durée illimitée. 
Pour revenir à la normale, hyperion.php, sans argument, ou n'importe quel effet temporisé.
