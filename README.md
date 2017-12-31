# Présentation
Gestion de stock TRES simple, EN COURS DE DEVELOPPEMENT (26/12/2017)

# Technologies
PHP/MySQL

# Site de démonstration
http://www.blueplace.fr/GSS/
* Connexion "utilisateur" : sdurant / sdurant
* Connexion "administrateur" : admin / admin

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

# Utilisateurs et stocks existants dans la base par défaut
A titre d'exemple, 2 utilisateurs et 2 stocks sont créés lorsque la base de données est créée:
* Utilisateurs
  * admin/admin (l'administrateur)
  * sdurant/sdurant (un utilisateur)
* Stocks
  * Stock MVA
  * Stock Epicerie

# Administrateur
L'utilisateur administrateur par défaut est admin/admin.
D'autres administrateurs peuvent être définis en modifiant la table "utilisateur" (c'est le seul paramètre nécessitant une MAJ directement en base de données)
