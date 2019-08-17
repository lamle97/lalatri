<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Information extends CI_Model {
	public function addInformation($data) {
		$this->db->query("INSERT INTO {DB_PREFIX}information SET title = '" . $this->db->escape_str($data['title']) . "', content = '" . $this->db->escape_str($data['content']) . "', meta_title = '" . $this->db->escape_str($data['meta_title']) . "', status = '" . (int)$data['status'] . "'");

		$information_id = $this->db->insert_id();

		if (isset($data['keyword'])) {
			$this->db->query("INSERT INTO {DB_PREFIX}url_alias SET query = 'information_id=" . (int)$information_id . "', keyword = '" . $this->db->escape_str($data['keyword']) . "'");
		}

		return $information_id;
	}

	public function editInformation($information_id, $data) {
		$this->db->query("UPDATE {DB_PREFIX}information SET title = '" . $this->db->escape_str($data['title']) . "', content = '" . $this->db->escape_str($data['content']) . "', meta_title = '" . $this->db->escape_str($data['meta_title']) . "', status = '" . (int)$data['status'] . "' WHERE information_id = '" . (int)$information_id . "'");


		$this->db->query("DELETE FROM {DB_PREFIX}url_alias WHERE query = 'information_id=" . (int)$information_id . "'");

		if (isset($data['keyword'])) {
			$this->db->query("INSERT INTO {DB_PREFIX}url_alias SET query = 'information_id=" . (int)$information_id . "', keyword = '" . $this->db->escape_str($data['keyword']) . "'");
		}
	}

	public function deleteInformation($information_id) {
		$this->db->query("DELETE FROM {DB_PREFIX}information WHERE information_id = '" . (int)$information_id . "'");
		$this->db->query("DELETE FROM {DB_PREFIX}url_alias WHERE query = 'information_id=" . (int)$information_id . "'");
	}

	public function getInformation($information_id) {
		$query = $this->db->query("SELECT *, (SELECT keyword FROM {DB_PREFIX}url_alias WHERE query = 'information_id=" . (int)$information_id . "') AS keyword FROM {DB_PREFIX}information WHERE information_id = '" . (int)$information_id . "'");

		return $query->row_array();
	}

	public function getInformations($data = array()) {
		$sql = "SELECT * FROM {DB_PREFIX}information";

		$sql .= " ORDER BY title";

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

		$informations = array();

		foreach ($query->result_array() as $information) {
			$informations[] = $this->getInformation($information['information_id']);
		}

		return $informations;
	}

	public function getTotalInformations() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM {DB_PREFIX}information");

		return $query->row()->total;
	}	
}