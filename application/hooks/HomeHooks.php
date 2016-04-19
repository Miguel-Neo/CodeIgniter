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
            /*
            echo '<pre>';
                if($this->ci->session->userdata('user_id')){
                    echo 'true';
                }else{
                    echo 'false';
                }
                if($this->ci->user->has_permission('public')){
                    echo '<br>tengo permiso<br>';
                }else{
                    echo '<br>no tengo permiso <br>';
                }
                //*/
                # Si no esta autenticado 
		if($this->ci->session->userdata('user_id') == FALSE)
		{
			//redirect(base_url('users/login'));
			//echo "<h1>este es mensaje del hooks</h1>";
		}
	}
}
/*
/end hooks/home.php
*/