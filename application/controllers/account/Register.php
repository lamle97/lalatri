<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('customer/customer');
    }    

	public function index()
	{
		$data = array();

        if($this->customer->isLogged())
        {
            redirect('/account', 'location');
        }                      

        if($this->input->post('register') && $this->validate())
        {
            $this->customer->login($this->input->post('email'), html_entity_decode($this->input->post('password'), ENT_QUOTES, 'UTF-8'));

        	redirect('/account', 'location');
        }

        if($this->session->userdata('error'))
        {
            $data['error'] = $this->session->userdata('error');
            $this->session->unset_userdata('error');
        } 

        $this->load->model('system/city');

        $data['citys'] = $this->city->getCitys();

		$this->load->template('account/register', $data);
	}

    public function validate() {
        $data['email'] = $this->input->post('email');
        $data['firstname'] = $this->input->post('firstname');
        $data['lastname'] = $this->input->post('lastname');
        $data['telephone'] = $this->input->post('telephone');
        $data['fax'] = $this->input->post('fax');
        $data['password'] = $this->input->post('password');
        $data['address_1'] = $this->input->post('address_1');
        $data['address_2'] = $this->input->post('address_2');
        $data['newsletter'] = $this->input->post('newsletter');
        $data['city_id'] = $this->input->post('city_id');
        $data['zone_id'] = $this->input->post('zone_id');
        $data['status'] = 1;       

        if (!$this->customer->addCustomer($data)) {
            $this->session->set_userdata('error','Email already exist, please try again');

            return false;
        }

        return true;
    }
}