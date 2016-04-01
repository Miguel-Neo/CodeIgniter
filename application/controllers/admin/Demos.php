<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demos extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->template->setTemplate('demos');
		$this->template->add_css('template','custom');
	}
	public function index()
	{
		

		$this->template->load_config_modules('menus/config_modulo_menu');
		# se le envia el item seleccionado
		$this->template->set(  'menu_principal'  ,  modules::run('menus/menuPrincipal','demos','demos_item_index')  );
		
		$this->template->render('welcome_message');

	}
	
	public function menus()
	{
		

		$this->template->load_config_modules('menus/config_modulo_menu');
		# se le envia el item seleccionado
		$this->template->set(  'menu_principal'  ,  modules::run('menus/menuPrincipal','demos','demos_item_menus')  );
		
		$this->template->render(['welcome_message']);

	}
	public function galerias()
	{
		

		$this->template->load_config_modules('menus/config_modulo_menu');
		# se le envia el item seleccionado
		$this->template->set(  'menu_principal'  ,  modules::run('menus/menuPrincipal','demos','demos_item_galerias')  );
		
		$this->template->render(['welcome_message']);

	}
}
