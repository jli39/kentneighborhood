<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CardModel extends CI_Model{

	const TBL = 'card';

	public function __construct(){
		parent::__construct();
	}

	public function addCard($data){
		return $this->db->insert(self::TBL , $data);
	}

	public function usercard($username){
		$this->db->where('username' , $username);
		$query = $this->db->get(self::TBL);
		return $query->result_array();
	}

	public function deletecard($card_num){
		$this->db->where('card_num' , $card_num);
		$this->db->delete(self::TBL);
		return true;
	}

	
}