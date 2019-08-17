<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informations extends CI_Controller {
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('catalog/information');
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

		$data['informations'] = $this->information->getInformations($filter_data);

		$this->load->helper('pagination');

		$config['total_rows'] = $this->information->getTotalInformations();
		$config['per_page'] = 10;	

		$data['pagination'] = pagination($config);		   

		$this->load->template_admin('catalog/informations', $data);

	}

	public function add()
	{
        if($this->input->post('title') && $this->validate())
        {
        	$data['title'] = $this->input->post('title');
        	$data['content'] = $this->input->post('content');
        	$data['meta_title'] = $this->input->post('meta_title');
        	$data['keyword'] = ($this->input->post('keyword') != '')?$this->input->post('keyword'):url_title(convert_accented_characters($data['title']), '-', true);
        	$data['status'] = $this->input->post('status');

        	$this->information->addInformation($data);

        	$this->session->set_userdata('success','Add information successfull.');

        	redirect('/admin/catalog/informations', 'location');
        }

		$data = array();

		$data['action'] = 'add';		

		$this->load->template_admin('catalog/information_form', $data);
	}

	public function edit($information_id)
	{
		if (!isset($information_id))
			redirect('/admin', 'location');

        if($this->input->post('title') && $this->validate())
        {
        	$data['title'] = $this->input->post('title');
        	$data['content'] = $this->input->post('content');
        	$data['meta_title'] = $this->input->post('meta_title');
        	$data['keyword'] = ($this->input->post('keyword') != '')?$this->input->post('keyword'):url_title(convert_accented_characters($data['title']), '-', true);
        	$data['status'] = $this->input->post('status');

        	$this->information->editInformation($information_id, $data);

        	$this->session->set_userdata('success','Edit information successfull.');

        	redirect('/admin/catalog/informations', 'location');
        }		

		$data = array();

		$data['action'] = 'edit';

		$data['information'] = $this->information->getInformation($information_id);

		$this->load->template_admin('catalog/information_form', $data);
	}

	public function delete()
	{
		if(!empty($this->input->post('item')) && $this->validate()) {
			foreach($this->input->post('item') as $id) {
        		$this->information->deleteInformation($id);
    		}	

    		$this->session->set_userdata('success','Delete information successfull.');
		}

		redirect('/admin/catalog/informations', 'location');
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
