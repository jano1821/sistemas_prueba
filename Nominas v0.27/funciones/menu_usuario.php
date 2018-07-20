<div id="tabs">
<br>
<h2> Login del Usuario: <?php echo($username); ?> </h2>
  <ul>
  <?php 
  //comprobar en que pagina estoy para saber que opcion de debe estar seleccionado en el menu
  $nombrevirtual=reset(explode("?", $_SERVER['REQUEST_URI'])); 
  //echo($virtualScriptName); 
  $paginas = array();
  $paginas[0]="./verdetalleuser.php";
  ?> 
			<li ><a href="<?php echo('verdetalleuser.php?username='.$username); ?>" title="Info Usuario" >
			<span class="selected">Info Usuario</span></a>
			</li>
  </ul>
</div>
<br><br><br>