<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Permisos extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('acl/Model_Permissions');
    }
    public function index(){
        if(isset($_POST['edit_permission']) && $_POST['edit_permission'] == 1){
            $permission = array(
                'id' => $_POST['id'],
                'title' => $_POST['title'],
                'name' => $_POST['name']
            );
            $this->Model_Permissions->editPermissions($permission);
        }
        
        $this->template->set('permissions', $this->Model_Permissions->getPermissions());
        $this->template->render('acl/permisos/permisos');
        
    }
    public function nuevo(){
        if($this->input->post('nuevo')==1){
            $perm = array(
                'title' =>$_POST['title'],
                'name' => $_POST['name']
            );
            if(!$this->Model_Permissions->insertpermission($perm)){
                $this->template->set_flash_message(['error' => dictionary('theme_model_erro')]);         
            }else{
                $this->template->set_flash_message(['success' => dictionary('theme_model_success')]);
            }
            redirect('permisos');
        }
        
        $this->template->set('action','Permisos/nuevo');
        $this->template->set('input_hidden',['nuevo'=>1]);
        $this->template->render('acl/permisos/nuevo_permiso');
    }
    public function eliminar($IDpermission){
        if(! $this->Model_Permissions->eliminarpermiso($IDpermission)){
            # imprimir mensaje de error 
            # en formato development muestra pagina de error 
            # en formato production no realizara cambios
        }
        redirect('permisos');
    }
}