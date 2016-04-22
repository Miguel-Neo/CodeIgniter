<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ACL_Controller extends MY_Controller {

    private $input;

    public function __construct() {
        parent::__construct();

        $this->load->model('Model_Acl');
        $this->load->model('Model_Users');
        $this->load->model('Model_Permissions');
    }

   
    /*
      =====================================================================================================================================
     * ROLES 
      =====================================================================================================================================
     */


    /*
      =====================================================================================================================================
     */

    public function usuarios() {

        $this->template->set('titulo', 'Usuarios');
        $this->template->set('usuarios', $this->Model_Users->getUsuarios());
        $this->template->render('acl/users/index');
    }

    public function permisosusuario($usuarioID) {
        if (!$usuarioID) {
            redirect('admin/ACL_Controller/usuarios');
        }
        $row = $this->Model_Users->getUsuario($usuarioID);

        if (!$row) {
            redirect('admin/ACL_Controller/usuarios');
        }


        if (isset($_POST['save_permissionsUser']) && $_POST['save_permissionsUser'] == 1) {
            $values = array_keys($_POST);

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


        $this->template->set('titulo', 'Administrador de permosos de Usuarios');
        $this->template->set('user', $row);
        $this->template->set('permisos', $this->Model_Users->getPermisosUsuario($usuarioID));
        $this->template->render('acl/users/permissions_user');
    }

    public function new_user() {
        if (isset($_POST['guardar']) && $_POST['guardar'] == 1) {
            $user = array(
                'idcreator' =>$this->user->id,
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'user' => $_POST['user'],
                'password' => $_POST['password'],
                'role' => $_POST['role']
            );
            $this->Model_Users->insertUser($user);
            redirect('admin/ACL_Controller/usuarios');
        }

        $this->template->set('roles', $this->Model_Acl->getRoles());
        $this->template->render('acl/users/new_user');
    }

    public function get_users() {

        $this->Model_Users->get_users();
        //$this->template->render('acl/users/index');
    }
    /*
      =====================================================================================================================================
     */

}
