<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller{
	//$managerusername = "none";

	public function __construct(){
		parent::__construct();
		
		$this->load->helper('captcha');
		$this->load->library('form_validation');
		$this->load->model('ManagerModel');

	}
	public function login(){
		$data['display'] = 'visibility:hidden';
		$data['message'] = 'Hey';
		$this->load->view('manager/login.html', $data);
	}

	public function signup(){
		$data['display'] = 'visibility:hidden';
		$data['message'] = 'Hey';
		$this->load->view('manager/manager_signup.html', $data);
	}

	public function code(){
		$code = create_captcha();
		$this->session->set_userdata('code', $code);
	}

	public function signin(){
		//set login rude
		$this->form_validation->set_rules('username','','required');
		$this->form_validation->set_rules('password','','required');
		$captcha = strtolower($this->input->post('captcha'));
		$code = strtolower($this->session->userdata('code'));

		if ($captcha === $code){

			if ($this->form_validation->run() == false){
				$data['display'] = '';
				$data['message'] = validation_errors();
				$this->load->view('manager/login.html', $data);
			}
			else{
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				if ($this->ManagerModel->login($username, $password)){
					$data = array(
						'username' => $this->input->post('username'),
						'is_login' => 1
						);
					$this->session->set_userdata($data);
					redirect('manager/IndexController/index');
				}
				else{
					$data['display'] = '';
					$data['message'] = 'Wrong Username Or Password!';
					$this->load->view('manager/login.html', $data);
				}
			}
		} 
		else{
			$data['display'] = '';
			$data['message'] = 'Wrong Verification Code!';
			$this->load->view('manager/login.html', $data);
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('manager/LoginController/login');
	}
}