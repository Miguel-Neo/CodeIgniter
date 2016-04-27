<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Cliente extends CI_Model {

    private $tables = [
        'clientes' => 'crm_cliente',
        'detallesCliente'=>'crm_detallesCliente'
    ];

    public function __construct() {
        parent::__construct();
    }
    

/*****************************************************************************/    
    
    
    /**
     * Obtiene todos los Clientes
     * @return Un Array con los registros en tipo Array
     */
    public function getClientes() {
        return $this->db->get($this->tables['clientes'])->result_array();
    }
    public function getIDCliente($razonSocial){
        $where['razonSocial'] = $razonSocial;
        return $this->db->get_where($this->tables['clientes'], $where)->row()->id;
    }
    public function insertinfo($idCliente,$atributo,$valor){
        $this->db->query(
                "replace into " . $this->tables['detallesCliente'] . " set " .
                "idcliente = $idCliente , atributo = '$atributo', valor ='$valor', "
        );
    }
    public function insert($cliente){
        $where['razonSocial'] = $cliente['razonSocial'];
        $existe = $this->db->get_where($this->tables['clientes'], $where)->row();
       
        if (!$existe) {
            $this->load->helper('date');
            date_default_timezone_set('America/Mexico_City');
            $now = time();
           
            $this->db->insert(
                    $this->tables['clientes'],
                    [
                        
                        'fechaRegistro'=>unix_to_human($now, TRUE, 'eu'), // Es un formato Europeo 24 horas y con seconds # Guarda fecha de creacion
                        'razonSocial'=>$cliente['razonSocial'], 
                        'tipoDeEmpresa'=>$cliente['tipoDeEmpresa'],
                        'estadoActivoInactivo'=>1,
                        'created'=>$cliente['created'],
                        'created_at'=>unix_to_human($now, TRUE, 'eu'), // Es un formato Europeo 24 horas y con seconds # Guarda fecha de creacion                        
                        'modified'=>$cliente['created'],
                        'modified_at'=>unix_to_human($now, TRUE, 'eu')
                    ]
                    );
            
            
            return true;
        }
        return false;
    }
    
    public function delete($id){
        $this->db->delete($this->tables['clientes'],array('id'=>$id));
    }
    
    public function update($servicio){
        
        
    }
    
    
}
