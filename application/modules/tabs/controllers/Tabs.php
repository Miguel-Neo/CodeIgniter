<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/*
 * Gallery hace uso de la libreria fancyBox
 */
class Tabs extends MY_Controller {

	public function __construct(){
        parent::__construct();
       
      
    }
	public function index()
	{
		
	}
	public function widgettabs(){
	
		
		$this->load->view('fancyBox_Button');
		

	} 
}
