<?php

class ApiModel extends CI_Model
{
	function registerUser($data)
	{
		$this->db->insert('users',$data);
	}

	function getUser($idUser)
	{
		$this->db->select('*');
		$this->db->where(['idUser' => $idUser]);
		$this->db->from('users as u');
		$this->db->join('address as a', 'a.idUser = u.idUser', 'left');
		$query = $this->db->get('users');
		return $query->row();
	}

	function checkLogin($data)
	{
		$this->db->where($data);
		$query = $this->db->get('users');
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	}
}
