<div id="tabs">
<br>
<h2> IdNomina: <?php echo($idnom); ?> </h2>
  <ul>
   <?php 
  //comprobar en que pagina estoy para saber que opcion de debe estar seleccionado en el menu
  $nombrevirtual=reset(explode("?", $_SERVER['REQUEST_URI'])); 
  //echo($virtualScriptName); 
  $paginas = array();
  $paginas[0]="/nominas/lnomina1.php";
  $paginas[1]="/nominas/detallenom.php";
  ?> 
  <li ><a href="<?php echo('lnomina1.php?idnomina='.$idnom); ?>" title="Info Nomina" >
			<span   <?php	if($nombrevirtual==$paginas[0]) { echo(' class="selected" '); }  ?>  >Informacion Nomina</span></a>
	</li>
	  <li ><a href="<?php echo('detallenom.php?idnomina='.$idnom); ?>" title="Detalle Conceptos" >
			<span   <?php	if($nombrevirtual==$paginas[1]) { echo(' class="selected" '); }  ?>  >Detalle Conceptos</span></a>
	</li>
	</ul>
</div>
<br><br><br>