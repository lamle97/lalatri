<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('system/user');
        $this->load->model('system/setting');
    }    

	public function index()
	{
		$data = array();

        if($this->user->isLogged())
        {
            redirect('/admin', 'location');
        }            

        if($this->input->post('loginform') && $this->validate())
        {
            redirect('/admin', 'location');
        }
        
        if($this->session->userdata('error'))
        {
            $data['error'] = $this->session->userdata('error');
            $this->session->unset_userdata('error');
        }      

        if($this->session->userdata('success'))
        {
            $data['success'] = $this->session->userdata('success');
            $this->session->unset_userdata('success');
        }                

        $data['setting'] = $this->setting->getSetting();
		$this->load->view('admin/common/login', $data);
	}

    public function validate() {
        if (!$this->input->post('username') || !$this->input->post('password') || !$this->user->login($this->input->post('username'), html_entity_decode($this->input->post('password'), ENT_QUOTES, 'UTF-8'))) {
            $this->session->set_userdata('error','Wrong user or password, please try again.');

            return false;
        }

        return true;
    }

    public function recover() {
		if ($this->input->post('email')) {
			$user_id = $this->user->getUserByEmail($this->input->post('email'))['user_id'];

			if (!$user_id) {
				$this->session->set_userdata('error','Wrong email, please try again.');
				redirect('/admin', 'location');
			}

			$password = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 10);
			$this->user->editPassword($user_id, $password);

			$this->load->model('system/setting');
            $this->load->library('email', $this->setting->getSettingValue('shop_mail_config'));

            $this->email->from($this->setting->getSettingValue('shop_mail_config')['smtp_user'], $this->setting->getSettingValue('shop_name'));
            $this->email->to($this->input->post('email'));
            $this->email->subject('Get your new password');
            $this->email->message('Hello my friend, you requested a new password for your account from shop<br/>Here your new password to login: <b>'. $password .'</b>');
            $this->email->set_newline("\r\n");  
            $this->email->send();  

            $this->session->set_userdata('success','A email with new password sent to you');          
		}    

		redirect('/admin', 'location');	
    }
}