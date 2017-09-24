<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PackageModel extends CI_Model{

	const TBL_PAC = 'package';
	

	public function __construct(){
		parent::__construct();
	}

	public function addPackage($data){
		return $this->db->insert(self::TBL_PAC , $data);
	}

	public function listPackage($limit, $offset, $sort_by, $sort_order){
		$query = $this->db->limit($limit, $offset)->order_by($sort_by, $sort_order)->get(self::TBL_PAC);
		return $query->result_array();
	}

	public function countPackage(){
		return $this->db->count_all(self::TBL_PAC);
	}

	public function check($username, $room){
		$condition['username'] = $username;
		$condition['room'] = $room;
		$query = $this->db->where($condition)->get(self::TBL_PAC);
		return $query->row_array();
	}

	public function updatePackage($data, $tracking_num){
		$this->db->where('tracking_num' , $tracking_num);
		$this->db->update(self::TBL_PAC, $data);
	}

	public function checkpickup($username){
		$this->db->where('username' , $username);
		$query = $this->db->get(self::TBL_PAC);
		return $query->result_array();
	}
/////////////////////////////////////////////////////////
	public function userpackage($username){
	    $this->db->where('username' , $username);
		$query = $this->db->get(self::TBL_PAC);
		return $query->result_array();
	}
}