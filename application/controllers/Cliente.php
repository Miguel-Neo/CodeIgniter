<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Model_Cliente');
        $this->load->helper(array('form', 'url'));
    }
    
    public function index(){
        $this->template->set('clientes',$this->Model_Cliente->getClientes());
        $this->template->render('cliente/v_clientes');
    }
    public function nuevo(){
        if($this->_validarCliente()){
            $razonSocial = $this->input->post('here')['razon_social'];
            if($this->Model_Cliente->insert($razonSocial,$this->input->post('ext'))){
                redirect('Cliente');
            }
            $this->template->add_message(['error' => [dictionary('theme_error_duplicate_element')]]);
        }
        $this->template->render('cliente/v_nuevo');
        
    }
    public function editar($ID){
        /*
        $this->Model_Cliente->updateinsertinfo(5,'sitio_web','kkk');
        redirect('Cliente');
        //*/
        $this->template->set('cliente',$this->Model_Cliente->getCliente($ID));
        $this->template->render('cliente/v_editar');
    }
    public function eliminar($ID){
        $this->Model_Cliente->delete($ID);
        redirect('Cliente');
    }
    private function _validarCliente(){
        
        if($this->input->post('nuevo_cliente') == 1){
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