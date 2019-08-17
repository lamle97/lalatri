<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Model {
    public function __construct()
    {
	    parent::__construct();

	    $this->load->model('customer/customer');
	    $this->load->model('catalog/product');

	    $this->load->library('cart', NULL, 'tmp_cart');
    }

    public function get()
    {
    	if($this->customer->isLogged())
    	{
    		$query = $this->db->query("SELECT * FROM {DB_PREFIX}cart WHERE customer_id = '" . (int)$this->customer->isLogged() . "'");

    		$carts = array();
    		foreach ($query->result_array() as $value) {
    			$cart = $value;
    			$carts[] = $cart;
    		}
    		
    		return $carts;
    	}
    	else
    	{
    		$carts = array();
    		foreach ($this->tmp_cart->contents() as $value) {
    			$cart['cart_id'] = $value['rowid'];
    			$cart['product_option_id'] = $value['id'];
    			$cart['quantity'] = $value['qty'];
    			$carts[] = $cart;
    		}
    		
    		return $carts;
    	}
    	
    }

	public function add($product_option_id, $quantity = 1) 
	{
		$product_quantity = $this->product->getProductByProductOptionId($product_option_id)['quantity'];
		$products = $this->get();
		foreach ($products as $product) {
			$cart_quantity = $product['quantity'] + $quantity;
			if ($product['product_option_id'] == $product_option_id && $product_quantity < $cart_quantity)
				return false;
		}
		if ($product_quantity < $quantity)
			return false;

		if($this->customer->isLogged())
    	{
    		$this->tmp_cart->destroy();
    		
			$query = $this->db->query("SELECT COUNT(*) AS total FROM {DB_PREFIX}cart WHERE customer_id = '" . (int)$this->customer->isLogged() . "' AND product_option_id = '" . (int)$product_option_id . "'");

			if (!$query->row()->total) {
				$this->db->query("INSERT {DB_PREFIX}cart SET customer_id = '" . (int)$this->customer->isLogged() . "', product_option_id = '" . (int)$product_option_id . "', quantity = '" . (int)$quantity . "', date_added = NOW()");
			} else {
				$this->db->query("UPDATE {DB_PREFIX}cart SET quantity = (quantity + " . (int)$quantity . ") WHERE customer_id = '" . (int)$this->customer->isLogged() . "' AND product_option_id = '" . (int)$product_option_id . "'");
			}
		}
		else
		{
			$data = array(
			        'id'      => $product_option_id,
			        'qty'     => $quantity,
			        'price'   => 1,
			        'name'    => $product_option_id
			);
        	$this->tmp_cart->insert($data);
		}

		return true;
	}

	public function update($product_option_id, $quantity = 1) 
	{
		$product_quantity = $this->product->getProductByProductOptionId($product_option_id)['quantity'];
		$products = $this->get();
		foreach ($products as $product) {
			$cart_quantity = $product['quantity'] + $quantity;
			if ($product['product_option_id'] == $product_option_id && $product_quantity < $cart_quantity)
				return false;
		}
		if ($product_quantity < $quantity)
			return false;

		if($this->customer->isLogged())
    	{		
			$this->db->query("UPDATE {DB_PREFIX}cart SET quantity = '" . (int)$quantity . "' WHERE product_option_id = '" . (int)$product_option_id . "' AND customer_id = '" . (int)$this->customer->isLogged() . "'");
		}
		else
		{
	        foreach($this->tmp_cart->contents() as $item){
	            if($item['id'] == $product_option_id){
	                $data = array("rowid" => $item['rowid'], "qty" => $quantity);
	                $this->tmp_cart->update($data);
	            }
	        }
	        
		}

		return true;
	}

	public function delete($product_option_id) {
		if($this->customer->isLogged())
    	{		
			$this->db->query("DELETE FROM {DB_PREFIX}cart WHERE product_option_id = '" . (int)$product_option_id . "' AND customer_id = '" . (int)$this->customer->isLogged() . "'");
		}
		else
		{
	        foreach($this->tmp_cart->contents() as $item){
	            if($item['id'] == $product_option_id){
					$this->tmp_cart->remove($item['rowid']);
	            }
	        }			
		}
	}

	public function clear() {
		if($this->customer->isLogged())
    	{			
			$this->db->query("DELETE FROM {DB_PREFIX}cart WHERE customer_id = '" . (int)$this->customer->isLogged() . "'");
		}
		else
		{
			$this->tmp_cart->destroy();
		}
	}

	public function total() 
	{
		$this->load->model('catalog/product');
		$total = 0;
		$cart = $this->get();

		foreach ($cart as $value) {
			$product = $this->product->getProductByProductOptionId($value['product_option_id']);

			if ($product['discount'] != $product['price'])
				$total += $product['discount']*$value['quantity'];
			else
				$total += $product['price']*$value['quantity'];
		}

		return $total;
	}	

	public function total_items() 
	{
		$total = 0;
		$cart = $this->get();

		foreach ($cart as $value) {
			$total += $value['quantity'];
		}

		return $total;
	}	
}