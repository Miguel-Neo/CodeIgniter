<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Esta librería es usada desde la librería ./application/libraries/User.php 
 * El usuario registrado debe pertenecer a un Rol ya que si no pertenece solo 
 * Tendra el permiso por default
 * 
 * title es el permiso 
 * name es el key  no puede ser un numero tienen q ser letras o combinado
 */
class Acl {
	private $CI;
	private $tables = [
		'users'=>'acl_users',
		'roles'=>'acl_roles',
		'perms'=>'acl_permissions',
		'user_perms'=>'acl_user_permissions',
		'role_perms'=>'acl_role_permissions'
	];
	private $user_id;  # SU ASIGNACION SE REALIZA EN __construct
	private $user_role_id; # SU ASIGNACION SE REALIZA EN __construct
	private $user_permissions;
	private $user_site_permissions;

	public function __construct( $options = array() ){
		$this->CI = & get_instance();
		$this->CI->load->config('acl');
		
		# si existe el usuario pone su id sino pone 0  <----
		$this->user_id = isset($options['id']) ? (int)$options['id'] : 0; 
		if ($this->user_id > 0 ) {

			# SI ESTE USUARIOI TINEN UN ROL PONE EL ID DEL ROL 
			# CARGA ROLe DE USUARIO
			$user_role = $this->CI->db
				->select('role')
				->get_where($this->tables['users'],['id'=>$this->user_id])->row();

			# SETEAR ID DEL ROLE
			# SINO TIENE ROL PONE 0 <----
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
		# agrega a los permisos del usuario el permoso del sitio que coincida con los permisos que tiene
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

        /**
         * Nos regresa los ids de los permisos aignados a el ROL que el user tiene asignado
         * @return En caso de existir un ROL retorna sus permisos, pero si no existe 
         *         ningun rol retorna un arrelgo vacio
         */
	public function role_permissions_ids(){
		# Esta funcion es usada en user_permissions()
		$ids = [];

		if ($this->user_role_id > 0) { # SI EXISTE UN ID DE ROL
			$perms = $this->CI->db
					->select('permission')
					->get_where($this->tables['role_perms'],['role'=>$this->user_role_id])
					->result_array();
			$ids = array_map(function ($item){
				return $item['permission'];# RETORNA EL VALOR DE CADA REGISTRO
			},$perms);
			array_filter($perms); # ELIMINA LOS ELEMENTOS VACIOS EN CASO DE QUE EXISTA ALGUNO
		} # SI NO EXISTE ROL RETORNA UN ARREGLO VACIO 
		return $ids;
	}
        /**
         * Nos reotna los permisos del ROL asignado a este usuario 
         * @return Los permisos del ROL.
         *         En caso de no tener ningun permiso Retorna el permiso public
         *         
         */
	public function role_permissions(){
		if ($this->user_role_id > 0) { # SI EXISTE UN ID DE ROL
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
		# EN CASO DE QUE NO TENGA NINGUN PERMISO RETORNA EL PERMISO PUBLIC 
		return $this->_permission('public');
	}
        /**
         * Nos reotna los permisos usuario 
         * @return Los permisos del usuario.
         *		   En caso de que no tenga ningu permiso retornara un arreglo vacio.
         *         Esto no genera ningun problema ya que al alcer arraymerge en el constructor
         *         tendra los permisos que genera del rol, minimo tendra public
         */
	public function user_permissions(){
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
        /**
         * FUNCION USADA PARA VERIFICAR SI EL USUARIO TIENE EL PREMISO 
         * QUE SE LE PASA COMO PARAMETRO
         * @param type $name ES EL NOMRE DEL PERMISO
         * @return boolean NOS DEVUELVE VERDADERO O FALSO DEPENDIENDO DE SI 
         *         EL USIARIO TIENE UN PERMISO HABILITADO O NO. 
         */
	public function has_permissions($name){
		if (array_key_exists($name, $this->user_permissions)) {
			if ($this->user_permissions[$name]['value'] == TRUE) {
				return TRUE;
			}
		}
		return FALSE;
	}
        /**
         * SETEAR LOS PERMISOS DEL SITIO
         * Nos va a servir para realizar consultas a las bases de datos, 
         * para traer consultas de acuedo a sus permisos
         * @param type $line     CLAVE DEL ARCHIVO DE CONFIGURACION config/acl.php
         * @param type $default  Es el permiso por default
         * @return type array    Los permisos que se encuentran el el archivo de configuracion 
         *          que coincidan con los pormisos que tienen el usuario 
         *          en caso de que no coincida ninguno retornara el permiso por default
         */
	private function _permissions($line,$default){
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
        /**
         * ESTE NOS DEVIELVE UN PERMISO EN PARTICULAR EN EL FORMATO USADO POR EL SISTEMA
         * El permiso que le pasamos tiene que existir en el la tabla permission 
         * @param type $name Es un nombre de que se conbertira en un permiso 
         *        En el formato usado por el sistema, pensado por si el usuario no tiene 
         *        ningu permiso aqui se creara uno por defau, 
         *        usado en la funcion role_permissions() para definir el permiso public
         * @return type retorna el $name en formato de permiso usado por el sistema
         */
	private function _permission($name){
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
		# si no se sobreescribio antes la variable esto quiere decir que si soporta
		# el idioma que se le paso y lo carga
		$this->CI->load->language('acl',$lang); // usa acl_lang.php 
	}

}


/* End of file Acl.php */
/* Location: ./application/libraries/Acl.php */