<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
///*
$config['templates']['front']['default'] = [
        'languaje'=>[],
	'regions' =>['header','main_menu','sidebar','footer'],
	'scripts' =>[
		['type'=>'lib','value'=>'jquery/jquery-2.2.0.min'],
		['type'=>'lib','value'=>'jqueryui/v1.11.4/jquery-ui.min'],
		['type'=>'lib','value'=>'bootstrap_3.3.6/js/bootstrap.min'],
		['type'=>'base','value'=>'function'],
		['type'=>'template','value'=>'funciones_default']
	],
	'styles'  =>[
		['type'=>'lib','value'=>'bootstrap_3.3.6/css/bootstrap.min'],
		['type'=>'lib','value'=>'jqueryui/v1.11.4/jquery-ui.min'],
		['type'=>'template','value'=>'custom']
	]
];
//*/
$config['templates']['admin']['default'] = [
	'regions' =>['header','main_menu','sidebar','footer'],
	'scripts' =>[
		['type'=>'lib','value'=>'jquery/jquery-2.2.0.min'],
		['type'=>'lib','value'=>'jqueryui/v1.11.4/jquery-ui.min'],
		['type'=>'lib','value'=>'bootstrap_3.3.6/js/bootstrap.min'],
		['type'=>'base','value'=>'function'],
	],
	'styles'  =>[
		['type'=>'lib','value'=>'bootstrap_3.3.6/css/bootstrap.min'],
		['type'=>'lib','value'=>'jqueryui/v1.11.4/jquery-ui.min'],
		['type'=>'template','value'=>'custom']
	]
];

/* End of file templates.php */
/* Location: ./application/config/templates.php */