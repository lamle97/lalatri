<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Loader extends CI_Loader {
	private $CI;

	public function __construct() {
		parent::__construct();

		$this->CI =& get_instance();
	}

    public function template_admin($template_name, $vars = array(), $return = FALSE)
    {
    	$this->CI->load->model('system/user');
    	$this->CI->load->model('system/setting');

    	$vars['base_template'] = base_url("application/views/admin/assets/");
    	$vars['setting'] = $this->CI->setting->getSetting();

    	if($this->CI->user->isLogged()) 
    	{
			$vars['current_user'] = $this->CI->user->getUser();

			$key = $this->CI->router->fetch_class();

			$avoid = array("home", "login", "logout");

			if(!$this->CI->user->hasPermission('access',$key) && !in_array($key, $avoid))
			{
				$this->CI->session->set_userdata('error', 'You don\'t have perrmission to access');
				redirect('/admin', 'location');
			}
		}
		else 
		{
			redirect('/admin/login', 'location');
		}

        if($this->CI->session->userdata('success'))
        {
            $vars['success'] = $this->CI->session->userdata('success');
            $this->CI->session->unset_userdata('success');
        } 
        if($this->CI->session->userdata('error'))
        {
            $vars['error'] = $this->CI->session->userdata('error');
            $this->CI->session->unset_userdata('error');
        }        		

        if($return)
        {
        	$content  = $this->view('admin/common/header', $vars, $return);
	    	$content  = $this->view('admin/common/slidebar_menu', $vars, $return);
	        $content .= $this->view('admin/'.$template_name, $vars, $return);
	        $content .= $this->view('admin/common/footer', $vars, $return);

	        return $content;
        }
	    else
	    {
	    	$this->view('admin/common/header', $vars);
	    	$this->view('admin/common/slidebar_menu', $vars);
	        $this->view('admin/'.$template_name, $vars);
	        $this->view('admin/common/footer', $vars);
	    }
    }

    public function template($template_name, $vars = array(), $return = FALSE)
    {
    	$this->CI->load->model('customer/customer');
    	$this->CI->load->model('catalog/product');
    	$this->CI->load->model('catalog/category');
    	$this->CI->load->model('system/setting');

    	$template = $this->CI->setting->getSettingValue('shop_template');
    	$vars['base_template'] = base_url("application/views/".$template."/assets/");

		$this->CI->load->model('customer/cart');

		$vars['cart']['products'] = array();

		foreach ($this->CI->cart->get() as $value) {
			$product = $this->CI->product->getProductByProductOptionId($value['product_option_id']);
			if ($product == null) {
				$this->CI->cart->delete($value['product_option_id']);
				continue;
			}

			$product['quantity'] = $value['quantity'];
			$vars['cart']['products'][] = $product;
		}

		$vars['cart']['total_money'] = $this->CI->cart->total();
		$vars['cart']['total_items'] = $this->CI->cart->total_items();

		$vars['category'] = $this->CI->category;
		$vars['customer'] = $this->CI->customer->getCustomer();
		$vars['setting'] = $this->CI->setting->getSetting();

        if($return)
        {
        	$content  = $this->view($template.'/common/header', $vars, $return);
	        $content .= $this->view($template.'/'.$template_name, $vars, $return);
	        $content .= $this->view($template.'/common/footer', $vars, $return);

	        return $content;
        }
	    else
	    {
	    	$this->view($template.'/common/header', $vars);
	        $this->view($template.'/'.$template_name, $vars);
	        $this->view($template.'/common/footer', $vars);
	    }
    }

    public function view_template($template_name, $vars = array(), $return = FALSE)
    {
    	$this->CI->load->model('customer/customer');
    	$this->CI->load->model('system/setting');
    	$this->CI->load->model('customer/cart');

		$customer_id = $this->CI->cache->file->get('customer.' . $this->CI->input->get('token'));

    	if ($customer_id)
    	{
    		$this->CI->customer->setCustomer($customer_id);
    	}  

		$vars['cart']['products'] = array();

		foreach ($this->CI->cart->get() as $value) {
			$product = $this->CI->product->getProductByProductOptionId($value['product_option_id']);
			$product['quantity'] = $value['quantity'];
			$vars['cart']['products'][] = $product;
		}

		$vars['cart']['total_money'] = $this->CI->cart->total();
		$vars['cart']['total_items'] = $this->CI->cart->total_items();    	

    	$template = $this->CI->setting->getSettingValue('shop_template');
    	$vars['base_template'] = base_url("application/views/".$template."/assets/");
    	$vars['customer'] = $this->CI->customer->getCustomer();
    	$vars['setting'] = $this->CI->setting->getSetting();  	

        if($return)
        {
	        $content = $this->view($template.'/'.$template_name, $vars, $return);

	        return $content;
        }
	    else
	    {
	        $this->view($template.'/'.$template_name, $vars);
	    }

    }
}