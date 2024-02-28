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
		$this->load->model('UserModel');

	}

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('template/default', array(
			'title' => 'Usuarios',
			'view' => 'users/index'
		));
	}

	public function create()
	{
		
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
