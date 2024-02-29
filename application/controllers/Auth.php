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

	public function login()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Senha', 'required');

		if($this->form_validation->run() === FALSE)
		{
			$response = array('error' => 'Email ou senha estão incorretos');
			retornoJson($response);
		}

		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = new UserModel;
		$userData = $user->getUserlogin($email);
		if(empty($userData))
		{
			$response = array('error' => 'Email ou senha estão incorretos');
			retornoJson($response);
		}

		$block=  $user->getBlock($userData['idUser']);
		if(!empty($block) && $block['count']>2){
			$dataLimit = DateTime::createFromFormat('Y-m-d H:i:s', $block['dateBlock']);
			$dataLimit->add(DateInterval::createFromDateString("3 minutes"))->format('Y-m-d H:i:s');
			if($dataLimit > new DateTime('NOW')){
				$response = array('error' => 'Usuario bloqueado!');
				retornoJson($response);
			}else{
				$user->unBlock($userData['idUser']);
			}
		}

		if((string)$userData['password'] !== md5($password))
		{
			$response = array('error' => 'Email ou senha estão incorretos');
			$user->blockIp($userData['idUser']);
			retornoJson($response);
		}
		if(empty($userData['status']))
		{
			$response = array('error' => 'Usuario inativo!');
			retornoJson($response);
		}

		$user->unBlock($userData['idUser']);
		$userdetails = array(
			'name' => $userData['name'],
			'cpf' => $userData['cpf'],
			'phone' => $userData['phone'],
			'idUser' => $userData['idUser'],
		);

		$this->session->set_userdata('authenticated', 1);
		$this->session->set_userdata('auth_user', $userdetails);
		$response = array('success' => 'Logando com sucesso', 'redirect' => base_url('users'));
		retornoJson($response);
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
