<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends MY_Controller {
    private $tipos_de_empresa = array(
            'AAA' => 'AAA',
            'AA' => 'AA',
            'A' => 'A',
            'Agencia' => 'Agencia',
        );
    public function __construct() {
        parent::__construct();
        $this->load->model('Model_Cliente');
        $this->load->helper(array('form', 'url', 'html'));
    }

    public function index() {
        $clientes = $this->Model_Cliente->getClientes();
        $idCliente = null;
        for ($i = 0; $i < count($clientes); $i++) {
            $idCliente = $clientes[$i]['id'];
            unset($clientes[$i]['id']);
            unset($clientes[$i]['created']);
            unset($clientes[$i]['created_at']);
            unset($clientes[$i]['modified']);
            unset($clientes[$i]['modified_at']);
            unset($clientes[$i]['detalles']);
            unset($clientes[$i]['estadoActivoInactivo']);

            $logotipo = $this->Model_Cliente->getAtributo($idCliente,'logotipo');
            $clientes[$i]['logo'] = $logotipo ? $logotipo : null;

            $clientes[$i]['contactos'] = anchor(
                    'Cliente/contactos/' . $idCliente, 
                    dictionary('theme_contact'),
                    [
                        'class'=>'link_a_contactos'
                    ]
            );
            $clientes[$i]['detalles'] = anchor(
                    'Cliente/detalles/' . $idCliente, 
                    dictionary('theme_details'),
                    [
                        'class'=>'link_a_detalles'
                    ]
            );
            $clientes[$i][dictionary('theme_edit')] = anchor(
                    'Cliente/editar/' . $idCliente, 
                    dictionary('theme_edit'),
                    [
                        'class'=>'link_a_editar'
                    ]
            );
            $clientes[$i][dictionary('theme_delete')] = anchor(
                    'Cliente/eliminar/' . $idCliente, 
                    dictionary('theme_delete'), 
                    [
                        'onclick' => 'return confirm_delete();',
                        'class'=>'link_a_eliminar'
                    ]
            );
            
        }
        array_unshift($clientes, ["razonSocial", "a img", "","",""]);

        //debugger($clientes);
        //$this->template->set('clientes',$this->Model_Cliente->getClientes());
        $this->template->set('tab_clientes', $clientes);
        $this->template->render('cliente/v_clientes');
    }

    private function _subirLogo($razonSocial) {
        $cliente = str_replace(" ", "_", $razonSocial);
        $cliente = str_replace(".", "_", $cliente);

        $config['upload_path'] = 'access_public/imagenes/logo/' . $cliente . "/";
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 6048;
        $config['max_width'] = 0;
        $config['max_height'] = 0;
        $config['remove_spaces'] = true;

        //debugger($config['upload_path']);
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('logo')) {
            $data = $this->upload->data();
            $file_name = $data['file_name'];
            $value = $config['upload_path'] . $file_name;
            $this->Model_Cliente->insertLogotipo(
                    $razonSocial, $value
            );
        }
    }

    public function nuevo() {
        if ($this->_validarCliente()) {
            $razonSocial = $this->input->post('here')['razon_social'];
            if ($this->Model_Cliente->insert($razonSocial, $this->input->post('ext'))) {
                $this->_subirLogo($razonSocial);
                redirect('Cliente');
            }
            $this->template->add_message(['error' => [dictionary('theme_error_duplicate_element')]]);
        }
        
        $default=[];
        $default['rs'] = "";
        $default['emp']= "";
        $default['cp'] = "";
        $default['dir']= "";
        $default['t1'] = "";
        $default['t2'] = "";
        $default['web']= "";
        
        $this->template->set('default', $default);
        $this->template->set('action', 'Cliente/nuevo/');
        $this->template->set('input_hidden', ['nuevo_cliente' => 1]);
        $this->template->set('tipos_de_empresa', $this->tipos_de_empresa);
        $this->template->render('cliente/v_nuevo');
    }

    public function editar($ID) {
        if ($this->_validarCliente()) {
            $razonSocial = $this->input->post('here')['razon_social'];
            $this->Model_Cliente->update($ID,$razonSocial);
            foreach($this->input->post('ext') as $key => $valor){
                $this->Model_Cliente->updateAtributo($ID,$key,$valor);
            }
            $this->_subirLogo($razonSocial);
            redirect('Cliente');
        }
        
        
        $cliente = $this->Model_Cliente->getCliente($ID);
        $default=[];
        $default['rs'] = $cliente['razonSocial'];
        $default['emp']= $this->Model_Cliente->getAtributo($ID,'empresa');
        $default['cp'] = $this->Model_Cliente->getAtributo($ID,'cp');
        $default['dir']= $this->Model_Cliente->getAtributo($ID,'direccion');
        $default['t1'] = $this->Model_Cliente->getAtributo($ID,'telefono_1');
        $default['t2'] = $this->Model_Cliente->getAtributo($ID,'telefono_2');
        $default['web']= $this->Model_Cliente->getAtributo($ID,'sitio_web');
        
        
        
        
        
        
        $this->template->set('default', $default);
        $this->template->set('action', 'Cliente/editar/'.$ID);
        $this->template->set('input_hidden', ['nuevo_cliente' => 1]);
        $this->template->set('tipos_de_empresa', $this->tipos_de_empresa);
        $this->template->render('cliente/v_nuevo');
    }

    public function eliminar($ID) {
        $this->Model_Cliente->delete($ID);
        redirect('Cliente');
    }

    public function contactos($idCliente) {
        $contactos = $this->Model_Cliente->getClienteContactos($idCliente);
        $this->template->set('contactos', $contactos);
        $this->template->set('idCliente', $idCliente);
        $this->template->render('cliente/v_contactos');
    }
    public function detalles($idCliente){
        $cliente = $this->Model_Cliente->getCliente($idCliente);
        $this->template->set('cliente',$cliente);
        $this->template->render('cliente/v_detalles');
    }
    private function _validarCliente() {

        if ($this->input->post('nuevo_cliente') == 1) {
            !$this->load->library('form_validation') ? $this->load->library('form_validation') : false;

            $rules = [
                [
                    'field' => 'here[razon_social]',
                    'label' => 'lang:theme_cliente_razon_social',
                    'rules' => 'trim|required|min_length[3]|max_length[40]'
                ]
            ];


            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() === TRUE) {
                return true;
            }
        }
        return false;
    }

}
