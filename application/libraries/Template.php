<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
  Requiere del archivo aplication/config/templates.php
  hace uso de Base de datos de la tabla 'templates'

  cosas que se usan en el view que vienen de aqui
  <?=$_css ?>    -----------     que vienen en el data
  <?=$_js ?>    -----------     que vienen en el data

  foreach ($_content as $_view) {
  include $_view;    -----------     que vienen en el data
  }
 */

class Template {

    private $CI;
    protected $configs;
    protected $data;
    protected $js;
    protected $css;
    protected $table;
    protected $id;
    protected $name;
    protected $default_id;
    protected $default_name;
    protected $message;
    protected $panel;
    protected $configs_modules;

    public function __construct() {
        $this->CI = & get_instance()->controller;  #http://stackoverflow.com/questions/12586125/codeigniter-hmvc-extends-mx-controller-unable-to-use-get-instance-properly
        $this->CI->load->config('templates');
        $this->configs = $this->CI->config->item('templates');
        //echo '<pre>';print_r($this->configs);exit;
        $this->data = [];
        $this->js = [];
        $this->css = [];
        $this->configs_modules = [];
        $this->table = 'templates'; // nombre de la tabla en la BD
        $this->id = null; // id de la platilla actual
        $this->name = null; // nombre de la plantilla actual
        $this->default_id = null; // id de la plantilla por defecto
        $this->default_name = null; // nombre de la plantilla por defecto
        $this->message = '';
        $this->panel = $this->CI->admin_panel() ? 'b' : 'f';

        /* Desde un controlador puedo cargar otra plantilla */
    }

    /**
     * Puedo cambiar el template a usar desde algun controlador
     * @param type $name Nombre del template 
     */
    public function setTemplate($name) {
        $this->name = $name;
    }
    public function getTemplate(){
        return $this->name;
    }
    public function getPanel(){
        return $this->panel;
    }

    /**
     * Setear el data 
     * @param type $key 
     * @param type $value
     */
    public function set($key, $value) {
        if (!empty($key)) {
            $this->data[$key] = $value;
        }
    }

    public function load_config_modules($modules = null) {
        if (!empty($modules)) {
            if (!is_array($modules)) {
                $modules = [$modules];
            }
            foreach ($modules as $module) {
                $this->CI->load->config($module);
                $this->configs_modules = array_merge_recursive($this->configs_modules, $this->CI->config->item('config_module'));
            }
        }
    }

    public function add_js($type, $value, $charset = null, $defer = null, $async = null) {
        $this->_add_asset($type, $value, ['charset' => $charset, 'defer' => $defer, 'async' => $async], 'script');
    }

    public function add_css($type, $value, $media = null) {
        $this->_add_asset($type, $value, ['media' => $media], 'style');
    }

    public function add_message($message, $type = null) {
        $this->_add_message($message, $type);
    }

    public function set_flash_message(array $message) {
        //Recibe el mismo arreglo que add_message() y lo guarda en una variable de session que posteriormente se leera y pasara a _add_message
        /*
          podria en un controlador hacer una validacion crear los mensajes de error por ejmplo redireccionar a otro controlador y este mostraria estos mensajes
         */
        if (sizeof($message) > 0) {
            $this->CI->session->set_flashdata('_message_', $message);
        }
    }

    /**
     * 
     * @param type $view el o los nombres de las vistas que se cargaran
     *      Si no se le pasa ningu parametro cargara pueramente el template
     */
    public function render($view = null) {
        $template = $this->_route();
        $routes = [];


        if (!empty($view)) {
            if (!is_array($view)) {
                $view = [$view];
            }

            foreach ($view as $file) {
                /*
                  Recorre las vistas.
                  buscara primero esa vista en la carpeta html que se encuentra en la carpeta
                  del template
                  y si no la encuentra buscara en la carpeta views
                 */
                $route = $this->panel == 'b' ? 'admin/' : '';
                $route .= $this->name . "/html/" . str_replace('admin/', '', $file);
                if (file_exists(APPPATH . "views/themes/{$route}.php")) {
                    $routes[] = APPPATH . "views/themes/{$route}.php";
                } else if (file_exists(APPPATH . "views/{$file}.php")) {
                    $routes[] = APPPATH . "views/{$file}.php";
                } else {
                    show_error($this->CI->lang->line('cms_general_error_load_view'));
                }
            }
        }

        /**
         * Guardo en session la url, ya que si el usuario itenta accedes a un direccion 
         * a la cual no tiene permisos, inmediatamente se redireccionara 
         * a la url en la cual se encontraba.
         */
        $this->CI->session->set_userdata('uri_string', uri_string());
        $this->_set_assets();
        $this->_set_messages();
        $this->data['_views'] = $routes;
        $this->CI->load->view($template, $this->data);
    }

    /**
     * Carga el template por defecto si es que no se especifico uno en el controlador
     * @return type String  La ruta del template 
     *              views/templates/{admin/''}/{name}/template.php
     */
    private function _route() {
        $route = 'themes/';
        if (empty($this->name)) {
            $this->name = "default";
        }
        $route .= $this->panel == 'b' ? 'admin/' : '';
        $route .= "{$this->name}/template.php";
        if (!file_exists(APPPATH . "views/{$route}")) {# si no existe el archivo
            show_error($this->CI->lang->line('cms_general_error_load_template'));
        }
        return $route;
    }

    private function _add_asset($type, $value, $options = array(), $asset_type) {
        /*
          setea los js y css
          es usado por las funciones publicas y una funcion privada
          _set_assets
          add_css
          add_js
         */
        if (!empty($type)) {
            $asset = [];
            if (is_array($value)) {
                foreach ($value as $val) {
                    $asset[] = ['type' => $type, 'value' => $val, 'option' => $options];
                }
            } else {
                $asset[] = ['type' => $type, 'value' => $value, 'option' => $options];
            }
        }
        if ($asset_type == 'script') {
            $this->js = array_merge($this->js, $asset);
        } elseif ($asset_type == 'style') {
            $this->css = array_merge($this->css, $asset);
        }
    }

    //Solo usado por render()
    private function _set_assets() {
        /*
          carga de js
          primero guarda en una temporal los js que se setearon desde el controlador
          recorre el archivo de configuracion.
          se los pasamos por _add_asset
          esto para ordenarlos pone primero los del archivo de cunfiguracion
          despues los que se setearon en el controlador.

          dependiendo del tipo es donde los buscara.
          completando asi la linea de codigo para el html con su direccion correspondiente

          Finalmente los añade al data

          $src = base_url().'assets/scripts/';

         */
        if (!empty($this->name)) { // si no esta vacia
            $panel = $this->panel == 'b' ? 'admin' : 'front';

            $scripts = $this->js; #los que se setean desde el controlador los guardo en otra variable
            $this->js = []; #limpio la variable global

            $styles = $this->css;
            $this->css = [];

            $configModules = $this->configs_modules;
            $this->configs_modules = [];

            # Cargo y uno los elementos de configuracion de los modlos 
            # estos se definen el el config/template o dentro del controlador q lo use 
            if (isset($this->configs[$panel][$this->name]['config_modules']) && sizeof($this->configs[$panel][$this->name]['config_modules']) > 0) {
                foreach ($this->configs[$panel][$this->name]['config_modules'] as $modules) {
                    $this->load_config_modules($modules['value']);
                }
            }
            $this->configs_modules = array_merge_recursive($this->configs_modules, $configModules);
            
            
            if (isset($this->configs[$panel][$this->name]['scripts']) && sizeof($this->configs[$panel][$this->name]['scripts']) > 0) {
                # lee los elementos del archivo de configuracion.
                foreach ($this->configs[$panel][$this->name]['scripts'] as $script) {
                    $this->_add_asset(
                            $script['type'], $script['value'], isset($script['options']) ? $script['options'] : [], 'script'
                    );
                }
            }
            
            # lee los elementos del archivo de configuracion de los MODULOS definidos
            if (isset($this->configs_modules['scripts']) && sizeof($this->configs_modules['scripts']) > 0) {

                foreach ($this->configs_modules['scripts'] as $script) {
                    $this->_add_asset(
                            $script['type'], $script['value'], isset($script['options']) ? $script['options'] : [], 'script'
                    );
                }
            }

            $this->js = array_merge($this->js, $scripts);

            # verificar que no se repita ninguna libreria 
            $this->_check_duplicate('scripts');



            if (isset($this->configs[$panel][$this->name]['styles']) && sizeof($this->configs[$panel][$this->name]['styles']) > 0) {

                foreach ($this->configs[$panel][$this->name]['styles'] as $style) {
                    $this->_add_asset(
                            $style['type'], $style['value'], isset($style['options']) ? $style['options'] : [], 'style'
                    );
                }
            }
            # lee los elementos del archivo de configuracion de los MODULOS definidos
            if (isset($this->configs_modules['styles']) && sizeof($this->configs_modules['styles']) > 0) {

                foreach ($this->configs_modules['styles'] as $style) {
                    $this->_add_asset(
                            $style['type'], $style['value'], isset($style['options']) ? $style['options'] : [], 'style'
                    );
                }
            }
            $this->css = array_merge($this->css, $styles);

            # verificar que no se repita ninguna libreria 
            $this->_check_duplicate('styles');
        }
        // Lo anterior solo reordena el array pone primero los elementos del archivo 
        // de configuracion del template luego los del modulo y al final los que se setean 
        // en el controlador  
        // que se setearon desde el controlador 
        // a continuacion crar las rutas para insertarlos en la vista
        $_css = $_js = '';
        $panel = $this->panel == 'b' ? 'admin/' : '';

        if (sizeof($this->js) > 0) {
            foreach ($this->js as $js) {
                $defer = $async = $charset = '';
                if (isset($js['options'])) {
                    $defer = isset($js['options']['defer']) ? 'defer' : '';
                    $async = isset($js['options']['async']) ? 'async' : '';
                    $charset = isset($js['options']['charset']) ? 'charset="' . $js['options']['charset'] . '"' : '';
                }
                $src = base_url() . 'assets/scripts/';

                switch ($js['type']) {
                    case 'lib':
                        $src = base_url() . 'assets/lib/' . $js['value'] . '.js';
                        break;
                    case 'base':
                        $src .= 'base/' . $js['value'] . '.js';
                        break;
                    case 'template':
                        $src .= 'templates/' . $panel . $this->name . '/' . $js['value'] . '.js';
                        break;
                    case 'view':
                        $src .= 'views/' . $js['value'] . '.js';
                        break;
                    case 'modules':
                        $src = base_url() .'assets/modules/' . $js['value'] . '.js';
                        break;
                    case 'url':
                        $src = $js['values'];
                        break;


                    default:
                        show_error('Error carga type assets');
                        //$src = '';
                        break;
                }
                $_js .= sprintf('<script type="text/javascript" src="%s" %s %s %s></script>'
                        , $src, $charset, $defer, $async
                );
            }
        }

        if (sizeof($this->css) > 0) {
            foreach ($this->css as $css) {
                $media = '';
                if (isset($css['options'])) {
                    $media = isset($css['options']['media']) ? 'media="' . $css['options']['media'] . '"' : '';
                }
                $href = base_url() . 'assets/styles/';

                switch ($css['type']) {
                    case 'lib':
                        $href = base_url() . 'assets/lib/' . $css['value'] . '.css';
                        break;
                    case 'base':
                        $href .= 'base/' . $css['value'] . '.css';
                        break;
                    case 'template':
                        $href .= 'templates/' . $panel . $this->name . '/' . $css['value'] . '.css';
                        break;
                    case 'view':
                        $href .= 'views/' . $css['value'] . '.css';
                        break;
                    case 'modules':
                        $href = base_url() . 'assets/modules/' . $css['value'] . '.css';
                        break;
                    case 'url':
                        $href = $css['value'];
                        break;
                    case 'bonus':
                        $_css .= $css['value'];
                        break;


                    default:
                        show_error('Error carga type assets');
                        //$href = '';
                        break;
                }
                $_css .= sprintf('<link type="text/css" rel="stylesheet" href="%s" %s>'
                        , $href, $media
                );
            }
        }
        $this->data['_js'] = $_js;
        $this->data['_css'] = $_css;
    }

    /*
      funcion para crear mensajer ['warning','success','error','info']

      asi se llena el arra de mensajes
      $this->template->add_message(['error' => ['mensaje','mensaje']]);
      asi queda la estructua:

      print_r($this->message);exit;
      Array
      (
      [error] => Array
      (
      [0] => mensaje
      [1] => mensaje
      )

      )

     */

    private function _add_message($message, $type = null) {
        if (!empty($message)) {
            $types = ['warning', 'success', 'error', 'info'];
            $check_type = function($_type) use ($types) {
                return (empty($_type) || !in_array($_type, $types)) ? 'warning' : $_type;
                // Si el tipo que se le pasa no se encuentra el el arreglo de tipos entonces lo regresa como warning
            };
            /*
              ['error' => ['mensaje','mensaje']]
             */
            if (is_array($message)) {
                foreach ($message as $type => $msg) {
                    if (!empty($msg)) {
                        $type = $check_type($type);
                        if (is_array($msg)) {
                            foreach ($msg as $_msg) {
                                if (!empty($_msg)) {
                                    $this->message[$type][] = (string) $_msg;
                                }
                            }
                        } else {
                            $this->message[$type][] = (string) $msg;
                        }
                    }
                }
            } else {
                $type = $check_type($type);
                $this->message[$type][] = (string) $message;
            }
        }
    }

    /*

      El arrego message lo coloca en la data
      si se quieren pasar mensajes a otra pagina se tienen que usar bariables de secion.
      la flassh data una vez que se lee la variable se elimina de forma automatica
     */

    private function _set_messages() {
        $this->_add_message($this->CI->session->flashdata('_message_'));

        $this->data['_alerts']['_warning'] = isset($this->message['warning']) ? $this->message['warning'] : [];
        $this->data['_alerts']['_success'] = isset($this->message['success']) ? $this->message['success'] : [];
        $this->data['_alerts']['_error'] = isset($this->message['error']) ? $this->message['error'] : [];
        $this->data['_alerts']['_info'] = isset($this->message['info']) ? $this->message['info'] : [];
    }

    private function _check_duplicate($arr) {
        if ($arr == 'scripts') {
            $this->js = $this->_unique_multidim_array($this->js, 'value');
        } else if ($arr == 'styles') {
            $this->css = $this->_unique_multidim_array($this->css, 'value');
        }
    }

    private function _unique_multidim_array($array, $key) {
        # http://php.net/manual/es/function.array-unique.php
        $temp_array = array();
        $i = 0;
        $key_array = array();

        foreach ($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }

}

/* End of file Template.php */
/* Location: ./application/libraries/Template.php */