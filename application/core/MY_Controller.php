<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  Requiere del archivo aplication/config/cms.php
 */

class MY_Controller extends MX_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->config('cms'); // cargo al config mi archivo de configuracion cms
        if (!$this->config->item('cms_admin_panel_uri')) {
            show_error('Error de configuracion');
        }

        $this->_set_language();
        /*
          Le paso el nombre del archivo y si no le paso el segundo parametro carga el que tiene
          configurado en el archivo config
         */
        $this->lang->load('cms_general');
        $this->lang->load('theme');
        $this->load->library(['template']); #CARGA LAS LIBRERIAS TEMPLATE Y USER
        $this->load->library('user');
        
        //echo '<pre>';
        //$this->load->library('user',['id'=>null]); #probando con el usuario 1
      
    }

    /**
     * Si el primer segmento de la url es admin 
     * Esta funcion devolbera true 
     * Para saber si estamos en el frontend o en el backend
     * @return type
     */
    public function admin_panel() {
        return strtolower($this->uri->segment(1)) == $this->config->item('cms_admin_panel_uri');
    }

    private function _set_language() {
        #	$config['cms_languages'] = ['english','spanish'];
        /*
          En el controlador Languaje define el lenguaje a usa $this->session->set_userdata('global_lang',$lang);
         */
        $lang = $this->session->userdata('global_lang'); // leo de variable de session el lenguaje
        
        if ($lang && in_array($lang, $this->config->item('cms_languages'))) {
            //si existe lang y ese idioma pertenece a  los que tenemos en nuestro archivo de configuracion
            $this->config->set_item('language', $lang);
            // setea el nuevo lenguaje a cargar 
        }
    }

}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */