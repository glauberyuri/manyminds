<?php

class Controller extends RestApi_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('api_auth');
		if($this->api_auth->isNotAuthenticated())
		{
			$err = array(
				'status'=>false,
				'message'=>'Não Autorizado',
				'data'=>[]
			);
			$this->response($err);
		}
		$this->load->model('ApiModel');

	}

	function getProfile()
	{
		$userId = $this->api_auth->getUserId();
		$profileData = $this->ApiModel->getProfile($userId);
		$err = array(
			'status'=>true,
			'message'=>'Sucesso ao buscar dados',
			'data'=>$profileData
		);
		$this->response($err,200);
	}

	function getUser($idUser)
	{
		$userData = $this->ApiModel->getUser($idUser);
		$err = array(
			'status'=>true,
			'message'=>'Sucesso ao buscar dados',
			'data'=>$userData
		);
		$this->response($err,200);
	}


}
