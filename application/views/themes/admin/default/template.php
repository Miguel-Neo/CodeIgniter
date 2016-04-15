<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?php echo base_url();?>assets/images/template/default/ico.ico">
	<title>Codeigniter</title>
	 <?=$_css; ?>
	<!-- Bootstrap core CSS -->
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	<!-- Bootstrap core CSS -->
	
</head>
<body data-baseurl="<?php echo base_url(); ?>">
	<div id="cms_main_container">
  		
  		<h1>PLANTILLA DEFAULT DEL BACK-END</h1>
		
		<!--  ================================================== -->
		<!--  Insert views                                       -->
		<!--  ================================================== -->

  		<?php foreach ($_views as $_view) {include $_view;} ?>
  		
  		<!--  ================================================== -->
		<!--  ./Insert views                                     -->
		<!--  ================================================== -->
		
	</div><!--  ./ .contenedor_principal -->
	
	<!--  ================================================== -->
	<!--  Core JavaScript                                    -->
	<!--  ================================================== -->
	<? echo $_js; ?>
	<!--  ================================================== -->
	<!--  ./Core JavaScript                                  -->
	<!--  ================================================== -->
</body>
</html>