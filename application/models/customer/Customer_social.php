<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_social extends CI_Model {
	public function addCustomer($data) {
		$check = $this->getCustomerByEmail($data['email']);

		if (!empty($data['social_id']) && !empty($data['network'])) {
			$check_social = $this->db->query("SELECT * FROM {DB_PREFIX}customer_social WHERE " . $this->db->escape_str($data['network']) . "_id = '" . $this->db->escape_str($data['social_id']) . "'");
			if ($check_social->num_rows())
				return false;
		}

		if ($check['customer_id'])
			return false;

		if (isset($data['password']))
			$password = $data['password'];
		else
			$password = $data['social_id'];

		$this->db->query("INSERT INTO {DB_PREFIX}customer SET firstname = '" . $this->db->escape_str($data['firstname']) . "', lastname = '" . $this->db->escape_str($data['lastname']) . "', email = '" . $this->db->escape_str($data['email']) . "', password = '" . $this->db->escape_str($password) . "', status = '1', date_added = NOW()");

		$customer_id = $this->db->insert_id();

		if (!empty($data['social_id']) && !empty($data['network']))
			$this->addSocial($customer_id, $data['social_id'], $data['network']);
	
		return $customer_id;
	}	

	public function addSocial($customer_id, $social_id, $network) {
		$check_social = $this->db->query("SELECT * FROM {DB_PREFIX}customer_social WHERE " . $this->db->escape_str($network) . "_id = '" . $this->db->escape_str($social_id) . "'");
		
		if ($check_social->num_rows())	
			return false;	

		$social_query = $this->db->query("SELECT customer_id FROM {DB_PREFIX}customer_social WHERE customer_id = '" . (int)$customer_id . "'");

		if ($social_query->num_rows()) {
			$this->db->query("UPDATE {DB_PREFIX}customer_social SET " . $this->db->escape_str($network) . "_id = '" . $this->db->escape_str($social_id) . "' WHERE customer_id = '" . (int)$customer_id . "'");
		} else {
			$this->db->query("INSERT INTO {DB_PREFIX}customer_social SET customer_id = '" . (int)$customer_id . "', " . $this->db->escape_str($network) . "_id = '" . $this->db->escape_str($social_id) . "'");
		}

		return true;
	}

	public function login($social_id, $network) {
		$customer_query = $this->db->query("SELECT cs.customer_id FROM {DB_PREFIX}customer_social cs JOIN {DB_PREFIX}customer c ON (c.customer_id = cs.customer_id) WHERE cs." . $this->db->escape_str($network) . "_id = '" . $this->db->escape_str($social_id) . "' AND c.status = '1'");

		if ($customer_query->num_rows())
		{		
			$customer_id = $customer_query->row_array()['customer_id'];
			$this->session->set_userdata('customer_id', $customer_id);
			$this->db->query("UPDATE {DB_PREFIX}customer SET ip = '" . $this->db->escape_str($this->input->ip_address()) . "' WHERE customer_id = '" . (int)$customer_id . "'");

			return $customer_id;
		}
		else
		{
			return false;
		}

	}

	public function getCustomerByEmail($email) {
		$query = $this->db->query("SELECT DISTINCT * FROM {DB_PREFIX}customer WHERE LCASE(email) = '" . $this->db->escape_str(strtolower($email)) . "'");

		$customer = $query->row_array();
		unset($customer['password']);

		return $customer;
	}			
}