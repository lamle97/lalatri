<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wishlist extends CI_Model {
    public function __construct()
    {
	    parent::__construct();

	    $this->load->model('customer/customer');

    }

	public function add($product_id) {
		$this->db->query("DELETE FROM {DB_PREFIX}customer_wishlist WHERE customer_id = '" . (int)$this->customer->isLogged() . "' AND product_id = '" . (int)$product_id . "'");

		$this->db->query("INSERT INTO {DB_PREFIX}customer_wishlist SET customer_id = '" . (int)$this->customer->isLogged() . "', product_id = '" . (int)$product_id . "', date_added = NOW()");
	} 

	public function delete($product_id) {
		$this->db->query("DELETE FROM {DB_PREFIX}customer_wishlist WHERE customer_id = '" . (int)$this->customer->isLogged() . "' AND product_id = '" . (int)$product_id . "'");
	}

	public function clear() {
		$this->db->query("DELETE FROM {DB_PREFIX}customer_wishlist WHERE customer_id = '" . (int)$this->customer->isLogged() . "'");
	}	

	public function get() {
        $query = $this->db->query("SELECT * FROM {DB_PREFIX}customer_wishlist WHERE customer_id = '" . (int)$this->customer->isLogged() . "'");

		return $query->result_array();
	}	   

	public function checkWished($product_id) {
		$query = $this->db->query("SELECT * FROM {DB_PREFIX}customer_wishlist WHERE customer_id = '" . (int)$this->customer->isLogged() . "' AND product_id = '" . (int)$product_id . "'");
		if ($query->num_rows())
			return true;
		else
			return false;
	}
}