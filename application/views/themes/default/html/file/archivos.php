<?php

     echo '<pre>';
     print_r($contenido);
     
foreach($contenido as $key => $valor){
    if(is_dir($valor['relative_path'])){
        echo anchor('File/index/'.$key,$key);
    }
    
    echo '<br>';
}
