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

    public function nuevo($id_cliente = null) {
        $this->load->model('Model_Proyectos_User');
        
        if ($this->_validar_nuevo()) {
            $proyecto = $this->input->post();
            if ($this->Model_Proyectos->insert($proyecto)) {
                $_usuario=[
                    'proyecto' => $this->Model_Proyectos->getpornombre($proyecto['titulo'])['id'],
                    'user'=>$this->user->id,
                    'Rol'=>'administrador'
                ];
                
                $this->Model_Proyectos_User->insert($_usuario);
                redirect('Proyectos');
            }
            $this->template->set_flash_message(['error' => dictionary('theme_model_erro')]);
        }

        $this->load->model('Model_Servicios');
        $this->load->model('Model_Cliente');

        $servicios = [];
        $clientes = [];
        $contactos = [];
        foreach ($this->Model_Servicios->getServicios() as $servicio) {
            $servicios[$servicio['id']] = $servicio['nombre'];
        }

        foreach ($this->Model_Cliente->getClientes() as $cliente) {
            $clientes[$cliente['id']] = $cliente['razonSocial'];
            if ($id_cliente == null)
                $id_cliente = $cliente['id'];
        }
        $contact = $this->Model_Cliente->getClienteContactos($id_cliente);
        if (count($contact) > 0) {
            foreach ($contact as $contacto) {
                $contactos[$contacto['id']] = $contacto['nombre'];
            }
        }

        $this->template->add_js('view', 'proyectos/new_proyect');

        $this->template->set('action', 'Proyectos/nuevo');
        $this->template->set('input_hidden', ['nuevo' => 1]);

        $this->template->set('servicios', $servicios);
        $this->template->set('clientes', $clientes);
        $this->template->set('cliente_selected', $id_cliente);
        $this->template->set('contactos', $contactos);



        $this->template->set('hola', "Hola mundo cruel");
        $this->template->render('proyectos/nuevo');
    }

    public function detalles($id) {
        $this->load->model('Model_Cliente');
        $this->load->model('Model_Contacto');
        $this->load->model('acl/Model_Users');
        $this->load->model('Model_Proyectos_User');

        $this->template->add_js('lib', 'tinymce_4.3.12/tinymce.min');
        $this->template->add_js('view', 'proyectos/detalles');


        $proyecto = $this->Model_Proyectos->get($id);
        $cliente = $this->Model_Cliente->getCliente($proyecto['idCliente']);
        $contactos = [];
        foreach ($this->Model_Contacto->getcontactos_proyecto($id) as $con) {
            $contactos_tem= $this->Model_Contacto->getcontacto($con['id']);
            $contactos_tem['link_eliminar']=anchor(
                'Proyectos/eliminar_contacto/'.$id.'/'.$contactos_tem['id'],
                'eliminar',
                array('onclick' => 'return confirm_delete();')   
                );
            $contactos[]=$contactos_tem;
        }
        $usuarios=[];
        foreach($this->Model_Proyectos->getuser_proyecto($id) as $_usuario){
            $_usuario_temp = $this->Model_Users->getdetailUser($_usuario['idUsuario']);
            $_usuario_temp['rel']=$_usuario;
            $_usuario_temp['link_eliminar']=anchor(
                'Proyectos/eliminar_usuario/'.$id.'/'.$_usuario_temp['id'],
                'eliminar',
                array('onclick' => 'return confirm_delete();')   
                );
            $usuarios[]=$_usuario_temp;
        }
        
        //debugger($usuarios);
        //debugger($this->Model_Proyectos->getuser($id));
        $tinymce = $this->Model_Proyectos->getatributo($id, 'tinymce')['valor'];
        $estatus = $this->Model_Proyectos->getatributo($id, 'estatus')['valor'];
        
        $this->template->set('nombre_proyecto', $proyecto['nombre']);
        $this->template->set('nombre_cliente', $cliente['razonSocial']);
        $this->template->set('proyecto', $proyecto);
        $this->template->set('idProyecto', $id);
        $this->template->set('cliente', $cliente);
        $this->template->set('contactos', $contactos);
        $this->template->set('users', $usuarios);
        $this->template->set('action_tinymce', '/proyectos/insert_tinymce/' . $id);
        $this->template->set('tinymce', $tinymce);
        $this->template->set('estatus',$estatus);
        $this->template->set('action_estatus','/proyectos/insert_status/' . $id);
        $this->template->set('action_chat','/proyectos/insert_chat/' . $id);
        
        $rel_p_u = $this->Model_Proyectos_User->getmy($id)['rol'];
        
        if ($this->user->has_permission('administrador') || $rel_p_u === 'administrador') {
            
            $this->template->render('proyectos/detalles_administrador');
            return NULL;
        }
        if ($rel_p_u === 'desarrollador') {
            $this->template->render('proyectos/detalles_desarrollador');
            return NULL;
        }

        $this->template->render('proyectos/detalles_publico');
    }

    public function nuevo_contacto($idProyecto, $idCliente) {
        if ($this->input->post('nuevo_contacto') == 1) {
            $this->Model_Proyectos->insertContacto($idProyecto, $this->input->post('contacto'));
            redirect('Proyectos/detalles/' . $idProyecto);
        }

        $this->load->model('Model_Cliente');
        $contactos = [];
        $contact = $this->Model_Cliente->getClienteContactos($idCliente);
        if (count($contact) > 0) {
            foreach ($contact as $contacto) {
                $contactos[$contacto['id']] = $contacto['nombre'];
            }
        }


        $this->template->set('action', 'Proyectos/nuevo_contacto/' . $idProyecto . '/' . $idCliente);
        $this->template->set('contactos', $contactos);
        $this->template->set('input_hidden', ['nuevo_contacto' => 1]);
        $this->template->render('proyectos/nuevo_contacto');
    }

    public function eliminar_contacto($idProyecto, $idContacto) {
        $this->Model_Proyectos->eliminar_contacto($idProyecto, $idContacto);
        redirect('Proyectos/detalles/' . $idProyecto);
    }
    public function eliminar_usuario($idProyecto, $idusuario){
        $this->Model_Proyectos->eliminar_usuario($idProyecto, $idusuario);
        redirect('Proyectos/detalles/' . $idProyecto);
    }

    public function nuevo_desarrollador($idProyecto = null) {
        if ($this->_validar_nuevo_desarrollador()) {
            $this->_inserta_nuevo_desarrollador();
        }

        if ($this->user->has_permission('administrador') || $this->user->has_permission($idProyecto . '_administrador') || $this->user->id == $this->Model_Proyectos->get($idProyecto)['created']) {

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
                'proyecto' => $idProyecto
            );
            $this->template->set('action', 'Proyectos/nuevo_desarrollador');
            $this->template->set('idProyecto', $idProyecto);
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
        if ($this->input->post('nuevo') == 1) {
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

    private function _inserta_nuevo_desarrollador() {
        $this->load->model('Model_Proyectos_User');
        #insertar usuario al grupo de trabajo
        $this->Model_Proyectos_User->insert($this->input->post());
        redirect('Proyectos/detalles/' . $this->input->post('proyecto'));
    }

    public function ajax_get_contactos($id_Cliente) {
        $this->load->model('Model_Cliente');
        $contactos = "";
        $contact = $this->Model_Cliente->getClienteContactos($id_Cliente);
        if (count($contact) > 0) {
            foreach ($contact as $contacto) {
                $contactos .="<option value='" . $contacto['id'] . "'>" . $contacto['nombre'] . "</option>";
            }
        } else {
            $contactos = "<option value=''></option>";
        }
        echo $contactos;
    }

    public function insert_tinymce($id) {
        $this->Model_Proyectos->setatributo($id, 'tinymce', $this->input->post('div_tinymce'));
        redirect('proyectos/detalles/' . $id);
    }
    public function insert_status($id){
        $this->Model_Proyectos->setatributo($id, 'estatus', $this->input->post('estatus'));
        redirect('proyectos/detalles/' . $id);
    }
    public function insert_chat($id){
        $this->Model_Proyectos->set_chat($id,$this->input->post('msg'));
    }
    public function get_chat_ajax($id=null){
        $msgs['msgs'] = $this->Model_Proyectos->get_chat($id);
        $vista= $this->load->view('themes/default/html/proyectos/view_chat',$msgs,true);
        print_r($vista);
        //print_r($this->uri->rsegments);
        return false;
    }

}
