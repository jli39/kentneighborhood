<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CommentController extends CI_Controller{

	public function __construct(){
		parent::__construct();
		
		$this->load->library('form_validation');
		$this->load->model('CommentModel');
	}

	public function comment(){
		$data['display'] = 'visibility:hidden';
		$data['message'] = 'Hey';
		$this->load->view('user/user_comment.html', $data);
	}

	public function insert(){


		//$user =$this ->session->userdata('user');
		$data['publish_time']=date('Y-m-d H:i:s');
		//$data['room_num'] = $user['room_num'];
		//$data['username'] = $user['username'];
		//$data['priority'] = $_POST['priority'];
		$data['title'] = $_POST['title'];
		//$data['permission'] = $_POST['permission'];
        $data['content'] = $_POST['content'];
		

		if ($this->CommentModel->addcomment($data)){
			$data['display'] = '';
			$data['message'] = "Leave comment Successful";
			$this->load->view('user/user_comment.html', $data);
		}else{
			echo "sorry! something went wrong";
		}
	}

	public function validation(){
		$this->load->library('form_validation');
		//$this->form_validation->set_rules('priority','','required|trim');
		//$this->form_validation->set_rules('permission','','required|trim');
		$this->form_validation->set_rules('title','','required|trim');
        $this->form_validation->set_rules('content','','required|trim');
		
		if ($this->form_validation->run()){
			$this->insert();
		}
		else{
			$data['display'] = '';
			$data['message'] = validation_errors();
			$this->load->view('user/user_comment.html', $data);
		}
	}

}