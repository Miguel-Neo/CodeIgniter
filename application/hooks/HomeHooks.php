<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class HomeHooks
{
	private $ci;
	public function __construct()
	{
		$this->ci =& get_instance();
		!$this->ci->load->library('session') ? $this->ci->load->library('session') : false;
		!$this->ci->load->helper('url') ? $this->ci->load->helper('url') : false;
	}	

	public function check_login()
	{
		if($this->ci->session->userdata('id') == FALSE)
		{
			//redirect(base_url('login');
		//	echo "<h1>este es mensaje del hooks</h1>";
		}
	}
}
/*
/end hooks/home.php
*/