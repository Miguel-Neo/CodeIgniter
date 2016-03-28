<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acl {
	private $CI;
	private $tables = [
		'users'=>'users',
		'roles'=>'roles',
		'perms'=>'permissions',
		'user_perms'=>'user_permissions',
		'role_perms'=>'role_permissions'
	];
	private $user_id;  # SU ASIGNACION SE REALIZA EN __construct
	private $user_role_id; # SU ASIGNACION SE REALIZA EN __construct
	private $user_permissions;
	private $user_site_permissions;

	public function __construct( $options = array() ){
		$this->CI = & get_instance();
		$this->CI->load->config('acl');
		
		# si existe el usuario pone si id sino pone 0  <----
		$this->user_id = isset($options['id']) ? (int)$options['id'] : 0; 
		if ($this->user_id > 0 ) {
			# SI ESTE USUARIOI TINEN UN ROL PONE EL ID DEL SOL 
			# SINO TIENE ROL PONE 0 <----
			# CARGA ROLe DE USUARIO
			$user_role = $this->CI->db
				->select('role')
				->get_where($this->tables['users'],['id'=>$this->user_id])->row();

			# SETEAR ID DEL ROLE
			$this->user_role_id = isset($user_role->role) ? (int)$user_role->role : 0;
		}

		# SETEAR EL LENGUAGE
		$this->_set_language( isset($options['lang']) ? $options['lang'] : null );

		# SETEAR PERMISOS DE USUARIO DESDE 
		# role_permissions() 
		# MAS 
		# user_permissions()
		$this->user_permissions = array_merge($this->role_permissions(),$this->user_permissions());

		# SETEAR LOS PERMISOS DEL SITIO
		# RECIBE LA CLAVE DEL ARCHIVO DE CONFIGURACION config/acl.php 
		# Ese archivo contiene los nombre de los permisos del sitio 
		# agrega a loas permisos del usuario el permoso del sitio que coincida
		# tambien le pasamos default public en caso de que el usuario no tenga ningu permiso 
		# el usuario tendre por defecto public 
		$this->user_site_permissions = $this->_permissions('acl_site_permissions','public');
	}
	public function __get($name){
		# nos permite hacer get de los atibutos sin crear sus geter para cada uno
		$property = 'user_'.$name;

		if (isset($this->$property)) {
			return $this->$property;
		}
	}


	public function role_permissions_ids(){
		# nosregresa los ids de los permisos aignados a el ROL que el user tiene asignado
		# Esta funcion es usada en user_permissions()
		$ids = [];

		if ($this->user_role_id > 0) {
			$perms = $this->CI->db
					->select('permission')
					->get_where($this->tables['role_perms'],['role'=>$this->user_role_id])
					->result_array();
			$ids = array_map(function ($item){
				return $item['permission'];
			},$perms);
			array_filter($perms);
		}
		return $ids;
	}
	public function role_permissions(){
		# nos reotna los permisos del rol asignado a ese usuario 
		if ($this->user_role_id > 0) {
			$permissions = $this->CI->db
						->from($this->tables['role_perms'].' r')
						->select(['r.permission','r.value','p.name','p.title'])
						->join($this->tables['perms'].' p','r.permission = p.id')
						->where(['r.role' => $this->user_role_id] )
						->get()->result();

			if (sizeof($permissions) > 0) {
				$data = [];
				foreach ($permissions as $permission) {
					if (trim($permission->name) == '') {
						continue;
					}
					$data[$permission->name] = [
						'permission'=>$permission->name,
						'title'=>$permission->title,
						'value'=>$permission->value == 1 ? TRUE : FALSE,
						'inherited'=>TRUE,
						'id'=>$permission->permission,
					];
				}
				if (sizeof($data) > 0) {
					return $data;
				}
			}

		}
		return $this->_permission('public');
	}
	public function user_permissions(){
		# nos reotna los permisos usuario 
		$data = [];
		# SI EXISTE EL USUARIO Y TIENE UN ROL 
		if ($this->user_id > 0 && $this->user_role_id > 0) {
			$ids = $this->role_permissions_ids(); # LOS ID DE PERMOSOS DE SU ROL 
			if (sizeof($ids) > 0 ) {
				$permissions = $this->CI->db
						->from($this->tables['user_perms'].' u')
						->select(['u.permission','u.value','p.name','p.title'])
						->join($this->tables['perms'].' p','u.permission = p.id')
						->where(['u.user' => $this->user_id] )
						->where_in(['u.permission' => $ids] ) # WHERE u.permission IN (1,2,3)
						->get()->result();

				if (sizeof($permissions) > 0) {
					
					foreach ($permissions as $permission) {
						if (trim($permission->name) == '') {
							continue;
						}
						$data[$permission->name] = [
							'permission'=>$permission->name,
							'title'=>$permission->title,
							'value'=>$permission->value == 1 ? TRUE : FALSE,
							'inherited'=>FALSE,
							'id'=>$permission->permission,
						];
					}
				}
			}
		}
		return $data;
	}
	public function has_permissions($name){
		# NOS DEVUELVE VERDADERO O FALSO DEPENDIENDO DE SI EL USIARIO TIENE UN 
		# PERMISO AVILITADO O NO 
		if (array_key_exists($name, $this->user_permissions)) {
			if ($this->user_permissions[$name]['value'] == TRUE) {
				return TRUE;
			}
		}
		return FALSE;
	}

	private function _permissions($line,$default){
		# PERMISOS DEL SITIO RECIVE ELCONFIG Y EL DAFAULT Q ES PUBLIC
		# SIRVE PARA HACER CONSULTAS A LAS BASES DE DATOS DE ACUERDO A LOS 
		# PERMISOS Q TENGA EL USUARIO
		$permissions = $this->CI->config->item($line);
		$result = [];

		if (is_array($permissions) && sizeof($permissions) > 0) {
			foreach ($permissions as $permission) {
				if ($this->has_permissions($permission) === TRUE ) {
					$result[] = $permission;
				}
			}
		}
		if (sizeof($result) == 0) {
			$result[] = $default;
		}
		return $result;
	}
	private function _permission($name){
		# ESTE NOS DEVIELVE UN PERMISO EN PARTICULAR EN EL FORMATO USADO POR EL SISTMA 
		$name = trim($name);
		if (! empty($name)) {
			$permission = $this->CI->db
					->get_where($this->tables['perms'],['name'=>$name])->row();
			if (sizeof($permission) > 0 ) {
				$data[$permission->name] = [
							'permission'=>$permission->name,
							'title'=>$permission->title,
							'value'=>TRUE,
							'inherited'=>TRUE,
							'id'=>$permission->id,
						];
				return $data;
			}
		}
		show_error($this->CI->lang->line('acl_error_permission_not_fount'));
	}
	private function _set_language($lang = null){
		$languages = ['english','spanish'];

		if(! $lang){
			# Si no se le pasa un lenguaje verifica si el lenguaje del sistema 
			# esta contenido en el arreglo que creamos arriba $languages = ['english','spanish'];
			if (in_array($this->CI->config->item('language'), $languages)) {
				$lang = $this->CI->config->item('language');
			}else{
				$lang = $languages[0];
			}
		}else{
			if (! in_array($lang, $languages)) {
				# si se le pasa un lenguaje y no pertenece 
				# a alguno q definimos regresa en ingles
				$lang = $languages[0];
			}
		}
		# si no se sobreescrivio antes la bariable esto quiere decir que si soporta
		# el idioma que se le paso y lo carga
		$this->CI->load->language('acl',$lang); // usa acl_lang.php 
	}

}


/* End of file Acl.php */
/* Location: ./application/libraries/Acl.php */