<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Cliente extends CI_Model {

    private $tables = [
        'clientes' => 'crm_cliente',
        'detallesCliente' => 'crm_detallesCliente',
        'cliente_contacto'=>'crm_cliente_contacto',
        'detallesContacto'=>'crm_detallesContacto'
    ];
    private $atributo = [
        'logotipo'    =>'logotipo',
        'empresa'     =>'tipo_de_empresa',
        'cp'          => 'cp',
        'direccion'   => 'direccion',
        'sitio_web'   => 'sitio_web',
        'telefono_1'  => 'telefono_1',
        'telefono_2'  => 'telefono_2'
        
    ];

    public function __construct() {
        parent::__construct();
    }

    /*     * ************************************************************************** */

    /**
     * Obtiene todos los Clientes
     * @return Un Array con los registros en tipo Array
     */
    public function getClientes() {
        $clientes = $this->db->get($this->tables['clientes'])->result_array();
        for ($i = 0; $i < count($clientes); $i ++) {
            $clientes[$i]['detalles'] = $this->db->get_where(
                            $this->tables['detallesCliente'], ['idCliente' => $clientes[$i]['id']])->result_array();
        }
        return $clientes;
    }

    public function getCliente($id) {
        $cliente = $this->db->get_where(
                        $this->tables['clientes'], ['id' => $id]
                )->row_array();
        $cliente['detalles'] = $this->db->get_where(
                        $this->tables['detallesCliente'], ['idCliente' => $id])->result_array();
        return $cliente;
    }

    public function getClientexnombre($razonSocial) {
        $where['razonSocial'] = $razonSocial;
        return $this->db->get_where($this->tables['clientes'], $where)->row();
    }
    
    public function getAtributo($idCliente,$atributo){
        $where['idCliente'] = $idCliente;
        $where['atributo'] = $this->atributo[$atributo];
        
        $logo = $this->db->get_where($this->tables['detallesCliente'], $where)->row();
        if($logo){
            return $logo->valor;
        }
        return null;
    }
    public function insertLogotipo($razonSocial,$value){
        $this->insertinfo(
                    $this->getClientexnombre($razonSocial)->id,
                    $this->atributo['logotipo'],
                    $value
                    );
    }
    public function insertinfo($idCliente, $atributo, $valor) {
        $this->load->helper('date');
        date_default_timezone_set('America/Mexico_City');

        $this->db->replace($this->tables['detallesCliente'], [
            'idcliente' => $idCliente,
            'atributo' => $atributo,
            'valor' => $valor,
            'created' => $this->user->id,
            'created_at' => unix_to_human(time(), TRUE, 'eu'),
            'modified' => $this->user->id,
            'modified_at' => unix_to_human(time(), TRUE, 'eu'),
        ]);
    }

    public function updateAtributo($idCliente, $atributo, $valor) {
        $this->load->helper('date');
        date_default_timezone_set('America/Mexico_City');

        $set = array(
            'valor' => $valor,
            'modified' => $this->user->id,
            'modified_at' => unix_to_human(time(), TRUE, 'eu'),
        );
        $where = array(
            'idcliente ' => $idCliente,
            'atributo' => $atributo
        );
        $this->db->update(
                $this->tables['detallesCliente'], $set, $where
        );
    }

    public function insert($razonSocial, $info) {
        $where['razonSocial'] = $razonSocial;
        $existe = $this->db->get_where($this->tables['clientes'], $where)->row();

        if (!$existe) {
            $this->load->helper('date');
            date_default_timezone_set('America/Mexico_City');
            $now = time();


            $this->db->trans_start();

            $this->db->insert(
                    $this->tables['clientes'], [
                'razonSocial' => $razonSocial,
                'estadoActivoInactivo' => 1,
                'created' => $this->user->id,
                'created_at' => unix_to_human($now, TRUE, 'eu'), // Es un formato Europeo 24 horas y con seconds # Guarda fecha de creacion                        
                'modified' => $this->user->id,
                'modified_at' => unix_to_human($now, TRUE, 'eu')
                    ]
            );
            $IDEmpresa = $this->getClientexnombre($razonSocial)->id;
            foreach ($info as $key => $valor) {
                $this->insertinfo($IDEmpresa, $key, $valor);
            }

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                return false;
                // generate an error... or use the log_message() function to log your error
            }
            return true;
        }
        return false;
    }

    public function delete($id) {
        $this->db->delete($this->tables['detallesCliente'], array('idCliente' => $id));
        $this->db->delete($this->tables['cliente_contacto'], array('idcliente' => $id));
        $this->db->delete($this->tables['clientes'], array('id' => $id));
    }

    public function update($id, $razonSocial) {
        $this->load->helper('date');
        date_default_timezone_set('America/Mexico_City');
            
        $data = array(
            'razonSocial' => $razonSocial,
            'modified'=>$this->user->id,
            'modified_at'=>unix_to_human(time(), TRUE, 'eu')
        );
        $this->db->where('id', $id);
        return $this->db->update($this->tables['clientes'], $data);
    }

    public function getClienteContactos($idCliente) {
        
        $idsContacto = $this->_get_ids_contactos($idCliente);
        
        if(count($idsContacto)>0){
            $contactos = $this->db
                ->from('crm_contacto')
                ->select('*')
                ->where_in('id', $idsContacto ) # WHERE id IN (1,2,3)
                ->get()->result_array();

            for ($i = 0; $i < count($contactos); $i ++) {
                $contactos[$i]['detalles'] = $this->db->get_where(
                                $this->tables['detallesContacto'], ['idContacto' => $contactos[$i]['id']])->result_array();
            }

            return $contactos;
        }
    }

    private function _get_ids_contactos($idCliente) {
        $ids = [];
        
            $perms = $this->db
                    ->select('*')
                    ->get_where($this->tables['cliente_contacto'], ['idcliente' => $idCliente])
                    ->result_array();
            
            $ids = array_map(function ($item) {
                return $item['idcontacto']; # RETORNA EL VALOR DE CADA REGISTRO
            }, $perms);
            array_filter($perms); # ELIMINA LOS ELEMENTOS VACIOS EN CASO DE QUE EXISTA ALGUNO
        
        return $ids;
    }

}
