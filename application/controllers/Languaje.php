<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Languaje extends MY_Controller {
        public function __construct() {
            parent::__construct();
        }
	public function change($lang = null)
	{
            if($lang != null){
		if (in_array($lang, $this->config->item('cms_languages'))) {
			// si el lenguaje que se le paso existe en nuestro arreglo application/config/cms.php
			// crea la variable de session 
			$this->session->set_userdata('global_lang',$lang);
		}
            }else{
                show_error($this->lang->line('cms_general_error_set_lenguage'));
            }
	}
}
