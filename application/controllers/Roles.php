<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('acl/Model_Roles');
    }
    
    public function index(){
        $this->template->set('roles', $this->Model_Roles->getRoles());
        $this->template->render('acl/rol/roles');
    }
    public function nuevo() {

        if (isset($_POST['guardar_nuevo_rol']) && $_POST['guardar_nuevo_rol'] == 1) {

            if (!$this->Model_Roles->insertarRole($_POST['role'])) {
                $this->template->add_message(['error' => [dictionary('acl_error_rol_duplicate')]]);

                $this->template->render('acl/rol/nuevo_rol');
            } else {
                redirect('roles');
            }
        } else {
            $this->template->render('acl/rol/nuevo_rol');
        }
    }
    public function editar(){
        if ($this->input->post('edit_role') == 1) {
            $id = $this->input->post('id');
            $name = $this->input->post('role');
            if($this->Model_Roles->editnameRole($id, $name)){
                $this->template->set_flash_message(['success' => dictionary('theme_model_role_edit_success')]);
            }else{
                $this->template->set_flash_message(['error' => dictionary('theme_model_role_edit_error')]);
            }
        }
        redirect('roles');
    }
    public function eliminar($ID){
        $this->Model_Roles->removeRole($ID);
        redirect('roles');
    }
    public function permisos($roleID){
        if (!$roleID) {
            redirect('roles');
        }
        $row = $this->Model_Roles->getRole($roleID);
        
        if (!$row) {
            redirect('roles');
        }


        if (isset($_POST['save_permissionsRole']) && $_POST['save_permissionsRole'] == 1) {
            $values = array_keys($_POST);

            $replace = array();
            $eliminar = array();

            for ($i = 0; $i < count($values); $i ++) {
                if (substr($values[$i], 0, 5) == 'perm_') {
                    $permiso = (strlen($values[$i]) - 5 );
                    if ($_POST[$values[$i]] == 'x') {
                        $eliminar[] = array(
                            'role' => $roleID,
                            'permiso' => substr($values[$i], -$permiso),
                        );
                    } else {
                        if ($_POST[$values[$i]] == 1) {
                            $v = 1;
                        } else {
                            $v = 0;
                        }

                        $replace[] = array(
                            'role' => $roleID,
                            'permiso' => substr($values[$i], -1),
                            'valor' => $v
                        );
                    }
                }
            }
            for ($i = 0; $i < count($eliminar); $i ++) {
                $this->Model_Roles->removePermissionsRole(
                        $eliminar[$i]['role'], $eliminar[$i]['permiso']
                );
            }
            for ($i = 0; $i < count($replace); $i ++) {
                $this->Model_Roles->editPermissionsRole(
                        $replace[$i]['role'], $replace[$i]['permiso'], $replace[$i]['valor']
                );
            }
        }


        
        $this->template->set('role', $row);
        $this->template->set('permisos', $this->Model_Roles->getPermissionsRole($roleID));
        $this->template->render('acl/rol/permisos_rol');
    }
    
}
