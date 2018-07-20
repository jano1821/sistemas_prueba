<?php
	require_once('login/comprobarweb.php');
?>
<html>
<head>
<title> Sitema de Empleados y Nominas Online </title>
<link rel=StyleSheet href="estilos.css" TYPE="text/css">
<link rel=StyleSheet href="menu/css/nav.css" TYPE="text/css">

<script language="JavaScript">
function abrir_popup(URL){
window.open(URL,"ventana1","width=600, height=670, directories=no ,scrollbars=no, menubar=no, location=no, resizable=no")
}
</script>

</head>

<body>
<?php
	include("menu/menu.php");
	include("funciones/crear_dropdown.php");
?>
<form name='formulario' method="post" action="<?=$_SERVER['PHP_SELF']?>"> 
    
<?php
$idemplega= $_GET['idempleatu'];

include("conectarbbdd.php");

$result = mysql_query("SELECT * FROM  `empleados` WHERE  `idemp` LIKE  '$idemplega' LIMIT 0 , 30");

while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    $nombrecompleto=$row[1].' '.$row[2].' '.$row[3];
    echo('<input type="hidden" name="idemple" value="'.$idemplega.'" >');
    echo('<input type="hidden" name="estadoemp" value="'.$row[6].'" >');
}

mysql_free_result($result);
?>
<?php include("funciones/menu_empleado.php"); ?>
<div id="contenido">
<?php include("menu/botonerahist.php"); ?>
<div id="principal">
<center>
<?php
$resulta = mysql_query("SELECT * FROM  `historicocambios` WHERE  `idempleado` = '$idemplega' ");

echo ('<center><h3> Historico de Cambios del Empleado: '.$idemplega.' - '.$nombrecompleto.'</h3></center> ');

$numerofilas=mysql_num_rows($resulta);

if ($numerofilas==0){
	echo("<div id='error'><img src='imagenes/cuidado.png'>  No figura cambio registrado sobre el empleado </div>");
	}
else { //mostrar la tabla

echo ('<table border="0" cellspacing="1" cellpadding="4" width="100%" id="tablahover">');
echo('<tr>');
echo('<th>IdCambio</th>');
echo('<th> IdEmpleado </th>');
echo('<th>Usuario</th>');
echo('<th>Fecha Cambio</th>');
echo('<th>Descripcion Cambio</th>');
echo('<th>Tabla del Cambio</th>');
echo('<th> IdRegistro </th></tr>');


	 //Cargar los valores del Historico de Cambios desde la BD
	include("conectarbbdd.php");
	$resultado = mysql_query("SELECT * FROM  `historicocambios` WHERE  `idempleado` = '$idemplega' ");
		
	while ($filas = mysql_fetch_array($resultado, MYSQL_NUM)) {
    	printf("<tr><td>%s</td>", $filas[0]);
    	printf("<td>%s</td>", $filas[5]);
		printf("<td>%s</td>", $filas[1]);
		printf("<td>%s</td>", $filas[2]);
		printf("<td>%s</td>", $filas[3]);
		printf("<td>%s</td>", $filas[4]);
		printf("<td>%s</td></tr>", $filas[6]);
	}
   
echo('</table><br><br>');
}
mysql_close();


?>

<?php

if(isset($_POST["actualizar"])) 
{ 
	$idemplega=$_REQUEST['idemple'];
	echo ('<meta http-equiv="Refresh" content="0; URL=verhistemp.php?idempleatu='.$idemplega.'">');
}
?>

</center>
</div>
</div>
</div>
</body>
</html>


