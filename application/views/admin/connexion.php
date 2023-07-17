<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<main>
	<div class="center">
		<h2 class="text-center">Page de connexion administrateur</h2>
		<?= form_open(""); ?>
		<?= validation_errors(); ?>
		<?php if ($this->session->flashdata('error')) { ?>
			<div class="alert alert-danger">
			<?= $this->session->flashdata('error'); ?>
			</div>
		<?php } ?>
		<input type="email" name="email" placeholder="Entrez votre email" value="<?= set_value('email');?>"><br>
		<input type="password" name="mot_de_passe" placeholder="Votre mot de passe"value="<?= set_value('mot_de_passe');?>"><br>
		<button type="submit" name="connexion" >Se connecter</button>
		<?= form_close(); ?>
	</div>
</main>
