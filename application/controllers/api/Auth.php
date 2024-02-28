<?php

class Auth extends RestApi_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('api_auth');
	}
}
