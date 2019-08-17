<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('system/setting');
    }    

	public function index()
	{
        if($this->input->post('settings') && $this->validate())
        {
            $settings = $this->input->post('settings');

            foreach ($settings as $key => $value) {
                if ($this->setting->getSettingValue($key) === null)
                    $this->setting->addSetting($key, $value);
                else
                    $this->setting->editSetting($key, $value);
            }

            $this->session->set_userdata('success','Edit setting successfull.');

            redirect('/admin/system/settings', 'location');
        }

        $data['settings'] = $this->setting->getSetting();

        if (file_exists(FCPATH .'application/views/'. $data['settings']['shop_template'] .'/addon/settings.php'))
        {
            $data['setting_template'] = $this->load->view_template('addon/settings.php', $data, true);
        }

		$this->load->template_admin('system/setting_form', $data);

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
