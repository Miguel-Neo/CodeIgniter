<?php

# Esta configuracion esta echa para la vista fancyBox_Button_helper
$config['config_module']= [
	'scripts' =>[
		['type'=>'lib','value'=>'fancyBox/source/jquery.fancybox.pack'], # Add fancyBox main JS and CSS files 
		['type'=>'lib','value'=>'fancyBox/source/helpers/jquery.fancybox-buttons'], # Add Button helper (this is optional) 
		['type'=>'modules','value'=>'gallery/fancyBox/Button_helper'] # Add Button helper (this is optional) 
	],
	'styles'  =>[
		['type'=>'lib','value'=>'fancyBox/source/jquery.fancybox'], # Add fancyBox main JS and CSS files 
		['type'=>'lib','value'=>'fancyBox/source/helpers/jquery.fancybox-buttons'] # Add Button helper (this is optional) 
	]
];
