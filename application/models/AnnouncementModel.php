<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AnnouncementModel extends CI_Model{

	const TBL = 'announcement';

	public function __construct(){
		parent::__construct();
	}

	public function listannouncement(){
		$query = $this->db->get(self::TBL);
		return $query->result_array();
	}

	public function getid($title){
		$this->db->where ('title',$title);
		$query = $this->db->get(self::TBL);
		return $query->result_array();
	}

	
}




