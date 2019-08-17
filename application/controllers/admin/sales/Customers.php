<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller {
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('customer/customer');
        $this->load->model('system/city');
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

		if ($this->input->get('email') != "") {
			$email = $this->input->get('email');
		} else {
			$email = null;
		}

		if ($this->input->get('status') != "") {
			$status = $this->input->get('status');
		} else {
			$status = null;
		}				

		$filter_data = array(
			'filter_name'	  => $name,
			'filter_email' => $email,
			'filter_status'   => $status,
			'start' => ($page - 1) * 10,
			'limit' => 10
		);

		$data['customers'] = $this->customer->getCustomers($filter_data);

		$this->load->helper('pagination');

		$config['total_rows'] = $this->customer->getTotalCustomers();
		$config['per_page'] = 10;	

		$data['pagination'] = pagination($config);  

		$this->load->template_admin('sales/customers', $data);

	}

	public function add()
	{
        if($this->input->post('email') && $this->validate())
        {
        	$data['email'] = $this->input->post('email');
        	$data['password'] = $this->input->post('password');
        	$data['firstname'] = $this->input->post('firstname');
        	$data['lastname'] = $this->input->post('lastname');
        	$data['telephone'] = $this->input->post('telephone');
        	$data['fax'] = $this->input->post('fax');
        	$data['address_1'] = $this->input->post('address_1');
        	$data['address_2'] = $this->input->post('address_2');
        	$data['city_id'] = $this->input->post('city_id');
        	$data['zone_id'] = $this->input->post('zone_id');
        	$data['newsletter'] = $this->input->post('newsletter');
        	$data['status'] = $this->input->post('status');

        	$this->customer->addCustomer($data);

        	$this->session->set_userdata('success','Add customer successfull.');

        	redirect('/admin/sales/customers', 'location');
        }

		$data = array();

		$data['action'] = 'add';	
		$data['citys'] = $this->city->getCitys();	

		$this->load->template_admin('sales/customer_form', $data);
	}

	public function edit($customer_id)
	{
		if (!isset($customer_id))
			redirect('/admin', 'location');

        if($this->input->post('email') && $this->validate())
        {
        	$data['email'] = $this->input->post('email');
        	$data['firstname'] = $this->input->post('firstname');
        	$data['lastname'] = $this->input->post('lastname');
        	$data['telephone'] = $this->input->post('telephone');
        	$data['fax'] = $this->input->post('fax');
        	$data['address_1'] = $this->input->post('address_1');
        	$data['address_2'] = $this->input->post('address_2');
        	$data['city_id'] = $this->input->post('city_id');
        	$data['zone_id'] = $this->input->post('zone_id');
        	$data['newsletter'] = $this->input->post('newsletter');
        	$data['status'] = $this->input->post('status');

        	if ($this->input->post('password') != "")
        		$data['password'] = $this->input->post('password');

        	$this->customer->editCustomer($customer_id, $data);

        	$this->session->set_userdata('success','Edit customer successfull.');

        	redirect('/admin/sales/customers', 'location');
        }		

		$data = array();

		$data['action'] = 'edit';

		$data['customer'] = $this->customer->getCustomer($customer_id);
		$data['citys'] = $this->city->getCitys();

		$this->load->template_admin('sales/customer_form', $data);
	}

	public function delete()
	{
		if(!empty($this->input->post('item')) && $this->validate()) {
			foreach($this->input->post('item') as $id) {
        		$this->customer->deleteCustomer($id);
    		}	

    		$this->session->set_userdata('success','Delete customer successfull.');
		}

		redirect('/admin/sales/customers', 'location');
	}

	public function autocomplete() {
		$json = array();

		if ($this->input->get('filter_name')) {
			$filter_data = array(
				'filter_name' => $this->input->get('filter_name'),
				'start'       => 0,
				'limit'       => 5
			);

			$json = $this->customer->getCustomers($filter_data);
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
