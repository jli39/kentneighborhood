<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CommentModel extends CI_Model{

	const TBL = 'comment';

	public function __construct(){
		parent::__construct();
	}

	public function addcomment($data){
		return $this->db->insert(self::TBL , $data);
	}

	

	
}