

<nav id ="main-header" class="navbar navbar-default navbar-fixed-top"> 
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <!-- Button for mobile -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- ./Button for mobile -->
            <a class="navbar-brand" href="#">
                <?php 
                $image_properties = array(
                        'src'   => 'assets/images/template/default/ico.ico',
                        'alt'   => 'logotipo',
                        'class' => 'post_images',
                        'style' => 'margin-top:-15px;',
                        'title' => 'That was quite a night',
                        'rel'   => 'lightbox'
                );
                echo img($image_properties);
                ?>
            </a>
        </div><!-- ./ .navbar-header" -->
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php echo $menu; ?>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        
                    </ul>
                </li>
                 <li><a href="#">Link</a></li>
            </ul>
        </div><!-- ./ #bs-example-navbar-collapse-1-->



    </div><!-- ./ .container-fluid-->
</nav>
