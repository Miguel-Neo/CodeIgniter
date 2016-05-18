<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Proyectos_User extends CI_Model {

    private $tables = [
        'ptru' => 'crm_proyecto_users'
    ];

    public function __construct() {
        parent::__construct();
    }
    public function insert($registro){
        $existe = $this->db->get_where(
                $this->tables['ptru'], 
                [
                    'idProyecto'=>$registro['proyecto'],
                    'idUsuario'=>$registro['user']
                ])->row();
        
        if (!$existe) {
            $this->load->helper('date');
            date_default_timezone_set('America/Mexico_City');
            
            $this->db->insert($this->tables['ptru'],[
                'idProyecto'   => $registro['proyecto'],
                'idUsuario'    => $registro['user'],
                'rol'          => $registro['Rol'],
                'created'      => $this->user->id,
                'created_at'   => unix_to_human(time(), TRUE, 'eu'),
                'modified'     => $this->user->id,
                'modified_at'  => unix_to_human(time(), TRUE, 'eu'),
                    
            ]);
            return true;
        }
        return false;
    }
    public function getmy($idProyecto){
        return $this->db->get_where($this->tables['ptru'], ['idProyecto' => $idProyecto,'idUsuario'=>$this->user->id])->row_array();
    }
}


