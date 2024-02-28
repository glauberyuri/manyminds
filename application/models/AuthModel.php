<?php

class AuthModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		if($this->session->has_userdata('authenticated')){
			redirect(base_url('users/index'));
		}else
		{
			$this->session->set_flashdata('status', 'Você não esta logado!!');
			redirect(base_url('login'));
		}
	}
}
