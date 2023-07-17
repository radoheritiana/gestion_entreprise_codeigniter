<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employe_model extends CI_Model
{
	protected $table = "employe";

	public function create($matricule, $nom, $prenoms, $poste, $email, $code_d_acces)
	{
		$this->db->set('matricule', $matricule);
		$this->db->set('nom', $nom);
		$this->db->set('prenoms', $prenoms);
		$this->db->set('date_d_embauche', 'NOW()', false);
		$this->db->set('date_mise_a_jour', 'NOW()', false);
		$this->db->set('poste', $poste);
		$this->db->set('email', $email);
		$this->db->set('code_d_acces', $code_d_acces);
		// par défaut, on met le statut active à true
		$this->db->set('active', 1);

		return $this->db->insert($this->table);
	}

	public function findLatestMatricule(){
		$matricule = $this->db->select('max(matricule) as matricule')
			->from($this->table)
			->get();
		return $matricule->row_array();
	}

	public function findAll()
	{
		$result = $this->db->get($this->table);
		return $result->result_array();
	}

	public function findAllActif()
	{
		$this->db->where("active", 1);
		$result = $this->db->get($this->table);
		return $result->result_array();
	}

	public function findAllNotActif()
	{
		$this->db->where("active", 0);
		$result = $this->db->get($this->table);
		return $result->result_array();
	}

	public function findByMatricule($matricule){
		$this->db->where('matricule', $matricule);
		$result = $this->db->get($this->table);
		return $result->row_array();
	}

	public function findByEmail($email){
		$this->db->where('email', $email);
		$result = $this->db->get($this->table);
		return $result->row_array();
	}

	public function updateStatus($matricule, $active){
		if ($active != 1 && $active != 0){
			return false;
		}

		$this->db->set('active', $active);
		$this->db->set('date_mise_a_jour', 'NOW()', false);
		$this->db->where('matricule', (int) $matricule);
		return $this->db->update($this->table);
	}

	public function update($matricule, $nom, $prenoms, $poste, $email, $code_d_acces, $actif){
		if ($actif != 1 && $actif != 0){
			return false;
		}

		$this->db->set('nom', $nom);
		$this->db->set('prenoms', $prenoms);
		$this->db->set('poste', $poste);
		$this->db->set('email', $email);
		$this->db->set('code_d_acces', $code_d_acces);
		$this->db->set('active', $actif);
		$this->db->set('date_mise_a_jour', 'NOW()', false);
		$this->db->where('matricule', (int) $matricule);
		return $this->db->update($this->table);
	}
}
