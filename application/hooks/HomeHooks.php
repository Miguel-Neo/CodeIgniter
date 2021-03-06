<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class HomeHooks {

    private $CI;

    public function __construct() {
        $this->CI = & get_instance();
        !$this->CI->load->library('session') ? $this->CI->load->library('session') : false;
        !$this->CI->load->helper('url') ? $this->CI->load->helper('url') : false;
    }

    public function check_login() {
        /*
          echo '<pre>';
          print_r($this->CI->uri->rsegments);
          exit;
          // */

        if ($this->CI->uri->segment(1) != "login") {
            # Si es diferente del controlador login verificara que este logeado
            # Si no esta logueado mandara a login
            if ($this->CI->session->userdata('user_id') == FALSE) {
                redirect(base_url('login'));
            }
            
            if (!$this->CI->user->has_permission('root')) {
                /**
                 * Verificando que el usuario tenga permiso para acceder 
                 * al controlador y función deseados 
                 */
                $controlador = $this->CI->uri->rsegments[1];
                $funcion = $this->CI->uri->rsegments[2];
                $permission = strtolower($controlador . '/' . $funcion);#paso todo a minusculas
                if (!$this->CI->user->has_permission($permission)) {
                    $this->CI->template->set_flash_message(['error' => dictionary('theme_not_authorized')]);
                    redirect($this->CI->session->userdata('uri_string'));
                }
            }
        }
    }
    public function ignoreAll(){
        
    }

}

/*
/end hooks/home.php
*/