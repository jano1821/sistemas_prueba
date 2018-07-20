<?php
	require_once('login/comprobarweb.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title> Sitema de Empleados y Nominas Online </title>
<link rel=StyleSheet href="estilos.css" TYPE="text/css">
<link rel=StyleSheet href="menu/css/nav.css" TYPE="text/css">
</head>

<body>
<?php
	include("menu/menu.php");
	include("funciones/crear_dropdown.php");
?>
 <center>
 
 <h2><img src="./imagenes/buscar.png">   Buscar Empleados: </h2> <br>
 <form method="post" action="<?php echo $PHP_SELF;?>">
 <table>
<tr>
<td>
<label>DNI: </label>
</td><td>
 <input type="text" name="dni" value="<?php echo $_POST['dni']?>" >
 </td>
<td>
 <label>IDEmpleado: </label>
</td><td>
 <input type="text" name="idempleado" value="<?php echo $_POST['idempleado']?>">
</td>
<?php
//crear array
$options = array();
include("conectarbbdd.php");
$result = mysql_query("SELECT * FROM  `t_estadosemp`");
$options[] = '&nbsp';
//opciones que tendra el dropdown
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    $options[] = $row[1];
}
echo('<td><label> Estado del Empleado </label> </td> <td>');
    //nombre del dropdown
    $name = 'state';

	 //opcion seleccionada en el dropdown
	$selected = $_POST['state'];
	 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
	 echo crear_dropdown( $name, $options, $selected );
	 echo('</td></tr>');
	 	 
?>
 <tr>
 <td>
 <label>Primer Apellido:</label>
 </td>
 <td>
 <input type="text" name="apellido1" value="<?php echo $_POST['apellido1']?>">
 </td>
 <td>
<label>Segundo Apellido:</label> 
 </td>
 <td>
 <input type="text" name="apellido2" value="<?php echo $_POST['apellido2']?>">
 </td>
 <td>
 <label>Nombre:</label>
 </td>
 <td>
 <input type="text" name="nombre" value="<?php echo $_POST['nombre']?>">
 </td>
 </tr>
 <td>
  <label>Telefono:</label>
 </td>
 <td>
  <input type="text" name="telefono" value="<?php echo $_POST['telefono']?>">
 </td>
</td>
<td><label> Email </label> </td> 
<td>
  <input type="text" name="email" value="<?php echo $_POST['email']?>">
 </td>
 <?php
	  //Provicias: recogiendo valores de la tabla t_provincias
	  //crear array
		$optionsprov = array();
		include("conectarbbdd.php");
		$optionsprov[] = '&nbsp';
		$resulprov = mysql_query("SELECT * FROM  `t_provincias`");
		while ($filaprov = mysql_fetch_array($resulprov, MYSQL_NUM)) {
    		$optionsprov[] = $filaprov[1];
		}
     printf("<td><label> Provincia:</label> </td> <td>");
    //nombre del dropdown
    $name = 'provincia';
    //opciones que tendra el dropdown
	 //opcion seleccionada en el dropdown
	 $selected = $_POST['provincia'];
	 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
	 echo crear_dropdown( $name, $optionsprov, $selected );
	 printf("</td></tr>");
    //Fin provincias
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
$dni=$_REQUEST['dni'];
$idempleado=$_REQUEST['idempleado'];
$apellido1=$_REQUEST['apellido1'];
$apellido2=$_REQUEST['apellido2'];
$nombre=$_REQUEST['nombre'];
$telefono=$_REQUEST['telefono'];
$state=$_REQUEST['state'];
$email=$_REQUEST['email'];
$provincia=$_REQUEST['provincia'];
//SABER QUE VARIABLES ESTAN VACIAS
$total=0; //contador para poner el and en el select
echo('<form action="exportar/export_busce.php" name="fexportar" method="POST">');
if (!empty($dni)) {
	echo('<input type="hidden" name="e_dni" value="'.$dni.'">');
    $sqldni=" `dni` LIKE  '%$dni%' ";
    $total=1;
}
if (!empty($idempleado)) {
	echo('<input type="hidden" name="e_idempleado" value="'.$idempleado.'">');
		if ($total==0){
		 $sqlidemp=" `idemp` LIKE  '$idempleado' "; $total=1;}
    else {
    	 $sqlidemp=" AND `idemp` LIKE  '$idempleado'";}
}
if (!empty($apellido1)) {
	echo('<input type="hidden" name="e_apellido1" value="'.$apellido1.'">');
	if ($total==0){
    $sqlape1="`apellidouno` LIKE  '%$apellido1%' "; $total=1;}
     else {
     	$sqlape1="AND `apellidouno` LIKE  '%$apellido1%' ";}
}
if (!empty($apellido2)) {
	echo('<input type="hidden" name="e_apellido2" value="'.$apellido2.'">');
	if ($total==0){
    $sqlape2=" `apellidodos` LIKE  '%$apellido2%' "; $total=1;}
     else {
     	$sqlape2="AND `apellidodos` LIKE  '%$apellido2%' ";}
}
if (!empty($nombre)) {
	echo('<input type="hidden" name="e_nombre" value="'.$nombre.'">');
	if ($total==0){
    $sqlnom="`nombre` LIKE  '%$nombre%'"; $total=1;}
     else {
     	 $sqlnom=" AND `nombre` LIKE  '%$nombre%'";}
}
if (!empty($state)) {
	echo('<input type="hidden" name="e_state" value="'.$state.'">');
	$state=$state-1;
	if ($total==0){
    $sqlstate="`estado` LIKE  '$state'"; $total=1;}
     else {
     	 $sqlstate=" AND `estado` LIKE  '$state'";}
}
if (!empty($provincia)) {
	echo('<input type="hidden" name="e_state" value="'.$provincia.'">');
	$provincia=$provincia-1;
	if ($total==0){
    $sqlprovincia="`provincia` LIKE  '$provincia'"; $total=1;}
     else {
     	 $sqlprovincia=" AND `provincia` LIKE  '$provincia'";}
}

if (!empty($email)) {
	echo('<input type="hidden" name="e_email" value="'.$email.'">');
	if ($total==0){
    $sqlemail="`email` LIKE  '%$email%'"; $total=1;}
     else {
     	 $sqlemail=" AND `email` LIKE  '%$email%'";}
}
if (!empty($telefono)) {
	echo('<input type="hidden" name="e_telefono" value="'.$telefono.'">');
	if ($total==0){
    $sqtelf="`telfcont` LIKE  '%$telefono%'"; $total=1;}
     else {
     	$sqtelf="AND `telfcont` LIKE  '%$telefono%'";}
}
$resultquery = "SELECT * FROM  `empleados` WHERE  $sqldni $sqlidemp  $sqlape1  $sqlape2 $sqlstate $sqlemail  $sqlprovincia $sqlnom  $sqtelf";
//echo ($resultquery); 
//LISTADO DE LOS RESULTADOS
if ($total==0){
	echo ("<label id='error'> <img src='imagenes/cuidado.png'> No has introducido ningun criterio para la busqueda </label>");
}
else
{
	echo ("<hr><br> LISTADO DE LOS RESULTADOS DE LA BUSQUEDA");
	echo ('<br><table border="0" cellspacing="1" cellpadding="4" width="100%" id="tablahover">');
	echo("<tr><th></th><th>IDEmpleado</th>");
	echo("<th>DNI</th>");
	echo("<th>Nombre</th>");
	echo("<th>1er Apellido</th>");
	echo("<th>2ndo Apellido</th>");
	echo("<th>Telefono</th>");
	echo("<th>Provincia</th>");
	echo("<th>Email</th>");
	echo("<th>Estado</th></tr>");
	include("conectarbbdd.php");
	$result=mysql_query($resultquery);
	//Cargar Opciones de la tabla t_estadosemp
		$opciones = array();
		include("conectarbbdd.php");
		$resultado = mysql_query("SELECT * FROM  `t_estadosemp`");
		while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
    		$opciones[] = $fila[1];
		}	
	//Fin Carga Estados
	
	  //Provicias: recogiendo valores de la tabla t_provincias
	  //crear array
		$optionsprov = array();
		include("conectarbbdd.php");
		$resulprov = mysql_query("SELECT * FROM  `t_provincias`");
		while ($filaprov = mysql_fetch_array($resulprov, MYSQL_NUM)) {
    		$optionsprov[] = $filaprov[1];
		}
		//fin carga de provincias
		
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		printf ("<tr><td><a href='verempleado.php?idempleatu=%s' target='empleado'><img src='./imagenes/buscar2.png'></a></td>", $row[0]);
		printf("<td>%s</td>", $row[0]);
		printf("<td>%s</td> ", $row[5]);
		printf("<td>%s</td>", $row[1]);
		printf("<td>%s</td>", $row[2]);
		printf("<td>%s</td>", $row[3]);
		printf("<td>%s</td>", $row[10]);
		printf("<td>%s</td>", $optionsprov[$row[17]]);
		printf("<td>%s</td>", $row[4]);
		printf("<td>%s</td></tr>", $opciones[$row[6]]);
	}
	echo("</table>");
	mysql_close();
	echo('<br><INPUT type="submit" name="botonexportar" value="Exportar En Excel"></form> ');
}

}

if(isset($_POST["botonlimpiar"])) 
{ 
	echo ('<meta http-equiv="Refresh" content="0; URL=buscaremp.php">');
}
?>
</form>

 </center>
</body>
</html>
