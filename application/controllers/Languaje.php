<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Languaje extends MY_Controller {

	public function change($lang)
	{
		if (in_array($lang, $this->config->item('cms_languages'))) {
			// si el lenguaje que se le paso existe en nuestro arreglo
			// crea la variable de session 
			$this->session->set_userdata('global_lang',$lang);
		}
		//redirect();
	}
}
