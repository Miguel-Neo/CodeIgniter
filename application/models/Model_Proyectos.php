<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Proyectos extends CI_Model {

    private $tables = [
        'proyectos' => 'crm_proyecto',
        'ptr_user'  => 'crm_proyecto_users',
        'users'     => 'acl_users'
    ];

    public function __construct() {
        parent::__construct();
    }
    

/*****************************************************************************/    
    public function insert($proyecto){
        $where['nombre'] = $proyecto['titulo'];
        $existe = $this->db->get_where($this->tables['proyectos'], $where)->row();
        if (!$existe) {
        
            $this->load->helper('date');
            date_default_timezone_set('America/Mexico_City');
            $this->db->insert(
                    $this->tables['proyectos'],
                    [
                        'nombre'       => $proyecto['titulo'],
                        'descripcion'  => $proyecto['descripcion'],
                        'idServicio'   => $proyecto['servicio'],
                        'idCliente'    => explode("_",$proyecto['cliente'])[0],
                        'estado'       => 1,
                        'fechaInicio'  => $proyecto['fecha_de_inicio'],
                        'fechaEntrega' => $proyecto['fecha_de_entrega'],
                        'created'      => $this->user->id,
                        'created_at'   => unix_to_human(time(), TRUE, 'eu'),
                        'modified'     => $this->user->id,
                        'modified_at'  => unix_to_human(time(), TRUE, 'eu'),
                    ]
                    );
            return true;
        }
        return false;
    }
    public function getall(){
        return $this->db->get($this->tables['proyectos'])->result_array();
    }
    public function get($id){
        return $this->db->get_where($this->tables['proyectos'],['id'=>$id])->row_array();
    }
    public function getuser($idProyecto){
        $this->db->select(
                  'p.idProyecto up_idProyecto,'
                . 'p.idUsuario  up_idUsuario,'
                . 'p.rol up_rol,'
                . 'p.created up_created,'
                . 'p.created_at up_created_at,'
                . 'p.modified up_modified,'
                . 'p.modified_at up_modified_at,'
                . 'u.id u_id,'
                . 'u.name u_name,'
                . 'u.email u_email,'
                . 'u.user u_user,'
                . 'u.password u_password,'
                . 'u.role u_role,'
                . 'u.active u_active,'
                . 'u.last_login u_last_login,'
                . 'u.created u_created,'
                . 'u.created_at u_created_at,'
                . 'u.modified u_modified,'
                . 'u.modified_at u_modified_at'
                
                );
        $this->db->from($this->tables['ptr_user']." p");
        $this->db->join($this->tables['users']." u", 'p.idUsuario = u.id');
        $this->db->where('p.idProyecto',$idProyecto);
        $this->db->where('u.active !=',0);
        
        $query = $this->db->get()->result_array();
        
        return $query;
    }
}
