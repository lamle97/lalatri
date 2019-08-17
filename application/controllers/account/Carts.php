<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carts extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        $this->load->model('customer/customer');
        $this->load->model('customer/cart');
    }   

    public function index()
    {
        $this->load->template('account/carts');
    }

    public function add($product_option_id)
    {
        $data = array();

        if ($product_option_id) {
            if ($this->input->get('quantity'))
                $this->cart->add($product_option_id, $this->input->get('quantity'));
            else
                $this->cart->add($product_option_id);
        }

        redirect($this->agent->referrer());
    }

    public function update()
    {
        if ($this->input->post('update_cart_action'))
        {
            $cart = $this->input->post('cart');
            foreach ($cart as $value) {
                $this->cart->update($value['product_option_id'], $value['quantity']);
            }
        }

        redirect($this->agent->referrer());
    }    

    public function delete($product_option_id)
    {
        $data = array();

        if ($product_option_id)
            $this->cart->delete($product_option_id);
                    
        redirect($this->agent->referrer());
    }    

    public function clear()
    {
        $this->cart->clear();
                    
        redirect($this->agent->referrer());
    }       
}