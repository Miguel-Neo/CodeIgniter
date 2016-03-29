<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Users extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	function get_users(){
/*
		$this->db->insert('users',[
			'name'=>'back-end'
			]);
//*/
//			/*
			$this->getPermisosUsuario(1);
		$query = $this->db->get('users');

		foreach ($query->result() as $row)
		{
			print_r($row);
		}
//*/
		//return $this->db->get('users')->row();
	}
	function get_user_details($user_id){
		$where['id'] = $user_id;
		return $this->db->get_where('users',$where)->row();
	}
	function algo(){
		///*
		$this->db->insert('templates',[
			'name'=>'front-end',
			'description'=>'Template front-end',
			'panel'=>'f',
			'default'=>1
			]);
		$this->db->insert('templates',[
			'name'=>'back-end',
			'description'=>'Template back-end',
			'panel'=>'b',
			'default'=>1
			]);
		
		$this->db->where(['id'=>2,'name'=>'back-end'])->update('templates',[
			'description'=>'Template back-end',
			'panel'=>'b',
			'default'=>1
			]);
		
		echo "<pre>";
		print_r($this->db->get('templates')->result());
		//*/
		/*
		$this->template->add_js('template','script1','utf-8',true,true);
		$this->template->add_css('view',['css1','css2'],'print');
		$this->template->add_css('url','http://css2.css','print');
		//*/
	}

	public function getUsuarios()
	{
		$usuarios = $this->db->query("select u.*,r.role from users u, roles r where u.role = r.id");
        return $usuarios->result();
	}

	public function getUsuario($usuarioID)
	{
		$usuarios = $this->db->query("select u.name,r.role from users u, roles r where u.role = r.id AND u.id = $usuarioID");
		//echo "<pre>";
		//print_r($usuarios->result_array());
		//exit;
        return $usuarios->result_array();
	}

	public function getPermisosUsuario($usuarioID)
	{
		$User = new User(['id' => $usuarioID,'lang' => 'spanish']); # CREA ACL CON ID
		//echo "<pre>";
		//print_r($User->permissions());
		//exit;
		return $User->permissions();
	}

	public function getPermisosRole($usuarioID)
	{
		$acl = new ACL($usuarioID);
		role_permissions();
        return $acl->getPermisosRole();
	}

	public function eliminarPermiso($usuarioID, $permisoID)
	{
		$this->db->query(
                "delete from permisos_usuario where ".
                "usuario = $usuarioID and permiso = $permisoID"
                );
	}

	public function editarPermiso($usuarioID, $permisoID, $valor)
    {
        $this->db->query(
                "replace into permisos_usuario set ".
                "usuario = $usuarioID , permiso = $permisoID, valor ='$valor'"
                );
    }
}