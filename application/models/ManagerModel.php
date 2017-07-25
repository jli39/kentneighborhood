<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ManagerModel extends CI_Model{

	const TBL_manager = 'manager';

	public function __construct(){
		parent::__construct();
	}

	public function getManager($username){
		$this->db->where('username' , $username);
		$query = $this->db->get(self::TBL_manager);
		return $query->result_array();
	}

	public function update($data, $username){
		$this->db->where('username' , $username);
		$this->db->update(self::TBL_manager, $data);
	}

	public function login($username, $password){
		$condition['username'] = $username;
		$condition['password'] = $password;
		$query = $this->db->where($condition)->get(self::TBL_manager);
		return $query->row_array();
	}
}