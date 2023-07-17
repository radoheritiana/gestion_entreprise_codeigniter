<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<main id="container">
	<h1>Liste des employés actifs</h1>

	<?php if ($this->session->flashdata('success')): ?>
		<div class="alert alert-success">
			<?= $this->session->flashdata('success'); ?>
		</div>
	<?php endif; ?>
	<?php if ($this->session->flashdata('error')): ?>
		<div class="alert alert-danger">
			<?= $this->session->flashdata('error'); ?>
		</div>
	<?php endif; ?>

	<?php if ($employes): ?>
	<table>
		<tr>
			<th>Matricule</th>
			<th>Nom</th>
			<th>Prénoms</th>
			<th>Poste</th>
			<th>Email</th>
			<th>Date d'embauche</th>
			<th>Date de modification</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
		<?php foreach ($employes as $employe):?>
			<tr>
				<td><?= $employe['matricule'];?></td>
				<td><?= $employe['nom'];?></td>
				<td><?= $employe['prenoms'];?></td>
				<td><?= $employe['poste'];?></td>
				<td><?= $employe['email'];?></td>
				<td><?= $employe['date_d_embauche'];?></td>
				<td><?= $employe['date_mise_a_jour'];?></td>
				<td><?= $employe['active'] ? "Actif" : "Inactif" ?></td>
				<td><a href="<?= base_url() . 'admin/modifier/'. $employe['matricule']; ?>">Modifier</a>
					<a
						href="<?= base_url() . 'admin/activer/'. $employe['matricule']; ?>"
						onclick="return confirm('Voulez vous activer ce employé?')"
					>Activer</a></td>
			</tr>
		<?php endforeach; ?>
	</table>
		<?php
		else:
			?>
			<h3>Pas d'employé à afficher!</h3>
		<?php endif; ?>

</main>
