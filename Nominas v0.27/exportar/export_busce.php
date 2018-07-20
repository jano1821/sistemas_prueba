<?php
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=ExportarExcel.xls");
?>
<html>
<head>
<title> Sitema de Empleados y Nominas Online </title>
</head>

<body>

<?php
//RECOGER DATOS DE LAS VARIABLES
$dni=$_POST['e_dni'];
$idempleado=$_POST['e_idempleado'];
$apellido1=$_POST['e_apellido1'];
$apellido2=$_POST['e_apellido2'];
$nombre=$_POST['e_nombre'];
$telefono=$_POST['e_telefono'];
$state=$_POST['e_state'];
$email=$_POST['e_email'];
//SABER QUE VARIABLES ESTAN VACIAS
$total=0; //contador para poner el and en el select
if (!empty($dni)) {
    $sqldni=" `dni` LIKE  '%$dni%' ";
    $total=1;
}
if (!empty($idempleado)) {
		if ($total==0){
		 $sqlidemp=" `idemp` LIKE  '$idempleado' "; $total=1;}
    else {
    	 $sqlidemp=" AND `idemp` LIKE  '$idempleado'";}
}
if (!empty($apellido1)) {
	if ($total==0){
    $sqlape1="`apellidouno` LIKE  '%$apellido1%' "; $total=1;}
     else {
     	$sqlape1="AND `apellidouno` LIKE  '%$apellido1%' ";}
}
if (!empty($apellido2)) {
	if ($total==0){
    $sqlape2=" `apellidodos` LIKE  '%$apellido2%' "; $total=1;}
     else {
     	$sqlape2="AND `apellidodos` LIKE  '%$apellido2%' ";}
}
if (!empty($nombre)) {
	if ($total==0){
    $sqlnom="`nombre` LIKE  '%$nombre%'"; $total=1;}
     else {
     	 $sqlnom=" AND `nombre` LIKE  '%$nombre%'";}
}
if (!empty($state)) {
	$state=$state-1;
	if ($total==0){
    $sqlstate="`estado` LIKE  '$state'"; $total=1;}
     else {
     	 $sqlstate=" AND `estado` LIKE  '$state'";}
}
if (!empty($email)) {
	if ($total==0){
    $sqlemail="`email` LIKE  '%$email%'"; $total=1;}
     else {
     	 $sqlemail=" AND `email` LIKE  '%$email%'";}
}
if (!empty($telefono)) {
	if ($total==0){
    $sqtelf="`telfcont` LIKE  '%$telefono%'"; $total=1;}
     else {
     	$sqtelf="AND `telfcont` LIKE  '%$telefono%'";}
}
$resultquery = "SELECT * FROM  `empleados` WHERE  $sqldni $sqlidemp  $sqlape1  $sqlape2 $sqlstate $sqlemail $sqlnom  $sqtelf";
//echo ($resultquery); 
//LISTADO DE LOS RESULTADOS
if ($total==0){
	echo ("<label id='error'> <img src='imagenes/cuidado.png'> No has introducido ningun criterio para la busqueda </label>");
}
else
{
	echo ("<hr><br> LISTADO DE LOS RESULTADOS DE LA BUSQUEDA");
	echo("<table id='listadoemp'><tr><th> IDEmpleado </th>");
	echo("<th> DNI </th>");
	echo("<th> Nombre </th>");
	echo("<th> 1er Apellido </th>");
	echo("<th> 2ndo Apellido </th>");
	echo("<th> Telefono </th>");
	echo("<th> Email </th>");
	echo("<th> Estado </th></tr>");
	include("../conectarbbdd.php");
	$result=mysql_query($resultquery);
	//Cargar Opciones de la tabla t_estadosemp
		$opciones = array();
		include("conectarbbdd.php");
		$resultado = mysql_query("SELECT * FROM  `t_estadosemp`");
		while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
    		$opciones[] = $fila[1];
		}
	//Fin Carga Estados
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		printf ("<tr>");
		printf("<td>  %s </td>", $row[0]);
		printf("<td>  %s </td> ", $row[5]);
		printf("<td>  %s </td>", $row[1]);
		printf("<td>  %s </td>", $row[2]);
		printf("<td>  %s </td>", $row[3]);
		printf("<td>  %s </td>", $row[10]);
		printf("<td>  %s </td>", $row[4]);
		printf("<td>  %s </td></tr>", $opciones[$row[6]]);
	}
	echo("</table>");
	mysql_close();
}
?>
</table>
</form> 
</center>
</body>
</html>


