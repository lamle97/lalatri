<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

	public function index()
	{
		$this->load->model('catalog/product');

		if ($this->input->get('page')) {
			$page = $this->input->get('page');
		} else {
			$page = 1;
		}	

		if ($this->input->get('view')) {
			$view = $this->input->get('view');
		} else {
			$view = 15;
		}			

		if ($this->input->get('name')) {
			$name = $this->input->get('name');
		} else {
			$name = null;
		}

		if ($this->input->get('quantity') != "") {
			$quantity = $this->input->get('quantity');
		} else {
			$quantity = null;
		}

		if ($this->input->get('status') != "") {
			$status = $this->input->get('status');
		} else {
			$status = null;
		}	

		if ($this->input->get('filter_price') != "") {
			$filter_price = explode(';',$this->input->get('filter_price'));
		} else {
			$filter_price = null;
		}			

		if ($this->input->get('sort') != "") {
			$sort_order = explode('-', $this->input->get('sort'));
			$sort = $sort_order[0];
			$order = $sort_order[1];
		} else {
			$sort = 'p.name';
			$order = 'ASC';
		}			

		$filter_data = array(
			'filter_name'	  => $name,
			'filter_quantity' => $quantity,
			'filter_status'   => $status,
			'filter_price_start' => $filter_price[0],
			'filter_price_end' => $filter_price[1],
			'sort' => $sort,
			'order' => $order,
			'start' => ($page - 1) * $view,
			'limit' => $view
		);	
						
		$data['products'] = $this->product->getProducts($filter_data);
		$data['name'] = $name;
		$data['title'] = $name;
		$this->load->helper('pagination');
		unset($filter_data['start'], $filter_data['limit']);
		$config['total_rows'] = (isset($data['products'][0]['total']))?$data['products'][0]['total']:0;
		$config['per_page'] = $view;	

		$data['pagination'] = pagination($config);

		$this->load->template('catalog/search', $data);
	}
}