<?php
	require_once('login/comprobarweb.php');
?>
<html>
<head>
<title> Seleccionar Contrato Asociado </title>
<link rel=StyleSheet href="estilos.css" TYPE="text/css">

<script> 
function retornavalores(idcontrato2, tipocontrato2, estadocont2, finicio2, ffin2, ncuenta2 ){ 
   window.opener.document.getElementById('idcontrato2').value=idcontrato2; 
   window.opener.document.getElementById('tipocontrato2').value=tipocontrato2; 
   window.opener.document.getElementById('estadocont2').value=estadocont2;
   window.opener.document.getElementById('finicio2').value=finicio2;  
   window.opener.document.getElementById('ffin2').value=ffin2; 
   window.opener.document.getElementById('ncuenta2').value=ncuenta2; 
   window.close(); 
} 
</script>  

</head>

<body>
<?php
	$idempleado= $_GET['idempleado'];
?>
<table class="tablaazul" bgcolor="white" border="3" bordercolor="#6396BB" cellpadding="4" cellspacing="0">
<tr>
<form action="">
<th>IdContrato</th>
<th>Tipo Contrato</th>
<th>Estado</th>
<th>Fecha Inicio</th>
<th>Fecha Fin</th> 
<th> &nbsp </th>
</tr>
<br>    
    
<?php

	$result=mysql_query($resultquery);
	//cargar listado de tipo contratos
	$opciones = array();
	include("conectarbbdd.php");
	$resultado = mysql_query("SELECT * FROM  `t_tipocontrato`");
	while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
    	$opciones[] = $fila[1];
	}
	//cargar listado de estado contratos
	$opestado = array();
	$resultado3 = mysql_query("SELECT * FROM  `t_estadoscont`");
	while ($fila3 = mysql_fetch_array($resultado3, MYSQL_NUM)) {
    	$opestado[] = $fila3[1];
	}

$result = mysql_query("SELECT * FROM  `contratos` WHERE `idempleado` = '$idempleado' LIMIT 0 , 90");


while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    printf("<tr> <td>%s</td>", $row[0]);
      printf("<td> %s &nbsp </td>", $opciones[$row[2]]);
     printf("<td> %s &nbsp </td>", $opestado[$row[7]]);
     printf("<td> %s &nbsp </td>", $row[4]);
    printf("<td> %s &nbsp </td>", $row[5]);
    printf("<td> <button type='submit' onclick=retornavalores('%s','%s','%s','%s','%s','%s')>
    <img src='./imagenes/seleccionar2.png' > </button> </td> </tr>", $row[0], urlencode($opciones[$row[2]]), urlencode($opestado[$row[7]]),$row[4], $row[5], $row[14]);
}

mysql_free_result($result);
?>

</table>
</form> 
</center>
</body>
</html>


