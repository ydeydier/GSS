# Présentation
Gestion de stock TRES simple, EN COURS DE DEVELOPPEMENT (26/12/2017)

# Technologies
PHP/MySQL

# Fonctionnalités
* Prévues :
  * stock réel et stock virtuel
  * 1 utilisateur peut gérer 1 ou plusieurs stocks
  * 1 utilisateur admin pour gérer les utilisateurs et les stocks
  * connexion par login/password local, ou relié à un LDAP
	
* Non prévues :
  * gestion des fournisseurs
  * gestion des commandes, des achats
	
# Installation
Voir le fichier documentation/installation.txt

# Documentation LDAP
* LDAP : si un mot de passe est défini pour un utilisateur (table utilisateur), alors le LDAP n'est pas interrogé. Sinon, et si utiliserLDAP=oui dans configuration.ini, alors le LDAP est interrogé.
