<?php defined('BASEPATH') OR exit('No direct script access allowed');

class PasswordController extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('captcha');
		$this->load->library('form_validation');
		$this->load->model('UserModel');
		$this->load->library('pagination');
	}


	public function password(){
		$data['errormessage'] = 'display: none';
		$data['successmessage'] = 'display: none';
		
		$data['message'] = '';
		$data['user'] = $this->UserModel->getUser($this->session->userdata('username'));
		$this->load->view('user/user_password.html', $data);
	}


	public function changepassword(){
		$this->load->model('UserModel');
		$user =$this ->session->userdata('user');
		$username = $user['username'];
		$password = $this->input->post('password');
		if ($this->UserModel->get_user($username, $password)){
			

			if($_POST['new_password'] == $_POST['confirm_password']){
				
				$config['password'] = $_POST['confirm_password'];
				$this->UserModel->updateUser($config, $user['username']);

				$data['errormessage'] = 'display: none';
				$data['successmessage'] = 'display: block';
				$data['message'] = 'change password success!';
				$data['user'] = $this->UserModel->getUser($this->session->userdata('username'));
				$this->load->view('user/user_password.html', $data);
			}
			else{
				$data['errormessage'] = 'display: block';
				$data['successmessage'] = 'display: none';
				$data['message'] = 'new password is not equal to confirm password!';
				$data['user'] = $this->UserModel->getUser($this->session->userdata('username'));
				$this->load->view('user/user_password.html', $data);
			}
		}
		else{
			$data['errormessage'] = 'display: block';
			$data['successmessage'] = 'display: none';
			$data['message'] = 'old password is wrong!';
			$data['user'] = $this->UserModel->getUser($this->session->userdata('username'));
			$this->load->view('user/user_password.html', $data);
		}
	}

}