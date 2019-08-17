<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends CI_Model {
	public function addReview($data) {
		$this->db->query("INSERT INTO {DB_PREFIX}review SET customer_id = '" . (int)$data['customer_id'] . "', product_id = '" . (int)$data['product_id'] . "', text = '" . $this->db->escape_str(strip_tags($data['text'])) . "', rating = '" . (int)$data['rating'] . "', status = '" . (int)$data['status'] . "', date_added = NOW()");

		$review_id = $this->db->insert_id();

		return $review_id;
	}

	public function editReview($review_id, $data) {
		$this->db->query("UPDATE {DB_PREFIX}review SET customer_id = '" . (int)$data['customer_id'] . "', product_id = '" . (int)$data['product_id'] . "', text = '" . $this->db->escape_str(strip_tags($data['text'])) . "', rating = '" . (int)$data['rating'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE review_id = '" . (int)$review_id . "'");
	}

	public function deleteReview($review_id) {
		$this->db->query("DELETE FROM {DB_PREFIX}review WHERE review_id = '" . (int)$review_id . "'");
	}

	public function getReview($review_id) {
		$query = $this->db->query("SELECT r.*, (SELECT name FROM {DB_PREFIX}product p WHERE p.product_id = r.product_id) AS product, (SELECT COUNT(*) > 0 FROM {DB_PREFIX}order o LEFT JOIN {DB_PREFIX}order_product op ON (o.order_id = op.order_id) LEFT JOIN {DB_PREFIX}product_option po ON (po.product_option_id = op.product_option_id) WHERE po.product_id = r.product_id AND o.customer_id = r.customer_id) AS buy, c.firstname, c.lastname, c.email FROM {DB_PREFIX}review r LEFT JOIN {DB_PREFIX}customer c ON (r.customer_id = c.customer_id) WHERE review_id = '" . (int)$review_id . "'");

		return $query->row_array();
	}

	public function getReviews($data = array()) {
		$sql = "SELECT * FROM {DB_PREFIX}review";

		$sql .= " ORDER BY date_added";

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

		$reviews = array();

		foreach ($query->result_array() as $review) {
			$reviews[] = $this->getReview($review['review_id']);
		}

		return $reviews;
	}

	public function getReviewsByProductId($product_id, $start = 0, $limit = 20) {
		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 20;
		}

		$query = $this->db->query("SELECT * FROM {DB_PREFIX}review WHERE product_id = '" . (int)$product_id . "'  ORDER BY date_added DESC LIMIT " . (int)$start . "," . (int)$limit);

		$reviews = array();

		foreach ($query->result_array() as $review) {
			$reviews[] = $this->getReview($review['review_id']);
		}

		return $reviews;
	}	

	public function getReviewsByCustomerId($customer_id, $start = 0, $limit = 20) {
		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 20;
		}

		$query = $this->db->query("SELECT * FROM {DB_PREFIX}review WHERE customer_id = '" . (int)$customer_id . "' ORDER BY date_added DESC LIMIT " . (int)$start . "," . (int)$limit);

		$reviews = array();

		foreach ($query->result_array() as $review) {
			$reviews[] = $this->getReview($review['review_id']);
		}

		return $reviews;
	}		

	public function getTotalReviews() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM {DB_PREFIX}review");

		return $query->row()->total;
	}

	public function getTotalReviewsByProductId($product_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM {DB_PREFIX}review WHERE product_id = '" . (int)$product_id . "'");

		return $query->row()->total;
	}	

	public function getTotalReviewsByCustomerId($customer_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM {DB_PREFIX}review WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->row()->total;
	}		
}