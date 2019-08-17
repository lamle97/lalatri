<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('customer/customer');
        $this->load->model('customer/customer_social');
        $this->load->model('customer/cart');
        $this->load->library('facebook');
    }    

	public function index()
	{
		$data = array();

        if($this->customer->isLogged())
        {
            redirect('/account', 'location');
        }                         

        $carts = $this->cart->get();

        if(($this->input->post('login') && $this->validate()) || $this->validate_fb())
        {
            foreach ($carts as $cart) {
                $this->cart->add($cart['product_option_id'], $cart['quantity']);
            }
        	redirect('/account', 'location');
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

        $data['facebook_login'] = $this->facebook->getLoginUrl(array('scope' => 'email'));

		$this->load->template('account/login', $data);
	}

    public function validate() {
        if (!$this->input->post('email') || !$this->input->post('password') || !$this->customer->login($this->input->post('email'), html_entity_decode($this->input->post('password'), ENT_QUOTES, 'UTF-8'))) {
            $this->session->set_userdata('error','Wrong email or password, please try again.');

            return false;
        }

        return true;
    }

    public function validate_fb() {
        if ($this->facebook->getUser()) {
            $user_profile = $this->facebook->api('/me?fields=email,first_name,last_name');
            if ($this->customer_social->login($user_profile['id'], 'fb'))
                return true;
            else {
                $user_profile['firstname'] = $user_profile['first_name'];
                $user_profile['lastname'] = $user_profile['last_name'];
                $user_profile['social_id'] = $user_profile['id'];
                $user_profile['network'] = 'fb';
                $this->customer_social->addCustomer($user_profile);
                return $this->validate_fb();
            }
        }

        return false;
    }

    public function recover() {
        if($this->input->post('email'))
        {
            $customer_id = $this->customer->getCustomerByEmail($this->input->post('email'))['customer_id'];

            if (!$customer_id) {
                $this->session->set_userdata('error','Wrong email, please try again.');
                redirect('/account/login', 'location');
            }

            $password = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 10);
            $this->customer->editPassword($customer_id, $password);

            $this->load->model('system/setting');
            $this->load->library('email', $this->setting->getSettingValue('shop_mail_config'));
            $content = str_replace(array('{email}', '{password}'), array($this->input->post('email'), $password), $this->setting->getSettingValue('shop_mail_recover')['content']);
            $this->email->from($this->setting->getSettingValue('shop_mail_config')['smtp_user'], $this->setting->getSettingValue('shop_name'));
            $this->email->to($this->input->post('email'));
            $this->email->subject($this->setting->getSettingValue('shop_mail_recover')['subject']);
            $this->email->message($content);
            $this->email->set_newline("\r\n");  
            $this->email->send();

            $this->session->set_userdata('success','A email with new password sent to you');          
        }    

        redirect('/account/login', 'location');         
    }
}