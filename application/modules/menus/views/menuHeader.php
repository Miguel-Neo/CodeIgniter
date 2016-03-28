<?php echo $menu; ?>
<!--  

http://bootsnipp.com/snippets/featured/multi-level-dropdown-menu-bs3

-->

<div class="container">
    <div class="row">
        <h2>Multi level dropdown menu in Bootstrap 3</h2>
        <hr>
        <div class="dropdown">
            <a id="dLabel" role="button" data-toggle="dropdown" class="btn btn-primary" data-target="#" href="/page.html">
                Dropdown <span class="caret"></span>
            </a>
            <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                <li><a href="#">Some action</a></li>
                <li><a href="#">Some other action</a></li>



                <li class="divider"></li>

                <li class="dropdown-submenu">
                    <a tabindex="-1" href="#">Hover me for more options</a>
                    
                    <ul class="dropdown-menu">
                        <li><a tabindex="-1" href="#">Second level</a></li>
                        <li class="dropdown-submenu">
                            <a href="#">Even More..</a>


                            <ul class="dropdown-menu">
                                <li><a href="#">3rd level</a></li>
                                <li><a href="#">3rd level</a></li>
                                <!-- -->
                                <li class="dropdown-submenu">
                                    <a href="#">Even More..</a>


                                    <ul class="dropdown-menu">
                                        <li><a href="#">3rd level</a></li>
                                        <li><a href="#">3rd level</a></li>
                                    </ul>

                                    
                                </li>
                                <!-- -->
                            </ul>


                        </li>
                        <li><a href="#">Second level</a></li>
                        <li><a href="#">Second level</a></li>
                    </ul>



                </li>

            </ul>
        </div>
    </div>
</div>