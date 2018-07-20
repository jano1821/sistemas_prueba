<?php 
	$fecha_actual = date("Y-m-d H:i:s");
	$result = mysql_query("INSERT INTO `historicocambios` (`idhistcambio` , `usuariocambio` , 
	`fechahora` , `desccambio` , `tabla` , `idempleado` , `idregistro` ) VALUES (NULL , 
	 '$usuario',  '$fecha_actual',  '$desccambio',  '$tabla',  '$idemplhist',  '$idregistro'); ");
 	mysql_close();
?>