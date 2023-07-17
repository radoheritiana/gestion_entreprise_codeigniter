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
	<h3><a href="<?= base_url() ?>">NOM ENTREPRISE</a></h3>
	<ul>
		<?php if ($this->session->userdata('user') == null) { ?>
			<li><a href="<?= base_url() . 'employe/connexion'; ?>" >CONNEXION</a></li>
			<li><a href="<?= base_url() . 'employe/inscription'; ?>" >INSCRIPTION</a></li>
		<?php } else { ?>
			<li><a href="<?= base_url() . 'employe/deconnexion'; ?>" >DECONNEXION</a></li>
		<?php } ?>
	</ul>
</nav>
