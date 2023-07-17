<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<main>
	<div class="center">
		<h3 style="text-align: center">Page d'Accueil du site</h3>

		<?php if ($this->session->flashdata('error')) : ?>
			<div class="alert alert-danger">
				<?= $this->session->flashdata('error'); ?>
			</div>
		<?php endif; ?>

		<?= form_open(''); ?>
		<label for="matricule">Matricule (readonly)</label><br>
		<input type="text" name="matricule" id="matricule" value="<?= $matricule; ?>" readonly><br>
		<label for="nom">Nom*</label><br>
		<input type="text" name="nom" id="nom" value="<?= set_value('nom'); ?>"><br>
		<?= form_error("nom"); ?>
		<label for="prenoms">Prénoms*</label><br>
		<input type="text" name="prenoms" id="prenoms" value="<?= set_value('prenoms'); ?>"><br>
		<?= form_error("prenoms"); ?>
		<label for="poste">Poste*</label><br>
		<input type="text" name="poste" id="poste" value="<?= set_value('poste'); ?>"><br>
		<?= form_error("poste"); ?>
		<label for="email">Email*</label><br>
		<input type="email" name="email" id="email" value="<?= set_value('email'); ?>"><br>
		<?= form_error("email"); ?>
		<label for="code_d_acces">Code d'access (Veuillez sauvegarder votre code d'accés quelquepart)  (readonly)</label><br>
		<div class="d-flex">
			<input type="text" name="code_d_acces" id="code_d_acces" value="<?= $code_d_acces ?>" readonly>
			<button type="button" id="regenerate_code">Regénérer</button><br>
		</div>
		<button type="submit" name="s'inscrire">
			S'inscrire
		</button>
		<?= form_close() ?>
	</div>
</main>

<script type="text/javascript">
	let base_url = "http://" + window.location.host + "/gestion_entreprise_codeigniter/";
	console.log(base_url);


	let btn_regenerate_code = document.getElementById("regenerate_code");
	let code_d_acces = document.getElementById("code_d_acces");
	btn_regenerate_code.onclick = (e) => {
		e.preventDefault();
		fetch_code().then((res) => res.json())
			.then((result) => {
				code_d_acces.value = result.code;
			});
	}

	async function fetch_code(){
		return await fetch(base_url + "employe/generate_code_d_acces");
	}

</script>
