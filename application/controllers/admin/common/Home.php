<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->model('report/sale');
		$this->load->model('customer/customer');
		$this->load->model('sales/order');

		$data['total_customer'] = $this->customer->getTotalCustomers();
		$data['new_customer'] = $this->sale->getTotalCustomersByYear()[date('n')]['total'];
		$data['total_order'] = $this->order->getTotalOrders();
		$data['new_order'] = $this->sale->getTotalOrdersByYear()[date('n')]['total'];
		$data['pending_order'] = count($this->sale->getOrders(array('filter_shipping_status' => 0)));
		$data['total_sale'] = $this->exchange($this->sale->getTotalSales());
		$data['lasted_orders'] = $this->order->getOrders();

		$data['orders'] = $this->sale->getTotalOrdersByYear();
		$data['customers'] = $this->sale->getTotalCustomersByYear();

		$this->load->template_admin('common/home', $data);

	}

	private function exchange($value)
	{
		if ($value > 1000000000000) {
			return round($value / 1000000000000, 1) . ' T';
		} elseif ($value > 1000000000) {
			return round($value / 1000000000, 1) . ' B';
		} elseif ($value > 1000000) {
			return round($value / 1000000, 1) . ' M';
		} elseif ($value > 1000) {
			return round($value / 1000, 1) . ' K';
		} else {
			return $value;
		}			
	}
}
