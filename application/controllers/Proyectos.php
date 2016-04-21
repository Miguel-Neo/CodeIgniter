<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Proyectos extends MY_Controller {

    public function index() {
        $this->template->render(['welcome_message']);
    }

}
