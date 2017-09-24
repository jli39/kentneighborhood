<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class NewsModel extends CI_Model{

	const TBL_NEWS = 'announcement';
	

	public function __construct(){
		parent::__construct();
	}

	public function addNews($data){
		return $this->db->insert(self::TBL_NEWS , $data);
	}

	public function listNews($limit, $offset, $sort_by, $sort_order){
		$query = $this->db->limit($limit, $offset)->order_by($sort_by, $sort_order)->get(self::TBL_NEWS);
		return $query->result_array();
	}

	public function countnews(){
		return $this->db->count_all(self::TBL_NEWS);
	}

///////////////////////////////////////////////////////////////////////
	public function listannouncement(){
		$query = $this->db->get(self::TBL_NEWS);
		return $query->result_array();
	}

	public function getid($title){
		$this->db->where ('title',$title);
		$query = $this->db->get(self::TBL_NEWS);
		return $query->result_array();
	}
}