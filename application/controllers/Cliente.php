<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_Cliente');
        $this->load->helper(array('form', 'url','html'));
    }

    public function index() {
        $clientes = $this->Model_Cliente->getClientes();

        for ($i = 0; $i < count($clientes); $i++) {
            unset($clientes[$i]['detalles']);
            unset($clientes[$i]['estadoActivoInactivo']);
            
            $logotipo = $this->Model_Cliente->getlogo($clientes[$i]['id']);
            $clientes[$i]['logo'] = $logotipo ? img($logotipo):"";
           
            
            $clientes[$i][dictionary('theme_edit')] = anchor(
                    'Cliente/editar/' . $clientes[$i]['id'], dictionary('theme_edit')
            );
            $clientes[$i][dictionary('theme_delete')] = anchor(
                    'Cliente/eliminar/' . $clientes[$i]['id'], dictionary('theme_delete'), array('onclick' => 'return confirm_delete();')
            );
            $clientes[$i]['contactos'] = anchor(
                    'Cliente/contactos/' . $clientes[$i]['id'], dictionary('theme_contact')
            );
        }
        array_unshift($clientes, ["id", "razonSocial", "created", "created_at"]);

        //debugger($clientes);

        $this->template->set('tab_clientes', $clientes);
        $this->template->render('cliente/v_clientes');
    }
    private function subirLogo($razonSocial){
        $cliente = str_replace(" ", "_", $razonSocial);
        $cliente = str_replace(".", "_", $cliente);
        
        $config['upload_path'] = 'access_public/imagenes/logo/'.$cliente."/";
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 6048;
        $config['max_width'] = 0;
        $config['max_height'] = 0;
        $config['remove_spaces'] = true;
        
        //debugger($config['upload_path']);
        if(!is_dir($config['upload_path'])){
            mkdir($config['upload_path'], 0777,TRUE);
        }
        
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('logo')){
            $data = $this->upload->data();
            $file_name = $data['file_name'];
            $value = $config['upload_path'].$file_name;
            $this->Model_Cliente->insertLogotipo(
                    $razonSocial,
                    $value
                    );
        }
    }
    public function nuevo() {
        if ($this->_validarCliente()) {
            $razonSocial = $this->input->post('here')['razon_social'];
            if ($this->Model_Cliente->insert($razonSocial, $this->input->post('ext'))) {
                $this->subirLogo($razonSocial);
                redirect('Cliente');
            }
            $this->template->add_message(['error' => [dictionary('theme_error_duplicate_element')]]);
        }

        $tipos_de_empresa = array(
            'AAA' => 'AAA',
            'AA' => 'AA',
            'A' => 'A',
            'Agencia' => 'Agencia',
        );

        $this->template->set('action', 'Cliente/nuevo/');
        $this->template->set('input_hidden', ['nuevo_cliente' => 1]);
        $this->template->set('tipos_de_empresa', $tipos_de_empresa);
        $this->template->render('cliente/v_nuevo');
    }

    public function editar($ID) {
        /*
          $this->Model_Cliente->updateinsertinfo(5,'sitio_web','kkk');
          redirect('Cliente');
          // */
        $this->template->set('cliente', $this->Model_Cliente->getCliente($ID));
        $this->template->render('cliente/v_editar');
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
