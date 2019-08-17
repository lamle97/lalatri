<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wishlists extends CI_Controller {
    public function __construct()
    {
	    parent::__construct();

	    $this->load->model('customer/customer');
	    $this->load->model('customer/wishlist');
	    $this->load->model('catalog/product');
    }	

    public function index()
    {
    	$data = array();

    	if (!$this->customer->isLogged()) {
            redirect('account/login', 'location');
        }

		$wishlists = $this->wishlist->get();
        $data['products'] = array();

		foreach ($wishlists as $wishlist) {
			$data['products'][] = $this->product->getProduct($wishlist['product_id']);
		}


    	$this->load->template('account/wishlists', $data);
    }

    public function add($product_id)
    {
        $data = array();

        if (!$this->customer->isLogged()) {
            redirect('account/login', 'location');
        }

        if ($product_id)
            $this->wishlist->add($product_id);

        redirect($this->agent->referrer());
    }

    public function delete($product_id)
    {
        $data = array();

        if (!$this->customer->isLogged()) {
            redirect('account/login', 'location');
        }

        if ($product_id)
            $this->wishlist->delete($product_id);
                    
        redirect($this->agent->referrer());
    }    
}