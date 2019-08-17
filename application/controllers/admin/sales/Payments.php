<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends CI_Controller {
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('sales/payment');
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

		$data['payments'] = $this->payment->getPayments($filter_data);

		$this->load->helper('pagination');

		$config['total_rows'] = $this->payment->getTotalPayments();
		$config['per_page'] = 10;	

		$data['pagination'] = pagination($config);	  

		$this->load->template_admin('sales/payments', $data);

	}

	public function add()
	{
        if($this->input->post('name') && $this->validate())
        {
        	$data['name'] = $this->input->post('name');
        	$data['method'] = $this->input->post('method');
        	$data['status'] = $this->input->post('status');

        	$this->payment->addPayment($data);

        	$this->session->set_userdata('success','Add payment successfull.');

        	redirect('/admin/sales/payments', 'location');
        }

		$data = array();

		$data['action'] = 'add';		

		$this->load->template_admin('sales/payment_form', $data);
	}

	public function edit($payment_id)
	{
		if (!isset($payment_id))
			redirect('/admin', 'location');

        if($this->input->post('name') && $this->validate())
        {
        	$data['name'] = $this->input->post('name');
        	$data['method'] = $this->input->post('method');
        	$data['status'] = $this->input->post('status');

        	$this->payment->editPayment($payment_id, $data);

        	$this->session->set_userdata('success','Edit payment successfull.');

        	redirect('/admin/sales/payments', 'location');
        }		

		$data = array();

		$data['action'] = 'edit';

		$data['payment'] = $this->payment->getPayment($payment_id);

		$this->load->template_admin('sales/payment_form', $data);
	}

	public function delete()
	{
		if(!empty($this->input->post('item')) && $this->validate()) {
			foreach($this->input->post('item') as $id) {
        		$this->payment->deletePayment($id);
    		}	

    		$this->session->set_userdata('success','Delete payment successfull.');
		}

		redirect('/admin/sales/payments', 'location');
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
