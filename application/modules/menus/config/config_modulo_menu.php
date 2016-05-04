<?php defined('BASEPATH') OR exit('No direct script access allowed');

# Esta configuracion esta echa para la vista modulo_menus_view_menu_02
$config['config_module']= [
	'scripts' =>[
		['type'=>'lib','value'=>'jquery/jquery-2.2.0.min'],
		['type'=>'lib','value'=>'bootstrap_3.3.6/js/bootstrap.min']
	],
	'styles'  =>[
		['type'=>'lib','value'=>'bootstrap_3.3.6/css/bootstrap.min'],
		['type'=>'modules','value'=>'menus/styles/menu_multiples_niveles']
	]
];