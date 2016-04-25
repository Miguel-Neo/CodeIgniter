<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Servicios extends CI_Model {

    private $tables = [
        'servicios' => 'crm_servicio'
    ];

    public function __construct() {
        parent::__construct();
    }
    

/*****************************************************************************/    
    
    
    /**
     * Obtiene todos los servicios
     * @return Un Array con los registros en tipo Array
     */
    public function getServicios() {
        return $this->db->get($this->tables['servicios'])->result_array();
    }
    /**
     * Obtiene un registro buscado por su ID 
     * @param type $id
     * @return type
     */
    public function getServicio($id){
        $this->db->where(['id' => $id]);
        return $this->db->get($this->tables['servicios'])->row_array();
    }
    public function delete($id){
        $this->db->delete($this->tables['servicios'],array('id'=>$id));
    }
    public function insert($servicio){
        $where['nombre'] = $servicio['nombre'];
        $existe = $this->db->get_where($this->tables['servicios'], $where)->row();
        if (!$existe) {
            
       
            $this->load->helper('date');
            date_default_timezone_set('America/Mexico_City');
            $now = time();

            $this->db->insert(
                    $this->tables['servicios'],
                    [
                        'fechaRegistro'=>unix_to_human($now, TRUE, 'eu'), // Es un formato Europeo 24 horas y con seconds # Guarda fecha de creacion
                        'nombre'=>$servicio['nombre'],
                        'descripcion'=>$servicio['descripcion'],
                    ]
                    );
            return true;
        }
        return false;
    }
    public function update($servicio){
        
        $set = array(
            'nombre'=>$servicio['nombre'],
            'descripcion'=>$servicio['descripcion']
        );
        $where = 'id ='.$servicio['id'];
        $this->db->update(
                $this->tables['servicios'],
                $set,
                $where
                );
    }
    
    
}
