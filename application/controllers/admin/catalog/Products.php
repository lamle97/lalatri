<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('catalog/product');
        $this->load->model('catalog/category');
        $this->load->model('catalog/manufacturer');
    }    

	public function index()
	{
		if ($this->input->get('page')) {
			$page = $this->input->get('page');
		} else {
			$page = 1;
		}	

		if ($this->input->get('name')) {
			$name = $this->input->get('name');
		} else {
			$name = null;
		}

		if ($this->input->get('quantity') != "") {
			$quantity = $this->input->get('quantity');
		} else {
			$quantity = null;
		}

		if ($this->input->get('status') != "") {
			$status = $this->input->get('status');
		} else {
			$status = null;
		}				

		$filter_data = array(
			'filter_name'	  => $name,
			'filter_quantity' => $quantity,
			'filter_status'   => $status,		
			'sort' => 'p.name',
			'order' => 'ASC',
			'start' => ($page - 1) * 10,
			'limit' => 10
		);

		$data['products'] = $this->product->getProducts($filter_data);

		$this->load->helper('pagination');

		$config['total_rows'] = $this->product->getTotalProducts();
		$config['per_page'] = 10;	

		$data['pagination'] = pagination($config);  

		$this->load->template_admin('catalog/products', $data);

	}

	public function add()
	{
        if($this->input->post('name') && $this->validate())
        {
        	$data['name'] = $this->input->post('name');
        	$data['description'] = $this->input->post('description');
        	$data['description_short'] = $this->input->post('description_short');
        	$data['description_technical'] = $this->input->post('description_technical');
        	$data['meta_title'] = $this->input->post('meta_title');
        	$data['tag'] = $this->input->post('tag');
        	$data['images'] = $this->input->post('images');
        	$data['options'] = $this->input->post('options');
        	$data['manufacturer_id'] = $this->input->post('manufacturer_id');
        	$data['category_id'] = $this->input->post('category_id');
        	$data['keyword'] = ($this->input->post('keyword') != '')?$this->input->post('keyword'):url_title(convert_accented_characters($data['name']), '-', true);
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
        	$data['description_short'] = $this->input->post('description_short');
        	$data['description_technical'] = $this->input->post('description_technical');
        	$data['meta_title'] = $this->input->post('meta_title');
        	$data['tag'] = $this->input->post('tag');
        	$data['images'] = $this->input->post('images');
        	$data['options'] = $this->input->post('options');
        	$data['manufacturer_id'] = $this->input->post('manufacturer_id');
        	$data['category_id'] = $this->input->post('category_id');
        	$data['keyword'] = ($this->input->post('keyword') != '')?$this->input->post('keyword'):url_title(convert_accented_characters($data['name']), '-', true);
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
		$data['product']['images'] = $this->product->getImagesByProductId($product_id);

		$this->load->template_admin('catalog/product_form', $data);
	}

	public function delete()
	{
		if(!empty($this->input->post('item')) && $this->validate()) {
			foreach($this->input->post('item') as $id) {
        		$this->product->deleteProduct($id);
    		}	

    		$this->session->set_userdata('success','Delete product successfull.');
		}

		redirect('/admin/catalog/products', 'location');
	}

	public function autocomplete() {
		$json = array();

		if ($this->input->get('filter_name')) {
			$filter_data = array(
				'filter_name' => $this->input->get('filter_name'),
				'sort'        => 'pd.name',
				'order'       => 'ASC',
				'start'       => 0,
				'limit'       => 5
			);

			$json = $this->product->getProducts($filter_data);
		}

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($json));
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
