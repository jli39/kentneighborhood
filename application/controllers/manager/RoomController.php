<?php defined('BASEPATH') OR exit('No direct script access allowed');

class RoomController extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('captcha');
		$this->load->library('form_validation');
		$this->load->model('RoomModel');
		$this->load->library('pagination');
	}

	public function listappartment($sort_by, $sort_order, $offset = ''){
		$config['base_url'] = site_url("manager/RoomController/listappartment/$sort_by/$sort_order");
		$config['total_rows'] = $this->RoomModel->countappartment();
		$config['per_page'] = 20;
		$config['uri_segment'] = 6;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$limit = $config['per_page'];
		$data['info'] = $this->RoomModel->listappartment($limit, $offset, $sort_by, $sort_order);
		$data['date'] = date('Y-m-d');
		$this->load->view('manager/apartmentinfo.html', $data);
	}

	public function remainappartment($offset = ''){
		$sort_by = $_POST['sortby'];
		$sort_order = "asc";
		$config['base_url'] = site_url("manager/RoomController/remainappartment/$sort_by/$sort_order");
		$config['total_rows'] = $this->RoomModel->countappartment();
		$config['per_page'] = 20;
		$config['uri_segment'] = 6;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$limit = $config['per_page'];
		$data['info'] = $this->RoomModel->listappartment($limit, $offset, $sort_by, $sort_order);
		$data['date'] = $_POST['date'];
		$this->load->view('manager/apartmentinfo.html', $data);
		//echo $_POST['room_num'];
	}
}