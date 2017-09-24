<?php defined('BASEPATH') OR exit('No direct script access allowed');

class PaymentController extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('captcha');
		$this->load->library('form_validation');
		$this->load->model('PaymentModel');
		$this->load->library('pagination');
	}

	public function listpayment($sort_by, $sort_order, $offset = ''){
		$config['base_url'] = site_url("manager/PaymentController/listpayment/$sort_by/$sort_order");
		$config['total_rows'] = $this->PaymentModel->countPayment();
		$config['per_page'] = 20;
		$config['uri_segment'] = 6;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$limit = $config['per_page'];
		$data['info'] = $this->PaymentModel->listsortPayment($limit, $offset, $sort_by, $sort_order);
		$data['date'] = date('Y-m');
		$this->load->view('manager/payment.html', $data);
		//echo $data['date'];
	}

	public function remainpayment($offset = ''){
		$sort_by = 'payment_time';
		$sort_order = "desc";
		$config['base_url'] = site_url("manager/PaymentController/remainpayment/$sort_by/$sort_order");
		$config['total_rows'] = $this->PaymentModel->countPayment();
		$config['per_page'] = 20;
		$config['uri_segment'] = 6;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$limit = $config['per_page'];
		$data['info'] = $this->PaymentModel->listsortPayment($limit, $offset, $sort_by, $sort_order);
		$data['date'] = $_POST['date'];
		$this->load->view('manager/payment.html', $data);
		//echo $_POST['date'];
	}
}