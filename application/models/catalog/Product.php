<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Model {
	public function addProduct($data) {
		$this->db->query("INSERT INTO {DB_PREFIX}product SET category_id = '" . (int)$data['category_id'] . "', name = '" . $this->db->escape_str($data['name']) . "', description = '" . $this->db->escape_str($data['description']) . "', description_short = '" . $this->db->escape_str($data['description_short']) . "', description_technical = '" . $this->db->escape_str($data['description_technical']) . "', tag = '" . $this->db->escape_str($data['tag']) . "', meta_title = '" . $this->db->escape_str($data['meta_title']) . "', manufacturer_id = '" . (int)$data['manufacturer_id'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW(), date_added = NOW()");

		$product_id = $this->db->insert_id();

		foreach ($data['options'] as $option) {
			$discount = ($option['discount'] != null) ? $option['discount'] : $option['price'];
			$this->db->query("INSERT INTO {DB_PREFIX}product_option SET product_id= '" . (int)$product_id . "', option_name = '" . $this->db->escape_str($option['option_name']) . "', model = '" . $this->db->escape_str($option['model']) . "', quantity = '" . (int)$option['quantity'] . "', price = '" . (float)$option['price'] . "', discount = '" . (float)$discount . "', sort_order = '" . (int)$option['sort_order'] . "', status = '" . (int)$option['status'] . "'");
		}

		if (isset($data['images'])) {
			foreach ($data['images'] as $image) {
				$this->db->query("INSERT INTO {DB_PREFIX}product_image SET product_id = '" . (int)$product_id . "', image = '" . $this->db->escape_str($image['image']) . "', sort_order = '" . (int)$image['sort_order'] . "'");
			}
		}			

		if ($data['keyword']) {
			$this->db->query("INSERT INTO {DB_PREFIX}url_alias SET query = 'product_id=" . (int)$product_id . "', keyword = '" . $this->db->escape_str($data['keyword']) . "'");
		}

		return $product_id;
	}	

	public function editProduct($product_id, $data) {
		$this->db->query("UPDATE {DB_PREFIX}product SET category_id = '" . (int)$data['category_id'] . "', name = '" . $this->db->escape_str($data['name']) . "', description = '" . $this->db->escape_str($data['description']) . "', description_short = '" . $this->db->escape_str($data['description_short']) . "', description_technical = '" . $this->db->escape_str($data['description_technical']) . "', tag = '" . $this->db->escape_str($data['tag']) . "', meta_title = '" . $this->db->escape_str($data['meta_title']) . "', manufacturer_id = '" . (int)$data['manufacturer_id'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE product_id = '" . (int)$product_id . "'");

		$this->db->query("DELETE FROM {DB_PREFIX}product_option WHERE product_id = '" . (int)$product_id . "'");

		foreach ($data['options'] as $option) {
			$discount = ($option['discount'] != null) ? $option['discount'] : $option['price'];
			$this->db->query("INSERT INTO {DB_PREFIX}product_option SET product_id= '" . (int)$product_id . "', option_name = '" . $this->db->escape_str($option['option_name']) . "', model = '" . $this->db->escape_str($option['model']) . "', quantity = '" . (int)$option['quantity'] . "', price = '" . (float)$option['price'] . "', discount = '" . (float)$discount . "', sort_order = '" . (int)$option['sort_order'] . "', status = '" . (int)$option['status'] . "'");
		}	

		$this->db->query("DELETE FROM {DB_PREFIX}product_image WHERE product_id = '" . (int)$product_id . "'");

		if (isset($data['images'])) {
			foreach ($data['images'] as $image) {
				$this->db->query("INSERT INTO {DB_PREFIX}product_image SET product_id = '" . (int)$product_id . "', image = '" . $this->db->escape_str($image['image']) . "', sort_order = '" . (int)$image['sort_order'] . "'");
			}
		}				

		$this->db->query("DELETE FROM {DB_PREFIX}url_alias WHERE query = 'product_id=" . (int)$product_id . "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO {DB_PREFIX}url_alias SET query = 'product_id=" . (int)$product_id . "', keyword = '" . $this->db->escape_str($data['keyword']) . "'");
		}
	}

	public function deleteProduct($product_id) {
		$this->db->query("DELETE FROM {DB_PREFIX}product WHERE product_id = '" . (int)$product_id . "'");

		$this->db->query("DELETE FROM {DB_PREFIX}product_image WHERE product_id = '" . (int)$product_id . "'");

		$this->db->query("DELETE FROM {DB_PREFIX}product_option WHERE product_id = '" . (int)$product_id . "'");		

		$this->db->query("DELETE FROM {DB_PREFIX}url_alias WHERE query = 'product_id=" . (int)$product_id . "'");
	}		

	public function getProduct($product_id) {
		$query = $this->db->query("SELECT DISTINCT p.*, pi.image, po.*, (SELECT keyword FROM {DB_PREFIX}url_alias WHERE query = 'product_id=" . (int)$product_id . "') AS keyword, (SELECT name FROM {DB_PREFIX}manufacturer m WHERE p.manufacturer_id = m.manufacturer_id) AS manufacturer, (SELECT name FROM {DB_PREFIX}category c WHERE c.category_id = p.category_id) AS category, (SELECT AVG(rating) FROM {DB_PREFIX}review r WHERE r.product_id = p.product_id) AS rating, p.sort_order as product_sort FROM {DB_PREFIX}product p LEFT JOIN {DB_PREFIX}product_option po ON (p.product_id = po.product_id AND po.status = '1' AND po.sort_order = '0') LEFT JOIN {DB_PREFIX}product_image pi ON (pi.product_id = p.product_id) WHERE p.product_id = '" . (int)$product_id . "' GROUP BY p.product_id");

		return $query->row_array();
	}

	public function getProducts($data = array()) {
		$sql = "SELECT SQL_CALC_FOUND_ROWS *, FOUND_ROWS() as total, (SELECT AVG(rating) FROM {DB_PREFIX}review r WHERE r.product_id = p.product_id) AS rating FROM {DB_PREFIX}product p LEFT JOIN {DB_PREFIX}product_option po ON (p.product_id = po.product_id AND po.status = '1' AND po.sort_order = '0') WHERE 1";

		if (!empty($data['filter_name'])) {
			$sql .= " AND p.name LIKE '%" . $this->db->escape_str($data['filter_name']) . "%'";
		}	

		if (isset($data['filter_quantity']) && !is_null($data['filter_quantity'])) {
			$sql .= " AND po.quantity = '" . (int)$data['filter_quantity'] . "'";
		}
		
		if (isset($data['filter_price']) && !is_null($data['filter_price'])) {
			$sql .= " AND po.discount = '" . (float)$data['filter_price'] . "'";
		}

		if (isset($data['filter_price_start']) && !is_null($data['filter_price_start']) && isset($data['filter_price_end']) && !is_null($data['filter_price_end'])) {
			$sql .= " AND po.discount >= '" . (float)$data['filter_price_start'] . "' AND po.discount <= '" . (float)$data['filter_price_end'] . "'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
		}

		if (!empty($data['filter_category_id'])) {
			$sql .= " AND p.category_id = '" . (int)$data['filter_category_id'] . "'";

			if (!empty($data['filter_sub_category'])) {
				$sql .= " OR p.category_id IN (SELECT c.category_id FROM {DB_PREFIX}category c JOIN {DB_PREFIX}category c2 ON c2.category_id = c.parent_id WHERE c2.category_id = '" . (int)$data['filter_category_id'] . "' OR c2.parent_id = '" . (int)$data['filter_category_id'] . "')";
			}
		}			

		$sql .= " GROUP BY p.product_id";

		$sort_data = array(
			'p.name',
			'po.model',
			'po.price',
			'po.discount',
			'po.quantity',
			'p.date_added',
			'p.status',
			'p.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY p.name";
		}

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

		$result = $query->result_array();

		$products = array();

		foreach ($result as $product) {
			$tmp = $this->getProduct($product['product_id']);
			$tmp['total'] = $product['total'];
			$products[] = $tmp;
		}

		return $products;
	}	

	public function getLatestProducts($limit) {
		$query = $this->db->query("SELECT * FROM {DB_PREFIX}product p WHERE p.status = '1' ORDER BY p.date_added DESC LIMIT " . (int)$limit);

		$products = array();

		foreach ($query->result_array() as $product) {
			$products[] = $this->getProduct($product['product_id']);
		}

		return $products;
	}

	public function getBestSellerProducts($limit) {
		$query = $this->db->query("SELECT p.product_id, SUM(op.quantity) AS total FROM {DB_PREFIX}order_product op LEFT JOIN {DB_PREFIX}order o ON (op.order_id = o.order_id) LEFT JOIN {DB_PREFIX}product_option po ON (op.product_option_id = po.product_option_id) LEFT JOIN {DB_PREFIX}product p ON (po.product_id = p.product_id) WHERE o.status > '0' AND p.status = '1' GROUP BY po.product_id ORDER BY total DESC LIMIT " . (int)$limit);

		$products = array();

		foreach ($query->result_array() as $product) {
			$products[] = $this->getProduct($product['product_id']);
		}

		return $products;		
	}	

	public function getProductSpecials($data = array()) {
		$sql = "SELECT * FROM {DB_PREFIX}product p LEFT JOIN {DB_PREFIX}product_option po ON (p.product_id = po.product_id AND po.status = '1') WHERE p.status = '1' AND p.discount != ''";

		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " AND p.category_id IN ( SELECT category_id FROM {DB_PREFIX}category WHERE category_id = '" . (int)$data['filter_category_id'] . "' UNION SELECT c.category_id FROM {DB_PREFIX}category c JOIN {DB_PREFIX}category c2 ON c2.category_id = c.parent_id WHERE c2.category_id = '" . (int)$data['filter_category_id'] . "' OR c2.parent_id = '" . (int)$data['filter_category_id'] . "')";
			} else {
				$sql .= " AND p.category_id = '" . (int)$data['filter_category_id'] . "'";
			}
		}		

		$sql .= " GROUP BY p.product_id";

		$sort_data = array(
			'p.name',
			'po.model',
			'po.price',
			'po.quantity',
			'p.status',
			'p.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY p.name";
		}

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

		$products = array();

		foreach ($query->result_array() as $product) {
			$products[] = $this->getProduct($product['product_id']);
		}

		return $products;
	}	

	public function getPopularProducts($limit) {
		$query = $this->db->query("SELECT * FROM {DB_PREFIX}product p WHERE p.status = '1' ORDER BY p.viewed DESC, p.date_added DESC LIMIT " . (int)$limit);
		
		$products = array();

		foreach ($query->result_array() as $product) {
			$products[] = $this->getProduct($product['product_id']);
		}

		return $products;
	}

	public function getRelatedProducts($category_id, $limit) {
		$query = $this->db->query("SELECT * FROM {DB_PREFIX}product p WHERE p.category_id = '" . (int)$category_id . "' AND p.status = '1' ORDER BY p.date_added DESC LIMIT " . (int)$limit);

		$products = array();

		foreach ($query->result_array() as $product) {
			$products[] = $this->getProduct($product['product_id']);
		}

		return $products;
	}	

	public function getOptionsByProductId($product_id) {
		$query = $this->db->query("SELECT * FROM {DB_PREFIX}product_option WHERE product_id = '" . (int)$product_id . "' AND status = '1'");

		return $query->result_array();
	}		

	public function getImagesByProductId($product_id) {
		$query = $this->db->query("SELECT * FROM {DB_PREFIX}product_image WHERE product_id = '" . (int)$product_id . "'");

		return $query->result_array();
	}

	public function getProductByProductOptionId($product_option_id) {
		$query = $this->db->query("SELECT DISTINCT p.*, pi.image, po.*, (SELECT keyword FROM {DB_PREFIX}url_alias WHERE query = CONCAT('product_id=', p.product_id)) AS keyword, (SELECT name FROM {DB_PREFIX}manufacturer m WHERE p.manufacturer_id = m.manufacturer_id) AS manufacturer, (SELECT name FROM {DB_PREFIX}category c WHERE c.category_id = p.category_id) AS category, (SELECT AVG(rating) FROM {DB_PREFIX}review r WHERE r.product_id = p.product_id) AS rating FROM {DB_PREFIX}product p LEFT JOIN {DB_PREFIX}product_option po ON (p.product_id = po.product_id AND po.status = '1') LEFT JOIN {DB_PREFIX}product_image pi ON (pi.product_id = p.product_id) WHERE po.product_option_id = '" . (int)$product_option_id . "' GROUP BY po.product_option_id");

		return $query->row_array();
	}		

	public function updateViewed($product_id) {
		$this->db->query("UPDATE {DB_PREFIX}product SET viewed = viewed+1 WHERE product_id = '" . (int)$product_id . "'");
	}	

	public function getTotalProducts() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM {DB_PREFIX}product");

		return $query->row()->total;
	}	
}