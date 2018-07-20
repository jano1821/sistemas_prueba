<?php
	require_once('login/comprobarweb.php');
?>
<html>
<head>
<title>Sitema de Empleados y Nominas Online </title>
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
?>
<center>
<br>
<h2> Reportes:</h2>
<br>

<form method="post" action="<?=$_SERVER['PHP_SELF']?>"> 
<table class="tablaazul" bgcolor="white" border="1" bordercolor="#6396BB" cellpadding="4" cellspacing="0">
<tr> <th> IdReporte </th> <th>Tipo Reporte </th> <th>Nombre Reporte</th> <th> &nbsp; </th> </tr>
<tr> 
<td> 1</td>
<td> Listado </td>
<td> Mostrar Listado de Empleados que se encuentren a fecha de hoy (actual) en Vacaciones Solicitadas y Aprobadas </td>
<td> &nbsp <button type="submit" name="ejectutar" id="ejectutar"> Ejecutar Reporte </button> </td>
 </tr>
</table>
</form>
<?php
if(isset($_POST["ejectutar"])) 
{
	echo('<hr>');
	include("conectarbbdd.php");
	$hoy = date("Y-m-j");
	//$sql = ("SELECT * FROM  `solicitudes` WHERE  `FechaFin` >=  '$hoy' AND `FechaInicio` <=  '$hoy' ");
	$sql = ("SELECT * FROM  `solicitudes` WHERE '$hoy' BETWEEN `FechaInicio` AND `FechaFin` AND `Tipo` = '4' AND `Aprobado` = '1'");
	//echo($sql);
	$resultado = mysql_query ($sql);	
	echo('<br><h2> Mostrando Listado de Empleados que se encuentren a fecha de hoy (actual) en Vacaciones Solicitadas y Aprobadas </h2><br>');
	echo('<table class="tablaazul" bgcolor="white" border="1" bordercolor="#6396BB" cellpadding="4" cellspacing="0">');
		echo('<tr><th> &nbsp; </th>');
		echo('<th> IdEmpleado </th>');
		echo('<th> DNI </th>');
		echo('<th> Nombre Empleado </th>');
		echo('<th> Fecha Inicio </th>');
		echo('<th> FechaFin </th>');
		echo('<th> Fecha Aprobado </th>');
		echo('<th> Motivo </th>');
		echo('</tr>');	
	while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
		echo('<tr><td><a href="javascript:abrir_popup(\'versolicitud.php?IdSolicitud='.$fila[0].' \')">');
		printf("<img src='./imagenes/buscar2.png'></a></td>", $fila[0]);
		echo('<td>'.$fila[1].'</td>');
		$sqlemp = mysql_query ("SELECT * FROM  `empleados` WHERE  `idemp` =  '$fila[1]' ");	
		while ($filaemp = mysql_fetch_array($sqlemp, MYSQL_NUM)) {
			echo('<td>'.$filaemp[5].'</td>');
			echo('<td>'.$filaemp[2].'&nbsp;'.$filaemp[3].'&nbsp;,'.$filaemp[1].'</td>');
		}
		echo('<td>'.$fila[3].'</td>');
		echo('<td>'.$fila[4].'</td>');
		echo('<td>'.$fila[7].'</td>');
		echo('<td>'.$fila[5].'</td>');
		echo('</tr>');
	}
	echo('</table>');
}

?>
</center>
</body>
</html>