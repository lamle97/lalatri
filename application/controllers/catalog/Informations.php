<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informations extends CI_Controller {

	public function index($information_id)
	{
		$this->load->model('catalog/information');

		$data['information'] = $this->information->getInformation($information_id);

		if (!$data['information']['status'])
			redirect('/', 'location');	

		$data['title'] = $data['information']['meta_title'];	
		$data['name'] = $data['information']['title'];
		$data['content'] = $data['information']['content'];

		$this->load->template('catalog/informations', $data);
	}
}