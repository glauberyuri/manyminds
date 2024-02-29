<?php

class UserModel extends CI_Model {
	public function __construct()
	{
		$this->load->helper('url');
	}

	public function getUserlogin($email)
	{
		$this->db->select('*');
		$this->db->where('email', $email);
//		$this->db->where('password', $data['password']);
		$this->db->from('users');
		$this->db->limit(1);
		$query = $this->db->get();

		if($query->num_rows() == 1)
		{
			return $query->result_array()[0] ?? [];
		}else {
			return [];
		}
	}
	public function createUser($user)
	{
		$idUser = $user['idUser'];
		$address = $user['address'];
		unset($user['address'], $user['idUser']);

		$this->db->trans_begin();

		if(!empty($idUser))
		{

			$this->db->set($user)->where('idUser', $idUser)->update('users');
			$this->db->where('idUser', $idUser)->delete('address');
		}else
		{
			$this->db->insert('users',$user);
			$idUser = $this->db->insert_id();

		}

		if(!empty($address))
		{
			$address = array_map(function (&$data) use($idUser){
				$data['idUser'] = $idUser;
				return $data;
			}, $address);

			$this->db->insert_batch('address',$address);
		}

		if( $this->db->trans_status() === TRUE){
			$this->db->trans_commit();
			return TRUE;
		}else{
			$this->db->trans_rollback();
			return FALSE;
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
			$row['action'] = empty($row['status']) ? '<button class="btn btn-success btn-sm btn-status" data-id="'.$row['idUser'].'">Ativar</button>' : '<button class="btn btn-danger btn-sm btn-status" data-id="'.$row['idUser'].'">Desativar</button>';
			if(!empty($row['status']))
			{
				$row['action'] .=  '&nbsp;<a href="'.base_url('users/edit/'.$row['idUser']).'" class="btn btn-primary btn-sm">Editar</a>';
				$row['action'] .=  '&nbsp;<a href="'.base_url('users/'.$row['idUser']).'" class="btn btn-secondary btn-sm">Detalhes</a>';
			}
			$row['action'] .= '<script>bindEvents();</script>';
		}

		return $data;
	}

	function getUser($idUser, $email=null)
	{
		$this->db->select('*');
		$this->db->from('users as u');
		if(!empty($idUser)) $this->db->where(['u.idUser'=>$idUser]);
		if(!empty($email)) $this->db->where(['u.email'=>$email]);
		$query = $this->db->get();

		$query = $query->result_array()[0] ?? [];

		if(!empty($query))
		{
			$query['address'] = $this->db->from('address as a')->where(['idUser'=>$idUser])->get()->result_array() ?? [];
		}
		return $query;
	}

	public function toggleStatus($id)
	{
		return $this->db->query("
			UPDATE users SET status = (
				 IF(status = 1, 0,1)
			) WHERE idUser = {$id}
		");
	}

	public function blockIp($idUser=null){
		if(empty($idUser)) return false;
		$ip= getClientIP();
		$data= date('Y-m-d H:i:s');
		$this->db->query("INSERT INTO ipsblock (ip,idUser,dateBlock) VALUES('{$ip}',$idUser,'{$data}') ON DUPLICATE KEY UPDATE count= (count + 1), dateBlock= ('{$data}')");
	}

	public function unBlock($idUser=null)
	{
		return $this->db->query("
			DELETE FROM ipsblock WHERE idUser = '{$idUser}'
		");
	}

	function getBlock($idUser)
	{
		$this->db->from('ipsblock AS ib');
		$this->db->where(['ib.idUser' => $idUser]);
		return $this->db->get()->result_array()[0] ?? [];
	}
}
