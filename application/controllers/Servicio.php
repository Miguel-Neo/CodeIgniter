<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Servicio extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Model_Servicios');
    }
    
    public function index(){
        
        $this->template->set('servicios',$this->Model_Servicios->getServicios());
        $this->template->render('servicio/view_servicio');
    }
    public function editar($id){
        if (!$id) {
            redirect('Servicio');
        }
        $servicio = $this->Model_Servicios->getServicio($id);
        if (!$servicio) {
            redirect('Servicio');
        }
        if ($this->input->post('editar_servicio') == 1) {
            $editarservicio = array(
                'id' => $this->input->post('id'),
                'nombre' => $this->input->post('nombre'),
                'descripcion' => $this->input->post('descripcion'),
            );
            $this->Model_Servicios->update($editarservicio);
            redirect('Servicio');
        }
        
        $this->template->set('servicio', $servicio);
        $this->template->render('servicio/view_editar');
    }
    public function eliminar($id){
        $this->Model_Servicios->delete($id);
        redirect('Servicio');
    }
    public function nuevo(){
        
        if ($this->input->post('nuevo_servicio') == 1) {
            $newservicio = array(
                'nombre' => $this->input->post('nombre'),
                'descripcion' => $this->input->post('descripcion'),
            );
            if($this->Model_Servicios->insert($newservicio)){
                redirect('Servicio');
            }
            $this->template->add_message(['error' => [dictionary('theme_error_duplicate_element')]]);
            
        }
        
        $this->template->render('servicio/view_nuevo');
    }
    
}