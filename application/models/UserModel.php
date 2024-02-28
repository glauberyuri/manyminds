<?php

class UserModel extends CI_Model {
	public function __construct()
	{
		$this->load->helper('url');
	}

	public function loginUser($data)
	{
		$this->db->select('*');
		$this->db->where('email', $data['email']);
		$this->db->where('password', $data['password']);
		$this->db->from('users');
		$this->db->limit(1);
		$query = $this->db->get();

		if($query->num_rows() == 1)
		{
			return $query->row();
		}else {
			return false;
		}
	}

	public function getUsers()
	{
		$this->db->select('
			u.*, a.*, u.idUser as idUser
		');
		$this->db->from('users as u');
		$this->db->join('address as a', 'a.idUser = u.idUser', 'left');
		$query = $this->db->get();

		$data = $query->result_array();
		foreach ($data as &$row) {
			$row['action'] = empty($row['status']) ? '<button class="btn btn-primary btn-sm btn-status" data-id="'.$row['idUser'].'">Ativar</button>' : '<button class="btn btn-danger btn-sm btn-status" data-id="'.$row['idUser'].'">Desativar</button>';
			$row['action'] .=  '&nbsp;<a href="'.base_url('users/edit/'.$row['idUser']).'" class="btn btn-info btn-sm">Editar</a>';
			$row['action'] .= '<script>bindEvents();</script>';
		}

		return $data;
	}

	public function toggleStatus($id)
	{
		return $this->db->query("
			UPDATE users SET status = (
				 IF(status = 1, 0,1)
			) WHERE idUser = {$id}
		");
	}
}
