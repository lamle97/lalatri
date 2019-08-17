<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        $this->load->model('catalog/product');
        $this->load->model('system/city');
        $this->load->model('sales/payment');
        $this->load->model('customer/cart');
    }   

    public function index()
    {
		$data['payment'] = $this->payment->getPayments();
        $data['citys'] = $this->city->getCitys();

        if ($this->cart->total_items() == 0) {
            redirect('/', 'location');
        }

        $this->load->template('account/checkout', $data);
    } 
}