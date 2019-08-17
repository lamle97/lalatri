<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('system/user');
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
			'sort' => 'username',
			'order' => 'ASC',
			'start' => ($page - 1) * 10,
			'limit' => 10
		);

		$data['users'] = $this->user->getUsers($filter_data);

        $this->load->helper('pagination');

        $config['total_rows'] = $this->user->getTotalUsers();
        $config['per_page'] = 10;   

        $data['pagination'] = pagination($config);          

		$this->load->template_admin('system/users', $data);

	}

	public function add()
	{
        if($this->input->post('username') && $this->validate())
        {
        	$data['username'] = $this->input->post('username');
        	$data['user_group_id'] = $this->input->post('user_group');
        	$data['firstname'] = $this->input->post('firstname');
        	$data['lastname'] = $this->input->post('lastname');
        	$data['email'] = $this->input->post('email');
        	$data['password'] = $this->input->post('password');
        	$data['status'] = $this->input->post('status');

        	$this->user->addUser($data);

        	$this->session->set_userdata('success','Add user successfull.');

        	redirect('/admin/system/users', 'location');
        }

		$data = array();

		$data['action'] = 'add';

        $data['user_groups'] = $this->user_group->getUserGroups();	

		$this->load->template_admin('system/user_form', $data);
	}

	public function edit($user_id)
	{
		if (!isset($user_id))
			redirect('/admin', 'location');

        if($this->input->post('username') && $this->validate())
        {
        	$data['username'] = $this->input->post('username');
        	$data['user_group_id'] = $this->input->post('user_group');
        	$data['firstname'] = $this->input->post('firstname');
        	$data['lastname'] = $this->input->post('lastname');
        	$data['email'] = $this->input->post('email');
        	$data['status'] = $this->input->post('status');

        	if ($this->input->post('password') != "")
        		$data['password'] = $this->input->post('password');

        	$this->user->editUser($user_id, $data);

        	$this->session->set_userdata('success','Edit user successfull.');

        	redirect('/admin/system/users', 'location');
        }		

		$data = array();

		$data['action'] = 'edit';

        $data['user_groups'] = $this->user_group->getUserGroups();        

		$data['user'] = $this->user->getUser($user_id);

		$this->load->template_admin('system/user_form', $data);
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

        return  true;
    }      
}
