<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Model {
	public function getSetting() {
		$setting_data = array();

		$query = $this->db->query("SELECT * FROM {DB_PREFIX}setting");

		foreach ($query->result_array() as $result) {
			if ($result['json'])
				$setting_data[$result['key']] = json_decode($result['value'],true);
			else
				$setting_data[$result['key']] = $result['value'];
		}

		return $setting_data;
	}

	public function addSetting($key = '', $value = '') {
		if (is_array($value))
			$this->db->query("INSERT INTO {DB_PREFIX}setting SET `key` = '" . $this->db->escape_str($key) . "', value = '" . $this->db->escape_str(json_encode($value)) . "', json = '1'");
		else
			$this->db->query("INSERT INTO {DB_PREFIX}setting SET `key` = '" . $this->db->escape_str($key) . "', value = '" . $this->db->escape_str($value) . "', json = '0'");
	}

	public function deleteSetting($key) {
		$this->db->query("DELETE FROM {DB_PREFIX}setting WHERE `key` = '" . $this->db->escape_str($key) . "'");
	}
	
	public function getSettingValue($key) {
		$query = $this->db->query("SELECT * FROM {DB_PREFIX}setting WHERE `key` = '" . $this->db->escape_str($key) . "'");

		if ($query->num_rows()) {
			$setting = $query->row_array();
			if ($setting['json'])
				return json_decode($setting['value'],true);
			else
				return $setting['value'];
		} else {
			return null;	
		}
	}
	
	public function editSetting($key = '', $value = '') {
		if (is_array($value))
			$this->db->query("UPDATE {DB_PREFIX}setting SET value = '" . $this->db->escape_str(json_encode($value)) . "', json = '1'  WHERE `key` = '" . $this->db->escape_str($key) . "'");
		else
			$this->db->query("UPDATE {DB_PREFIX}setting SET value = '" . $this->db->escape_str($value) . "', json = '0'  WHERE `key` = '" . $this->db->escape_str($key) . "'");
	}	
}