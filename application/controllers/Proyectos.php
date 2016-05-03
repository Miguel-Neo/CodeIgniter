<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Proyectos extends MY_Controller {
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $this->load->model('Model_Proyectos');
        $proyectos = $this->Model_Proyectos->getall();
        $this->template->set('proyectos',$proyectos);
        $this->template->render('proyectos/proyectos');
    }
    public function nuevo(){
        $this->load->model('Model_Proyectos');
        if($this->_validar_nuevo()){
            $proyecto = $this->input->post();
            $this->Model_Proyectos->insert($proyecto);
            redirect('Proyectos');
        }
        
        $this->load->model('Model_Servicios');
        $this->load->model('Model_Cliente');
        
        $servicios = [];
        $clientes  = [];
        foreach ($this->Model_Servicios->getServicios() as $servicio){
            $servicios[$servicio['id']]=$servicio['nombre'];
        }
        foreach ($this->Model_Cliente->getClientes() as $cliente){
            $clientes[$cliente['id']]=$cliente['razonSocial'];
        }
        
        $this->template->set('servicios',$servicios);
        $this->template->set('clientes',$clientes);
        $this->template->render('proyectos/nuevo');
    }
    public function detalles($id){
        $this->load->model('Model_Proyectos');
        $proyecto = $this->Model_Proyectos->get($id);
        
        if($this->user->has_permission('admin')){
            $this->template->render('proyectos/detalles_administrador');
        }
        if($this->user->has_permission($id.'_admin')){
            $this->template->render('proyectos/detalles_administrador');
        }
        if($this->user->has_permission($id.'_desarrollador')){
            $this->template->render('proyectos/detalles_desarrollador');
        }
        
        
        $this->template->set('proyecto',$proyecto);
        $this->template->render('proyectos/detalles_publico');
    }
    private function _validar_nuevo(){
        if($this->input->post('nuevo_proyecto') == 1){
            return true;
        }
        return false;
    }
}
