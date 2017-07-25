<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('captcha');
		$this->load->library('form_validation');
		$this->load->model('UserModel');
	}

	public function index(){
		$this->load->view('user/user_index.html');
	}

	public function top(){
		$this->load->view('user/user_top.html');
	}
	public function menu(){
		$this->load->view('user/user_menu.html');
	}
	//public function announcement(){
		//$this->load->view('user/user_announcement.html');
	//}
	



}