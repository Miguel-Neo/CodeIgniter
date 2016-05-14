<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Contacto extends CI_Model {

    private $tables = [
        'contacto' => 'crm_contacto',
        'detallesContacto'=>'crm_detallesContacto',
        'cliente_contacto'=>'crm_cliente_contacto'
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
    
}
