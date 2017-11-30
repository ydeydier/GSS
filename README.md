***************************************************************
Présentation
***************************************************************
Gestion de stock TRES simple, EN COURS DE DEVELOPPEMENT (30/11/2017)

***************************************************************
Technologies
***************************************************************
PHP/MySQL

***************************************************************
Fonctionnalités
***************************************************************
Prévues :
	- stock réel et stock virtuel
	- 1 utilisateur peut gérer 1 ou plusieurs stocks
	- connexion par login/password local, ou relié à un LDAP
	
Non prévues :
	- gestion des fournisseurs
	- gestion des commandes, des achats
	
***************************************************************
Installation
***************************************************************
- Installer PHP / MySQL
- Créer un répetoire GSS dans www ou htdocs, selon le serveur web
- Copier dans ce répertoire toute l'arborescence de GSS
- Créer la base de donnée 'GSS' avec "GSS\sql\Creation_base_GSS.sql"
- Modifier configuration.ini si nécessaire
- Lancer avec http://host:port/GSS/
