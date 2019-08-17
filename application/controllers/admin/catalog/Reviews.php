<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reviews extends CI_Controller {
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('catalog/review');
    }    

	public function index()
	{
		if ($this->input->get('page')) {
			$page = $this->input->get('page');
		} else {
			$page = 1;
		}		

		$filter_data = array(
			'order' => 'ASC',
			'start' => ($page - 1) * 10,
			'limit' => 10
		);

		$data['reviews'] = $this->review->getReviews($filter_data);

		$this->load->helper('pagination');

		$config['total_rows'] = $this->review->getTotalReviews();
		$config['per_page'] = 10;	

		$data['pagination'] = pagination($config);		   

		$this->load->template_admin('catalog/reviews', $data);

	}

	public function add()
	{
        if($this->input->post('customer_id') && $this->validate())
        {
        	$data['customer_id'] = $this->input->post('customer_id');
        	$data['product_id'] = $this->input->post('product_id');
        	$data['text'] = $this->input->post('text');
        	$data['rating'] = $this->input->post('rating');
        	$data['status'] = $this->input->post('status');

        	$this->review->addReview($data);

        	$this->session->set_userdata('success','Add review successfull.');

        	redirect('/admin/catalog/reviews', 'location');
        }

		$data = array();

		$data['action'] = 'add';		

		$this->load->template_admin('catalog/review_form', $data);
	}

	public function edit($review_id)
	{
		if (!isset($review_id))
			redirect('/admin', 'location');

        if($this->input->post('customer_id') && $this->validate())
        {
        	$data['customer_id'] = $this->input->post('customer_id');
        	$data['product_id'] = $this->input->post('product_id');
        	$data['text'] = $this->input->post('text');
        	$data['rating'] = $this->input->post('rating');
        	$data['status'] = $this->input->post('status');

        	$this->review->editReview($review_id, $data);

        	$this->session->set_userdata('success','Edit review successfull.');

        	redirect('/admin/catalog/reviews', 'location');
        }		

		$data = array();

		$data['action'] = 'edit';

		$data['review'] = $this->review->getReview($review_id);

		$this->load->template_admin('catalog/review_form', $data);
	}

	public function delete()
	{
		if(!empty($this->input->post('item')) && $this->validate()) {
			foreach($this->input->post('item') as $id) {
        		$this->review->deleteReview($id);
    		}	

    		$this->session->set_userdata('success','Delete review successfull.');
		}

		redirect('/admin/catalog/reviews', 'location');
	}

	private function validate() {	
		$this->load->model("system/user");

		if (!$this->user->hasPermission('modify', strtolower(get_class($this)))) {
			$this->session->set_userdata('error','You don\'t have permission to modify!');
			return false;
		}	

		return 	true;
	}		
}
