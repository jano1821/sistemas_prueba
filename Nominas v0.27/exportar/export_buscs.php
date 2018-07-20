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
$idempleado=$_POST['e_idempleado'];
$idsolicitud=$_POST['e_idsolicitud'];
$tipopermiso=$_POST['e_tipopermiso'];
$fechainicio=$_POST['e_fechainicio'];
$fechafin=$_POST['e_fechafin'];
$aprobado=$_POST['e_aprobado'];
//SABER QUE VARIABLES ESTAN VACIAS
$total=0; //contador para poner el and en el select
if (!empty($idempleado)) {
    $sqlidemp=" `IdEmp` LIKE  '$idempleado' ";
    $total=1;
}
if (!empty($idsolicitud)) {
		if ($total==0){
		 $sqlidsol=" `IdSolicitud` LIKE  '$idsolicitud' "; $total=1;}
    else {
    	 $sqlidsol=" AND `IdSolicitud` LIKE  '$idsolicitud'";}
}

if (!empty($tipopermiso)) {
	if ($total==0){
    $sqltipo="`Tipo` LIKE  '$tipopermiso'"; $total=1;}
     else {
     	 $sqltipo=" AND `Tipo` LIKE  '$tipopermiso'";}
}
if (!empty($fechainicio)) {
	if ($total==0){
    $sqlinicio="`FechaInicio` LIKE  '$fechainicio'"; $total=1;}
     else {
     	 $sqlinicio=" AND `FechaInicio` LIKE  '$fechainicio'";}
}
if (!empty($fechafin)) {
	if ($total==0){
    $sqlfin="`FechaFin` LIKE  '$fechafin'"; $total=1;}
     else {
     	 $sqlfin=" AND `FechaFin` LIKE  '$fechafin'";}
}
if (!empty($aprobado)) {
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
	echo ("<br> LISTADO DE LOS RESULTADOS DE LA BUSQUEDA");
	echo("<table id='listadoemp'><tr><th> IDSolicitud </th>");
	echo("<th> IdEmpleado  </th>");
	echo("<th> Tipo Permiso </th>");
	echo("<th> Fecha Inicio </th>");
	echo("<th> Fecha Fin </th>");
	echo("<th> Motivo </th>");
	echo("<th> Aprobado </th></tr>");
	include("../conectarbbdd.php");
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
		printf ("<tr>");
		printf("<td> %s </td>", $row[0]);
		printf("<td> %s </td> ", $row[1]);
		printf("<td> %s </td>", $opciones[$row[2]-1]);
		printf("<td> %s </td>", $row[3]);
		printf("<td> %s </td>", $row[4]);
		printf("<td> %s </td>", $row[5]);
		printf("<td> %s </td></tr>", $opsino[$row[6]]);
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


