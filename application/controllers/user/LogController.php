<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//用户控制器
class LogController extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('captcha');
		$this->load->library('form_validation');
		$this->load->model('UserModel');
		
	}

	#显示登录页面
	public function login(){
		$data['display'] = 'visibility:hidden';
		$data['message'] = '';
		$this->load->view('user/user_login.html',$data);
	}

	public function code(){
		#调用函数生成验证码
		$vals = array(
			'word_length' => 4,
		);
		$code = create_captcha($vals);
		#将验证码字符串保存到session中
		$this->session->set_userdata('code',$code);
	}


	#登录动作
	public function signin(){

		$this->form_validation->set_rules('username','','required');
		$this->form_validation->set_rules('password','','required');

		#获取表单数据
		$captcha = strtolower($this->input->post('captcha'));

		#获取session中保存的验证码
		$code = strtolower($this->session->userdata('code'));

		//if ($captcha === $code){
			
			///if ($this->form_validation->run() == false){
				//$data['display'] = '';
				//$data['message'] = validation_errors();
				
				//$this->load->view('user/user_login.html',$data);
			//} else{
				$username = $this->input->post('username');
				$password = $this->input->post('password');

				
				if ($this->UserModel->get_user($username,$password)){
					$user = $this->UserModel->get_user($username,$password);
					$this->session->set_userdata('user',$user);
					redirect('user/MainController/index');
				} else{
					
					$data['display'] = '';
					$data['message'] = 'password wrong';
					
					$this->load->view('user/user_login.html',$data);
				}
			//}
			
		//} else {
			
			//$data['display'] = '';
			//$data['message'] = 'Wrong Verification Code!';
			
			//$this->load->view('user/user_login.html',$data);
		}


		
	public function logout(){

		$this->session->unset_userdata('user');
		$this->session->sess_destroy();
		
		redirect('user/LogController/login');
	}
	
}