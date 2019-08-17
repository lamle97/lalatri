<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class City extends CI_Model {
	public function addCity($data) {
		$this->db->query("INSERT INTO {DB_PREFIX}city SET name = '" . $this->db->escape_str($data['name']) . "', iso_code_2 = '" . $this->db->escape_str($data['iso_code_2']) . "', iso_code_3 = '" . $this->db->escape_str($data['iso_code_3']) . "', status = '" . (int)$data['status'] . "'");
		
		return $this->db->insert_id();
	}

	public function editCity($city_id, $data) {
		$this->db->query("UPDATE {DB_PREFIX}city SET name = '" . $this->db->escape_str($data['name']) . "', iso_code_2 = '" . $this->db->escape_str($data['iso_code_2']) . "', iso_code_3 = '" . $this->db->escape_str($data['iso_code_3']) . "', status = '" . (int)$data['status'] . "' WHERE city_id = '" . (int)$city_id . "'");
	}

	public function deleteCity($city_id) {
		$this->db->query("DELETE FROM {DB_PREFIX}city WHERE city_id = '" . (int)$city_id . "'");
	}

	public function getCity($city_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM {DB_PREFIX}city WHERE city_id = '" . (int)$city_id . "'");

		return $query->row_array();
	}

	public function getCitys($data = array()) {
		$sql = "SELECT * FROM {DB_PREFIX}city";

		$sort_data = array(
			'name',
			'iso_code_2',
			'iso_code_3'
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

		return $query->result_array();
	}

	public function getTotalCitys() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM {DB_PREFIX}city");

		return $query->row->total;
	}
}