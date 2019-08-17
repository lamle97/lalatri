<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	public function index($product_id)
	{
		$this->load->model('catalog/product');
		$this->load->model('catalog/review');
		$this->load->model('customer/customer');

		$data['product'] = $this->product->getProduct($product_id);

		if (!$data['product'])
			redirect('/', 'location');

		$data['product']['options'] = $this->product->getOptionsByProductId($product_id);
		$data['product']['images'] = $this->product->getImagesByProductId($product_id);

		if ($this->input->post('review') && $this->customer->isLogged()) {
			$info['customer_id'] = $this->customer->isLogged();
			$info['product_id'] = $product_id;
			$info['rating'] = $this->input->post('rating');
			$info['text'] = $this->input->post('text');
			$info['status'] = 1;

			$this->review->addReview($info);
		}		

		$data['related_products'] = $this->product->getRelatedProducts($data['product']['category_id'], 12);

		$data['review'] = $this->review->getReviewsByProductId($product_id);
		$data['total_review'] = $this->review->getTotalReviewsByProductId($product_id);


		$data['title'] = $data['product']['meta_title'];

		
		// Set product viewed
		$this->product->updateViewed($product_id);

		if (!empty($this->input->cookie('viewed_product'))) {
			$viewed_product = json_decode($this->input->cookie('viewed_product'));
		} else {
			$viewed_product = array();
		}

		if (count($viewed_product) == 10) {
			array_pop($viewed_product);
		}
		array_unshift($viewed_product, $product_id);

        $cookie = array(
        'name'   => 'viewed_product',
        'value'  => json_encode($viewed_product),                            
        'expire' => '3600*24*7'
        );
		$this->input->set_cookie($cookie);

		$this->load->template('catalog/products', $data);
	}

	public function getProduct($product_option_id)
	{
		$this->load->model('catalog/product');

		$json = $this->product->getProductByProductOptionId($product_option_id);
		$json['images'] = $this->product->getImagesByProductId($json['product_id']);

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($json));		
	}
}
