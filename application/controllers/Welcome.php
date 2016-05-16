<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function index()
	{
		//$this->load->view('welcome_message');
		/*
		$this->load->library('acl',['lang'=>'spanish','id'=>1]);
		echo "<pre>";
		print_r($this->acl->permissions);
		print_r($this->acl->site_permissions);
		
		exit;
		//*/

		$this->template->load_config_modules(['menus/config_modulo_menu','menus/config_modulo_menu2']);
		
		$this->template->load_config_modules('gallery/config_fancyBox_simple_image_gallery');
		$this->template->load_config_modules('gallery/config_fancyBox_Button');
		$this->template->load_config_modules('gallery/config_fancyBox_Thumbnail');
		
		

		$this->load->library('user',['lang'=>'spanish','id'=>2]);
		
		$this->template->add_message(['error' => ['mensaje','mensaje'],'success'=>'hola']);
		
		# se le envia el item seleccionado
		$this->template->set(  'menu_principal'  ,  modules::run('menus/widgetMenuHeader','324')  );
		

		$this->template->render(['welcome_message']);
                
	}
        public function dbclear(){
            $sql = [];
            $sql[] =  "TRUNCATE TABLE crm_cliente; ";
            $sql[] =  "TRUNCATE TABLE crm_cliente_contacto; ";
            $sql[] =  "TRUNCATE TABLE crm_contacto; ";
            $sql[] =  "TRUNCATE TABLE crm_detallesCliente; ";
            $sql[] =  "TRUNCATE TABLE crm_detallesContacto; ";
            $sql[] =  "TRUNCATE TABLE crm_proyecto; ";
            $sql[] =  "TRUNCATE TABLE crm_proyecto_contactos; ";
            $sql[] =  "TRUNCATE TABLE crm_proyecto_users; ";
            $sql[] =  "TRUNCATE TABLE crm_servicio;";
            
            foreach($sql as $s){
                $this->db->query($s);
            }
            

        }
}
