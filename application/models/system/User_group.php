<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User_group extends CI_Model {
	public function addUserGroup($data) {
		$this->db->query("INSERT INTO {DB_PREFIX}user_group SET name = '" . $this->db->escape_str($data['name']) . "', permission = '" . (isset($data['permission']) ? $this->db->escape_str(json_encode($data['permission'])) : '') . "'");
	
		return $this->db->insert_id();
	}

	public function editUserGroup($user_group_id, $data) {
		$this->db->query("UPDATE {DB_PREFIX}user_group SET name = '" . $this->db->escape_str($data['name']) . "', permission = '" . (isset($data['permission']) ? $this->db->escape_str(json_encode($data['permission'])) : '') . "' WHERE user_group_id = '" . (int)$user_group_id . "'");
	}

	public function deleteUserGroup($user_group_id) {
		$this->db->query("DELETE FROM {DB_PREFIX}user_group WHERE user_group_id = '" . (int)$user_group_id . "'");
	}

	public function getUserGroup($user_group_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM {DB_PREFIX}user_group WHERE user_group_id = '" . (int)$user_group_id . "'");

		$user_group = array(
			'name'       => $query->row()->name,
			'permission' => json_decode($query->row()->permission, true)
		);

		return $user_group;
	}

	public function getUserGroups($data = array()) {
		$sql = "SELECT * FROM {DB_PREFIX}user_group";

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

	public function getTotalUserGroups() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM {DB_PREFIX}user_group");

		return $query->row()->total;
	}
}