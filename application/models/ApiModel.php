<?php

class ApiModel extends CI_Model
{
	function registerUser($data)
	{
		$this->db->insert('users',$data);
	}

	function getProfile($idUser)
	{
		$this->db->select('name,email');
		$this->db->where(['idUser'=>$idUser]);
		$query = $this->db->get('users');
		return $query->row();
	}

	function getUser($idUser)
	{
		$this->db->select('
			u.*, a.*
		');
		$this->db->where(['u.idUser'=>$idUser]);
		$this->db->from('users as u');
		$this->db->join('address as a', 'a.idUser = u.idUser', 'left');
		$query = $this->db->get();

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
