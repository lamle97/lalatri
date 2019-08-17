<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('customer/customer');
        $this->load->model('customer/cart');
        $this->load->model('sales/order');
        $this->load->model('sales/payment');
    }  

	public function index()
	{
		$data = array();

        if(!$this->customer->isLogged())
        {
            redirect('/account/login', 'location');
        } 

        $data['orders'] = $this->order->getOrderByCustomerId($this->customer->isLogged());
        if ($data['orders'] == null)
            $data['orders'] = array();        

		$this->load->template('account/orders', $data);
	}  

    public function view($order_id)  
    {
        $data['order'] = $this->order->getOrder($order_id);

        if ($data['order']['customer_id'] != $this->customer->isLogged())
            redirect('/account', 'location');

        $data['order']['payment'] = $this->payment->getPayment($data['order']['payment_id']);
        $data['order']['payment']['method'] = str_replace(array('{order_id}', '{total}', '{paid}'), array($order_id.'-'.$data['order']['customer_id'], $data['order']['total'], base_url('account/orders/paid/'.$order_id)), $data['order']['payment']['method']);
        $data['order']['products'] = $this->order->getProductsOrder($order_id);

        $this->load->template('account/view_order', $data);
    }

    public function add()
    {
        $this->load->model('catalog/product');

        if ($this->input->post('checkout'))
        {
            $data['email'] = $this->input->post('email');
            $data['note'] = $this->input->post('note');
            $data['payment_id'] = $this->input->post('payment_id');
            $data['firstname'] = $data['shipping_firstname'] = $this->input->post('shipping_firstname');
            $data['lastname'] = $data['shipping_lastname'] = $this->input->post('shipping_lastname');
            $data['telephone'] = $data['shipping_telephone'] = $this->input->post('shipping_telephone');
            $data['address_1'] = $data['shipping_address'] = $this->input->post('shipping_address');
            $data['city_id'] = $data['shipping_city_id'] = $this->input->post('shipping_city_id');
            $data['zone_id'] = $data['shipping_zone_id'] = $this->input->post('shipping_zone_id');
            $data['status'] = $data['shipping_status'] = 0;

            $customer_id = $this->cache->file->get('customer.' . $this->input->get('token'));

            if ($customer_id)
            {
                $this->customer->setCustomer($customer_id);
            }            

            if(!$this->customer->isLogged())
            {
                $data['password'] = $data['telephone'];
                $data['fax'] = $data['address_2'] = null;
                $data['newsletter'] = $data['status'] = 1;
                $data['customer_id'] = $this->customer->addCustomer($data);
            } 
            else
            {
                $data['customer_id'] = $this->customer->isLogged();
            }

            $data['products'] = $this->cart->get();
            $data['total'] = $this->cart->total();
            foreach ($data['products'] as $key => $value) {
                $data['products'][$key] = $this->product->getProductByProductOptionId($value['product_option_id']);
                if ($value['quantity'] > $data['products'][$key]['quantity'])  
                    redirect('account', 'location');
                $data['products'][$key]['quantity'] =  $value['quantity'];
                $data['products'][$key]['price'] = $data['products'][$key]['discount'];
                $data['products'][$key]['total'] =  $data['products'][$key]['quantity']*$data['products'][$key]['price'];
            }

            $this->order->addOrder($data);
            $this->cart->clear();

            $this->load->model('system/setting');
            $this->load->library('email', $this->setting->getSettingValue('shop_mail_config'));

            $this->email->from($this->setting->getSettingValue('shop_mail_config')['smtp_user'], $this->setting->getSettingValue('shop_name'));
            $this->email->to($data['email']);
            $this->email->subject($this->setting->getSettingValue('shop_mail_order')['subject']);
            $this->email->message($this->setting->getSettingValue('shop_mail_order')['content']);
            $this->email->set_newline("\r\n");  
            $this->email->send();             
        }
        redirect('account', 'location');
    }

    public function paid($order_id)
    {
        $this->order->editOrderStatus($order_id, array('status' => 1));
        redirect('account', 'location');
    }
}