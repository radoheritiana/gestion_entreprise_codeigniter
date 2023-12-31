<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Gestion d'entreprise | <?= $title ?></title>
	<link rel="stylesheet" href="<?= css_url("main") ?>">
</head>
<body>

<nav>
	<h3><a href="<?= base_url() ?>">Nom entreprise</a></h3>
	<ul>
		<?php if ($this->session->userdata('admin') == null) { ?>
			<li><a href="<?= base_url() . 'admin/connexion'; ?>" >CONNEXION</a></li>
		<?php } else { ?>
			<li><a href="<?= base_url() . 'admin'; ?>" >EMPLOYE ACTIF</a></li>
			<li><a href="<?= base_url() . 'admin/employe_inactif'; ?>" >EMPLOYE INACTIF</a></li>
			<li><a href="<?= base_url() . 'admin/ajouter_employe'; ?>" >AJOUTER EMPLOYE</a></li>
			<li><a href="<?= base_url() . 'admin/deconnexion'; ?>" >DECONNEXION</a></li>
		<?php } ?>
	</ul>
</nav>
