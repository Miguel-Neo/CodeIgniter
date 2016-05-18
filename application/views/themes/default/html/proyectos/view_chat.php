<?php
//debugger($msgs);
?>
<div id="mensajes">
<?php if(isset($msgs)):?>
    <?php foreach ($msgs as $msg):?>
        <?php $class="";?>
        <?php if($msg['created'] == $this->user->id):?>
            <?php $class="mi_mensaje";?>
        <?php else:?>
            <?php $class="otro_mensaje";?>
        <?php endif;?>   
<div class="msg_chat <?=$class;?>">
    <div>
        <?=$msg['nombre_usuario']?>
        :
        <?=$msg['created_at']?>
    </div>
    <div>
        <?=$msg['msg']?>
    </div>
    <div>
        
    </div>
    
</div>
    <?php endforeach;?>
<?php endif;?>
</div>