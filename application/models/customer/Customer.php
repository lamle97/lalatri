<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Model {
	private $customer;

	public function __construct() {
		parent::__construct();
		if ($this->session->has_userdata('customer_id')) {
			$customer_query = $this->db->query("SELECT * FROM {DB_PREFIX}customer WHERE customer_id = '" . (int)$this->session->userdata('customer_id') . "' AND status = '1'");

			if ($customer_query->num_rows()) {
				$this->customer = $customer_query->row_array();

				$this->db->query("UPDATE {DB_PREFIX}customer SET ip = '" . $this->db->escape_str($this->input->ip_address()) . "' WHERE customer_id = '" . (int)$this->customer['customer_id'] . "'");

			} else {
				$this->logout();
			}
		}
	}

	public function setCustomer($token) {
		$customer_query = $this->db->query("SELECT * FROM {DB_PREFIX}customer WHERE customer_id = '" . (int)$token . "' AND status = '1'");

		if ($customer_query->num_rows()) {
			$this->customer = $customer_query->row_array();

			$this->db->query("UPDATE {DB_PREFIX}customer SET ip = '" . $this->db->escape_str($this->input->ip_address()) . "' WHERE customer_id = '" . (int)$this->customer['customer_id'] . "'");

		}		
	}

	public function addCustomer($data) {
		$check = $this->getCustomerByEmail($data['email']);

		if ($check['customer_id'])
			return false;

		$this->db->query("INSERT INTO {DB_PREFIX}customer SET firstname = '" . $this->db->escape_str($data['firstname']) . "', lastname = '" . $this->db->escape_str($data['lastname']) . "', email = '" . $this->db->escape_str($data['email']) . "', telephone= '" . $this->db->escape_str($data['telephone']) . "', fax = '" . $this->db->escape_str($data['fax']) . "', password = '" . $this->db->escape_str(md5($data['password'])) . "', address_1 = '" . $this->db->escape_str($data['address_1']) . "', address_2 = '" . $this->db->escape_str($data['address_2']) . "', newsletter = '" . (int)$data['newsletter'] . "', city_id = '" . (int)$data['city_id'] . "', zone_id = '" . (int)$data['zone_id'] . "', status = '" . (int)$data['status'] . "', date_added = NOW()");
	
		return $this->db->insert_id();
	}

	public function editCustomer($customer_id, $data) {
		$check = $this->getCustomerByEmail($data['email']);

		if ($check['customer_id'] != $customer_id)
			return false;

		$this->db->query("UPDATE {DB_PREFIX}customer SET firstname = '" . $this->db->escape_str($data['firstname']) . "', lastname = '" . $this->db->escape_str($data['lastname']) . "', email = '" . $this->db->escape_str($data['email']) . "', telephone= '" . $this->db->escape_str($data['telephone']) . "', fax = '" . $this->db->escape_str($data['fax']) . "', address_1 = '" . $this->db->escape_str($data['address_1']) . "', address_2 = '" . $this->db->escape_str($data['address_2']) . "', newsletter = '" . (int)$data['newsletter'] . "', city_id = '" . (int)$data['city_id'] . "', zone_id = '" . (int)$data['zone_id'] . "', status = '" . (int)$data['status'] . "' WHERE customer_id = '" . (int)$customer_id . "'");

		if ($data['password']) {
			$this->db->query("UPDATE {DB_PREFIX}customer SET password = '" . $this->db->escape_str(md5($data['password'])) . "' WHERE customer_id = '" . (int)$customer_id . "'");
		}
	}

	public function editPassword($customer_id, $password) {
		$this->db->query("UPDATE {DB_PREFIX}customer SET password = '" . $this->db->escape_str(md5($password)) . "' WHERE customer_id = '" . (int)$customer_id . "'");
	}	

	public function deleteCustomer($customer_id) {
		$this->db->query("DELETE FROM {DB_PREFIX}customer WHERE customer_id = '" . (int)$customer_id . "'");
	}

	public function login($email, $password) {
		$customer_query = $this->db->query("SELECT * FROM {DB_PREFIX}customer WHERE LOWER(email) = '" . $this->db->escape_str(mb_strtolower($email)) . "' AND (password = '" . $this->db->escape_str(md5($password)) . "' OR password = '" . $this->db->escape_str($password) . "') AND status = '1'");

		if ($customer_query->num_rows()) {
			$this->customer = $customer_query->row_array();

			$this->session->set_userdata('customer_id', $this->customer['customer_id']);

			$this->db->query("UPDATE {DB_PREFIX}customer SET ip = '" . $this->db->escape_str($this->input->ip_address()) . "' WHERE customer_id = '" . (int)$this->customer['customer_id'] . "'");

			return $this->customer['customer_id'];
		} else {
			return false;
		}
	}

	public function logout() {
		$this->session->unset_userdata('customer_id');

		$this->customer = null;
	}

	public function getCustomers($data = array()) {
		$sql = "SELECT * FROM {DB_PREFIX}customer WHERE 1";

		if (!empty($data['filter_name'])) {
			$sql .= " AND CONCAT(firstname, ' ', lastname) LIKE '%" . $this->db->escape_str($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_email'])) {
			$sql .= " AND email LIKE '%" . $this->db->escape_str($data['filter_name']) . "%'";
		}		

		if (isset($data['filter_newsletter']) && !is_null($data['filter_newsletter'])) {
			$sql .= " AND newsletter = '" . (int)$data['filter_newsletter'] . "'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND status = '" . (int)$data['filter_status'] . "'";
		}		

		$sql .= " ORDER BY email";

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		$customers = array();

		foreach ($query->result_array() as $customer) {
			$customers[] = $this->getCustomer($customer['customer_id']);
		}

		return $customers;
	}

	public function isLogged() {
		return $this->customer['customer_id'];
	}

	public function getCustomer($customer_id = 0) {
		if ($customer_id == 0)
			$customer_id = $this->customer['customer_id'];		

		$query = $this->db->query("SELECT *, (SELECT ct.name FROM {DB_PREFIX}city ct WHERE ct.city_id = c.city_id) AS city, (SELECT z.name FROM {DB_PREFIX}zone z WHERE z.zone_id = c.zone_id) AS zone FROM {DB_PREFIX}customer c WHERE customer_id = '" . (int)$customer_id . "'");

		$customer = $query->row_array();
		unset($customer['password']);

		return $customer;
	}

	public function getCustomerByEmail($email) {
		$query = $this->db->query("SELECT DISTINCT * FROM {DB_PREFIX}customer WHERE LCASE(email) = '" . $this->db->escape_str(strtolower($email)) . "'");

		$customer = $query->row_array();
		unset($customer['password']);

		return $customer;
	}	

	public function getTotalCustomers($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM {DB_PREFIX}customer";

		$implode = array();
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$implode[] = "status = '" . (int)$data['filter_status'] . "'";
		}		

		if (!empty($data['filter_date_added'])) {
			$implode[] = "DATE(date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}

		$query = $this->db->query($sql);

		return $query->row()->total;
	}		
}