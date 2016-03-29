<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ACL_Controller extends MY_Controller {
	public function __construct(){
        parent::__construct();
        
        $this->load->model('Model_Acl');
        $this->load->model('Model_Users');
      
    }
	public function index()
	{

		$this->template->render('acl/index');
	}
/*
=====================================================================================================================================
* ROLES 
=====================================================================================================================================
*/
	public function roles(){

		$this->template->set('roles',$this->Model_Acl->getRoles());
		$this->template->render('acl/roles'); 
	}
	public function permissionsRole($roleID){
		if(! $roleID){
			redirect('admin/ACL_Controller/roles');
		}
		$row = $this->Model_Acl->getRole($roleID);

		if(!$row){
			redirect('admin/ACL_Controller/roles');
		}


		if ( isset($_POST['save_permissionsRole']) && $_POST['save_permissionsRole'] == 1 ) {
			$values = array_keys($_POST);

			$replace = array();
			$eliminar = array();

			for ($i = 0; $i <count($values); $i ++) {
				if (substr($values[$i], 0,5) == 'perm_') {
					$permiso = (strlen($values[$i]) -5 );
					if ($_POST[$values[$i]] == 'x') {
						$eliminar[] = array(
							'role' => $roleID,
							'permiso' => substr($values[$i], -$permiso),

							);
					}else{
						if ($_POST[$values[$i]] == 1) {
							$v=1;
						}else{
							$v=0;
						}

						$replace[] = array(

							'role' => $roleID,
							'permiso' => substr($values[$i], -1),
							'valor' => $v
							);
					}
				}
			}
			for ($i = 0; $i <count($eliminar); $i ++) {
				$this->Model_Acl->removePermissionsRole(
					$eliminar[$i]['role'],
					$eliminar[$i]['permiso']
					);
			}
			for ($i = 0; $i <count($replace ); $i ++) {
				$this->Model_Acl->editPermissionsRole(
					$replace[$i]['role'],
					$replace[$i]['permiso'],
					$replace[$i]['valor']
					);
			}
		}


		$this->template->set('titulo','Administrador de permosos de rol');
		$this->template->set('role',$row);
		$this->template->set('permisos',$this->Model_Acl->getPermissionsRole($roleID));
		$this->template->render('acl/permissions_role'); 

	}
	public function nuevo_role(){
		$this->template->set('titulo','Nuevo Role');
        
        if(isset($_POST['guardar']) && $_POST['guardar'] == 1){
            $this->template->set('datos', $_POST['role']);
            
            if(! $this->Model_Acl->insertarRole($_POST['role'])){
            	$this->template->add_message(['error' => [$this->lang->line('acl_error_rol_duplicate')]]);
                
                $this->template->render('acl/nuevo_role');
                
            }else{
	            redirect('admin/ACL_Controller/roles');
        	}
        }else{
        	$this->template->render('acl/nuevo_role');
        
        }
	}
/*
=====================================================================================================================================
*/
	public function usuarios(){
		$this->template->set('titulo', 'Usuarios');
		$this->template->set('usuarios', $this->Model_Users->getUsuarios());
		$this->template->render('acl/users/index');
	}
	public function permisosusuario($usuarioID){
		echo $usuarioID;
	}
	public function algo (){

		$this->Model_Users->get_users();
	}

}
