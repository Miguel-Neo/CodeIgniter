<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contacto extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Model_Cliente');
        $this->load->model('Model_Contacto');
        $this->load->helper(array('form', 'url'));
    }
    
    public function index(){
        redirect('Cliente');
    }
    public function nuevo($idCliente = null){
        if($this->_validarContacto()){
            $here = $this->input->post('here');
            $info = $this->input->post('ext');
            $id_cliente = $this->input->post('id_cliente');
            foreach ($this->input->post('tel') as $key => $val){
                $valor=$val[1]." ext. ".$val[2];
                $info[$key]=$valor;
            }
            if($this->Model_Contacto->insert($id_cliente,$here,$info)){
                redirect('Cliente/contactos/'.$idCliente);
            }
        }
        
        $clientes = [];
        foreach ($this->Model_Cliente->getClientes() as $cliente){
            $clientes[$cliente['id']]=$cliente['razonSocial'];
            if ($idCliente === null) {
                $idCliente = $cliente['id'];
            }
        }
        //print_r($idCliente);exit;
        $this->template->set('clientes',$clientes);
        $this->template->set('idcliente',$idCliente);
        $this->template->render('cliente/v_nuevocontacto');
    }
    public function eliminar($id,$idcliente){
        $this->Model_Contacto->delete($id);
        redirect('Cliente/contactos/'.$idcliente);
    }
    public function editar($id){
        
    }


    
    
    private function _validarContacto(){
        if($this->input->post('nuevo_contacto') == 1){
            return true;
        }
        return false;
    }
}