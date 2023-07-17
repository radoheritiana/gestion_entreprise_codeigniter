<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Gestion d'entreprise | page de connexion administrateur</title>
	<link rel="stylesheet" href="<?= css_url("login") ?>">
</head>
<body>

<div id="container">
	<h1 style="text-align: center">Page de connexion administrateur</h1>
	<center>
		<?= form_open("login"); ?>
		<input type="email" name="email" placeholder="Entrez votre email"><br>
		<input type="password" name="mot_de_passe" placeholder="Votre mot de passe"><br>
		<input type="submit" name="connexion" value="Se connecter">
		<?= form_close(); ?>
	</center>
</div>

</body>
</html>
