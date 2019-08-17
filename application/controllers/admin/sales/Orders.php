<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('sales/order');
        $this->load->model('sales/payment');
        $this->load->model('customer/customer');
    }    

	public function index()
	{
		if ($this->input->get('page')) {
			$page = $this->input->get('page');
		} else {
			$page = 1;
		}	

		if ($this->input->get('customer')) {
			$customer = $this->input->get('customer');
		} else {
			$customer = null;
		}

		if ($this->input->get('order_id') != "") {
			$order_id = $this->input->get('order_id');
		} else {
			$order_id = null;
		}	

		if ($this->input->get('status') != "") {
			$status = $this->input->get('status');
		} else {
			$status = null;
		}		

		if ($this->input->get('shipping_status') != "") {
			$shipping_status = $this->input->get('shipping_status');
		} else {
			$shipping_status = null;
		}				

		if ($this->input->get('date_start') != "") {
			$date_start = $this->input->get('date_start');
		} else {
			$date_start = null;
		}	

		if ($this->input->get('date_end') != "") {
			$date_end = $this->input->get('date_end');
		} else {
			$date_end = null;
		}	

		$filter_data = array(
			'filter_customer'	  => $customer,
			'filter_order_id' => $order_id,
			'filter_status'   => $status,	
			'filter_shipping_status'   => $shipping_status,	
			'filter_date_start'   => $date_start,	
			'filter_date_end'   => $date_end,	
			'sort' => 'date_added',
			'order' => 'DESC',
			'start' => ($page - 1) * 10,
			'limit' => 10
		);

		$data['orders'] = $this->order->getOrders($filter_data);

		$this->load->helper('pagination');

		$config['total_rows'] = $this->order->getTotalOrders($filter_data);
		$config['per_page'] = 10;	

		$data['pagination'] = pagination($config);  

		$this->load->template_admin('sales/orders', $data);

	}

	public function add()
	{
        if($this->input->post('name') && $this->validate())
        {
        	$data['name'] = $this->input->post('name');
        	$data['description'] = $this->input->post('description');
        	$data['meta_title'] = $this->input->post('meta_title');
        	$data['tag'] = $this->input->post('tag');
        	$data['options'] = $this->input->post('options');
        	$data['manufacturer_id'] = $this->input->post('manufacturer_id');
        	$data['category_id'] = $this->input->post('category_id');
        	$data['sort_order'] = $this->input->post('sort');
        	$data['status'] = $this->input->post('status');

        	$this->product->addProduct($data);

        	$this->session->set_userdata('success','Add product successfull.');

        	redirect('/admin/catalog/products', 'location');
        }

		$data = array();

		$data['action'] = 'add';		

		$this->load->template_admin('catalog/product_form', $data);
	}

	public function edit($product_id)
	{
		if (!isset($product_id))
			redirect('/admin', 'location');

        if($this->input->post('name') && $this->validate())
        {
        	$data['name'] = $this->input->post('name');
        	$data['description'] = $this->input->post('description');
        	$data['meta_title'] = $this->input->post('meta_title');
        	$data['tag'] = $this->input->post('tag');
        	$data['options'] = $this->input->post('options');
        	$data['manufacturer_id'] = $this->input->post('manufacturer_id');
        	$data['category_id'] = $this->input->post('category_id');
        	$data['sort_order'] = $this->input->post('sort');
        	$data['status'] = $this->input->post('status');

        	$this->product->editProduct($product_id, $data);

        	$this->session->set_userdata('success','Edit product successfull.');

        	redirect('/admin/catalog/products', 'location');
        }		

		$data = array();

		$data['action'] = 'edit';

		$filter_data = array(
			'sort' => 'name',
			'order' => 'ASC'
		);	

		$data['product'] = $this->product->getProduct($product_id);
		$data['product']['options'] = $this->product->getOptionsByProductId($product_id);
		foreach ($data['product']['options'] as $key => $value) {
			$data['product']['options'][$key]['images'] = $this->product->getImagesByProductOptionId($value['product_option_id']);
		}

		$this->load->template_admin('catalog/product_form', $data);
	}

	public function view($order_id)
	{
		if (!isset($order_id))
			redirect('/admin', 'location');

        if($this->input->post('update') && $this->validate())
        {
        	$edit['status'] = $this->input->post('status');
        	$edit['shipping_status'] = $this->input->post('shipping_status');
        	$this->order->editOrderStatus($order_id, $edit);

        	$this->session->set_userdata('success','Update order successfull.');
        }		

		$data = array();

		$data['order'] = $this->order->getOrder($order_id);
		$data['customer'] = $this->customer->getCustomer($data['order']['customer_id']);
        $data['order']['payment'] = $this->payment->getPayment($data['order']['payment_id']);
        $data['order']['products'] = $this->order->getProductsOrder($order_id);		

		$this->load->template_admin('sales/order_view', $data);
	}

	public function delete()
	{
		if(!empty($this->input->post('item')) && $this->validate()) {
			foreach($this->input->post('item') as $id) {
        		$this->order->deleteOrder($id);
    		}	

    		$this->session->set_userdata('success','Delete order successfull.');
		}

		redirect('/admin/sales/orders', 'location');
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
