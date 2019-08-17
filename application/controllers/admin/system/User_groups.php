<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_groups extends CI_Controller {
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('system/user_group');
    }    

	public function index()
	{
		if ($this->input->get('page')) {
			$page = $this->input->get('page');
		} else {
			$page = 1;
		}

		$filter_data = array(
			'start' => ($page - 1) * 10,
			'limit' => 10
		);

		$data['user_groups'] = $this->user_group->getUserGroups($filter_data);

        $this->load->helper('pagination');

        $config['total_rows'] = $this->user_group->getTotalUserGroups();
        $config['per_page'] = 10;   

        $data['pagination'] = pagination($config);   

		$this->load->template_admin('system/user_groups', $data);

	}

	public function add()
	{
        if($this->input->post('name') && $this->validate())
        {
        	$data['name'] = $this->input->post('name');
            $data['permission']['access'] = $this->input->post('access');
            $data['permission']['modify'] = $this->input->post('modify');        	

        	$this->user_group->addUserGroup($data);

        	$this->session->set_userdata('success','Add user group successfull.');

        	redirect('/admin/system/user_groups', 'location');
        }

		$data = array();

		$data['action'] = 'add';	

        $this->load->helper('list_controller');

        $data['permissions'] = list_controller();		

		$this->load->template_admin('system/user_group_form', $data);
	}

	public function edit($user_group_id)
	{
		if (!isset($user_group_id))
			redirect('/admin', 'location');

        if($this->input->post('name') && $this->validate())
        {
        	$data['name'] = $this->input->post('name');
            $data['permission']['access'] = $this->input->post('access');
            $data['permission']['modify'] = $this->input->post('modify');

        	$this->user_group->editUserGroup($user_group_id, $data);

        	$this->session->set_userdata('success','Edit user group successfull.');

        	redirect('/admin/system/user_groups', 'location');
        }		

		$data = array();

		$data['action'] = 'edit';

        $this->load->helper('list_controller');

        $data['permissions'] = list_controller();

		$data['user_group'] = $this->user_group->getUserGroup($user_group_id);

		$this->load->template_admin('system/user_group_form', $data);
	}

	public function delete()
	{
		if(!empty($this->input->post('item')) && $this->validate()) {
			foreach($this->input->post('item') as $id) {
        		$this->user->deleteUser($id);
    		}	

    		$this->session->set_userdata('success','Delete user successfull.');
		}

		redirect('/admin/system/users', 'location');
	}

	private function validate() {	
		$this->load->model("system/user");

		if (!$this->user->hasPermission('modify', strtolower(get_class($this)))) {
			$this->session->set_userdata('error','You don\'t have permission to modify!');
			return false;
		}	

		return 	true;
	}		
}
