<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Model {
	public function addPayment($data) {
		$this->db->query("INSERT INTO {DB_PREFIX}payment SET name = '" . $this->db->escape_str($data['name']) . "', status = '" . (int)$data['status'] . "'");

		$payment_id = $this->db->insert_id();

		if (isset($data['method'])) {
			$this->db->query("UPDATE {DB_PREFIX}payment SET method = '" . $this->db->escape_str($data['method']) . "' WHERE payment_id = '" . (int)$payment_id . "'");
		}

		return $payment_id;
	}

	public function editPayment($payment_id, $data) {
		$this->db->query("UPDATE {DB_PREFIX}payment SET name = '" . $this->db->escape_str($data['name']) . "', status = '" . (int)$data['status'] . "' WHERE payment_id = '" . (int)$payment_id . "'");

		if (isset($data['method'])) {
			$this->db->query("UPDATE {DB_PREFIX}payment SET method = '" . $this->db->escape_str($data['method']) . "' WHERE payment_id = '" . (int)$payment_id . "'");
		}
	}

	public function deletePayment($payment_id) {
		$this->db->query("DELETE FROM {DB_PREFIX}payment WHERE payment_id = '" . (int)$payment_id . "'");
	}

	public function getPayment($payment_id) {
		$query = $this->db->query("SELECT * FROM {DB_PREFIX}payment WHERE payment_id = '" . (int)$payment_id . "'");

		return $query->row_array();
	}

	public function getPayments($data = array()) {
		$sql = "SELECT * FROM {DB_PREFIX}payment";

		if (!empty($data['filter_name'])) {
			$sql .= " WHERE name LIKE '" . $this->db->escape_str($data['filter_name']) . "%'";
		}

		$sql .= " ORDER BY name";

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

		return $query->result_array();
	}

	public function getTotalPayments() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM {DB_PREFIX}payment");

		return $query->row()->total;
	}
}