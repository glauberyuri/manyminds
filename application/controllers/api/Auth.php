<?php

class Auth extends RestApi_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('api_auth');
		$this->load->model('ApiModel');
	}

	function register()
	{
		$username = $this->input->post('name');
		$cpf = $this->input->post('cpf');
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('cpf','CPF','required');
		$this->form_validation->set_rules('phone','phone','required');
		$this->form_validation->set_rules('email','Email','required');
		$this->form_validation->set_rules('password','senha','required');
		if($this->form_validation->run())
		{
			$data  = array(
				'name'=>$username,
				'cpf'=>$cpf,
				'phone'=>$phone,
				'email'=>$email,
				'password'=>MD5($password),
			);
			$this->ApiModel->registerUser($data);
			$responseData = array(
				'status'=>true,
				'message' => 'Cadastro Registrado com sucesso',
				'data'=> []
			);
			return $this->response($responseData,200);
		}
		else
		{
			$responseData = array(
				'status'=>false,
				'message' => 'Todos os dados precisam ser preenchidos',
				'data'=> []
			);
			return $this->response($responseData);
		}
	}

	function login()
	{

		$email = $this->input->post('email');
		$password = $this->input->post('password');


		$this->form_validation->set_rules('email','Email','required');
		$this->form_validation->set_rules('password','Password','required');
		if($this->form_validation->run())
		{
			$data = array('email'=>$email,'password'=> md5($password));
			$loginStatus = $this->ApiModel->checkLogin($data);
			if($loginStatus != false)
			{
				$idUser = $loginStatus->idUser;
				$bearerToken = $this->api_auth->generateToken($idUser);
				$responseData = array(
					'status'=> true,
					'message' => 'Você esta logado',
					'token'=> $bearerToken,
				);
				return $this->response($responseData,200);
			}
			else
			{
				$responseData = array(
					'status'=>false,
					'message' => 'invalido',
					'data'=> []
				);
				return $this->response($responseData);
			}
		}
		else
		{
			$responseData = array(
				'status'=>false,
				'message' => 'email e senha precisam ser preenchido',
				'data'=> []
			);
			return $this->response($responseData);
		}
	}

}
