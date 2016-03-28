<?php


$config['config_module']= [
	'scripts' =>[
		['type'=>'lib','value'=>'fancyBox/source/jquery.fancybox.pack'], # Add fancyBox main JS and CSS files 
		['type'=>'lib','value'=>'fancyBox/source/helpers/jquery.fancybox-thumbs'],
		['type'=>'modules','value'=>'gallery/fancyBox/Thumbnail']
	],
	'styles'  =>[
		['type'=>'lib','value'=>'fancyBox/source/jquery.fancybox'], # Add fancyBox main JS and CSS files 
		['type'=>'lib','value'=>'fancyBox/source/helpers/jquery.fancybox-thumbs']
	]
];