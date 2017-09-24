<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CardController extends CI_Controller{

	public function __construct(){
		parent::__construct();
		
		$this->load->library('form_validation');
		$this->load->model('CardModel');
	}

	public function Addcard(){
		$data['display'] = 'visibility:hidden';
		$data['message'] = 'Hey';
		$this->load->view('user/user_addcard.html', $data);
	}

	public function viewcard(){
		$user =$this ->session->userdata('user');
		$data['info'] = $this->CardModel->usercard($user['username']);
		$this->load->view('user/user_card.html', $data);
	}

	public function insert(){
        $user =$this ->session->userdata('user');
		
		
		$data['username'] = $user['username'];
		$data['card_type'] = $_POST['card_type'];
		$data['card_name'] = $_POST['card_name'];
		$data['card_num'] = $_POST['card_num'];
		$data['exp_date'] = $_POST['exp_year'] . '-' . $_POST['exp_month'];
		$data['cvv'] = $_POST['cvv'];
		

		if ($this->CardModel->addcard($data)){
			$data['display'] = '';
			$data['message'] = "Add card Successful";
			$this->load->view('user/user_addcard.html', $data);
		}else{
			echo "sorry! something went wrong";
		}
	}

	public function validation(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('card_type','','required|trim');
		$this->form_validation->set_rules('card_num','','required|trim');
		$this->form_validation->set_rules('card_name','','required|trim');
		$this->form_validation->set_rules('exp_date','','required|trim');
		$this->form_validation->set_rules('cvv','','required|trim');
		
		if ($this->form_validation->run()){
			$this->insert();
		}
		else{
			$data['display'] = '';
			$data['message'] = validation_errors();
			$this->load->view('user/user_card.html', $data);
		}
	}

	public function delete($card_num){
		$this->CardModel->deletecard($card_num);
		redirect ('user/CardController/viewcard');
	}

}