<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('catalog/category');
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

		$filter_data = array(
			'filter_name'	  => $name,			
			'sort' => 'name',
			'order' => 'ASC',
			'start' => ($page - 1) * 10,
			'limit' => 10
		);

		$data['categories'] = $this->category->getCategories($filter_data);

		$this->load->helper('pagination');

		$config['total_rows'] = $this->category->getTotalCategories();
		$config['per_page'] = 10;	

		$data['pagination'] = pagination($config);   

		$this->load->template_admin('catalog/categories', $data);

	}

	public function add()
	{
        if($this->input->post('name') && $this->validate())
        {
        	$data['name'] = $this->input->post('name');
        	$data['description'] = $this->input->post('description');
        	$data['meta_title'] = $this->input->post('meta_title');
        	$data['parent_id'] = $this->input->post('parent_id');
        	$data['keyword'] = ($this->input->post('keyword') != '')?$this->input->post('keyword'):url_title(convert_accented_characters($data['name']), '-', true);
        	$data['image'] = $this->input->post('image');
        	$data['sort_order'] = $this->input->post('sort');
        	$data['status'] = $this->input->post('status');

        	if($this->input->post('manufacturer_id'))
        		$data['manufacturer_id'] = $this->input->post('manufacturer_id');

        	$this->category->addCategory($data);

        	$this->session->set_userdata('success','Add category successfull.');

        	redirect('/admin/catalog/categories', 'location');
        }

		$data = array();

		$data['action'] = 'add';	

		$this->load->template_admin('catalog/category_form', $data);
	}

	public function edit($category_id)
	{
		if (!isset($category_id))
			redirect('/admin', 'location');

        if($this->input->post('name') && $this->validate())
        {
        	$data['name'] = $this->input->post('name');
        	$data['description'] = $this->input->post('description');
        	$data['meta_title'] = $this->input->post('meta_title');
        	$data['parent_id'] = $this->input->post('parent_id');
        	$data['keyword'] = ($this->input->post('keyword') != '')?$this->input->post('keyword'):url_title(convert_accented_characters($data['name']), '-', true);
        	$data['image'] = $this->input->post('image');
        	$data['sort_order'] = $this->input->post('sort');
        	$data['status'] = $this->input->post('status');

        	if($this->input->post('manufacturer_id'))
        		$data['manufacturer_id'] = $this->input->post('manufacturer_id');

        	$this->category->editCategory($category_id, $data);

        	$this->session->set_userdata('success','Edit category successfull.');

        	redirect('/admin/catalog/categories', 'location');
        }		

		$data = array();

		$data['action'] = 'edit';

		$data['category'] = $this->category->getCategory($category_id);
		$data['manufacturers'] = $this->category->getManufacturersByCategoryId($category_id);

		$this->load->template_admin('catalog/category_form', $data);
	}

	public function delete()
	{
		if(!empty($this->input->post('item')) && $this->validate()) {
			foreach($this->input->post('item') as $id) {
        		$this->category->deleteCategory($id);
    		}	
    		$this->session->set_userdata('success','Delete category successfull.');
		}
		
		redirect('/admin/catalog/categories', 'location');
	}

	public function autocomplete() {
		$json = array();

		if ($this->input->get('filter_name')) {
			$filter_data = array(
				'filter_name' => $this->input->get('filter_name'),
				'sort'        => 'name',
				'order'       => 'ASC',
				'start'       => 0,
				'limit'       => 5
			);

			$json = $this->category->getCategories($filter_data);
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
