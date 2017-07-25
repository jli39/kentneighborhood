<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PaymentModel extends CI_Model{

	const TBL = 'payment';

	public function __construct(){
		parent::__construct();
	}

	public function addPayment($data){
		return $this->db->insert(self::TBL , $data);
	}

	public function listPayment(){
		$query = $this->db->get(self::TBL);
		return $query->result_array();
	}

	public function listsortPayment($limit, $offset, $sort_by, $sort_order){
		$query = $this->db->limit($limit, $offset)->order_by($sort_by, $sort_order)->get(self::TBL);
		return $query->result_array();
	}

	public function countPayment(){
		return $this->db->count_all(self::TBL);
	}


	/////////////////////////////////////////////////
	public function userPayment($username){
		$this->db->where('username' , $username);
		$query = $this->db->get(self::TBL);
		return $query->result_array();
	}
}