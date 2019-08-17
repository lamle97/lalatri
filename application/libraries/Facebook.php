<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'fb/lib_facebook.php';

class Facebook extends Lib_facebook{
    public function __construct()
    {
        parent::__construct(array(
		  'appId'  => '822588784564045',
		  'secret' => 'c3a3e17b5e12fd7a2d88cde95f10c732',
		));
    }
}