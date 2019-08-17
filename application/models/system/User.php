<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {
	private $user;
	private $permission;

	public function __construct() {
		parent::__construct();
		if ($this->session->has_userdata('user_id')) {
			$user_query = $this->db->query("SELECT * FROM {DB_PREFIX}user WHERE user_id = '" . (int)$this->session->userdata('user_id') . "' AND status = '1'");

			if ($user_query->num_rows()) {
				$this->user = $user_query->row_array();

				$this->db->query("UPDATE {DB_PREFIX}user SET ip = '" . $this->db->escape_str($this->input->ip_address()) . "' WHERE user_id = '" . (int)$this->user['user_id'] . "'");

				$user_group_query = $this->db->query("SELECT permission FROM {DB_PREFIX}user_group WHERE user_group_id = '" . (int)$this->user['user_group_id'] . "'");

				$permissions = json_decode($user_group_query->row_array()['permission'], true);

				if (is_array($permissions)) {
					foreach ($permissions as $key => $value) {
						$this->permission[$key] = $value;
					}
				}
			} else {
				$this->logout();
			}
		}
	}

	public function addUser($data) {
		$this->db->query("INSERT INTO {DB_PREFIX}user SET username = '" . $this->db->escape_str($data['username']) . "', user_group_id = '" . (int)$data['user_group_id'] . "', password = '" . $this->db->escape_str(md5($data['password'])) . "', firstname = '" . $this->db->escape_str($data['firstname']) . "', lastname = '" . $this->db->escape_str($data['lastname']) . "', email = '" . $this->db->escape_str($data['email']) . "', status = '" . (int)$data['status'] . "', date_added = NOW()");
	
		return $this->db->insert_id();
	}

	public function editUser($user_id, $data) {
		$this->db->query("UPDATE {DB_PREFIX}user SET username = '" . $this->db->escape_str($data['username']) . "', user_group_id = '" . (int)$data['user_group_id'] . "', firstname = '" . $this->db->escape_str($data['firstname']) . "', lastname = '" . $this->db->escape_str($data['lastname']) . "', email = '" . $this->db->escape_str($data['email']) . "', status = '" . (int)$data['status'] . "' WHERE user_id = '" . (int)$user_id . "'");

		if ($data['password']) {
			$this->db->query("UPDATE {DB_PREFIX}user SET password = '" . $this->db->escape_str(md5($data['password'])) . "' WHERE user_id = '" . (int)$user_id . "'");
		}
	}

	public function editPassword($user_id, $password) {
		$this->db->query("UPDATE {DB_PREFIX}user SET password = '" . $this->db->escape_str(md5($password)) . "' WHERE user_id = '" . (int)$user_id . "'");
	}	

	public function deleteUser($user_id) {
		$this->db->query("DELETE FROM {DB_PREFIX}user WHERE user_id = '" . (int)$user_id . "'");
	}

	public function login($username, $password) {
		$user_query = $this->db->query("SELECT * FROM {DB_PREFIX}user WHERE username = '" . $this->db->escape_str($username) . "' AND password = '" . $this->db->escape_str(md5($password)) . "' AND status = '1'");

		if ($user_query->num_rows()) {
			$this->user = $user_query->row_array();

			$this->session->set_userdata('user_id', $this->user['user_id']);

			$user_group_query = $this->db->query("SELECT permission FROM {DB_PREFIX}user_group WHERE user_group_id = '" . (int)$this->user['user_group_id'] . "'");

			$permissions = json_decode($user_group_query->row_array()['permission'], true);

			if (is_array($permissions)) {
				foreach ($permissions as $key => $value) {
					$this->permission[$key] = $value;
				}
			}

			return true;
		} else {
			return false;
		}
	}

	public function logout() {
		$this->session->unset_userdata('user_id');

		$this->user = null;
	}

	public function hasPermission($key, $value) {
		if (isset($this->permission[$key])) {
			return in_array($value, $this->permission[$key]);
		} else {
			return false;
		}
	}

	public function getUsers($data = array()) {
		$sql = "SELECT * FROM {DB_PREFIX}user";

		$sql .= " ORDER BY username";

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

	public function isLogged() {
		return $this->user['user_id'];
	}

	public function getUser($user_id = 0) {
		if ($user_id == 0)
			return $this->user;
		
		$query = $this->db->query("SELECT *, (SELECT ug.name FROM {DB_PREFIX}user_group ug WHERE ug.user_group_id = u.user_group_id) AS user_group FROM {DB_PREFIX}user u WHERE u.user_id = '" . (int)$user_id . "'");

		return $query->row_array();		
	}

	public function getUserByEmail($email) {
		$query = $this->db->query("SELECT DISTINCT * FROM {DB_PREFIX}user WHERE LCASE(email) = '" . $this->db->escape_str(strtolower($email)) . "'");

		$user = $query->row_array();
		unset($user['password']);

		return $user;
	}	

	public function getId() {
		return $this->user['user_id'];
	}

	public function getUserName() {
		return $this->user['username'];
	}

	public function getGroupId() {
		return $this->user['user_group_id'];
	}

	public function getTotalUsers() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM {DB_PREFIX}user");

		return $query->row()->total;
	}	
}