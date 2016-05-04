<?php

# Esta configuracion esta echa para la vista fancyBox_Simple_image_gallery
$config['config_module']= [
	'scripts' =>[
		['type'=>'lib','value'=>'fancyBox/source/jquery.fancybox.pack'], # Add fancyBox main JS and CSS files 
		['type'=>'modules','value'=>'gallery/scripts/fancyBox/Simple_image_gallery']
	],
	'styles'  =>[
		['type'=>'lib','value'=>'fancyBox/source/jquery.fancybox'] # Add fancyBox main JS and CSS files 
	]
];