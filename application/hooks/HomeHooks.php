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
           
           if($this->ci->uri->segment(1) != "login")
            {
                if($this->ci->session->userdata('user_id') == FALSE)
                {
                    redirect(base_url('login'));
                }
            }
            
            //$this->uri->segment(1)
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
            
            
            /**
		if($this->ci->session->userdata('user_id') == FALSE)
		{
			redirect(base_url('Usuario/login'));
                }
                //*/
	}
}
/*
/end hooks/home.php
*/