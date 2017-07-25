<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model{

	const TBL_USER = 'user';
	

	public function __construct(){
		parent::__construct();
	}

	public function addUser($data){
		return $this->db->insert(self::TBL_USER , $data);
	}

	public function deleteUser($username){
		$this->db->where('username' , $username);
		$this->db->delete(self::TBL_USER);
		return true;
	}

	public function listUser($limit, $offset, $sort_by, $sort_order){
		$query = $this->db->limit($limit, $offset)->order_by($sort_by, $sort_order)->get(self::TBL_USER);
		return $query->result_array();
	}

	public function getUser($username){
		$this->db->where('username' , $username);
		$query = $this->db->get(self::TBL_USER);
		return $query->result_array();
	}

	public function updateUser($data, $username){
		$this->db->where('username' , $username);
		$this->db->update(self::TBL_USER, $data);
	}

	public function countUser(){
		return $this->db->count_all(self::TBL_USER);
	}
//////////////////////////////////////////////////////////////////////////////////
	public function get_user($username,$password){
		$condition['username'] = $username;
		$condition['password'] = $password;
		$query = $this->db->where($condition)->get(self::TBL_USER);
		return $query->row_array();
	}

	public function list_info(){
		$query = $this->db->get(self::TBL_USER);
		return $query->result_array();
	}

//////////////////////////////////////////////////////////////////////////////////
}