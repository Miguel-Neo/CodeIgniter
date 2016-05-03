<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Proyectos extends CI_Model {

    private $tables = [
        'proyectos' => 'crm_proyecto'
    ];

    public function __construct() {
        parent::__construct();
    }
    

/*****************************************************************************/    
    public function insert($proyecto){
        $this->load->helper('date');
        date_default_timezone_set('America/Mexico_City');
        $this->db->insert(
                $this->tables['proyectos'],
                [
                    'nombre'       => $proyecto['titulo'],
                    'descripcion'  => $proyecto['descripcion'],
                    'idServicio'   => $proyecto['servicio'],
                    'idCliente'    => $proyecto['cliente'],
                    'estado'       => 1,
                    'fechaInicio'  => $proyecto['fecha_de_inicio'],
                    'fechaEntrega' => $proyecto['fecha_de_entrega'],
                    'created'      => $this->user->id,
                    'created_at'   => unix_to_human(time(), TRUE, 'eu'),
                    'modified'     => $this->user->id,
                    'modified_at'  => unix_to_human(time(), TRUE, 'eu'),
                ]
                );
    }
    public function getall(){
        return $this->db->get($this->tables['proyectos'])->result_array();
    }
    public function get($id){
        return $this->db->get_where($this->tables['proyectos'],['id'=>$id])->row_array();
    }
    
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
