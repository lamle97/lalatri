<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Model {
	public function addCategory($data) {
		$this->db->query("INSERT INTO {DB_PREFIX}category SET image = '" . $this->db->escape_str($data['image']) . "', parent_id = '" . (int)$data['parent_id'] . "', name = '" . $this->db->escape_str($data['name']) . "', description = '" . $this->db->escape_str($data['description']) . "', meta_title = '" . $this->db->escape_str($data['meta_title']) . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW(), date_added = NOW()");

		$category_id = $this->db->insert_id();

		if (isset($data['manufacturer_id'])) {
			foreach ($data['manufacturer_id'] as $value) {
				$this->db->query("INSERT INTO {DB_PREFIX}category_manufacturer SET category_id = '" . (int)$category_id . "', manufacturer_id = '" . (int)$value . "'");
			}
		}

		if (isset($data['keyword'])) {
			$this->db->query("INSERT INTO {DB_PREFIX}url_alias SET query = 'category_id=" . (int)$category_id . "', keyword = '" . $this->db->escape_str($data['keyword']) . "'");
		}

		return $category_id;
	}

	public function editCategory($category_id, $data) {
		$this->db->query("UPDATE {DB_PREFIX}category SET image = '" . $this->db->escape_str($data['image']) . "', parent_id = '" . (int)$data['parent_id'] . "', name = '" . $this->db->escape_str($data['name']) . "', description = '" . $this->db->escape_str($data['description']) . "', meta_title = '" . $this->db->escape_str($data['meta_title']) . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE category_id = '" . (int)$category_id . "'");

		if (isset($data['manufacturer_id'])) {
			$this->db->query("DELETE FROM {DB_PREFIX}category_manufacturer WHERE category_id = '" . (int)$category_id . "'");

			foreach ($data['manufacturer_id'] as $value) {
				$this->db->query("INSERT INTO {DB_PREFIX}category_manufacturer SET category_id = '" . (int)$category_id . "', manufacturer_id = '" . (int)$value . "'");
			}
		}

		$this->db->query("DELETE FROM {DB_PREFIX}url_alias WHERE query = 'category_id=" . (int)$category_id . "'");

		if (isset($data['keyword'])) {
			$this->db->query("INSERT INTO {DB_PREFIX}url_alias SET query = 'category_id=" . (int)$category_id . "', keyword = '" . $this->db->escape_str($data['keyword']) . "'");
		}

	}

	public function deleteCategory($category_id) {
		$this->db->query("DELETE FROM {DB_PREFIX}category WHERE category_id = '" . (int)$category_id . "'");
		$this->db->query("DELETE FROM {DB_PREFIX}url_alias WHERE query = 'category_id=" . (int)$category_id . "'");
	}

	public function getCategory($category_id) {
		$query = $this->db->query("SELECT *, (SELECT keyword FROM {DB_PREFIX}url_alias WHERE query = 'category_id=" . (int)$category_id . "') AS keyword,(SELECT name FROM {DB_PREFIX}category WHERE category_id = c.parent_id) AS parent FROM {DB_PREFIX}category c WHERE c.category_id = '" . (int)$category_id . "'");

		return $query->row_array();
	}

	public function getCategories($data = array()) {
		$sql = "SELECT * FROM {DB_PREFIX}category WHERE 1";

		if (!empty($data['filter_name'])) {
			$sql .= " AND name LIKE '%" . $this->db->escape_str($data['filter_name']) . "%'";
		}

		if (isset($data['parent_id'])) {
			$sql .= " AND parent_id = '" . (int)$data['parent_id'] . "'";
		}		

		if (isset($data['status'])) {
			$sql .= " AND status = '" . (int)$data['status'] . "'";
		}			

		$sort_data = array(
			'name',
			'sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY name";
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

		$categories = array();

		foreach ($query->result_array() as $category) {
			$categories[] = $this->getCategory($category['category_id']);
		}

		return $categories;
	}

	public function getDesktop($parent_id) {
		$query = $this->db->query("SELECT *, (SELECT name FROM {DB_PREFIX}category WHERE category_id = c.parent_id) AS parent, (SELECT DISTINCT *, (SELECT keyword FROM {DB_PREFIX}url_alias WHERE query = 'product_id=' + p.product_id) AS keyword, (SELECT name FROM {DB_PREFIX}manufacturer m WHERE p.manufacturer_id = m.manufacturer_id) AS manufacturer, (SELECT name FROM {DB_PREFIX}category c WHERE c.category_id = p.category_id) AS category, (SELECT AVG(rating) FROM {DB_PREFIX}review r WHERE r.product_id = p.product_id) AS rating FROM {DB_PREFIX}product p LEFT JOIN {DB_PREFIX}product_option po ON (p.product_id = po.product_id AND po.status = '1') LEFT JOIN {DB_PREFIX}product_image pi ON (pi.product_option_id = po.product_option_id) WHERE p.category_id = c.category_id GROUP BY p.product_id ORDER BY p.date_added DESC LIMIT 0,10) as products FROM {DB_PREFIX}category c WHERE c.parent_id = '" . (int)$parent_id . "'");

		return $query->result_array();		
	}	

	public function getManufacturersByCategoryId($category_id) {
		$query = $this->db->query("SELECT * FROM {DB_PREFIX}category_manufacturer cm LEFT JOIN {DB_PREFIX}manufacturer m ON cm.manufacturer_id = m.manufacturer_id WHERE cm.category_id = " . (int)$category_id);

		return $query->result_array();
	}

	public function getTotalCategories() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM {DB_PREFIX}category");

		return $query->row()->total;
	}
}