<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class File extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index($name = '') {
        redirect('File/do_upload');
        $this->load->helper('file');
        $contenido = get_dir_file_info(APPPATH."../assets/".$name);
        
        
        $this->template->set('contenido',$contenido);
        $this->template->render('file/archivos');
    }
    

    public function do_upload() {
        $config['upload_path'] = 'access_public/imagenes';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|zip';
        $config['max_size'] = 400048;
        $config['max_width'] = 0;
        $config['max_height'] = 0;
        $config['remove_spaces'] = true;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $this->template->add_message(['error' => $this->upload->display_errors()]);
            
            $this->template->render('file/subir');
        } else {
            $data = $this->upload->data();

            $this->template->set('upload_data', $data);
            $this->template->render('file/upload_success');
        }
    }

    public function sub2() {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

            
            /* ---------- */
            //obtenemos el archivo a subir
            $file = $_FILES['userfile']['name'];
            //$direccion = $_SERVER['DOCUMENT_ROOT']."/neocrm/proyectos/".$_GET['id_proyecto']."/".$_FILES['archivo']['name']; 

            $direccion = "/Applications/XAMPP/xamppfiles/htdocs/www/CodeIgniter/assets/archivos/";
            
            print_r($file);

            //comprobamos si el archivo ha subido
            if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], $direccion . $file)) {
               
                
                /* ---------- */
            }

            
        } else {
            throw new Exception("Error Processing Request", 1);
        }
    }

}
