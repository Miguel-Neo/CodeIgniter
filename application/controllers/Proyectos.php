<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Proyectos extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_Proyectos');
    }

    public function index() {
        $this->load->model('Model_Proyectos');
        $proyectos = $this->Model_Proyectos->getall();
        $this->template->set('proyectos', $proyectos);
        $this->template->render('proyectos/proyectos');
    }
    public function nuevo() {
        if ($this->_validar_nuevo()) {
            $proyecto = $this->input->post();
            $this->Model_Proyectos->insert($proyecto);
            redirect('Proyectos');
        }

        $this->load->model('Model_Servicios');
        $this->load->model('Model_Cliente');

        $servicios = [];
        $clientes = [];
        foreach ($this->Model_Servicios->getServicios() as $servicio) {
            $servicios[$servicio['id']] = $servicio['nombre'];
        }
        /*foreach ($this->Model_Cliente->getClientes() as $cliente) {
            $clientes[$cliente['id']] = $cliente['razonSocial'];
        }//*/
        foreach ($this->Model_Cliente->getClientes() as $cliente){
            $contactos = $this->Model_Cliente->getClienteContactos($cliente['id']);
            foreach ($contactos as $contacto){
                $clientes['Cliente: '.$cliente['razonSocial']]=[
                    $cliente['id']."_".$contacto['id']=>'contacto: '.$contacto['nombre']
                ];
            }
        }

        $this->template->set('servicios', $servicios);
        $this->template->set('clientes', $clientes);
        $this->template->render('proyectos/nuevo');
    }

    public function detalles($id) {
        $this->load->model('Model_Cliente');
        $proyecto = $this->Model_Proyectos->get($id);

        $this->template->set('proyecto', $proyecto);



        if ($this->user->has_permission('administrador') || $this->user->has_permission($id . '_administrador')) {
            $this->template->set('idProyecto', $id);
            $this->template->set('cliente',$this->Model_Cliente->getCliente($proyecto['idCliente']));
            $this->template->set('users', $this->Model_Proyectos->getuser($id));
            $this->template->render('proyectos/detalles_administrador');
            return NULL;
        }
        if ($this->user->has_permission($id . '_desarrollador')) {
            $this->template->render('proyectos/detalles_desarrollador');
            return NULL;
        }

        $this->template->render('proyectos/detalles_publico');
    }

    public function nuevo_desarrollador($idProyecto = null) {
        if($this->_validar_nuevo_desarrollador()){
            $this->_inserta_nuevo_desarrollador();
        }

        if ($this->user->has_permission('administrador') || $this->user->has_permission($idProyecto . '_administrador') || $this->user->id == $this->Model_Proyectos->get($idProyecto)['created'])
        {

            $this->load->model('acl/Model_Users');

            $usuarios = [];
            foreach ($this->Model_Users->getUsuarios() as $usuario) {
                $usuarios[$usuario->id] = $usuario->name;
            }
            $rol = [
                'desarrollador' => 'Desarrollador',
                'administrador' => 'Administrador'
            ];
            $hidden = array(
                'nuevo_dearrollador' => 1,
                'proyecto'=>$idProyecto
            );
            
            $this->template->set('idProyecto',$idProyecto);
            $this->template->set('rol', $rol);
            $this->template->set('hidden', $hidden);
            $this->template->set('usuarios', $usuarios);
            $this->template->render('proyectos/nuevo_desarrollador');

            return null;
        }
        $this->template->set_flash_message(['error' => dictionary('theme_not_authorized')]);

        redirect($this->session->userdata('uri_string'));
    }

    private function _validar_nuevo() {
        if ($this->input->post('nuevo_proyecto') == 1) {
            return true;
        }
        return false;
    }
    private function _validar_nuevo_desarrollador() {
        if ($this->input->post('nuevo_dearrollador') == 1) {
            return true;
        }
        return false;
    }
    private function _inserta_nuevo_desarrollador(){
        $this->load->model('acl/Model_Permissions');
        $this->load->model('Model_Proyectos_User');
        $this->load->model('acl/Model_Users');
        
         
        $permiso = $this->Model_Permissions->getPermisoname($this->input->post('proyecto').'_'.$this->input->post('Rol'));
        #cargar permiso
        if(!$permiso){
            $newPresmission = [
                'title'=>'Presmiso para desarrollador de proyecto',
                'name'=> $this->input->post('proyecto').'_'.$this->input->post('Rol')
            ];
            $this->Model_Permissions->insertpermission($newPresmission);
            $permiso = $this->Model_Permissions->getPermisoname($this->input->post('proyecto').'_'.$this->input->post('Rol'));
        
        }
        #insertar usuario al grupo de trabajo
        $this->Model_Proyectos_User->insert($this->input->post());
        
        #le asigno el permiso al usuario,
        $this->Model_Users->editarPermiso($this->input->post('user'), $permiso['id'], 1);
       
            
        redirect('Proyectos/detalles/'.$this->input->post('proyecto'));
    }

}
