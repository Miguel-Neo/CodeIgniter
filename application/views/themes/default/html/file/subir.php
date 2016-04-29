<?php $this->load->helper('form');?>

<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php if(isset($error))echo $error;?>

<?php echo form_open_multipart('file/do_upload',['id'=>'formulario_archivos_proyecto']);?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>
<!--
Para hacer el envio del archivo mediante ajax

<button type="button" class="btn btn-primary" onclick="upload_Archivo()">Guardar</button>
-->
</body>
</html>