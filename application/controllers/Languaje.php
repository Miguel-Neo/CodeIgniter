<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Languaje extends MY_Controller {
        public function __construct() {
            parent::__construct();
        }
	public function change($lang)
	{
		if (in_array($lang, $this->config->item('cms_languages'))) {
			// si el lenguaje que se le paso existe en nuestro arreglo application/config/cms.php
			// crea la variable de session 
			$this->session->set_userdata('global_lang',$lang);
		}
		//redirect();
	}
        public function changethema($lang)
	{
            //print_r($this->config->item('cms_languages'));
            $this->template->render();
            $panel = $this->admin_panel() ? 'admin' : 'front';
            $name = $this->template->getTemplate();
                    
            print_r($panel."   ".$name);
		//redirect();
	}
}
