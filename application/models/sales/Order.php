<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Model {
    public function __construct()
    {
	    parent::__construct();
	    $this->load->model('catalog/product');
    }

	public function addOrder($data) {
		$this->db->query("INSERT INTO {DB_PREFIX}order SET customer_id = '" . (int)$data['customer_id'] . "', payment_id = '" . (int)$data['payment_id'] . "', shipping_firstname = '" . $this->db->escape_str($data['shipping_firstname']) . "', shipping_lastname = '" . $this->db->escape_str($data['shipping_lastname']) . "', shipping_address = '" . $this->db->escape_str($data['shipping_address']) . "', shipping_telephone = '" . $this->db->escape_str($data['shipping_telephone']) . "', shipping_city_id = '" . (int)$data['shipping_city_id'] . "', shipping_zone_id = '" . (int)$data['shipping_zone_id'] . "', note = '" . $this->db->escape_str(strip_tags($data['note'])) . "', total = '" . (float)$data['total'] . "', status = '" . (int)$data['status'] . "', shipping_status = '" . (int)$data['shipping_status'] . "', ip = '" . $this->db->escape_str($this->input->ip_address()) . "', date_added = NOW(), date_modified = NOW()");

		$order_id = $this->db->insert_id();

		if (isset($data['products'])) {
			foreach ($data['products'] as $product) {
				$this->db->query("INSERT INTO {DB_PREFIX}order_product SET order_id = '" . (int)$order_id . "', product_option_id = '" . (int)$product['product_option_id'] . "', name = '" . $this->db->escape_str($product['name']) . "', model = '" . $this->db->escape_str($product['model']) . "', quantity = '" . (int)$product['quantity'] . "', price = '" . (float)$product['price'] . "', total = '" . (float)$product['total'] . "'");
				$this->db->query("UPDATE {DB_PREFIX}product_option SET quantity = quantity - '" . (int)$product['quantity'] . "' WHERE product_option_id = '" . (int)$product['product_option_id'] . "'");
			}
		}

		return $order_id;
	}

	public function editOrder($order_id, $data) {
		$this->db->query("UPDATE {DB_PREFIX}order SET customer_id = '" . (int)$data['customer_id'] . "', payment_id = '" . (int)$data['payment_id'] . "', shipping_firstname = '" . $this->db->escape_str($data['shipping_firstname']) . "', shipping_lastname = '" . $this->db->escape_str($data['shipping_lastname']) . "', shipping_address = '" . $this->db->escape_str($data['shipping_address']) . "', shipping_telephone = '" . $this->db->escape_str($data['shipping_telephone']) . "', shipping_city_id = '" . (int)$data['shipping_city_id'] . "', shipping_zone_id = '" . (int)$data['shipping_zone_id'] . "', note = '" . $this->db->escape_str(strip_tags($data['note'])) . "', total = '" . (float)$data['total'] . "', status = '" . (int)$data['status'] . "', shipping_status = '" . (int)$data['shipping_status'] . "', ip = '" . $this->db->escape_str($this->input->ip_address()) . "', date_modified = NOW() WHERE order_id ='" . (int)$order_id . "'");

		if (isset($data['products'])) {
			foreach ($data['products'] as $product) {
				$query = $this->db->query("SELECT quantity FROM {DB_PREFIX}order_product WHERE order_id = '" . (int)$order_id . "' AND product_option_id = '" . (int)$product['product_option_id'] . "'");
				$old_qty = $query->row()->quantity;
				$this->db->query("DELETE FROM {DB_PREFIX}order_product WHERE order_id = '" . (int)$order_id . "' AND product_option_id = '" . (int)$product['product_option_id'] . "'");
				$this->db->query("INSERT INTO {DB_PREFIX}order_product SET order_id = '" . (int)$order_id . "', product_option_id = '" . (int)$product['product_option_id'] . "', name = '" . $this->db->escape_str($product['name']) . "', model = '" . $this->db->escape_str($product['model']) . "', quantity = '" . (int)$product['quantity'] . "', price = '" . (float)$product['price'] . "', total = '" . (float)$product['total'] . "'");
				$this->db->query("UPDATE {DB_PREFIX}product_option SET quantity = quantity - '" . (int)$product['quantity'] - (int)$old_qty . "' WHERE product_option_id = '" . (int)$product['product_option_id'] . "'");	
			}
		}
	}	

	public function editOrderStatus($order_id, $data) {
		if (isset($data['status']))
			$this->db->query("UPDATE {DB_PREFIX}order SET status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE order_id ='" . (int)$order_id . "'");
		if (isset($data['shipping_status']))
			$this->db->query("UPDATE {DB_PREFIX}order SET shipping_status = '" . (int)$data['shipping_status'] . "', date_modified = NOW() WHERE order_id ='" . (int)$order_id . "'");
	}

	public function deleteOrder($order_id) {
		$this->db->query("DELETE FROM {DB_PREFIX}order WHERE order_id = '" . (int)$order_id . "'");
		$this->db->query("DELETE FROM {DB_PREFIX}order_product WHERE order_id = '" . (int)$order_id . "'");
	}		

	public function getOrder($order_id) {
		$order_query = $this->db->query("SELECT o.*, (SELECT ct.name FROM {DB_PREFIX}city ct WHERE ct.city_id = o.shipping_city_id) AS city, (SELECT z.name FROM {DB_PREFIX}zone z WHERE z.zone_id = o.shipping_zone_id) AS zone, CONCAT(o.shipping_firstname, ' ', o.shipping_lastname) AS customer FROM {DB_PREFIX}order o WHERE o.order_id = '" . (int)$order_id . "'");

		if ($order_query->num_rows()) {
			return $order_query->row_array();
		} else {
			return null;
		}
	}	

	public function getOrders($data = array()) {
		$sql = "SELECT order_id FROM {DB_PREFIX}order";

		if (isset($data['filter_status'])) {
			$sql .= " WHERE status = '" . (int)$data['filter_status'] . "'";
		} else {
			$sql .= " WHERE status >= '0'";
		}

		if (isset($data['filter_shipping_status'])) {
			$implode = array();

			$order_shipping_statuses = explode(',', $data['filter_shipping_status']);

			foreach ($order_shipping_statuses as $shipping_status) {
				$implode[] = "shipping_status = '" . (int)$shipping_status . "'";
			}

			if ($implode) {
				$sql .= " AND (" . implode(" OR ", $implode) . ")";
			}
		}

		if (!empty($data['filter_order_id'])) {
			$sql .= " AND order_id = '" . (int)$data['filter_order_id'] . "'";
		}

		if (!empty($data['filter_customer'])) {
			$sql .= " AND CONCAT(firstname, ' ', lastname) LIKE '%" . $this->db->escape($data['filter_customer']) . "%'";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		if (!empty($data['filter_date_modified'])) {
			$sql .= " AND DATE(date_modified) = DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
		}

		if (!empty($data['filter_date_start'])) {
			$sql .= " AND DATE(date_added) >= '" . $this->db->escape_str($data['filter_date_start']) . "'";
		}

		if (!empty($data['filter_date_end'])) {
			$sql .= " AND DATE(date_added) <= '" . $this->db->escape_str($data['filter_date_end']) . "'";
		}		

		if (!empty($data['filter_total'])) {
			$sql .= " AND total = '" . (float)$data['filter_total'] . "'";
		}

		$sort_data = array(
			'order_id',
			'customer',
			'status',
			'shipping_status',
			'date_added',
			'date_modified',
			'total'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY date_added";
		}

		if (isset($data['order']) && ($data['order'] == 'ASC')) {
			$sql .= " ASC";
		} else {
			$sql .= " DESC";
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

		$orders = array();

		foreach ($query->result_array() as $order) {
			$orders[] = $this->getOrder($order['order_id']);
		}

		return $orders;
	}

	public function getProductsOrder($order_id) {
		$order_query = $this->db->query("SELECT * FROM {DB_PREFIX}order_product WHERE order_id = '" . (int)$order_id . "'");

		if ($order_query->num_rows()) {
			return $order_query->result_array();
		} else {
			return null;
		}
	}	

	public function getOrderByCustomerId($customer_id) {
		$order_query = $this->db->query("SELECT o.*, (SELECT ct.name FROM {DB_PREFIX}city ct WHERE ct.city_id = o.shipping_city_id) AS city, (SELECT z.name FROM {DB_PREFIX}zone z WHERE z.zone_id = o.shipping_zone_id) AS zone FROM {DB_PREFIX}order o WHERE o.customer_id = '" . (int)$customer_id . "' ORDER BY o.date_added DESC");

		if ($order_query->num_rows()) {
			return $order_query->result_array();
		} else {
			return null;
		}
	}

	public function getTotalOrders($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM {DB_PREFIX}order";

		$implode = array();

		if (!empty($data['filter_status'])) {
			$implode[] = "status = '" . (int)$data['filter_status'] . "'";
		} else {
			$implode[] = "status >= '0'";
		}

		if (isset($data['filter_shipping_status'])) {
			$tmp = array();

			$order_shipping_statuses = explode(',', $data['filter_shipping_status']);

			foreach ($order_shipping_statuses as $shipping_status) {
				$tmp[] = "shipping_status = '" . (int)$shipping_status . "'";
			}

			if ($tmp) {
				$implode[] = "(" . implode(" OR ", $implode) . ")";
			}
		}

		if (!empty($data['filter_order_id'])) {
			$implode[] = "order_id = '" . (int)$data['filter_order_id'] . "'";
		}

		if (!empty($data['filter_customer'])) {
			$implode[] = "CONCAT(firstname, ' ', lastname) LIKE '%" . $this->db->escape($data['filter_customer']) . "%'";
		}

		if (!empty($data['filter_date_added'])) {
			$implode[] = "DATE(date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		if (!empty($data['filter_date_modified'])) {
			$implode[] = "DATE(date_modified) = DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
		}

		if (!empty($data['filter_date_start'])) {
			$implode[] = "DATE(date_added) >= '" . $this->db->escape_str($data['filter_date_start']) . "'";
		}

		if (!empty($data['filter_date_end'])) {
			$implode[] = "DATE(date_added) <= '" . $this->db->escape_str($data['filter_date_end']) . "'";
		}		

		if (!empty($data['filter_total'])) {
			$implode[] = "total = '" . (float)$data['filter_total'] . "'";
		}

		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}

		$query = $this->db->query($sql);

		return $query->row()->total;
	}				
}