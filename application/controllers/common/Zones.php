<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zones extends CI_Controller {
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('system/zone');
    }    

	public function autocomplete() {
		$json = array();

		if ($this->input->get('filter_city_id')) {
			$filter_data = array(
				'filter_city_id' => $this->input->get('filter_city_id'),
				'filter_status' => 1,
				'sort'        => 'z.name',
				'order'       => 'ASC'
			);

			$results = $this->zone->getZones($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'zone_id' => $result['zone_id'],
					'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				);
			}
		}

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($json));
	}    
}