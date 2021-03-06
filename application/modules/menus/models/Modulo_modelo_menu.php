<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Modulo_modelo_menu extends CI_Model {

	function get_items($nombre){
		//return $this->db->get('users');
		$menu['demos']=
        [
            [   
                'id'    => 'demos_item_index',
                'title' => 'Home',
                'link'  => 'admin/demos/index'
            ],
            [   
                'id'    => 'demos_item_menus',
                'title' => 'Menus',
                'link'  => 'admin/demos/menus'
            ],
            [   
                'id'    => 'demos_item_galerias',
                'title' => 'galerias',
                'link'  => 'admin/demos/galerias'
            ]
        ];
        $menu['navigation'] = 
        [
            [
                'id' => 'home',
                'title'  => 'home', 
                'link'   => ''
            ],[
                'id' => 'roles',
                'title'  => 'roles', 
                'link'   => 'roles'
            ],[
                'id' => '324',
                'title'  => '324', 
                'link'   => '#ancla-cabecera'
            ],[
                'id' => 'permisos',
                'title'  => 'permisos', 
                'link'   => 'permisos'
            ],[
                'id' => 'Usuario',
                'title'  => 'Usuario', 
                'link'   => 'Usuario'
            ],[
                'id' => 'logout',
                'title'  => 'logout', 
                'link'   => 'login/logout'
            ],[
                'id' => 'servicio',
                'title'  => 'Servicios', 
                'link'   => 'Servicio'
            ],[
                'id' => 'Cliente',
                'title'  => 'Clientes', 
                'link'   => 'Cliente'
            ],[
                'id' => 'File',
                'title'  => 'File', 
                'link'   => 'File'
            ],[
                'id' => 'Proyectos',
                'title'  => 'Proyectos', 
                'link'   => 'Proyectos'
            ],
            
            
            [
                'id' => 'services',
                'title'  => 'services', 
                'link'   => '',
                'submenu' => [
                    [
                    'id' => 'about',
                    'title'  => 'About Us', 
                    'link'   => 'index.php/about'
                    ],
                    [
                    'id' => 'about',
                    'title'  => 'About Us', 
                    'link'   => 'index.php/about',
                    'submenu' => [
                            [
                            'id' => 'about',
                            'title'  => 'About Us', 
                            'link'   => 'index.php/about'
                            ],
                            [
                            'id' => 'about',
                            'title'  => 'About Us', 
                            'link'   => 'index.php/about',
                            'submenu'=> [
                                    [
                                    'id' => 'about',
                                    'title'  => 'About Us', 
                                    'link'   => 'index.php/about'
                                    ],  
                                ]
                            ],
                        ]
                    ],
                ]
            ],
        ];
    //    /*
     

    //    */

        return $menu[$nombre];
	}
}