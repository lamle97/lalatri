<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info extends CI_Controller {
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('customer/customer');
        $this->load->model('system/city');
    }  

	public function index()
	{
		$data = array();

        if(!$this->customer->isLogged())
        {
            redirect('/account/login', 'location');
        }     

        if ($this->input->post('update'))
        {
            $data['firstname'] = $this->input->post('firstname');
            $data['lastname'] = $this->input->post('lastname');
            $data['telephone'] = $this->input->post('telephone');
            $data['fax'] = $this->input->post('fax');
            $data['firstname'] = $this->input->post('firstname');
            $data['firstname'] = $this->input->post('firstname');
        }

        $data['customer'] = $this->customer->getCustomer();
        $data['citys'] = $this->city->getCitys();

		$this->load->template('account/info', $data);
	} 

    public function update()
    {
        if(!$this->customer->isLogged())
        {
            redirect('/account/login', 'location');
        }     

        $customer = $this->customer->getCustomer();

        if ($this->input->post('update'))
        {
            $data['firstname'] = $this->input->post('firstname');
            $data['lastname'] = $this->input->post('lastname');
            $data['email'] = $customer['email'];
            $data['telephone'] = $this->input->post('telephone');
            $data['fax'] = $this->input->post('fax');
            $data['address_1'] = $this->input->post('address_1');
            $data['address_2'] = $this->input->post('address_2');
            $data['city_id'] = $this->input->post('city_id');
            $data['zone_id'] = $this->input->post('zone_id');
            $data['newsletter'] = $this->input->post('newsletter');
            $data['status'] = 1;

            if ($this->input->post('password'))
                $data['password'] = $this->input->post('password');

            $this->customer->editCustomer($this->customer->isLogged(), $data);
        }       

        redirect('account/info'); 
    }   
}