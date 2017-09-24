<?php defined('BASEPATH') OR exit('No direct script access allowed');

class PackageController extends CI_Controller{

	public function __construct(){
		parent::__construct();
		
		$this->load->model('PackageModel');
		
	}

	public function viewpackage(){
		$user =$this ->session->userdata('user');
		$data['info'] = $this->PackageModel->userpackage($user['username']);
		$this->load->view('user/user_package.html', $data);
	}


}
	