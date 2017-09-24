<?php defined('BASEPATH') OR exit('No direct script access allowed');

class NewsController extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('captcha');
		$this->load->library('form_validation');
		$this->load->model('NewsModel');
		$this->load->library('pagination');
	}

	public function validation(){
		$this->form_validation->set_rules('title','','required|trim');
		$this->form_validation->set_rules('content','','required|trim');

		if ($this->form_validation->run()){
			$data['title'] = $_POST['title'];
			$data['publish_time'] = date('Y-m-d H:i:s');
			$data['content'] = $_POST['content'];

			if ($this->NewsModel->addNews($data)){
				redirect ('manager/NewsController/listnews');
			}else{
				echo "sorry! something went wrong";
			}
		}
		else{
			$data['display'] = '';
			$data['message'] = validation_errors();
			$this->load->view('manager/news.html', $data);
		}
	}

	

	public function listnews($sort_by = 'news_id', $sort_order = 'desc', $offset = ''){
		$config['base_url'] = site_url("manager/NewsController/listnews/$sort_by/$sort_order");
		$config['total_rows'] = $this->NewsModel->countnews();
		$config['per_page'] = 10;
		$config['uri_segment'] = 6;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();

		$limit = $config['per_page'];
		$data['info'] = $this->NewsModel->listNews($limit, $offset, $sort_by, $sort_order);
		$data['date'] = date('Y-m-d');
		$data['display'] = 'visibility:hidden';
		$data['message'] = '';
		$this->load->view('manager/news.html', $data);
		//echo $data['date'];
	}
}