<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends MY_Controller {

    public function __construct(){
        parent::__construct();
        
        $this->load->model('acl/Model_Users');
        $this->load->model('acl/Model_Roles');
    }
    public function index(){
        $this->template->set('usuarios', $this->Model_Users->getUsuarios());
        $this->template->render('acl/usuario/usuarios');
    }
    public function nuevo(){
        if ($this->input->post('nuevo_usuario') == 1) {
            
            $user = array(
                'idcreator' =>$this->user->id,
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'user' => $this->input->post('user'),
                'password' => $this->input->post('password'),
                'role' => $this->input->post('role')
            );
            if($this->Model_Users->insertUser($user)){
                redirect('usuario');
            }
            $this->template->add_message(['error' => dictionary('theme_error_duplicate_user')]);
            $this->template->set('user',$user);
        }
        
        $this->template->set('roles', $this->Model_Roles->getRoles());
        $this->template->render('acl/usuario/nuevo_usuario');
    }
    public function permisosusuario($usuarioID) {
        if (!$usuarioID) {
            redirect('usuario');
        }
        $row = $this->Model_Users->getUsuario($usuarioID);

        if (!$row) {
            redirect('usuario');
        }


        if ($this->input->post('save_permissionsUser') == 1) {
            $values = array_keys($this->input->post());

            $replace = array();
            $eliminar = array();

            for ($i = 0; $i < count($values); $i ++) {
                if (substr($values[$i], 0, 5) == 'perm_') {
                    $permiso = (strlen($values[$i]) - 5 );
                    if ($_POST[$values[$i]] == 'x') {
                        $eliminar[] = array(
                            'user' => $usuarioID,
                            'permiso' => substr($values[$i], -$permiso),
                        );
                    } else {
                        if ($_POST[$values[$i]] == 1) {
                            $v = 1;
                        } else {
                            $v = 0;
                        }

                        $replace[] = array(
                            'user' => $usuarioID,
                            'permiso' => substr($values[$i], -1),
                            'valor' => $v
                        );
                    }
                }
            }
            for ($i = 0; $i < count($eliminar); $i ++) {
                $this->Model_Users->eliminarPermiso(
                        $eliminar[$i]['user'], $eliminar[$i]['permiso']
                );
            }
            for ($i = 0; $i < count($replace); $i ++) {
                $this->Model_Users->editarPermiso(
                        $replace[$i]['user'], $replace[$i]['permiso'], $replace[$i]['valor']
                );
            }
        }


        $this->template->set('user', $row);
        $this->template->set('permisos', $this->Model_Users->getPermisosUsuario($usuarioID));
        $this->template->render('acl/usuario/permissions_user');
    }

    
}
