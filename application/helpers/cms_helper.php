<?php

defined('BASEPATH') OR exit('No direct script access allowed');


        


if (!function_exists('alerts')) {

    function alerts($_alerts) {
        echo '<div id = "panel_message_alert">';
        foreach ($_alerts['_warning'] as $_msg) {
            echo '<div class="alert alert-warning" role="alert">' . $_msg . '</div>';
        }
        foreach ($_alerts['_success'] as $_msg) {
            echo '<div class="alert alert-success" role="alert">' . $_msg . '</div>';
        }
        foreach ($_alerts['_error'] as $_msg) {
            echo '<div class="alert alert-danger" role="alert">' . $_msg . '</div>';
        }
        foreach ($_alerts['_info'] as $_msg) {
            echo '<div class="alert alert-info" role="alert">' . $_msg . '</div>';
        }
        echo "</div>";
    }

}

/**
 * Esta funcio cambia el idioma del sitio 
 * Esto solo imprime un selected sensillo con los idiomas definidos en 
 * ./application/config/cms.php
 * y toma como idioma predeterminado el valor del item de configuracion language de codeigniter
 * 
 * para esto usa un script setLenguage(lenguage) que mediante ajax envia la peticion al controlador Language
 */
if(!function_exists('select_Languge')){
    function select_Languge(){
        
        $CI = & get_instance(); 
        echo '<select onchange="setLenguage(this.value)">';
        foreach($CI->config->item('cms_languages') as $lang){
            $selected = ''; 
            if($lang == $CI->config->item('language'))
                {$selected = 'selected';}else{$selected = '';}
                
            echo '<option value="'.$lang.'" '.$selected.'>'.$lang.'</option> ';
        }
        echo '</select>';
         
         //*/
    }
}

if(!function_exists('dictionary')){
    function dictionary($clave){
        $CI = & get_instance(); 
        return $CI->lang->line($clave);
    }
}

if(!function_exists('debugger')){
    function debugger($msg){
        echo '<pre>';
        print_r($msg);
        exit;
    }
}

   
