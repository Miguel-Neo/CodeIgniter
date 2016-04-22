<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->lang->load('form_validation');
    }

    public function index() {
        /*
          $this->load->library('encrypt');
          echo $this->encrypt->password('prueba');
          exit;
          // */

        if ($this->input->post('login') == 1) {
            $this->load->library('form_validation');

            $rules = [
                [
                    'field' => 'user',
                    'label' => 'lang:cms_general_label_user',
                    'rules' => 'trim|required|alpha_dash|max_length[30]'
                ],
                [
                    'field' => 'password',
                    'label' => 'lang:cms_general_label_password',
                    'rules' => 'required|max_length[30]'
                ]
            ];


            $this->form_validation->set_rules($rules);

            if ($this->form_validation->run() === TRUE) {
                if ($this->user->login($this->input->post('user'), $this->input->post('password')) === TRUE) {
                    # CARGO EN VARIABLE DE SESSION EL ID DEL USUARIO
                    $this->session->set_userdata('user_id', $this->user->id);

                    redirect(base_url());
                }

                $this->template->add_message(['error' => $this->user->errors()]);
            }
        }

        $this->load->helper('form');
        $this->template->render('users/login');
    }

    public function logout() {
        if ($this->user->is_logged_in()) {
            $this->session->sess_destroy();
        }

        redirect(base_url());
    }

    public function changeLanguage($lang = null) {
        if ($lang != null) {
            if (in_array($lang, $this->config->item('cms_languages'))) {
                // si el lenguaje que se le paso existe en nuestro arreglo application/config/cms.php
                // crea la variable de session 
                $this->session->set_userdata('global_lang', $lang);
            }
        } else {
            show_error($this->lang->line('cms_general_error_set_lenguage'));
        }
    }

}
