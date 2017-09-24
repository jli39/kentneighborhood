<?php defined('BASEPATH') OR exit('No direct script access allowed');

class PackageController extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('captcha');
		$this->load->library('form_validation');
		$this->load->model('PackageModel');
		$this->load->library('pagination');
	}

	public function validation(){
		$this->form_validation->set_rules('username','','required|trim');
		$this->form_validation->set_rules('carrier','','required|trim');
		$this->form_validation->set_rules('tracking_num','','required|trim');
		$this->form_validation->set_rules('room','','required|trim');

		if ($this->form_validation->run()){
			$data['username'] = $_POST['username'];
			$data['carrier'] = $_POST['carrier'];
			$data['tracking_num'] = $_POST['tracking_num'];
			$data['room'] = $_POST['room'];
			$data['arrive_time'] = date('Y-m-d H:i:s');			

			if ($this->PackageModel->addPackage($data)){
				$data['displayerror'] = 'visibility:hidden';
				$data['displaysuccess'] = '';
				$data['message'] = 'success!';
			$this->load->view('manager/package.html', $data);
			}else{
				echo "sorry! something went wrong";
			}
		}
		else{
			$data['displayerror'] = '';
			$data['displaysuccess'] = 'visibility:hidden';
			$data['message'] = validation_errors();
			$this->load->view('manager/package.html', $data);
		}
	}

	public function pickuppackage($sort_by = 'package_id', $sort_order = 'desc', $offset = ''){
		$config['base_url'] = site_url("manager/PackageController/pickuppackage/$sort_by/$sort_order");
		$config['total_rows'] = $this->PackageModel->countPackage();
		$config['per_page'] = 10;
		$config['uri_segment'] = 6;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$limit = $config['per_page'];
		$data['info'] = $this->PackageModel->listpackage($limit, $offset, $sort_by, $sort_order);

		$data['display'] = 'visibility:hidden';
		$data['message'] = '';
		$data['username'] = '';
		$data['room'] = '';
		$this->load->view('manager/checkpackage.html', $data);
	}

	public function listpackage($sort_by = 'package_id', $sort_order = 'desc', $offset = ''){
		$config['base_url'] = site_url("manager/PackageController/listpackage/$sort_by/$sort_order");
		$config['total_rows'] = $this->PackageModel->countPackage();
		$config['per_page'] = 10;
		$config['uri_segment'] = 6;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$limit = $config['per_page'];
		$data['info'] = $this->PackageModel->listpackage($limit, $offset, $sort_by, $sort_order);
		$data['date'] = date('Y-m-d');
		$data['display'] = 'visibility:hidden';
		$data['message'] = '';
		$this->load->view('manager/package.html', $data);
		//echo $data['date'];
	}

	public function checkpackage($sort_by = 'arrive_time', $sort_order = 'desc', $offset = ''){
		//set rude
		$this->form_validation->set_rules('username','','required');
		$this->form_validation->set_rules('room','','required');

		if ($this->form_validation->run() == false){
			$config['base_url'] = site_url("manager/PackageController/pickuppackage/$sort_by/$sort_order");
			$config['total_rows'] = $this->PackageModel->countPackage();
			$config['per_page'] = 10;
			$config['uri_segment'] = 6;
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();

			$limit = $config['per_page'];
			$data['info'] = $this->PackageModel->listpackage($limit, $offset, $sort_by, $sort_order);

			$data['display'] = '';
			$data['message'] = validation_errors();
			$data['username'] = $this->input->post('username');
			$data['room'] = $this->input->post('room');
			$this->load->view('manager/checkpackage.html', $data);
		}
		else{
			$username = $this->input->post('username');
			$room = $this->input->post('room');
			if ($this->PackageModel->check($username, $room)){
				$packagedata = $this->PackageModel->checkpickup($_POST['username']);
				//$update['pickup_time'] = date('Y-m-d H:i:s');
				//$this->PackageModel->updatePackage($update, $username);
				
				$config['base_url'] = site_url("manager/PackageController/pickuppackage/$sort_by/$sort_order");
				$config['total_rows'] = $this->PackageModel->countPackage();
				$config['per_page'] = 10;
				$config['uri_segment'] = 6;
				$this->pagination->initialize($config);
				$data['pagination'] = $this->pagination->create_links();

				$limit = $config['per_page'];
				$data['info'] = $packagedata;

				$data['display'] = 'visibility:hidden';
				$data['message'] = '';
				$data['username'] = $this->input->post('username');
				$data['room'] = $this->input->post('room');
				$this->load->view('manager/checkpackage.html', $data);
			}
			else{
				$config['base_url'] = site_url("manager/PackageController/pickuppackage/$sort_by/$sort_order");
				$config['total_rows'] = $this->PackageModel->countPackage();
				$config['per_page'] = 10;
				$config['uri_segment'] = 6;
				$this->pagination->initialize($config);
				$data['pagination'] = $this->pagination->create_links();

				$limit = $config['per_page'];
				$data['info'] = $this->PackageModel->listpackage($limit, $offset, $sort_by, $sort_order);

				$data['display'] = '';
				$data['message'] = 'information did not match our system!';
				$data['username'] = $this->input->post('username');
				$data['room'] = $this->input->post('room');
				$this->load->view('manager/checkpackage.html', $data);
			}
		}
	}

	public function update($username, $room, $tracking_num, $sort_by = 'arrive_time', $sort_order = 'desc', $offset = ''){
		$update['pickup_time'] = date('Y-m-d H:i:s');
		$this->PackageModel->updatePackage($update, $tracking_num);
		
		$packagedata = $this->PackageModel->checkpickup($username);		
		$config['base_url'] = site_url("manager/PackageController/pickuppackage/$sort_by/$sort_order");
		$config['total_rows'] = $this->PackageModel->countPackage();
		$config['per_page'] = 10;
		$config['uri_segment'] = 6;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$limit = $config['per_page'];
		$data['info'] = $packagedata;

		$data['display'] = 'visibility:hidden';
		$data['message'] = '';
		$data['username'] = $username;
		$data['room'] = $room;
		$this->load->view('manager/checkpackage.html', $data);
	}

	public function registerpackage(){
		$data['displayerror'] = 'visibility:hidden';
		$data['displaysuccess'] = 'visibility:hidden';
		$data['message'] = '';
		$this->load->view('manager/package.html', $data);
	}
}