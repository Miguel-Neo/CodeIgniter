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
                $info[$key]=$val[1];
                $info[$key."_ext"]=$val[2];
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
        
        
        $default=[];
        $default['nombre'] = "";
        $default['apellidos']= "";
        $default['puesto']= "";
        $default['t1'] = "";
        $default['t1ext'] = "";
        $default['t2'] = "";
        $default['t2ext'] = "";
        $default['celular']= "";
        $default['e-mail']= "";
        
        
        $this->template->set('default', $default);
        $this->template->set('action','Contacto/nuevo/'.$idCliente);
        $this->template->set('input_hidden',['editar'=>1]);
        $this->template->set('clientes',$clientes);
        $this->template->set('idcliente',$idCliente);
        $this->template->render('cliente/v_nuevocontacto');
    }
    public function eliminar($id,$idcliente){
        $this->Model_Contacto->delete($id);
        redirect('Cliente/contactos/'.$idcliente);
    }
    public function editar($idContacto,$idCliente){
        
        $clientes = [];
        foreach ($this->Model_Cliente->getClientes() as $cliente){
            $clientes[$cliente['id']]=$cliente['razonSocial'];
        }
        
        $contacto = $this->Model_Contacto->getcontacto($idContacto);
     
        
        $default=[];
        $default['nombre'] = $contacto['nombre'];
        $default['apellidos']= $contacto['apellidos'];
        $default['puesto']= $contacto['puesto'];
        $default['t1'] = $contacto['telefono_1'];
        $default['t1ext'] = $contacto['telefono_1_ext'];
        $default['t2'] = $contacto['telefono_2'];
        $default['t2ext'] = $contacto['telefono_2_ext'];
        $default['celular']= $contacto['celular'];
        $default['e-mail']= $contacto['e-mail'];
        
        
        $this->template->set('default', $default);
        $this->template->set('action','Contacto/editar/'.$idContacto.'/'.$idCliente);
        $this->template->set('input_hidden',['editar'=>1]);
        $this->template->set('clientes',$clientes);
        $this->template->set('idcliente',$idCliente);
        $this->template->render('cliente/v_nuevocontacto');
    }


    
    
    private function _validarContacto(){
        if($this->input->post('editar') == 1){
            return true;
        }
        return false;
    }
}