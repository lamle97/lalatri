<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('customer/customer');
        $this->load->model('system/city');
        $this->load->model('sales/order');
    }  

	public function index()
	{
		$data = array();

        if(!$this->customer->isLogged())
        {
            redirect('/account/login', 'location');
        }     

        $data['customer'] = $this->customer->getCustomer();
        $data['orders'] = $this->order->getOrderByCustomerId($this->customer->isLogged());

        if ($data['orders'] == null)
            $data['orders'] = array();


		$this->load->template('account/dashboard', $data);
	}    
}