<?php defined('BASEPATH') OR exit('No direct script access allowed');

class PaymentController extends CI_Controller{

	public function __construct(){
		parent::__construct();
		
		$this->load->library('form_validation');
		$this->load->model('PaymentModel');
		$this->load->model('CardModel');
	}

	public function addpayment(){
		$data['display'] = 'visibility:hidden';
		$data['message'] = 'Hey';
		$user =$this ->session->userdata('user');
		$data['info'] = $this->CardModel->usercard($user['username']);
		$this->load->view('user/user_addpayment.html', $data);
	}

	public function viewpayment(){
		$user =$this ->session->userdata('user');
		$data['info'] = $this->PaymentModel->userpayment($user['username']);
		$this->load->view('user/user_payment.html', $data);
	}

	public function insert(){
        $user =$this ->session->userdata('user');
		$data['payment_time']=date('Y-m-d H:i:s');
		$data['payment_month']=$_POST['payment_month'];
		$data['room_num'] = $user['room_num'];
		$data['username'] = $user['username'];
		//$data['method'] = $_POST['method'];
		//$data['name'] = $_POST['name'];
		$data['card_num'] = $_POST['card_num'];
		//$data['exp_date'] = $_POST['exp_date'];
		//$data['amount'] = $_POST['amount'];
		

		if ($this->PaymentModel->addPayment($data)){
			$data['display'] = '';
			$data['message'] = "Payment Successful";
			$user =$this ->session->userdata('user');
			$data['info'] = $this->CardModel->usercard($user['username']);
			$this->load->view('user/user_addpayment.html', $data);
		}else{
			echo "sorry! something went wrong";
		}
	}

	public function validation(){
		$this->load->library('form_validation');
		//$this->form_validation->set_rules('method','','required|trim');
		//$this->form_validation->set_rules('card_num','','required|trim');
		//$this->form_validation->set_rules('name','','required|trim');
		//$this->form_validation->set_rules('exp_date','','required|trim');
		//$this->form_validation->set_rules('amount','','required|trim');
		
		if ($this->form_validation->run()){
			$this->insert();
		}
		else{
			$data['display'] = '';
			$data['message'] = validation_errors();
			$this->load->view('user/user_payment.html', $data);
		}
	}

}