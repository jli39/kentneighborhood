<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MaintainanceController extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('captcha');
		$this->load->library('form_validation');
		$this->load->model('MaintainanceModel');
		$this->load->library('pagination');
	}

	public function listmaintainance($sort_by = 'case_id', $sort_order = 'desc', $offset = ''){
		$config['base_url'] = site_url("manager/MaintainanceController/listmaintainance/$sort_by/$sort_order");
		$config['total_rows'] = $this->MaintainanceModel->countmaintainance();
		$config['per_page'] = 10;
		$config['uri_segment'] = 6;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$limit = $config['per_page'];
		$data['info'] = $this->MaintainanceModel->listsortedmaintainance($limit, $offset, $sort_by, $sort_order);
		$data['date'] = date('Y-m-d');
		$data['display'] = 'visibility:hidden';
		$data['message'] = '';
		$this->load->view('manager/maintainance.html', $data);
		//echo $data['date'];
	}

	public function checkmaintainance(){
		//set rude
		$this->form_validation->set_rules('username','','required');
		$this->form_validation->set_rules('room','','required');

		if ($this->form_validation->run() == false){
			$data['display'] = '';
			$data['message'] = validation_errors();
			$this->load->view('manager/checkmaintainance.html', $data);
		}
		else{
			$username = $this->input->post('username');
			$room = $this->input->post('room');
			if ($this->MaintainanceModel->check($username, $room)){
				$roomdata = $this->MaintainanceModel->checkmaintainance($_POST['username']);
				foreach($roomdata as $temp);
				if ($temp['finish_time'] == '0000-00-00 00:00:00'){
					$update['finish_time'] = date('Y-m-d H:i:s');
					$update['status'] = 'finish';
					$this->MaintainanceModel->update($update, $username);
					$infomation['url'] = site_url('manager/MaintainanceController/finishmaintainance');
					$infomation['wait'] = 5;
					$infomation['message'] = 'Maintainance is done!';
					$this->load->view('manager/message.html', $infomation);
				}
				else{
					$data['display'] = '';
					$data['message'] = 'Maintainance is already done!';
					$this->load->view('manager/checkmaintainance.html', $data);
				}
			}
			else{
				$data['display'] = '';
				$data['message'] = 'information did not match our system!';
				$this->load->view('manager/checkmaintainance.html', $data);
			}
		}

	}

	public function finishmaintainance(){
		$data['display'] = 'visibility:hidden';
		$data['message'] = '';
		$this->load->view('manager/checkmaintainance.html', $data);
	}

	public function update($username, $sort_by = 'request_time', $sort_order = 'desc', $offset = ''){
		$update['status'] = 'processing';
		$this->MaintainanceModel->update($update, $username);
		
		redirect('manager/MaintainanceController/listmaintainance');
	}
}