<div id="tabs">
<br>
<h2> IdEmpleado: <?php echo($idemplega); ?> - <?php echo($nombrecompleto); ?> </h2>
  <ul>
  <?php 
  //comprobar en que pagina estoy para saber que opcion de debe estar seleccionado en el menu
  $nombrevirtual=reset(explode("?", $_SERVER['REQUEST_URI'])); 
  //echo($virtualScriptName); 
  $paginas = array();
  $paginas[0]="/nominas/verempleado.php";
  $paginas[1]="/nominas/vernominasemp.php";
  $paginas[2]="/nominas/versolicitudemp.php";
  $paginas[3]="/nominas/verausenciaemp.php";
  $paginas[4]="/nominas/vercontratoemp.php";
  $paginas[5]="/nominas/verhistemp.php";
  ?> 
			<li ><a href="<?php echo('verempleado.php?idempleatu='.$idemplega); ?>" title="Informacion" >
			<span <?php	if($nombrevirtual==$paginas[0]) { echo(' class="selected" '); }  ?> >Informacion</span></a>
			</li>
			<li><a href="<?php echo('vernominasemp.php?idempleatu='.$idemplega); ?>" title="Nominas">
			<span <?php	if($nombrevirtual==$paginas[1]) { echo(' class="selected" '); }  ?> >Nominas</span></a>
			</li>
			<li><a href="<?php echo('versolicitudemp.php?idempleatu='.$idemplega); ?>"title="Solicitudes">
			<span  <?php	if($nombrevirtual==$paginas[2]) { echo(' class="selected" '); }  ?> >Solicitudes</span></a>
			</li>
			<li> <a href="<?php echo('verausenciaemp.php?idempleatu='.$idemplega); ?>"title="Ausencias">
			<span  <?php	if($nombrevirtual==$paginas[3]) { echo(' class="selected" '); }  ?> >Ausencias</span></a>
			</li>
			<li> <a href="<?php echo('vercontratoemp.php?idempleatu='.$idemplega); ?>"title="Contratos">
			<span  <?php	if($nombrevirtual==$paginas[4]) { echo(' class="selected" '); }  ?>  >Contratos</span></a></li>
  			</li>
  			
  			
			<?php
			if ($_SESSION['EMPTABHIST'] == '1'){
				echo('<li> <a href="verhistemp.php?idempleatu='.$idemplega.'" title="Historico Cambios">');
				echo('<span');
				if($nombrevirtual==$paginas[5]) { 
					echo(' class="selected" '); 
				}   
				echo('>Historico Cambios</span></a></li>');
			}
			?> 
			
  </ul>
</div>
<br><br><br>