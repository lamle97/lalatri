<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->model('catalog/manufacturer');
		$this->load->model('catalog/product');
		$this->load->model('catalog/category');

		$data['manufacturers'] = $this->manufacturer->getManufacturers();
		$data['popular_products'] = $this->product->getPopularProducts(12); 



		$data['products'] = $this->cache->file->get('productDesktop');
		if (!$data['products'])
		{
			$category = $this->category->getCategories(array('parent_id' => 0));
			
			foreach ($category as $value) {
				$filter = array(
					'filter_category_id' => $value['category_id'],
					'filter_sub_category' => true,
					'sort' => 'p.date_added',
					'order' => 'DESC',
					'start' => 0,
					'limit' => 12
				);
				if(count($products = $this->product->getProducts($filter)) > 0) {
					$result['category_id'] = $value['category_id'];
					$result['category_name'] = $value['name'];
					$result['data'] = $products;

					$data['products'][] = $result;
				}
			}

			$this->cache->file->save('productDesktop', $data['products'], 2*3600);
		}
		else 
		{
			foreach ($data['products'] as $i => $products) {
				foreach ($products['data'] as $j => $product) {
					$data['products'][$i]['data'][$j] = $this->product->getProduct($product['product_id']);
				}
			}
		}

		$this->load->template('common/home', $data);
	}
}
