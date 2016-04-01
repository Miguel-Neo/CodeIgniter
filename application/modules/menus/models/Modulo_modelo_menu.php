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
                'id' => 'dss',
                'title'  => 'ds', 
                'link'   => 'index.php/about'
            ],[
                'id' => '324',
                'title'  => '324', 
                'link'   => '#ancla-cabecera'
            ],[
                'id' => 'about',
                'title'  => 'Users', 
                'link'   => 'index.php/Users/login'
            ],[
                'id' => 'about',
                'title'  => 'About Us', 
                'link'   => 'index.php/about'
            ],[
                'id' => 'about',
                'title'  => 'About Us', 
                'link'   => 'index.php/about'
            ],[
                'id' => 'about',
                'title'  => 'About Us', 
                'link'   => 'index.php/about'
            ],[
                'id' => 'about',
                'title'  => 'About Us', 
                'link'   => 'index.php/about'
            ],[
                'id' => 'about',
                'title'  => 'About Us', 
                'link'   => 'index.php/about'
            ],[
                'id' => 'services',
                'title'  => 'services', 
                'link'   => 'index.php/about'
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