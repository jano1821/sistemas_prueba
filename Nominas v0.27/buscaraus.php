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
 
 <h2><img src="./imagenes/buscar.png">   Buscar Ausencias: </h2> <br>
 <form method="post" action="<?php echo $PHP_SELF;?>">
 <table>
<tr>
<td>
 <label>IDEmpleado: </label>
</td><td>
 <input type="text" name="idempleado" value="<?php echo $_POST['idempleado']?>">
</td>
<td>
 <label>Horas Ausencia:</label>
 </td><td>
 <input type="text" name="horasausencia" value="<?php echo $_POST['horasausencia']?>">
 </td>
<?php
//crear array
$options = array();
include("conectarbbdd.php");
$result = mysql_query("SELECT * FROM  `t_tipoausencia`");
$options[] = '&nbsp';
//opciones que tendra el dropdown
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    $options[] = $row[1];
}
printf("<td><label> Tipo de Ausencia </label> </td> <td>");
//nombre del dropdown
$name = 'tipoausencia';
//opcion seleccionada en el dropdown
$selected = $_POST['tipoausencia'];
//crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
echo crear_dropdown($name, $options, $selected );
	 printf("</td></tr>");
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
//crear array
$options2 = array();
include("conectarbbdd.php");
$resultado2 = mysql_query("SELECT * FROM  `t_estadosaus`");
$options2[] = '&nbsp';
//opciones que tendra el dropdown
while ($fila2 = mysql_fetch_array($resultado2, MYSQL_NUM)) {
    $options2[] = $fila2[1];
}

printf("<td><label> Estado </label> </td> <td>");
//nombre del dropdown
$name2 = 'estado';
//opciones que tendra el dropdown
//opcion seleccionada en el dropdown
$selected2 = $_POST['estado'];
//crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
echo crear_dropdown( $name2, $options2, $selected2 );
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
$horasausencia=$_REQUEST['horasausencia'];
$tipoausencia=$_REQUEST['tipoausencia'];
$fechainicio=$_REQUEST['fechainicio'];
$fechafin=$_REQUEST['fechafin'];
$estado=$_REQUEST['estado'];
//SABER QUE VARIABLES ESTAN VACIAS
$total=0; //contador para poner el and en el select
echo('<form action="exportar/export_busca.php" name="fexportar" method="POST">');
if (!empty($idempleado)) {
	echo('<input type="hidden" name="e_idempleado" value="'.$idempleado.'">');
    $sqlidemp=" `idempleado` LIKE  '$idempleado' ";
    $total=1;
}
if (!empty($horasausencia)) {
	echo('<input type="hidden" name="e_horasausencia" value="'.$horasausencia.'">');
		if ($total==0){
		 $sqlhoras=" `horas` =  '$horasausencia' "; $total=1;}
    else {
    	 $sqlhoras=" AND `horas` =  '$horasausencia'";}
}

if (!empty($tipoausencia)) {
	echo('<input type="hidden" name="e_tipoausencia" value="'.$tipoausencia.'">');
	$tipoausencia=$tipoausencia;
	if ($total==0){
    $sqltipo="`tipoausencia` =  '$tipoausencia'"; $total=1;}
     else {
     	 $sqltipo=" AND `tipoausencia` =  '$tipoausencia'";}
}
if (!empty($fechainicio)) {
	echo('<input type="hidden" name="e_fechainicio" value="'.$fechainicio.'">');
	if ($total==0){
    $sqlinicio="`fechainicio` LIKE  '$fechainicio'"; $total=1;}
     else {
     	 $sqlinicio=" AND `fechainicio` LIKE  '$fechainicio'";}
}
if (!empty($fechafin)) {
	echo('<input type="hidden" name="e_fechafin" value="'.$fechafin.'">');
	if ($total==0){
    $sqlfin="`fechafin` LIKE  '$fechafin'"; $total=1;}
     else {
     	 $sqlfin=" AND `fechafin` LIKE  '$fechafin'";}
}

if (!empty($estado)) {
	echo('<input type="hidden" name="e_estado" value="'.$estado.'">');
	$estado=$estado-1;
	if ($total==0){
    $sqlestado="`estado` =  '$estado'"; $total=1;}
     else {
     	 $sqlestado=" AND `estado` =  '$estado'";}
}

$resultquery = "SELECT * FROM  `ausencias` WHERE $sqlidemp $sqlhoras $sqltipo $sqlinicio $sqlfin $sqlestado";
//echo ($resultquery); 
//LISTADO DE LOS RESULTADOS
if ($total==0){
	echo ("<label id='error'> <img src='imagenes/cuidado.png'> No has introducido ningun criterio para la busqueda </label>");
}
else
{
	echo ("<hr><br> LISTADO DE LOS RESULTADOS DE LA BUSQUEDA");
	echo ('<br><br><table border="0" cellspacing="1" cellpadding="4" width="100%" id="tablahover">');
	echo("<tr><th></th>");
	echo("<th>IdEmpleado</th>");
	echo("<th>Tipo Ausencia</th>");
	echo("<th>Fecha Inicio</th>");
	echo("<th>Fecha Fin</th>");
	echo("<th>Horas Ausencia</th>");
	echo("<th>Estado</th></tr>");
	include("conectarbbdd.php");
	$result=mysql_query($resultquery);
	//cargar listado de tipo ausencias
	$opciones = array();
	include("conectarbbdd.php");
	$resultado = mysql_query("SELECT * FROM  `t_tipoausencia`");
	while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
    	$opciones[] = $fila[1];
	}
	//cargar listado de estado ausencias
	$opestado = array();
	include("conectarbbdd.php");
	$resultado3 = mysql_query("SELECT * FROM  `t_estadosaus`");
	while ($fila3 = mysql_fetch_array($resultado3, MYSQL_NUM)) {
    	$opestado[] = $fila3[1];
	}

	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		printf ("<tr><td>");
		echo('<a href="javascript:abrir_popup(\'verausencia.php?IdAusencia='.$row[0].' \')">');
		printf("<img src='./imagenes/buscar2.png'></a></td>", $row[0]);
		printf("<td>%s</td> ", $row[1]);
		printf("<td>%s</td>", $opciones[$row[3]-1]);
		printf("<td>%s</td>", $row[5]);
		printf("<td>%s</td>", $row[6]);
		printf("<td>%s</td>", $row[7]);
		printf("<td>%s</td></tr>", $opestado[$row[4]]);
	}
	echo("</table>");
	mysql_close();
	echo('<INPUT type="submit" name="botonexportar" value="Exportar En Excel"></form> ');
}

}

if(isset($_POST["botonlimpiar"])) 
{ 
	echo ('<meta http-equiv="Refresh" content="0; URL=buscaraus.php">');
}

?>
</form>

 </center>
</body>
</html>
