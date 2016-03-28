<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/*
 * Gallery hace uso de la libreria fancyBox
 */
class Gallery extends MY_Controller {

	public function __construct(){
        parent::__construct();
        
        
        $this->load->model('modulo_modelo_gallery');
        
        
      
    }
	public function index()
	{
		
	}
	public function widgetGallery(){
	
		
		$this->load->view('fancyBox_Simple_image_gallery');
		$this->load->view('fancyBox_Button');
		$this->load->view('fancyBox_Thumbnail');
		

	} 
}
