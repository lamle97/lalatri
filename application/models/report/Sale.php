<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sale extends CI_Model {
	public function getTotalSales($data = array()) {
		$sql = "SELECT COALESCE(SUM(total),0) AS total FROM {DB_PREFIX}order WHERE status > '0'";

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(date_added) = DATE('" . $this->db->escape_str($data['filter_date_added']) . "')";
		}

		$query = $this->db->query($sql);

		return $query->row()->total;
	}

	public function getTotalOrdersByDay() {
		$order_data = array();

		for ($i = 0; $i < 24; $i++) {
			$order_data[$i] = array(
				'hour'  => $i,
				'total' => 0
			);
		}

		$query = $this->db->query("SELECT COUNT(*) AS total, HOUR(date_added) AS hour FROM {DB_PREFIX}order WHERE status > 0 AND DATE(date_added) = DATE(NOW()) GROUP BY HOUR(date_added) ORDER BY date_added ASC");

		foreach ($query->result_array() as $result) {
			$order_data[$result['hour']] = array(
				'hour'  => $result['hour'],
				'total' => $result['total']
			);
		}

		return $order_data;
	}

	public function getTotalOrdersByWeek() {
		$order_data = array();

		$date_start = strtotime('-' . date('w') . ' days');

		for ($i = 0; $i < 7; $i++) {
			$date = date('Y-m-d', $date_start + ($i * 86400));

			$order_data[date('w', strtotime($date))] = array(
				'day'   => date('D', strtotime($date)),
				'total' => 0
			);
		}

		$query = $this->db->query("SELECT COUNT(*) AS total, date_added FROM {DB_PREFIX}order WHERE status > 0 AND DATE(date_added) >= DATE('" . $this->db->escape_str(date('Y-m-d', $date_start)) . "') GROUP BY DAYNAME(date_added)");

		foreach ($query->result_array() as $result) {
			$order_data[date('w', strtotime($result['date_added']))] = array(
				'day'   => date('D', strtotime($result['date_added'])),
				'total' => $result['total']
			);
		}

		return $order_data;
	}

	public function getTotalOrdersByMonth() {
		$order_data = array();

		for ($i = 1; $i <= date('t'); $i++) {
			$date = date('Y') . '-' . date('m') . '-' . $i;

			$order_data[date('j', strtotime($date))] = array(
				'day'   => date('d', strtotime($date)),
				'total' => 0
			);
		}

		$query = $this->db->query("SELECT COUNT(*) AS total, date_added FROM {DB_PREFIX}order WHERE status > 0 AND DATE(date_added) >= '" . $this->db->escape_str(date('Y') . '-' . date('m') . '-1') . "' GROUP BY DATE(date_added)");

		foreach ($query->result_array() as $result) {
			$order_data[date('j', strtotime($result['date_added']))] = array(
				'day'   => date('d', strtotime($result['date_added'])),
				'total' => $result['total']
			);
		}

		return $order_data;
	}

	public function getTotalOrdersByYear() {
		$order_data = array();

		for ($i = 1; $i <= 12; $i++) {
			$order_data[$i] = array(
				'month' => date('M', mktime(0, 0, 0, $i)),
				'total' => 0
			);
		}

		$query = $this->db->query("SELECT COUNT(*) AS total, date_added FROM {DB_PREFIX}order WHERE status > 0 AND YEAR(date_added) = YEAR(NOW()) GROUP BY MONTH(date_added)");

		foreach ($query->result_array() as $result) {
			$order_data[date('n', strtotime($result['date_added']))] = array(
				'month' => date('M', strtotime($result['date_added'])),
				'total' => $result['total']
			);
		}

		return $order_data;
	}

	public function getOrders($data = array()) {
		$sql = "SELECT MIN(o.date_added) AS date_start, MAX(o.date_added) AS date_end, COUNT(*) AS orders, SUM((SELECT SUM(op.quantity) FROM {DB_PREFIX}order_product op WHERE op.order_id = o.order_id GROUP BY op.order_id)) AS products, SUM(o.total) AS total FROM {DB_PREFIX}order o";

		if (isset($data['filter_status'])) {
			$sql .= " WHERE o.status = '" . (int)$data['filter_status'] . "'";
		} else {
			$sql .= " WHERE o.status >= '0'";
		}

		if (isset($data['filter_shipping_status'])) {
			$implode = array();

			$order_shipping_statuses = explode(',', $data['filter_shipping_status']);

			foreach ($order_shipping_statuses as $shipping_status) {
				$implode[] = "o.shipping_status = '" . (int)$shipping_status . "'";
			}

			if ($implode) {
				$sql .= " AND (" . implode(" OR ", $implode) . ")";
			}
		}

		if (!empty($data['filter_date_start'])) {
			$sql .= " AND DATE(o.date_added) >= '" . $this->db->escape_str($data['filter_date_start']) . "'";
		}

		if (!empty($data['filter_date_end'])) {
			$sql .= " AND DATE(o.date_added) <= '" . $this->db->escape_str($data['filter_date_end']) . "'";
		}

		if (!empty($data['filter_group'])) {
			$group = $data['filter_group'];
		} else {
			$group = 'week';
		}

		switch($group) {
			case 'day';
				$sql .= " GROUP BY YEAR(o.date_added), MONTH(o.date_added), DAY(o.date_added)";
				break;
			default:
			case 'week':
				$sql .= " GROUP BY YEAR(o.date_added), WEEK(o.date_added)";
				break;
			case 'month':
				$sql .= " GROUP BY YEAR(o.date_added), MONTH(o.date_added)";
				break;
			case 'year':
				$sql .= " GROUP BY YEAR(o.date_added)";
				break;
		}

		$sql .= " ORDER BY o.date_added DESC";

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

	public function getTotalOrders($data = array()) {
		if (!empty($data['filter_group'])) {
			$group = $data['filter_group'];
		} else {
			$group = 'week';
		}

		switch($group) {
			case 'day';
				$sql = "SELECT COUNT(DISTINCT YEAR(date_added), MONTH(date_added), DAY(date_added)) AS total FROM {DB_PREFIX}order";
				break;
			default:
			case 'week':
				$sql = "SELECT COUNT(DISTINCT YEAR(date_added), WEEK(date_added)) AS total FROM {DB_PREFIX}order";
				break;
			case 'month':
				$sql = "SELECT COUNT(DISTINCT YEAR(date_added), MONTH(date_added)) AS total FROM {DB_PREFIX}order";
				break;
			case 'year':
				$sql = "SELECT COUNT(DISTINCT YEAR(date_added)) AS total FROM {DB_PREFIX}order";
				break;
		}

		if (!empty($data['filter_status'])) {
			$sql .= " WHERE status = '" . (int)$data['filter_status'] . "'";
		} else {
			$sql .= " WHERE status > '0'";
		}

		if (!empty($data['filter_date_start'])) {
			$sql .= " AND DATE(date_added) >= '" . $this->db->escape_str($data['filter_date_start']) . "'";
		}

		if (!empty($data['filter_date_end'])) {
			$sql .= " AND DATE(date_added) <= '" . $this->db->escape_str($data['filter_date_end']) . "'";
		}

		$query = $this->db->query($sql);

		return $query->row()->total;
	}

	public function getTotalCustomersByDay() {
		$customer_data = array();

		for ($i = 0; $i < 24; $i++) {
			$customer_data[$i] = array(
				'hour'  => $i,
				'total' => 0
			);
		}

		$query = $this->db->query("SELECT COUNT(*) AS total, HOUR(date_added) AS hour FROM {DB_PREFIX}customer WHERE DATE(date_added) = DATE(NOW()) GROUP BY HOUR(date_added) ORDER BY date_added ASC");

		foreach ($query->result_array() as $result) {
			$customer_data[$result['hour']] = array(
				'hour'  => $result['hour'],
				'total' => $result['total']
			);
		}

		return $customer_data;
	}

	public function getTotalCustomersByWeek() {
		$customer_data = array();

		$date_start = strtotime('-' . date('w') . ' days');

		for ($i = 0; $i < 7; $i++) {
			$date = date('Y-m-d', $date_start + ($i * 86400));

			$order_data[date('w', strtotime($date))] = array(
				'day'   => date('D', strtotime($date)),
				'total' => 0
			);
		}

		$query = $this->db->query("SELECT COUNT(*) AS total, date_added FROM {DB_PREFIX}customer WHERE DATE(date_added) >= DATE('" . $this->db->escape_str(date('Y-m-d', $date_start)) . "') GROUP BY DAYNAME(date_added)");

		foreach ($query->result_array() as $result) {
			$customer_data[date('w', strtotime($result['date_added']))] = array(
				'day'   => date('D', strtotime($result['date_added'])),
				'total' => $result['total']
			);
		}

		return $customer_data;
	}

	public function getTotalCustomersByMonth() {
		$customer_data = array();

		for ($i = 1; $i <= date('t'); $i++) {
			$date = date('Y') . '-' . date('m') . '-' . $i;

			$customer_data[date('j', strtotime($date))] = array(
				'day'   => date('d', strtotime($date)),
				'total' => 0
			);
		}

		$query = $this->db->query("SELECT COUNT(*) AS total, date_added FROM {DB_PREFIX}customer WHERE DATE(date_added) >= '" . $this->db->escape_str(date('Y') . '-' . date('m') . '-1') . "' GROUP BY DATE(date_added)");

		foreach ($query->result_array() as $result) {
			$customer_data[date('j', strtotime($result['date_added']))] = array(
				'day'   => date('d', strtotime($result['date_added'])),
				'total' => $result['total']
			);
		}

		return $customer_data;
	}

	public function getTotalCustomersByYear() {
		$customer_data = array();

		for ($i = 1; $i <= 12; $i++) {
			$customer_data[$i] = array(
				'month' => date('M', mktime(0, 0, 0, $i)),
				'total' => 0
			);
		}

		$query = $this->db->query("SELECT COUNT(*) AS total, date_added FROM {DB_PREFIX}customer WHERE YEAR(date_added) = YEAR(NOW()) GROUP BY MONTH(date_added)");

		foreach ($query->result_array() as $result) {
			$customer_data[date('n', strtotime($result['date_added']))] = array(
				'month' => date('M', strtotime($result['date_added'])),
				'total' => $result['total']
			);
		}

		return $customer_data;
	}	
}