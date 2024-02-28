<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');

		$this->load->library('form_validation');
		$this->load->model('UserModel');

	}
	private function authVerify()
	{
		$authenticated = $this->session->userdata('authenticated') ?? null;
		$iduser = $this->session->userdata('auth_user')['idUser'] ?? null;
		if($authenticated && !empty($iduser)) {
			redirect('users');
		}
	}
	public function index()
	{
		$this->authVerify();
		$this->load->view('auth/layout', array(
			'title' => 'Login',
			'view' => 'auth/login'
		));
	}

	public function login() {
		$this->load->library('session');

		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Senha', 'required');

		if($this->form_validation->run() === FALSE) {
			$response = array('error' => 'Email ou senha estão incorretos');
		} else {
			$data = array(
				'email' => $email,
				'password' => $password
			);

			$user = new UserModel;
			$result = $user->loginUser($data);
			if($result != FALSE)
			{
				$userdetails = array(
					'name' => $result->name,
					'cpf' => $result->cpf,
					'phone' => $result->phone,
					'idUser' => $result->idUser
				);
				if ($result->status == 1) {
					$this->session->set_userdata('authenticated', 1);
					$this->session->set_userdata('auth_user', $userdetails);
					$response = array('success' => 'Logando com sucesso', 'redirect' => base_url('users'));
				} else {
					$response = array('error' => 'Usuario desativado!');
				}
			} else {
				$response = array('error' => 'Email ou senha estão incorretos');
			}
		}
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($response));
	}

	public function logout()
	{
		$this->session->unset_userdata(array(
			'authenticated',
			'auth_user'
		));

		redirect('login');
	}
	
}
