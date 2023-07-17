<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employe extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		// si l'utilisateur n'est pas connecté
		if($this->session->userdata('user') == null){
			$this->session->set_flashdata('error', 'Veuillez vous connecter!');
			redirect(base_url() . "employe/connexion");
		}

		$this->load->view("partials/header");
		$this->load->view('index');
		$this->load->view("partials/footer");
	}

	public function connexion()
	{
		// si l'utilisateur est déjà connecté
		if($this->session->userdata('user') !== null){
			$this->session->set_flashdata('success', 'Vous êtes déjà connecté!');
			redirect(base_url());
		}

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');

		$this->form_validation->set_rules(
			'matricule',
			'Matricule',
			'required|trim'
		);
		$this->form_validation->set_rules(
			'code_d_acces',
			'Code d\'accés',
			'required|trim'
		);

		if($this->form_validation->run()){
			$matricule = $this->input->post('matricule');
			$code_d_acces = $this->input->post('code_d_acces');
			// on verifie si le matricule existe
			$res = $this->Employe_model->findByMatricule($matricule);
			if(isset($res) && count($res) > 0){
				//on verifie si le code est incorrect et que l'utilisateur a un statut active
				if($code_d_acces == $res['code_d_acces'] && $res['active'] == 1){
					$this->session->set_userdata('user', $res);
					redirect(base_url() . "employe");
				} else {
					$this->session->set_flashdata('error', 'Identifiant invalide ou compte inactif!');
				}
			}else{
				$this->session->set_flashdata('error', 'Identifiant invalide!');
			}
		}

		$this->load->view("partials/header");
		$this->load->view('employe/connexion');
		$this->load->view("partials/footer");
	}

	public function inscription()
	{
		// si l'utilisateur est déjà connecté
		if($this->session->userdata('user') !== null){
			$this->session->set_flashdata('success', 'Vous êtes déjà connecté!');
			redirect(base_url());
		}

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');

		$this->form_validation->set_rules(
			'nom',
			'Nom',
			'required|trim|min_length[4]|max_length[255]'
		);
		$this->form_validation->set_rules(
			'prenoms',
			'Prénoms',
			'required|trim|min_length[4]|max_length[255]'
		);
		$this->form_validation->set_rules(
			'poste',
			'Poste',
			'required|trim|max_length[255]'
		);
		$this->form_validation->set_rules(
			'email',
			'Email',
			'required|valid_email|trim|max_length[255]'
		);

		if ($this->form_validation->run()) {
			$matricule = $this->input->post('matricule');
			$nom = $this->input->post('nom');
			$prenoms = $this->input->post('prenoms');
			$poste = $this->input->post('poste');
			$email = $this->input->post('email');
			$code_d_acces = $this->input->post('code_d_acces');

			//on verifie si le matricule existe déjà
			$res = $this->Employe_model->findByMatricule($matricule);

			if(isset($res ) && count($res) > 0) {
				$this->session->set_flashdata('error', 'Le Matricule existe déjà!');
			} else {
				// on verifie si l'email existe déjà
				$res = $this->Employe_model->findByEmail($email);
				if(isset($res) && count($res) > 0) {
					$this->session->set_flashdata('error', 'L\'email existe déjà!');
				} else {
					$is_saved = $this->Employe_model->create($matricule, $nom, $prenoms, $poste, $email, $code_d_acces);
					if($is_saved){
						$this->session->set_flashdata('success', 'Inscription reussi, veuillez vous connecter!');
						redirect(base_url() . 'employe/connexion');
					}else{
						$this->session->set_flashdata('error', 'Une erreur s\'est produite!');
					}
				}
			}
		}

		// on génére un code d'accés pour l'employé
		$random_code = generate_code(15);
		$matricule = $this->Employe_model->findLatestMatricule();
		$data['code_d_acces'] = $random_code;
		$data['matricule'] = format_matricule($matricule['matricule']);

		$this->load->view("partials/header");
		$this->load->view('employe/inscription', $data);
		$this->load->view("partials/footer");
	}

	public function deconnexion(){
		$this->session->sess_destroy();
		redirect(base_url() . "employe/connexion");
	}

	public function generate_code_d_acces(){
		$random_code = generate_code(15);
		echo json_encode(array("code" =>  $random_code));
	}
}
