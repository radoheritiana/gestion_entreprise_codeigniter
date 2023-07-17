<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<main id="container">
	<div class="center">
		<h1 class="text-center"> Modifier employé</h1>

		<div class="form">
			<?= form_open(""); ?>
			<?php if ($this->session->flashdata('error')): ?>
				<div class="alert alert-danger">
					<?= $this->session->flashdata('error'); ?>
				</div>
			<?php endif; ?>

			<input type="hidden" name="matricule" id="matricule" value="<?= $employe['matricule']; ?>" readonly><br>
			<label for="nom">Nom</label><br>
			<input type="text" name="nom" id="nom" value="<?= $employe['nom']; ?>"><br>
			<?= form_error("nom"); ?>
			<label for="prenoms">Prénoms</label><br>
			<input type="text" name="prenoms" id="prenoms" value="<?= $employe['prenoms']; ?>"><br>
			<?= form_error("prenoms"); ?>
			<label for="poste">Poste</label><br>
			<input type="text" name="poste" id="poste" value="<?= $employe['poste']; ?>"><br>
			<?= form_error("poste"); ?>
			<label for="email">Email</label><br>
			<input type="email" name="email" id="email" value="<?= $employe['email']; ?>"><br>
			<?= form_error("email"); ?>
			<label for="code_d_acces">Code d'access (Veuillez sauvegarder votre code d'accés quelquepart)</label><br>
			<div class="d-flex">
				<input type="text" name="code_d_acces" id="code_d_acces" value="<?= $employe['code_d_acces']; ?>" readonly>
				<button type="button" id="regenerate_code">Générer nouveau code</button>
			</div>
			<input type="checkbox" name="actif" id="actif" <?= $employe['active'] == 1 ? 'checked': null; ?>>
			<label for="actif">Actif?</label>	<br>
			<button type="submit" name="s'inscrire">
				Modifier
			</button>

			<?= form_close(); ?>
		</div>
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
