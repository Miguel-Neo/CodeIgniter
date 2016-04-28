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
        $clientes = $this->db->get($this->tables['clientes'])->result_array();
        for ($i = 0; $i < count($clientes); $i ++) {
            $clientes[$i]['detalles']=
                    $this->db->get_where(
                            $this->tables['detallesCliente'], 
                            ['idCliente'=>$clientes[$i]['id']])->result_array();
        }
        return $clientes;
    }
    public function getCliente($id){
        $cliente = $this->db->get_where(
                $this->tables['clientes'],
                ['id'=>$id]
                )->row_array();
        $cliente['detalles'] = 
                $this->db->get_where(
                            $this->tables['detallesCliente'], 
                            ['idCliente'=>$id])->result_array();
        return $cliente;
    }
    public function getIDCliente($razonSocial){
        $where['razonSocial'] = $razonSocial;
        return $this->db->get_where($this->tables['clientes'], $where)->row()->id;
    }
    private function _insertinfo($idCliente,$atributo,$valor){
        $this->load->helper('date');
        date_default_timezone_set('America/Mexico_City');
        
        $this->db->replace($this->tables['detallesCliente'],
        [
            'idcliente'=>$idCliente,
            'atributo'=>$atributo,
            'valor'=>$valor,
            'created'=>$this->user->id,
            'created_at'=>unix_to_human(time(), TRUE, 'eu'),
            'modified'=>$this->user->id,
            'modified_at'=>unix_to_human(time(), TRUE, 'eu'),
        ]);
    }
    public function updateinsertinfo($idCliente,$atributo,$valor){
        $this->load->helper('date');
        date_default_timezone_set('America/Mexico_City');
        
        $set = array(
            'valor'=>$valor,
            'modified'=>$this->user->id,
            'modified_at'=>unix_to_human(time(), TRUE, 'eu'),
        );
        $where = array(
            'idcliente '=>$idCliente,
            'atributo'=>$atributo
        );
        $this->db->update(
                $this->tables['detallesCliente'],
                $set,
                $where
                );
        
        
    }
    public function insert($razonSocial,$info){
        $where['razonSocial'] = $razonSocial;
        $existe = $this->db->get_where($this->tables['clientes'], $where)->row();
       
        if (!$existe) {
            $this->load->helper('date');
            date_default_timezone_set('America/Mexico_City');
            $now = time();
            
            
            $this->db->trans_start();
            
            $this->db->insert(
                    $this->tables['clientes'],
                    [
                        'razonSocial'=>$razonSocial, 
                        'estadoActivoInactivo'=>1,
                        'created'=>$this->user->id,
                        'created_at'=>unix_to_human($now, TRUE, 'eu'), // Es un formato Europeo 24 horas y con seconds # Guarda fecha de creacion                        
                        'modified'=>$this->user->id,
                        'modified_at'=>unix_to_human($now, TRUE, 'eu')
                    ]
                    );
            $IDEmpresa = $this->getIDCliente($razonSocial);
            foreach ($info as $key => $valor) {
                $this->_insertinfo($IDEmpresa,$key,$valor);
            }
            
            $this->db->trans_complete();
            
            if ($this->db->trans_status() === FALSE)
            {
                return false;
                    // generate an error... or use the log_message() function to log your error
            }
            return true;
        }
        return false;
    }
    
    public function delete($id){
        $this->db->delete($this->tables['detallesCliente'],array('idCliente'=>$id));
        $this->db->delete($this->tables['clientes'],array('id'=>$id));
    }
    
    public function update($cliente,$info){
        
        
    }
    
    
}
