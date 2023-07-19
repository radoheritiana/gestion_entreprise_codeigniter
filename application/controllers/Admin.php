<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
		if ($this->session->userdata('admin') == null){
			$this->session->set_flashdata('error', 'Vous devez d\'abord vous connecter!');
			redirect(base_url() . "admin/connexion");
		}

		$employes = $this->Employe_model->findAllActif();
		$data['employes'] = $employes;

		$header['title'] = "Accueil Administrateur";

		$this->load->view('partials/admin-header', $header);
		$this->load->view('admin/index', $data);
		$this->load->view('partials/footer');
	}

	public function ajouter_employe(){
		if ($this->session->userdata('admin') == null){
			$this->session->set_flashdata('error', 'Vous devez d\'abord vous connecter!');
			redirect(base_url() . "admin/connexion");
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

						// on envoie un email de confirmation à l'utilisateur
						$this->load->library('email');
						$this->load->config('email');

						$this->email->from('mon.entreprise@email.com', 'Mon entreprise');
						$this->email->to($email);
						$this->email->subject('Inscription reussi!');
						$this->email->message('Felicitations! \n Votre compte a été crée avec success!');

						$this->email->send();
						//on se redirige vers la liste des employés actifs
						redirect(base_url() . 'admin');
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

		$header['title'] = "Ajouter employé";

		$this->load->view('partials/admin-header', $header);
		$this->load->view('admin/ajouter', $data);
		$this->load->view('partials/footer');
	}

	public function modifier($matricule){
		if ($this->session->userdata('admin') == null){
			$this->session->set_flashdata('error', 'Vous devez d\'abord vous connecter!');
			redirect(base_url() . "admin/connexion");
		}

		if (!$matricule){
			show_404();
		}

		$result = $this->Employe_model->findByMatricule($matricule);
		if (!$result){
			show_404();
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
			$status = $this->input->post('actif');
			$actif = 0;
			if (isset($status) && $status == 'on'){
				$actif = 1;
			}

			$is_updated = $this->Employe_model->update($matricule, $nom, $prenoms, $poste, $email, $code_d_acces, $actif);

			if($is_updated){
				$this->session->set_flashdata('success', 'Employé modifié avec success!');
				redirect(base_url() . 'admin');
			}else{
				$this->session->set_flashdata('error', 'Une erreur s\'est produite!');
			}
		}


		$data['employe'] = $result;

		$header['title'] = "Modifier employé $matricule";

		$this->load->view('partials/admin-header', $header);
		$this->load->view('admin/modifier', $data);
		$this->load->view('partials/footer');
	}

	public function employe_inactif()
	{
		if ($this->session->userdata('admin') == null){
			$this->session->set_flashdata('error', 'Vous devez d\'abord vous connecter!');
			redirect(base_url() . "admin/connexion");
		}

		$employes = $this->Employe_model->findAllNotActif();
		$data['employes'] = $employes;

		$header['title'] = "Employé inactifs";

		$this->load->view('partials/admin-header', $header);
		$this->load->view('admin/employe-inactif', $data);
		$this->load->view('partials/footer');
	}

	public function supprimer($matricule = null)
	{
		if ($this->session->userdata('admin') == null){
			$this->session->set_flashdata('error', 'Vous devez d\'abord vous connecter!');
			redirect(base_url() . "admin/connexion");
		}

		if (!$matricule){
			show_404();
		}

		$result = $this->Employe_model->findByMatricule($matricule);
		if (!$result){
			show_404();
		}

		$is_updated = $this->Employe_model->updateStatus($matricule, 0);
		if ($is_updated) {
			$this->session->set_flashdata('success', "L'employé a été modifié avec success!");
		}else{
			$this->session->set_flashdata('error', "Une erreur est survenue!");
		}
		redirect(base_url() . "admin");
	}

	public function activer($matricule = null)
	{
		if ($this->session->userdata('admin') == null){
			$this->session->set_flashdata('error', 'Vous devez d\'abord vous connecter!');
			redirect(base_url() . "admin/connexion");
		}

		if (!$matricule){
			show_404();
		}

		$result = $this->Employe_model->findByMatricule($matricule);
		if (!$result){
			show_404();
		}

		$is_updated = $this->Employe_model->updateStatus($matricule, 1);
		if ($is_updated) {
			$this->session->set_flashdata('success', "L'employé a été modifié avec success!");
		}else{
			$this->session->set_flashdata('error', "Une erreur est survenue!");
		}
		redirect(base_url() . "admin/employe_inactif");
	}

	public function connexion()
	{
		if ($this->session->userdata('admin') !== null){
			$this->session->set_flashdata('success', "Vous êtes déjà connectés!");
			redirect(base_url() . "admin");
		}

		$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
		$this->form_validation->set_rules(
			'email',
			'Email',
			'required|trim|valid_email'
		);
		$this->form_validation->set_rules(
			'mot_de_passe',
			'Mot de passe',
			'required|trim'
		);

		if($this->form_validation->run()){
			$email = $this->input->post('email');
			$mot_de_passe = $this->input->post('mot_de_passe');
			$admin = $this->Admin_model->findByEmail($email);
			// on verifie si l'email existe
			if ($admin){
				//on verifie si le mot de passe correspond
				if (password_verify($mot_de_passe, $admin->getMot_de_passe())){
					$this->session->set_userdata('admin', $admin);
					redirect(base_url() . "admin");
				} else {
					$this->session->set_flashdata('error', "Identifiant invalide!");
				}
			} else {
				$this->session->set_flashdata('error', "Identifiant invalide!");
			}
		}

		$header['title'] = "Connexion Administrateur";

		$this->load->view('partials/admin-header', $header);
		$this->load->view('admin/connexion');
		$this->load->view('partials/footer');
	}

	public function deconnexion()
	{
		$this->session->sess_destroy();
		redirect(base_url() . "admin/connexion");
	}

}
