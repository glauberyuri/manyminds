<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$authenticated = $this->session->userdata('authenticated') ?? null;
		$iduser = $this->session->userdata('auth_user')['idUser'] ?? null;
		if(!$authenticated || empty($iduser)) {
			redirect('login');
		}
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('UserModel');

	}

	public function index()
	{
		$this->load->view('template/default', array(
			'title' => 'Usuarios',
			'view' => 'users/index'
		));
	}

	public function getNewUser(){
		$dados['dataView']['title'] = 'Adicionar Usuario';
		$idUser= $this->uri->segment(3);
		$dados['dataView']['preview']=0;
		$partTitle='Editar';
		print_r($idUser);

		if(empty($idUser)){
			$idUser= $this->uri->segment(2);
			if(!empty($idUser) && $idUser!='create'){
				$dados['dataView']['preview']=1;
				$partTitle='Detalhes do';
			}
		}
		if(!empty($idUser) && $idUser!='create'){
			$dados['dataView']['user']= $this->UserModel->getUser($idUser);
			if(empty($dados['dataView']['user'])){
				return redirect(base_url('users'));
			}
			$dados['dataView']['title'] = "{$partTitle} usuario: ".$dados['dataView']['user']->name;
		}
		$dados['view']='users/create';

		$this->load->view('template/default', array(
			'view' => 'users/create',
			'data' => $dados
		));
	}

	public function createUser()
	{
		$this->form_validation->set_rules('name', 'nome completo', 'required');
		$this->form_validation->set_rules('cpf', 'CPF', 'required|max_length[11]');
		$this->form_validation->set_rules('phone', 'celular', 'required|max_length[11]');
		$this->form_validation->set_rules('password', 'senha', 'required');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');

		if($this->form_validation->run())
			{
				$user = array(
					'name' => $this->security->xss_clean($this->input->post('name')),
					'cpf' =>$this->security->xss_clean($this->input->post('cpf')),
					'phone' => $this->security->xss_clean($this->input->post('phone')),
					'password' => md5($this->input->post('password')),
					'email' => $this->security->xss_clean($this->input->post('email'))
				);

				$this->UserModel->createUser($user);

				$result = array(
					'success' => '<div class="alert alert-success">Obrigado por cadastrar</div>',
					'redirect' => base_url('users')
				);


			}
		else
			{
				$result = array(
					'error' => true,
					'name_error' => form_error('name'),
					'cpf_error' => form_error('cpf'),
					'phone_error' => form_error('phone'),
					'email_error' => form_error('email'),
					'password_error' => form_error('password')
				);
			}


		$this->output->set_content_type('application/json');
		return $this->output->set_output(json_encode($result));
	}

	public function getUsers ()
	{
		$users = new UserModel;
		$result = array(
			'data' => $users->getUsers(),
			'draw' => $params['draw'] ?? 0,
            'recordsTotal' => 0,
            'recordsFiltered' => 0
		);
		$this->output->set_content_type('application/json');

		return $this->output->set_output(json_encode($result));
	}

	public function toggleStatus()
	{
		$return = array(
			'success' => false
		);
		$id = $this->input->post('id');

		if($this->UserModel->toggleStatus($id))
		{
			$return['success'] = true;
		}
		$this->output->set_content_type('application/json');

		return $this->output->set_output(json_encode($return));
	}



}
