<?php

if (isset($cliente)) {

    
    
}
?>
<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php if(isset($error))echo $error;?>

<?php echo form_open_multipart('cliente/do_upload');?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>

</body>
</html>