<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menus extends MY_Controller {

	/*
menu:
http://www.cristalab.com/tutoriales/crear-menu-de-navegacion-con-un-helper-de-codeigniter-c95190l/

galerias:
http://bootsnipp.com/tags/gallery
http://startbootstrap.com/template-overviews/3-col-portfolio/
http://bootsnipp.com/snippets/featured/image-gallery-with-fancybox

menu multi nivel:
http://bootsnipp.com/snippets/featured/multi-level-dropdown-menu-bs3
	*/
	public function __construct(){
        parent::__construct();
        
        $this->load->model('modulo_modelo_menu');
        $this->load->helper('html');
        
        $this->load->library('modulo_menus_libraries_menu');
      
    }
	public function index()
	{
		
	}
	public function widgetMenuHeader($selected='home'){
	//	mod_menu_ul();
	//	modmenusDelnavo();
		$menu = $this->modulo_modelo_menu->get_items('navigation');

		$data['menu'] = $this
			->modulo_menus_libraries_menu
			->get_menu_ul($menu,$selected);

	//	$this->load->view('modulo_menu_test');
	//	$this->load->view('menuHeader',$data);
		$this->load->view('modulo_menus_view_menu_02',$data);

		//$this->load->view('modulo_menus_view_menu_03',$data);

	} 
	public function menuPrincipal($nameMenu,$selected='Home'){
		$menu = $this->modulo_modelo_menu->get_items($nameMenu);

		$data['menu'] = $this
			->modulo_menus_libraries_menu
			->get_menu_ul($menu,$selected);
		$this->load->view('modulo_menus_view_menu_02',$data);
	}
}
