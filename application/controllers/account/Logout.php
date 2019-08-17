<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function index()
	{
		$this->load->model('customer/customer');

        if($this->customer->isLogged())
        {
            $this->customer->logout();
            session_destroy();
        } 
        
		redirect('/', 'location');
	}
}