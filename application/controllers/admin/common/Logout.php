<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function index()
	{
		$this->load->model('system/user');

        if($this->user->isLogged())
        {
            $this->user->logout();
        } 
        
		redirect('/admin/login', 'location');
	}
}