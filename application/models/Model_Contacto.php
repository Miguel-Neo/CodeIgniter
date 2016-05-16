<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Contacto extends CI_Model {

    private $tables = [
        'contacto' => 'crm_contacto',
        'detallesContacto'=>'crm_detallesContacto',
        'cliente_contacto'=>'crm_cliente_contacto',
        'proyectos' => 'crm_proyecto',
        'ptr_user'  => 'crm_proyecto_users',
        'ptr_contacto'  => 'crm_proyecto_contactos',
        'users'     => 'acl_users'
    ];

    public function __construct() {
        parent::__construct();
    }
    

/*****************************************************************************/    
    
    
    
    public function delete($id){
        $this->db->delete($this->tables['detallesContacto'], array('idContacto' => $id));
        $this->db->delete($this->tables['cliente_contacto'], array('idcontacto' => $id));
        $this->db->delete($this->tables['contacto'],array('id' => $id));
    }
    public function getcontacto($idcontacto){
        $cliente = $this->db->get_where(
                        $this->tables['contacto'], ['id' => $idcontacto]
                )->row_array();
        $detalles = $this->db->get_where(
                        $this->tables['detallesContacto'], ['idContacto' => $idcontacto])->result_array();
        
        foreach($detalles as $detalle){
            $cliente[$detalle['atributo']] = $detalle['valor'];
        }
        return $cliente;
    }
    public function getcontactos_proyecto($idProyecto){
        $this->db->select(
                  'c.*'
                );
        $this->db->from($this->tables['ptr_contacto']." pc");
        $this->db->join($this->tables['contacto']." c", 'pc.idContacto = c.id');
        $this->db->where('pc.idProyecto',$idProyecto);
        
        $query = $this->db->get()->result_array();
        
        return $query;
    }
    
    public function insert($idCliente,$here, $info) {
        
            $this->load->helper('date');
            date_default_timezone_set('America/Mexico_City');
            $now = time();


            $this->db->trans_start();

            $this->db->insert(
                    $this->tables['contacto'], [
                'nombre' => $here['nombre'],
                'apellidos'=>$here['apellidos'],
                'estadoActivoInactivo' => 1,
                'created' => $this->user->id,
                'created_at' => unix_to_human($now, TRUE, 'eu'), // Es un formato Europeo 24 horas y con seconds # Guarda fecha de creacion                        
                'modified' => $this->user->id,
                'modified_at' => unix_to_human($now, TRUE, 'eu')
                    ]
            );
            
            $IDContacto = $this->_getIDContacto();
            $this->_insertclienteContacto($idCliente,$IDContacto);
            foreach ($info as $key => $valor) {
                $this->_insertinfo($IDContacto, $key, $valor);
            }

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                return false;
                // generate an error... or use the log_message() function to log your error
            }
            return true;
        
    }
    
    public function update($contacto) {
        $this->load->helper('date');
        date_default_timezone_set('America/Mexico_City');
            
        $data = array(
            'nombre' => $contacto['nombre'],
            'apellidos' => $contacto['apellidos'],
            'modified'=>$this->user->id,
            'modified_at'=>unix_to_human(time(), TRUE, 'eu')
        );
        $this->db->where('id', $contacto['id']);
        return $this->db->update($this->tables['contacto'], $data);
    }
    
    private function _insertclienteContacto($idCliente,$idcontacto){
        $this->db->insert(
                    $this->tables['cliente_contacto'], [
                'idcliente' => $idCliente,
                'idcontacto'=> $idcontacto
                    ]
            );
    }
    private function _getIDContacto(){
        $this->db->select('*');
        $this->db->from($this->tables['contacto']);
        $this->db->order_by('id','DESC');
        $this->db->limit(1);
        $query = $this->db->get()->row()->id;
        return $query;
    }
    private function _insertinfo($idCliente, $atributo, $valor) {
        $this->load->helper('date');
        date_default_timezone_set('America/Mexico_City');

        $this->db->replace($this->tables['detallesContacto'], [
            'idContacto' => $idCliente,
            'atributo' => $atributo,
            'valor' => $valor,
            'created' => $this->user->id,
            'created_at' => unix_to_human(time(), TRUE, 'eu'),
            'modified' => $this->user->id,
            'modified_at' => unix_to_human(time(), TRUE, 'eu'),
        ]);
    }
    public function updateAtributo($idContacto, $atributo, $valor) {
        $this->load->helper('date');
        date_default_timezone_set('America/Mexico_City');

        $set = array(
            'valor' => $valor,
            'modified' => $this->user->id,
            'modified_at' => unix_to_human(time(), TRUE, 'eu'),
        );
        $where = array(
            'idContacto ' => $idContacto,
            'atributo' => $atributo
        );
        $this->db->update(
                $this->tables['detallesContacto'], $set, $where
        );
    }
    
}
