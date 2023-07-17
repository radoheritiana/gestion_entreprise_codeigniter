<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Gestion d'entreprise | page de connexion</title>
	<link rel="stylesheet" href="<?= css_url("main") ?>">
</head>
<body>

<nav>
	<h3><a href="<?= base_url() ?>">Nom entreprise</a></h3>
	<ul>
		<?php if ($this->session->userdata('user') == null) { ?>
			<li><a href="<?= base_url() . 'employe/connexion'; ?>" >Connexion</a></li>
			<li><a href="<?= base_url() . 'employe/inscription'; ?>" >Inscription</a></li>
		<?php } else { ?>
			<li><a href="<?= base_url() . 'employe/deconnexion'; ?>" >Deconnexion</a></li>
		<?php } ?>
	</ul>
</nav>
