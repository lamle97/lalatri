<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manufacturers extends CI_Controller {
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('catalog/manufacturer');
    }    

	public function index()
	{
		if ($this->input->get('page')) {
			$page = $this->input->get('page');
		} else {
			$page = 1;
		}		

		$filter_data = array(
			'sort' => 'name',
			'order' => 'ASC',
			'start' => ($page - 1) * 10,
			'limit' => 10
		);

		$data['manufacturers'] = $this->manufacturer->getManufacturers($filter_data);

		$this->load->helper('pagination');

		$config['total_rows'] = $this->manufacturer->getTotalManufacturers();
		$config['per_page'] = 10;	

		$data['pagination'] = pagination($config);		   

		$this->load->template_admin('catalog/manufacturers', $data);

	}

	public function add()
	{
        if($this->input->post('name') && $this->validate())
        {
        	$data['name'] = $this->input->post('name');
        	$data['image'] = $this->input->post('image');
        	$data['sort_order'] = $this->input->post('sort');
        	$data['keyword'] = ($this->input->post('keyword') != '')?$this->input->post('keyword'):url_title(convert_accented_characters($data['name']), '-', true);

        	$this->manufacturer->addManufacturer($data);

        	$this->session->set_userdata('success','Add manufacturer successfull.');

        	redirect('/admin/catalog/manufacturers', 'location');
        }

		$data = array();

		$data['action'] = 'add';		

		$this->load->template_admin('catalog/manufacturer_form', $data);
	}

	public function edit($manufacturer_id)
	{
		if (!isset($manufacturer_id))
			redirect('/admin', 'location');

        if($this->input->post('name') && $this->validate())
        {
        	$data['name'] = $this->input->post('name');
        	$data['image'] = $this->input->post('image');
        	$data['sort_order'] = $this->input->post('sort');
        	$data['keyword'] = ($this->input->post('keyword') != '')?$this->input->post('keyword'):url_title(convert_accented_characters($data['name']), '-', true);

        	$this->manufacturer->editManufacturer($manufacturer_id, $data);

        	$this->session->set_userdata('success','Edit manufacturer successfull.');

        	redirect('/admin/catalog/manufacturers', 'location');
        }		

		$data = array();

		$data['action'] = 'edit';

		$data['manufacturer'] = $this->manufacturer->getManufacturer($manufacturer_id);

		$this->load->template_admin('catalog/manufacturer_form', $data);
	}

	public function delete()
	{
		if(!empty($this->input->post('item')) && $this->validate()) {
			foreach($this->input->post('item') as $id) {
        		$this->manufacturer->deleteManufacturer($id);
    		}	

    		$this->session->set_userdata('success','Delete manufacturer successfull.');
		}

		redirect('/admin/catalog/manufacturers', 'location');
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

			$results = $this->manufacturer->getManufacturers($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'manufacturer_id' => $result['manufacturer_id'],
					'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				);
			}
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
