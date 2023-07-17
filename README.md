# gestion_entreprise_codeigniter

## Prérequis
* 5.3.7 <= PHP <= 7
* MySQL

## Installation
* créer une base de données dans le SGBD MySQL : nom "gestion_entreprise_db"
* Importer dans cette nouvelle base de données le fichier gestion_entreprise_db.sql dans le SGBD MySQL
* Copier le dossier gestion_entreprise_codeigniter dans le dossier htdocs (pour XAMPP) ou www pour wampserver
* modifier dans application/config/config.php la base_url selon le port de votre serveur apache
```php
# la base url doit se terminer par un /
$config['base_url'] = 'http://localhost:8080/gestion_entreprise_codeigniter/';
```
* vous pouvez aussi utiliser des virtuals hosts mais il faut bien modifier aussi la base_url
* Modifer les configuration dans application/config/database.php
```php
$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost', # a changer selon votre connexion
	'username' => 'root', # a changer selon votre connexion
	'password' => '', # a changer selon votre connexion
	'database' => 'gestion_entreprise_db', # a changer si le nom de la base de données cha ge
	'dbdriver' => 'mysqli',
	....
];
```

## les liens principales (en fonction du base_url)
* pour les employés
  * connexion : base_url + "employe/connexion";
  * inscription : base_url + "employe/inscription";
  * page d'accueil : base_url;
  * deconnexion : base_url + "employe/deconnexion";
* pour l'administration
  * connexion : base_url + "admin/connexion";
  * liste employé actif : base_url + "admin/";
  * liste employé inactif : base_url + "admin/employe_inactif";
  * Ajouter employé : base_url + "admin/ajouter_employe";
  * modifier employé : base_url + "admin/modifier/<matricule>"
  * supprimer employé : base_url + "admin/supprimer/<matricule>"
  * activer employé : base_url + "admin/activer/<matricule>"

## Pour l'authentification de l'administrteur
* email : admin@gmail.com
* mot de passe : admin
