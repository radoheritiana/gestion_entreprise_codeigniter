<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$user = $this->session->userdata('user');

?>

<main>
	<center>
		<h3>Matricule de l'employé : <?= $user['matricule']; ?></h3>
		<h3>Status de l'employé : <?= $user['active']; ?></h3>
		<h3>Nom et prénoms de l'employé : <?= $user['nom'] . " " . $user['prenoms']; ?></h3>
		<h3>Poste de l'employé : <?= $user['poste']; ?></h3>
		<h3>Email d'accés de l'employé : <?= $user['email']; ?></h3>
		<h3>Code d'accés de l'utilisateur : <?= $user['code_d_acces']; ?></h3>
	</center>
</main>


