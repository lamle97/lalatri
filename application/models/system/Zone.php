<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zone extends CI_Model {
	public function addZone($data) {
		$this->db->query("INSERT INTO {DB_PREFIX}zone SET status = '" . (int)$data['status'] . "', name = '" . $this->db->escape_str($data['name']) . "', city_id = '" . (int)$data['city_id'] . "'");
		
		return $this->db->insert_id();
	}

	public function editZone($zone_id, $data) {
		$this->db->query("UPDATE {DB_PREFIX}zone SET status = '" . (int)$data['status'] . "', name = '" . $this->db->escape_str($data['name']) . "', city_id = '" . (int)$data['city_id'] . "' WHERE zone_id = '" . (int)$zone_id . "'");
	}

	public function deleteZone($zone_id) {
		$this->db->query("DELETE FROM {DB_PREFIX}zone WHERE zone_id = '" . (int)$zone_id . "'");
	}

	public function getZone($zone_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM {DB_PREFIX}zone WHERE zone_id = '" . (int)$zone_id . "'");

		return $query->row_array();
	}

	public function getZones($data = array()) {
		$sql = "SELECT *, (SELECT c.name FROM {DB_PREFIX}city c WHERE c.city_id = z.city_id) AS city FROM {DB_PREFIX}zone z WHERE 1";

		if (isset($data['filter_city_id']) && !is_null($data['filter_city_id'])) {
			$sql .= " AND z.city_id = '" . (int)$data['filter_city_id'] . "'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND z.status = '" . (int)$data['filter_status'] . "'";
		}

		$sort_data = array(
			'c.name',
			'z.name'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY c.name";
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

	public function getZonesByCityId($city_id) {
		$query = $this->db->query("SELECT * FROM {DB_PREFIX}zone WHERE city_id = '" . (int)$city_id . "' AND status = '1' ORDER BY name");

		return $query->result_array();
	}

	public function getTotalZones() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM {DB_PREFIX}zone");

		return $query->row->total;
	}

	public function getTotalZonesByCountryId($city_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM {DB_PREFIX}zone WHERE city_id = '" . (int)$city_id . "'");

		return $query->row->total;
	}
}	