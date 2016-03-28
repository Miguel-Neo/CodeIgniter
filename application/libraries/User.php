<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__).'/Acl.php';

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
        	#VERIFICARA QUE SI HAY UNO EN VARIABLE DE SESSION 
            $row = $this->_row(['id' => $this->CI->session->userdata('user_id')]);
            
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

    public function permissions()
    {
        return $this->acl->permissions;
    }
    
    public function site_permissions()
    {
        return $this->acl->site_permissions;
    }
    
    public function has_permission($name)
    {
        return $this->acl->has_permission($name);
    }
    
    public function is_logged_in()
    {
    	#verifica si este usuario esta logeado en el sistema
        if($this->user_id > 0)
        {
            return $this->user_id == (int) $this->CI->session->userdata('user_id');
            # Esta variable de seccion se crear en ellogin del sistema en un controlador aparte
        }
        
        return FALSE;
    }

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
        #sta libreria es MY_Encrypt.php
        
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
    
    private function _load($row = null)
    {
        if($row == null || sizeof($row) == 0)
        {
            $this->user_id = 0;
            $this->user_user = $this->CI->lang->line('cms_general_label_site_visitor_user');
            $this->user_name = $this->CI->lang->line('cms_general_label_site_visitor_name');
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