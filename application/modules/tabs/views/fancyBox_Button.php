<style>
	/* Estos estiloa anulan los de bootstrap*/
	.panel{
		    box-shadow: none; 
		    
	}
	#accordion{
		width: 100%;
	}
</style>

<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
        Collapsible Group 1</a>

<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
        Collapsible Group 2</a>

<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
        Collapsible Group 3</a>


<div class="panel-group" id="accordion">
  <div class="panel">
   
    <div id="collapse1" class="panel-collapse collapse in">
      <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
      minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
      commodo consequat.</div>
    </div>
  </div>
  <div class="panel">
    
    <div id="collapse2" class="panel-collapse collapse">
      <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
      minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
      commodo consequat.</div>
    </div>
  </div>
  <div class="panel">
   
    <div id="collapse3" class="panel-collapse collapse">
      <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
      minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
      commodo consequat.</div>
    </div>
  </div>
</div>


<?php 
// http://codepen.io/CesarGabriel/pen/tKaxq
 ?>
<section>
  <h1>Tabs with HTML5, CSS3 and jQuery</h1>
  <ul class="tabs">
    <li><a href="#tab1">Pestaña 1</a></li>
    <li><a href="#tab2">Pestaña 2</a></li>
    <li><a href="#tab3">Pestaña 3</a></li>
  </ul>

  <section class="block">
    <article id="tab1">
      <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti. Pellentesque fermentum dolor. Aliquam quam lectus, facilisis auctor, ultrices ut, elementum vulputate, nunc.</p>
    </article>
    <article id="tab2">
      <p>Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. Praesent elementum hendrerit tortor. Sed semper lorem at felis. Vestibulum volutpat, lacus a ultrices sagittis, mi neque euismod dui, eu pulvinar nunc sapien ornare nisl. Phasellus pede arcu, dapibus eu, fermentum et, dapibus sed, urna.</p>
    </article>
    <article id="tab3">
      <p>Morbi interdum mollis sapien. Sed ac risus. Phasellus lacinia, magna a ullamcorper laoreet, lectus arcu pulvinar risus, vitae facilisis libero dolor a purus. Sed vel lacus. Mauris nibh felis, adipiscing varius, adipiscing in, lacinia vel, tellus. Suspendisse ac urna. Etiam pellentesque mauris ut lectus. Nunc tellus ante, mattis eget, gravida vitae, ultricies ac, leo. Integer leo pede, ornare a, lacinia eu, vulputate vel, nisl.</p>
    </article>
  </section>
</section>

<script>
	document.addEventListener( 'DOMContentLoaded', function () {
 $(function(){
  $('ul.tabs li:first').addClass('active');
  $('.block article').hide();
  $('.block article:first').show();
  $('ul.tabs li').on('click',function(){
    $('ul.tabs li').removeClass('active');
    $(this).addClass('active')
    $('.block article').hide();
    var activeTab = $(this).find('a').attr('href');
    $(activeTab).show();
    return false;
  });
})
}, false );
</script>