<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

	<main>
		<center>
			<h1>Page d'Accueil du site</h1>
			<?php
				if ($this->session->flashdata('success')) {
					echo $this->session->flashdata('success');
				}
			?>
			<?php
			if ($this->session->flashdata('error')) {
				echo $this->session->flashdata('error');
			}
			?>
			<?= form_open(''); ?>
			<?= validation_errors(); ?>
			<input type="text" name="matricule" placeholder="Matricule"><br>
			<input type="password" name="code_d_acces" placeholder="Code d'accés"><br>
			<button type="submit" name="connexion">Se connecer</button>
			<?= form_close(); ?>
		</center>
	</main>
