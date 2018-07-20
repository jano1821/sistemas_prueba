<?php
	require_once('login/comprobarweb.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
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
 <center>
 
 <h2><img src="./imagenes/buscar.png">   Buscar Solicitudes: </h2> <br>
 <form method="post" action="<?php echo $PHP_SELF;?>">
 <table>
<tr>
<td>
 <label>IDEmpleado: </label>
</td><td>
 <input type="text" name="idempleado" value="<?php echo $_POST['idempleado']?>">
</td>
<td>
 <label>IDSolicitud:</label>
 </td><td>
 <input type="text" name="idsolicitud" value="<?php echo $_POST['idsolicitud']?>">
 </td>
<?php
//crear array
$options = array();
include("conectarbbdd.php");
$result = mysql_query("SELECT * FROM  `t_tiposol`");
$options[] = '&nbsp';
//opciones que tendra el dropdown
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    $options[] = $row[1];
}
echo('<td><label> Tipo de Solicitud </label> </td> <td>');
    //nombre del dropdown
    $name = 'tipopermiso';

	 //opcion seleccionada en el dropdown
	$selected = $_POST['tipopermiso'];
	 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
	 echo crear_dropdown( $name, $options, $selected );
	 echo('</td></tr>');
	 	 
?>
<tr>
<td>
 <label>Fecha Inicio: </label>
</td><td>
 <input type="text" name="fechainicio" value="<?php echo $_POST['fechainicio']?>">
</td>
<td>
 <label>Fecha Fin: </label>
</td><td>
 <input type="text" name="fechafin" value="<?php echo $_POST['fechafin']?>">
</td>
<?php
printf("<td><label> Aprobado </label> </td> <td>");
    //nombre del dropdown
    $name = 'aprobado';
    //opciones que tendra el dropdown
	 $options = array( '', 'Si', 'No');
	 //opcion seleccionada en el dropdown
	 $selected = $_POST['aprobado'];
	 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
	 echo crear_dropdown( $name, $options, $selected );
	 printf("</td></tr>");
?>
<tr><td colspan="6" align="center">
<INPUT type="submit" name="botonbuscar" value="Buscar"> 
<INPUT type="submit" name="botonlimpiar" value="Limpiar"> 
</form> </td>
</tr>
</table>
<?php
if(isset($_POST["botonbuscar"])) 
{ 
//RECOGER DATOS DE LAS VARIABLES
$idempleado=$_REQUEST['idempleado'];
$idsolicitud=$_REQUEST['idsolicitud'];
$tipopermiso=$_REQUEST['tipopermiso'];
$fechainicio=$_REQUEST['fechainicio'];
$fechafin=$_REQUEST['fechafin'];
$aprobado=$_REQUEST['aprobado'];
//SABER QUE VARIABLES ESTAN VACIAS
$total=0; //contador para poner el and en el select
echo('<form action="exportar/export_buscs.php" name="fexportar" method="POST">');
if (!empty($idempleado)) {
	echo('<input type="hidden" name="e_idempleado" value="'.$idempleado.'">');
    $sqlidemp=" `IdEmp` LIKE  '$idempleado' ";
    $total=1;
}
if (!empty($idsolicitud)) {
	echo('<input type="hidden" name="e_idsolicitud" value="'.$idsolicitud.'">');
		if ($total==0){
		 $sqlidsol=" `IdSolicitud` LIKE  '$idsolicitud' "; $total=1;}
    else {
    	 $sqlidsol=" AND `IdSolicitud` LIKE  '$idsolicitud'";}
}

if (!empty($tipopermiso)) {
	echo('<input type="hidden" name="e_tipopermiso" value="'.$tipopermiso.'">');
	if ($total==0){
    $sqltipo="`Tipo` LIKE  '$tipopermiso'"; $total=1;}
     else {
     	 $sqltipo=" AND `Tipo` LIKE  '$tipopermiso'";}
}
if (!empty($fechainicio)) {
	echo('<input type="hidden" name="e_fechainicio" value="'.$fechainicio.'">');
	if ($total==0){
    $sqlinicio="`FechaInicio` LIKE  '$fechainicio'"; $total=1;}
     else {
     	 $sqlinicio=" AND `FechaInicio` LIKE  '$fechainicio'";}
}
if (!empty($fechafin)) {
	echo('<input type="hidden" name="e_fechafin" value="'.$fechafin.'">');
	if ($total==0){
    $sqlfin="`FechaFin` LIKE  '$fechafin'"; $total=1;}
     else {
     	 $sqlfin=" AND `FechaFin` LIKE  '$fechafin'";}
}
if (!empty($aprobado)) {
	echo('<input type="hidden" name="e_aprobado" value="'.$aprobado.'">');
	if ($total==0){
    $sqlaprobar="`Aprobado` LIKE  '$aprobado'"; $total=1;}
     else {
     	$sqlaprobar="AND `Aprobado` LIKE  '$aprobado'";}
}
$resultquery = "SELECT * FROM  `solicitudes` WHERE $sqlidemp $sqlidsol $sqltipo $sqlinicio $sqlfin $sqlaprobar";
//echo ($resultquery); 
//LISTADO DE LOS RESULTADOS
if ($total==0){
	echo ("<label id='error'> <img src='imagenes/cuidado.png'> No has introducido ningun criterio para la busqueda </label>");
}
else
{
	echo ("<hr><br> LISTADO DE LOS RESULTADOS DE LA BUSQUEDA");
	echo ('<br><br><table border="0" cellspacing="1" cellpadding="4" width="100%" id="tablahover">');
	echo("<tr><th></th><th>IDSolicitud</th>");
	echo("<th>IdEmpleado</th>");
	echo("<th>Tipo Permiso</th>");
	echo("<th>Fecha Inicio</th>");
	echo("<th>Fecha Fin</th>");
	echo("<th>Motivo</th>");
	echo("<th>Aprobado</th></tr>");
	include("conectarbbdd.php");
	$result=mysql_query($resultquery);
	//Cargar Opciones de la tabla t_estadosemp
	$opciones = array();
	include("conectarbbdd.php");
	$resultado = mysql_query("SELECT * FROM  `t_tiposol`");
	while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
    		$opciones[] = $fila[1];
	}
	//Fin Carga Estados
	$opsino = array( '', 'SI', 'NO');
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		printf ("<tr><td>");
		echo('<a href="javascript:abrir_popup(\'versolicitud.php?IdSolicitud='.$row[0].' \')">');
		printf("<img src='./imagenes/buscar2.png'></a></td>", $row[0]);
		printf("<td>%s</td>", $row[0]);
		printf("<td>%s</td> ", $row[1]);
		printf("<td>%s</td>", $opciones[$row[2]-1]);
		printf("<td>%s</td>", $row[3]);
		printf("<td>%s</td>", $row[4]);
		printf("<td>%s</td>", $row[5]);
		printf("<td>%s</td></tr>", $opsino[$row[6]]);
	}
	echo("</table>");
	mysql_close();
	echo('<INPUT type="submit" name="botonexportar" value="Exportar En Excel"></form> ');
}

}

if(isset($_POST["botonlimpiar"])) 
{ 
	echo ('<meta http-equiv="Refresh" content="0; URL=buscarsol.php">');
}

?>
</form>

 </center>
</body>
</html>
