<nav class="navbar navbar-inverse">
  <div class="container-fluid">
  
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>

    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">Page 1</a></li>
      <li><a href="#">Page 2</a></li> 
      <li><a href="#">Page 3</a></li> 
    </ul>

    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>

  </div>
</nav>


<?php if (false):?>
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Page 1</a></li>
                <li><a href="#">Page 2</a></li> 
                <li><a href="#">Page 3</a></li> 
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="">item1</a></li>


                                                
                                                <li class="dropdown-submenu">
                                                    <a href="">drop</a>

                                                    <ul class="dropdown-menu">
                                                        <li><a href="">i</a></li>
                                                    </ul>
                                                    
                                                </li>
                                            </ul>
                                        </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
<?php endif;?>