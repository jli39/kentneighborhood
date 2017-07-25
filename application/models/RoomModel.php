<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RoomModel extends CI_Model{
	const TBL_ROOM = 'appartment';

	public function __construct(){
		parent::__construct();
	}

	public function checkRoom($room_num){
		$this->db->where('room_num' , $room_num);
		$query = $this->db->get(self::TBL_ROOM);
		return $query->result_array();
	}

	public function updateRoom($data, $room_num){
		$this->db->where('room_num' , $room_num);
		$this->db->update(self::TBL_ROOM, $data);
	}

	public function listappartment($limit, $offset, $sort_by, $sort_order){
		$query = $this->db->limit($limit, $offset)->order_by($sort_by, $sort_order)->get(self::TBL_ROOM);
		return $query->result_array();
	}

	public function countappartment(){
		return $this->db->count_all(self::TBL_ROOM);
	}
}
