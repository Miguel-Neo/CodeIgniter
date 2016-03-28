<?php 


class Modulo_modelo_gallery extends CI_Model {

	function get_items($nombre){
		//return $this->db->get('users');
		
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