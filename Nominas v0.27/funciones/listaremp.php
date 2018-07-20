<?php
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	printf ("<tr><td><a href='verempleado.php?idempleatu=%s' target='empleado'><img src='./imagenes/buscar2.png'></a></td>", $row[0]);
    printf("<td><input id='person10' value='%s' size='6'/></td>", $row[0]);
    printf("<td><input id='person11' value='%s' size='15'/></td> ", $row[1]);
     printf("<td><input id='person12' value='%s' size='15'/></td>", $row[2]);
    printf("<td><input id='person13' value='%s' size='15'/></td>", $row[3]);
     printf("<td><input id='person14' value='%s' size='25'/></td>", $row[4]);
    printf("<td><input id='person15' value='%s' size='10'/></td>", $row[5]);
    //Cambiar el numero del estado por el valor correspondiente
    $opciones = array( 'Activo', 'Inactivo', 'Practicas', 'Maternidad', 'Permiso', 'Otro', 'Baja' );
	 $estado = $opciones[$row[6]];
    printf("<td><input id='person16' value='%s' size='15'/></td></tr>", $estado);
}
?>