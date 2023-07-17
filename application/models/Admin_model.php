<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Admin_model extends CI_Model
{
	protected $table = "administrateur";
	private $email;
	private $mot_de_passe;

	public function findByEmail($email){
		$this->db->where('email', $email);
		$result = $this->db->get($this->table);
		if ($result->row_array()){
			return $this->hydrate($result->row_array());
		}
		return null;
	}

	public function hydrate($donnees)
	{
		foreach ($donnees as $key => $value)
		{
			$setter = 'set'.ucfirst($key);

			if (method_exists($this, $setter))
			{
				$this->$setter($value);
			}
		}
		return $this;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function getMot_de_passe()
	{
		return $this->mot_de_passe;
	}

	public function setMot_de_passe($mot_de_passe)
	{
		$this->mot_de_passe = $mot_de_passe;
	}

}
