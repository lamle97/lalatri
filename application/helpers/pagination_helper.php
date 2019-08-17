<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function pagination($data = array())
{
	$CI =& get_instance();

	$CI->load->library('pagination');

	$config['base_url'] = ($_SERVER['QUERY_STRING'])?current_url()."?".$_SERVER['QUERY_STRING']:current_url();
	$config['page_query_string'] = TRUE;
	$config['query_string_segment'] = 'page';
	$config['total_rows'] = $data['total_rows'];
	$config['per_page'] = $data['per_page'];
	$config['use_page_numbers'] = TRUE;	

	$config['full_tag_open'] = '<div class="pagination alternate"><ul class="pagination">';
	$config['full_tag_close'] = '</ul></div><!--pagination-->';
	$config['first_link'] = '&laquo; First';
	$config['first_tag_open'] = '<li>';
	$config['first_tag_close'] = '</li>';
	$config['last_link'] = 'Last &raquo;';
	$config['last_tag_open'] = '<li>';
	$config['last_tag_close'] = '</li>';
	$config['next_link'] = 'Next &rarr;';
	$config['next_tag_open'] = '<li>';
	$config['next_tag_close'] = '</li>';
	$config['prev_link'] = '&larr; Previous';
	$config['prev_tag_open'] = '<li>';
	$config['prev_tag_close'] = '</li>';
	$config['cur_tag_open'] = '<li class="active"><a href="">';
	$config['cur_tag_close'] = '</a></li>';
	$config['num_tag_open'] = '<li>';
	$config['num_tag_close'] = '</li>';		

	$CI->pagination->initialize($config);

	return $CI->pagination->create_links();
}