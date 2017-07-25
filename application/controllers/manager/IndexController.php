<?php defined('BASEPATH') OR exit('No direct script access allowed');

class IndexController extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('captcha');
		$this->load->library('form_validation');
		$this->load->model('UserModel');
		$this->load->model('ManagerModel');
		$this->load->model('RoomModel');
		$this->load->library('pagination');
	}

	public function index(){
		if ($this->session->userdata('is_login')){
			$this->load->view('manager/index.html');
		}
		else{
			redirect('manager/LoginController/login');
		}
	}

	public function top($firsttag, $secondtag){
		$data['firsttag'] = $firsttag;
		$data['secondtag'] = $secondtag;
		$this->load->view('manager/topbar.html', $data);
	}
	public function menu(){
		$this->load->view('manager/leftmenu.html');
	}
	public function content(){
		$this->load->view('manager/dashboard.html');
	}
	public function register(){
		$data['display'] = 'visibility:hidden';
		$data['message'] = 'Hey';
		$this->load->view('manager/user_signup.html', $data);
	}
	public function account($sort_by, $sort_order, $offset = ''){
		//pageination
		$config['base_url'] = site_url("manager/IndexController/account/$sort_by/$sort_order");
		$config['total_rows'] = $this->UserModel->countUser();
		$config['per_page'] = 20;
		$config['uri_segment'] = 6;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$limit = $config['per_page'];
		$data['info'] = $this->UserModel->listUser($limit, $offset, $sort_by, $sort_order);
		$data['display'] = 'display: none';
		$data['displaymessage'] = 'display: none';
		$data['message'] = '';
		$this->load->view('manager/userinfo.html', $data);
	}

	public function insert(){
		$data['username'] = $_POST['username'];
		$data['password'] = $_POST['password'];
		$data['firstname'] = $_POST['firstname'];
		$data['lastname'] = $_POST['last_name'];
		$data['email'] = $_POST['email'];
		$data['phone_num'] = $_POST['phone_num'];
		$data['room_num'] = $_POST['room_num'];
		$data['lease_start'] = $_POST['lease_start'];
		$data['lease_end'] = $_POST['lease_end'];
		$data['add_time'] = date('Y-m-d H:i:s');
		$data['update_time'] = date('Y-m-d H:i:s');

		$room['date'] = $_POST['lease_end'];
		$this->RoomModel->updateRoom($room, $_POST['room_num']);
		if ($this->UserModel->addUser($data)){
			redirect ('manager/IndexController/register');
		}else{
			echo "sorry! something went wrong";
		}
	}

	public function edit($username, $sort_by = 'update_time', $sort_order = 'desc', $offset = ''){
		$config['base_url'] = site_url("manager/IndexController/account/$sort_by/$sort_order");
		$config['total_rows'] = $this->UserModel->countUser();
		$config['per_page'] = 20;
		$config['uri_segment'] = 6;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$limit = $config['per_page'];
		$data['info'] = $this->UserModel->listUser($limit, $offset, $sort_by, $sort_order);
		$data['display'] = 'display: block';
		$data['displaymessage'] = 'display: none';
		$data['message'] = '';
		$data['user'] = $this->UserModel->getUser($username);
		$this->load->view('manager/userinfo.html', $data);
	}

	public function update($sort_by = 'update_time', $sort_order = 'desc', $offset = ''){
		$this->form_validation->set_rules('username','','required|trim');
		$this->form_validation->set_rules('password','','required|trim');
		$this->form_validation->set_rules('firstname','','required|trim');
		$this->form_validation->set_rules('last_name','','required|trim');
		$this->form_validation->set_rules('email','','required|trim');
		$this->form_validation->set_rules('phone_num','','required|trim');
		$this->form_validation->set_rules('room_num','','required|trim');
		$this->form_validation->set_rules('lease_start','','required|trim');
		$this->form_validation->set_rules('lease_end','','required|trim');
		$username = $_POST['username'];
		if ($this->form_validation->run()){
			$roomdata = $this->RoomModel->checkRoom($_POST['room_num']);
			foreach($roomdata as $temp);
			if ($roomdata){
				if($_POST['lease_start'] > $temp['date']){
					$data['username'] = $_POST['username'];
					$data['password'] = $_POST['password'];
					$data['firstname'] = $_POST['firstname'];
					$data['lastname'] = $_POST['last_name'];
					$data['email'] = $_POST['email'];
					$data['phone_num'] = $_POST['phone_num'];
					$data['room_num'] = $_POST['room_num'];
					$data['lease_start'] = $_POST['lease_start'];
					$data['lease_end'] = $_POST['lease_end'];
					$data['update_time'] = date('Y-m-d H:i:s');

					$room['date'] = $_POST['lease_end'];
					$this->RoomModel->updateRoom($room, $_POST['room_num']);
					$this->UserModel->updateUser($data, $username);
					redirect ('manager/IndexController/account/' . 'update_time/' . 'desc');
				}
				else{
					$config['base_url'] = site_url("manager/IndexController/account/$sort_by/$sort_order");
					$config['total_rows'] = $this->UserModel->countUser();
					$config['per_page'] = 20;
					$config['uri_segment'] = 6;
					$this->pagination->initialize($config);
					$data['pagination'] = $this->pagination->create_links();
					$limit = $config['per_page'];

					$data['message'] = 'Sorry, room is not available';
					$data['info'] = $this->UserModel->listUser($limit, $offset, $sort_by, $sort_order);
					$data['display'] = 'display: block';
					$data['displaymessage'] = 'display: block';
					$data['user'] = $this->UserModel->getUser($username);
					$this->load->view('manager/userinfo.html', $data);
				}
			}
			else{
				$config['base_url'] = site_url("manager/IndexController/account/$sort_by/$sort_order");
				$config['total_rows'] = $this->UserModel->countUser();
				$config['per_page'] = 20;
				$config['uri_segment'] = 6;
				$this->pagination->initialize($config);
				$data['pagination'] = $this->pagination->create_links();
				$limit = $config['per_page'];

				$data['message'] = 'Sorry, room number is not vaild';
				$data['info'] = $this->UserModel->listUser($limit, $offset, $sort_by, $sort_order);
				$data['display'] = 'display: block';
				$data['displaymessage'] = 'display: block';
				$data['user'] = $this->UserModel->getUser($username);
				$this->load->view('manager/userinfo.html', $data);
			}
		}
		else{
			$config['base_url'] = site_url("manager/IndexController/account/$sort_by/$sort_order");
			$config['total_rows'] = $this->UserModel->countUser();
			$config['per_page'] = 20;
			$config['uri_segment'] = 6;
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
			$limit = $config['per_page'];

			$data['message'] = validation_errors();
			$data['info'] = $this->UserModel->listUser($limit, $offset, $sort_by, $sort_order);
			$data['display'] = 'display: block';
			$data['displaymessage'] = 'display: block';
			$data['user'] = $this->UserModel->getUser($username);
			$this->load->view('manager/userinfo.html', $data);
		}
	}

	public function validation(){
		$this->form_validation->set_rules('username','','required|trim|is_unique[user.username]');
		$this->form_validation->set_rules('password','','required|trim');
		$this->form_validation->set_rules('firstname','','required|trim');
		$this->form_validation->set_rules('last_name','','required|trim');
		$this->form_validation->set_rules('email','','required|trim|is_unique[user.email]');
		$this->form_validation->set_rules('phone_num','','required|trim');
		$this->form_validation->set_rules('room_num','','required|trim');
		$this->form_validation->set_rules('lease_start','','required|trim');
		$this->form_validation->set_rules('lease_end','','required|trim');

		$this->form_validation->set_message('is_unique', 'This value is already exists.');
		if ($this->form_validation->run()){

			/*
			$key = md5(uniqid());
			$this->load->library('email', array('mailtype'=>'html'));
			$this->email->from('cricel.design@gmail.com', "cricel");
			$this->email->to($_POST['email']);
			$this->email->subject("KentAppartment account info");

			$message = "<p>Thanks for choosing our Appartment</p>";
			$message .= "<p>here is your account information:</p>";

			//$message .= "<p>your username is $_POST['username']</p>";
			//$message .= "<p>your password is $_POST['password']</p>";
			$this->email->message($message);
			if($this->email->send()){
				echo "success";
			}
			else{
				echo "fail";
			}
			*/
			$roomdata = $this->RoomModel->checkRoom($_POST['room_num']);
			foreach($roomdata as $temp);
			if ($roomdata){
				if($_POST['lease_start'] > $temp['date']){
					$this->insert();
				}
				else{
					$data['display'] = '';
					$data['message'] = 'Sorry, room is not available';
					$this->load->view('manager/user_signup.html', $data);
				}
			}
			else{
				$data['display'] = '';
				$data['message'] = 'Sorry, room number is not vaild';
				$this->load->view('manager/user_signup.html', $data);
			}
			
			
		}
		else{
			$data['display'] = '';
			$data['message'] = validation_errors();
			$this->load->view('manager/user_signup.html', $data);
		}
	}

	public function delete($username){
		$this->UserModel->deleteUser($username);
		redirect ('manager/IndexController/account/' . 'update_time/' . 'desc');
	}

}