<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Proyectos_Contactos extends CI_Model {

    private $tables = [
        'clientes' => 'crm_cliente',
        'detallesCliente' => 'crm_detallesCliente',
        'cliente_contacto'=>'crm_cliente_contacto',
        'detallesContacto'=>'crm_detallesContacto'
    ];

    public function __construct() {
        parent::__construct();
    }
    
}


