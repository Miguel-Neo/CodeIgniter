<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Model_Cliente');
    }
    
    public function index(){
        $this->template->set('clientes',$this->Model_Cliente->getClientes());
        $this->template->render('cliente/v_clientes');
    }
    public function nuevo(){
        
        
        
        if($this->_validarCliente()){
            $razonSocial = $this->input->post('here')['razon_social'];
            
    
                $newEmpresa = array(
                    'razonSocial'=>$razonSocial,
                    'tipoDeEmpresa'=>$this->input->post('here')['tipo_de_empresa'],
                    'created'=>$this->user->id,
                );
                
                if($this->Model_Cliente->insert($newEmpresa)){
                    $IDEmpresa = $this->Model_Cliente->getIDCliente($razonSocial);
                    foreach ($this->input->post('ext') as $key => $valor) {
                        $this->Model_Cliente->insertinfo($IDEmpresa,$key,$valor);
                    }
                    redirect('Cliente');
                }
                $this->template->add_message(['error' => [dictionary('theme_error_duplicate_element')]]);
            
            
            
        }else{
            //echo 'invalido';exit;
        }
        $this->template->render('cliente/v_nuevo');
        
    }
    public function editar($ID){
        $this->template->render('cliente/v_editar');
    }
    public function eliminar($ID){
        
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