<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Modulo_menus_libraries_menu {

	public function __construct(){

	}
	public function get_menu_ul($menue, $selected = 'home', $style = ''){
		$menu = '<ul class="nav navbar-nav">'."\n";
		foreach($menue as $item)
        {
            # si el id o title o link coinciden con el selected es el activo
            $current   =(in_array($selected, $item))  ?   ' class="active"'          :   '';
            $id = (!empty($item['id']))     ?    ' id="'.$item['id'].'"'    :   '';
            if ( ! empty($item['submenu'])) {
                if(is_array($item['submenu'])){
                  $menu     .=   $this->_dropdown($item);
                }
            }else
            $menu     .=   '<li'.$current.'><a href="'.base_url().$item['link'].'"'.$id.' class = "menu_con_efecto_scroll">'.$item['title'].'</a></li>'."\n";
        }
        $menu .= '</ul>'."\n";
        return $menu;
	}

	private function _dropdown($items){
	    $submenu = '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$items['title'].' <span class="caret"></span></a>';
	    $submenu .='<ul class="dropdown-menu">';
	    foreach($items['submenu'] as $item){
	        # si el id o title o link coinciden con el selected es el activo
	            $current   =  '';
	            $id = (!empty($item['id']))     ?    ' id="'.$item['id'].'"'    :   '';
	            if ( ! empty($item['submenu'])) {
	                if(is_array($item['submenu'])){
	                  $submenu     .=   $this->_dropdown_submenu($item);
	                }
	            }else
	            $submenu     .=   '<li'.$current.'><a href="'.$item['link'].'"'.$id.'>'.$item['title'].'</a></li>'."\n";
	        
	    }
	    
	    $submenu .= '</ul></li>';
	    return $submenu;
	}
	private function _dropdown_submenu($items){
	    $submenu = '<li class="dropdown-submenu"><a href="">'.$items['title'].'</a>';
	    $submenu .='<ul class="dropdown-menu">';
	    foreach($items['submenu'] as $item){
	        # si el id o title o link coinciden con el selected es el activo
	            $current   =  '';
	            $id = (!empty($item['id']))     ?    ' id="'.$item['id'].'"'    :   '';
	               if ( ! empty($item['submenu'])) {
	                    if(is_array($item['submenu'])){
	                      $submenu     .=   $this->_dropdown_submenu($item);
	                    }
	                }else
	            $submenu     .=   '<li'.$current.'><a href="'.$item['link'].'"'.$id.'>'.$item['title'].'</a></li>'."\n";
	        
	    }
	    
	    $submenu .= '</ul></li>';
	    return $submenu;
	}
}