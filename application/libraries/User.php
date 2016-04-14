<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__).'/Acl.php';

/**
 * Manejara al usuario autenticado. Hace uso de la libreria ./application/libraries/Acl.php
 * 
 * Esta libreria se carga desde el core (My_controller) 
 * En el controlador que funcione como login ara uso de esta libreria para verificar si el usuario 
 * tiene acceso al sistema con la funcion que se encuentra en esta libreria.
 * Si el usuario tiene acceso retorna true y el controlador podra crear la variable se session con el id
 * permitiendo asi poder validar en todo momento sus permisos 
 * 
 * login()                 Si el usuario cumple con todo retorna TRUE.
 * 
 * has_permission($name)   verifica que el usuario tenga el premiso que 
 *                         se le pasa como parametro y este habilitado.
 * 
 * permissions()           Me retorna todos los permisos que tenga el usuario 
 *                         tanto de user_permissions y role_permissions.
 * 
 * site_permissions()      Me retorna un arreglo unidimencional con los keys 
 *                         de los permisios de sitio que coinciden con los 
 *                         permisos del usuario.
 *  
 * is_logged_in()          Verifica si esta logeado el usuario.
 *                         Es usado en el logout() del controlador para cerrar session
 */
class User
{
    private $CI;
    private $table = 'users';
    private $lang;
    private $acl;
    private $errors = [];
    private $user_id;
    private $user_user;
    private $user_name;
    private $user_email;
    private $user_status;
    private $user_active;
    private $pattern = "/^([-a-z0-9_-])+$/i"; # ESTE ES EL PATRON DE LOS NOMBRES DE USUARIO
    
    public function __construct($options = array()) 
    {
        $this->CI =& get_instance();
        
        $this->_set_language(isset($options['lang']) ? $options['lang'] : null);
        
        $row = null;
        
        if(isset($options['id']) && (int)$options['id'] > 0)
        {
        	#SI LE PASAN UN USUARIO COMO PARAMETRO
        	#REALIZARA UNA PETICION POR ID 
            $row = $this->_row(['id' => (int)$options['id']]);
            
            if(sizeof($row) == 0)
            {
                show_error($this->CI->lang->line('user_error_invalid_user'));
            }
        }
        else if((int) $this->CI->session->userdata('user_id') > 0)
        {
        	# SI NO LE PASAN UN ID 
        	# VERIFICARA QUE SI HAY UNO EN VARIABLE DE SESSION 
            $row = $this->_row(['id' => $this->CI->session->userdata('user_id')]);
            
            # si no hay usuario o esta desabilitado para el sistema lo carga como anonimo
            if(sizeof($row) == 0 || $row->active != 1 || $row->status != 1)
            {
                $this->CI->session->sess_destroy();
                $this->_load(null);
                return;
            }
        }
        
        // si me carga con null se crear como usuario anonimo 
        $this->_load($row);
    }
    
    public function __get($name)
    {
        $property = 'user_' . $name;
        
        if(isset($this->$property))
        {
            return $this->$property;
        }
    }
    
    public function errors()
    {
    	#devuelve los errores de la  libreria 
        return $this->errors;
    }
    /**
     * 
     * @return type array retorna los permisos del usuario
     */
    public function permissions()
    {
        return $this->acl->permissions;
    }
    /**
     * 
     * @return type array retorna los permisos del sitio que coinciden con los del usuario
     */
    public function site_permissions()
    {
        return $this->acl->site_permissions;
    }
    /**
    * FUNCION USADA PARA VERIFICAR SI EL USUARIO TIENE EL PREMISO 
    * QUE SE LE PASA COMO PARAMETRO
    * @param type $name ES EL NOMRE DEL PERMISO
    * @return boolean NOS DEVUELVE VERDADERO O FALSO DEPENDIENDO DE SI 
    *         EL USIARIO TIENE UN PERMISO HABILITADO O NO. 
    */
    public function has_permission($name)
    {
        return $this->acl->has_permissions($name);
    }
    /**
     * Verifica si este usuario esta logeado en el sistema
     * @return boolean true si esta logeado y falso si no esta logeado
     */
    public function is_logged_in()
    {
    	#verifica si este usuario esta logeado en el sistema
        if($this->user_id > 0)
        {
            return $this->user_id == (int) $this->CI->session->userdata('user_id');
            # Esta variable de seccion se crear en el login del sistema en un controlador aparte
        }
        
        return FALSE;
    }
    /**
     * 
     * @param type $user
     * @param type $password
     * @param type $hash
     * @return boolean Si el usuario cumple con todo retorna TRUE y asi el controlador podra 
     *          crear la variable de sesion con el id del usuario.
     *          de lo contrario retorna fales
     */
    public function login($user, $password, $hash = 'sha256')
    {
    	# se crea un login en el sistema (controlador)
    	# y ara uso de esta funcion para verificar si elusuario puede o no entrar 
    	# si el usuario cumple con todo regresara true y cargara al usuario que se solicito
    	# si devuelve true el controlador para login cargara en session al usuario
    	# este es como un validador 
        if(empty($user) || ! preg_match($this->pattern, $user))
        {
        	#si no se envia nombre de usuario o no coincide con el patron 
        	# se añade este error al arreglo de errores
            $this->errors[] = $this->CI->lang->line('user_error_username');
        }
        
        if(empty($password))
        {
        	# Si la contrasena no se envia agrega este error 
            $this->errors[] = $this->CI->lang->line('user_error_empty_password');
        }
        
        if(count($this->errors))
        {
        	# si existen errores retorna false 
            return FALSE;
        }
        
        $this->CI->load->library('encrypt');#para enciptar las contraseñas
        #Esta libreria es MY_Encrypt.php
        
        # peticion de un usuario
        $row = $this->_row(['user' => $user, 'password' => $this->CI->encrypt->password($password, $hash)]);
        
        # Si no hay usuario o no esta activado o avilitado genera un mensaje de error
        if(sizeof($row) == 0 || $row->active != 1 || $row->status != 1)
        {
            $this->errors[] = $this->CI->lang->line('user_error_wrong_credentials');
            return FALSE;
        }
        
        # si paso todo  carga al usuario 
        $this->_load($row);
        return TRUE;
    }
    
    /**
     * Cargara al usuario si esta registrado obtiene sus datos y sus permisos
     * y si no esta registrado o esta desabilitado lo crea como anonimo y con un unico permiso que es el public 
     * @param type $row es el usuario de la BD y es null crea a un usuario anonimo
     * @return type nada, solo es para salir de la funcion
     */
    private function _load($row = null)
    {
        if($row == null || sizeof($row) == 0)
        {
            $this->user_id = 0;
            $this->user_user = $this->CI->lang->line('cms_general_label_site_visitor_user');#user para los usuarios invitados
            $this->user_name = $this->CI->lang->line('cms_general_label_site_visitor_name');#nombre para los usuarios invitados
            $this->user_email = '';
            $this->user_active = 0;
            $this->user_status = 0;
            $this->acl = new Acl(['lang' => $this->lang]); # CREA ACL SIN ID SOLO LENGUAJE
            
            return;
        }
        
        $this->user_id = $row->id;
        $this->user_user = $row->user;
        $this->user_name = $row->name;
        $this->user_email = $row->email;
        $this->user_active = $row->active;
        $this->user_status = $row->status;
        $this->acl = new Acl(['id' => $row->id,'lang' => $this->lang]); # CREA ACL CON ID
    }
    
    /**
     * Realiza una consulta a la base de datos.
     * @param type $where
     * @param type $select
     * @return type 
     */
    private function _row($where = null, $select = null)
    {
        if(is_array($where))
        {
            $this->CI->db->where($where);
        }
        
        if(is_array($select))
        {
            $this->CI->db->select($select);
        }
        
        return $this->CI->db->get($this->table)->row();
    }
    
    private function _set_language($lang = null)
    {
        $languages = ['english', 'spanish'];
        
        if( ! $lang)
        {
            if(in_array($this->CI->config->item('language'), $languages))
            {
                $lang = $this->CI->config->item('language');
            }
            else
            {
                $lang = $languages[0];
            }
        }
        else
        {
            if( ! in_array($lang, $languages))
            {
                $lang = $languages[0];
            }
        }
        
        $this->lang = $lang;
        $this->CI->load->language('user', $lang);
    }    
}

/* End of file User.php */
/* Location: ./application/libraries/User.php */