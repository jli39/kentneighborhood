<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MaintainanceController extends CI_Controller{

	public function __construct(){
		parent::__construct();
		
		$this->load->library('form_validation');
		$this->load->model('MaintainanceModel');
	}

	public function addmaintainance(){
		$data['display'] = 'visibility:hidden';
		$data['message'] = 'Hey';
		$this->load->view('user/user_addmaintainance.html', $data);
	}

	public function viewmaintainance(){
		$user =$this ->session->userdata('user');
		$data['info'] = $this->MaintainanceModel->usermaintainance($user['username']);
		$this->load->view('user/user_maintainance.html', $data);
	}


	public function insert(){


		$user =$this ->session->userdata('user');
		$data['request_time']=date('Y-m-d H:i:s');
		$data['room_num'] = $user['room_num'];
		$data['username'] = $user['username'];
		//$data['priority'] = $_POST['priority'];
		$data['location'] = $_POST['location'];
		//$data['permission'] = $_POST['permission'];
        $data['description'] = $_POST['description'];
        $data['status'] = 'requested';
		

		if ($this->MaintainanceModel->addmaintainance($data)){
			$data['display'] = '';
			$data['message'] = "Maintainance Request Successful";
			$this->load->view('user/user_addmaintainance.html', $data);
		}else{
			echo "sorry! something went wrong";
		}
	}

	public function validation(){
		$this->load->library('form_validation');
		//$this->form_validation->set_rules('priority','','required|trim');
		//$this->form_validation->set_rules('permission','','required|trim');
		$this->form_validation->set_rules('location','','required|trim');
        $this->form_validation->set_rules('description','','required|trim');
		
		if ($this->form_validation->run()){
			$this->insert();
		}
		else{
			$data['display'] = '';
			$data['message'] = validation_errors();
			$this->load->view('user/user_maintainance.html', $data);
		}
	}

}