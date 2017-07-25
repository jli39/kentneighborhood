<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ManagerController extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('captcha');
		$this->load->library('form_validation');
		$this->load->model('ManagerModel');
	}

	public function managerinfo(){
		$data['errormessage'] = 'display: none';
		$data['successmessage'] = 'display: none';
		$data['message'] = '';
		$data['user'] = $this->ManagerModel->getManager($this->session->userdata('username'));
		$this->load->view('manager/manager_info.html', $data);
	}

	public function changepassword(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if ($this->ManagerModel->login($username, $password)){
			if($_POST['new_password'] == $_POST['confirm_password']){
				$config['password'] = $_POST['confirm_password'];
				$this->ManagerModel->update($config, $_POST['username']);

				$data['errormessage'] = 'display: none';
				$data['successmessage'] = 'display: block';
				$data['message'] = 'change password success!';
				$data['user'] = $this->ManagerModel->getManager($this->session->userdata('username'));
				$this->load->view('manager/manager_info.html', $data);
			}
			else{
				$data['errormessage'] = 'display: block';
				$data['successmessage'] = 'display: none';
				$data['message'] = 'new password is not equal to confirm password!';
				$data['user'] = $this->ManagerModel->getManager($this->session->userdata('username'));
				$this->load->view('manager/manager_info.html', $data);
			}
		}
		else{
			$data['errormessage'] = 'display: block';
			$data['successmessage'] = 'display: none';
			$data['message'] = 'old password is wrong!';
			$data['user'] = $this->ManagerModel->getManager($this->session->userdata('username'));
			$this->load->view('manager/manager_info.html', $data);
		}
	}
}