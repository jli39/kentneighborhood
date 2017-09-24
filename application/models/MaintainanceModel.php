<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MaintainanceModel extends CI_Model{

	const TBL = 'maintainance';

	public function __construct(){
		parent::__construct();
	}

	public function addmaintainance($data){
		return $this->db->insert(self::TBL , $data);
	}

	public function listmaintainance(){
		$query = $this->db->get(self::TBL);
		return $query->result_array();
	}

	public function listsortedmaintainance($limit, $offset, $sort_by, $sort_order){
		$query = $this->db->limit($limit, $offset)->order_by($sort_by, $sort_order)->get(self::TBL);
		return $query->result_array();
	}

	public function countmaintainance(){
		return $this->db->count_all(self::TBL);
	}

	public function check($username, $room_num){
		$condition['username'] = $username;
		$condition['room_num'] = $room_num;
		$query = $this->db->where($condition)->get(self::TBL);
		return $query->row_array();
	}

	public function checkmaintainance($username){
		$this->db->where('username' , $username);
		$query = $this->db->get(self::TBL);
		return $query->result_array();
	}

	public function update($data, $username){
		$this->db->where('username' , $username);
		$this->db->update(self::TBL, $data);
	}

	////////////////////////////////////////
	public function usermaintainance($username){
	    $this->db->where('username' , $username);
		$query = $this->db->get(self::TBL);
		return $query->result_array();
	}
}