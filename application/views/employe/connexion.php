<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

	<main>
		<div class="center">
			<h2 class="text-center">Page de connexion employé</h2>
			<?php if ($this->session->flashdata('success')) : ?>
					<div class="alert alert-success">
						<?= $this->session->flashdata('success'); ?>
					</div>
			<?php endif; ?>

			<?php if ($this->session->flashdata('error')) : ?>
				<div class="alert alert-danger">
					<?= $this->session->flashdata('error'); ?>
				</div>
			<?php endif; ?>

			<?= form_open(''); ?>
			<?= validation_errors(); ?>

			<input type="text" name="matricule" placeholder="Matricule" value="<?= set_value("matricule"); ?>"><br>
			<input type="password" name="code_d_acces" placeholder="Code d'accés" value="<?= set_value("code_d_acces"); ?>"><br>
			<button type="submit" name="connexion">Se connecer</button>
			<?= form_close(); ?>
		</div>
	</main>
