<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$user = $this->session->userdata('user');

?>

<main>
	<div>
		<h2>Matricule de l'employé : <?= $user['matricule']; ?></h2>
		<h2>Status de l'employé : <?= $user['active'] == 1 ? "Actif" : "Inactif" ?></h2>
		<h2>Nom et prénoms de l'employé : <?= $user['nom'] . " " . $user['prenoms']; ?></h2>
		<h2>Poste de l'employé : <?= $user['poste']; ?></h2>
		<h2>Email d'accés de l'employé : <?= $user['email']; ?></h2>
		<h2>Code d'accés de l'utilisateur : <?= $user['code_d_acces']; ?></h2>
	</div>
</main>


