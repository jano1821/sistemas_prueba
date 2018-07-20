<?php
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=ExportarExcel.xls");
?>
<html>
<head>
<title> Exportar: Busqueda de Contratos de Empleados </title>
</head>

<body>

<?php
//RECOGER DATOS DE LAS VARIABLES
$idempleado=$_POST['e_idempleado'];
$tipocontrato=$_POST['e_tipocontrato'];
$fechainicio=$_POST['e_fechainicio'];
$fechafin=$_POST['e_fechafin'];
$estadoscont=$_POST['e_estadoscont'];

//SABER QUE VARIABLES ESTAN VACIAS
$total=0; //contador para poner el and en el select
if (!empty($idempleado)) {
    $sqlidemp=" `idempleado` LIKE  '$idempleado' ";
    $total=1;
}

if (!empty($tipocontrato)) {
	$tipocontrato=$tipocontrato-1;
	if ($total==0){
    $sqltipo="`tipocontrato` =  '$tipocontrato'"; $total=1;}
     else {
     	 $sqltipo=" AND `tipocontrato` =  '$tipocontrato'";}
}
if (!empty($fechainicio)) {
	if ($total==0){
    $sqlinicio="`fechainicio` LIKE  '$fechainicio'"; $total=1;}
     else {
     	 $sqlinicio=" AND `fechainicio` LIKE  '$fechainicio'";}
}
if (!empty($fechafin)) {
	if ($total==0){
    $sqlfin="`fechafin` LIKE  '$fechafin'"; $total=1;}
     else {
     	 $sqlfin=" AND `fechafin` LIKE  '$fechafin'";}
}
if (!empty($estadoscont)) {
	$estadoscont=$estadoscont-1;
	if ($total==0){
    $sqlestado="`estado` =  '$estadoscont'"; $total=1;}
     else {
     	$sqlestado="AND `estado` =  '$estadoscont'";}
}
$resultquery = "SELECT * FROM  `contratos` WHERE $sqlidemp $sqltipo $sqlinicio $sqlfin $sqlestado";
//echo ($resultquery);
//LISTADO DE LOS RESULTADOS
	if ($total==0){
	echo ("<center><label id='error'> <img src='imagenes/cuidado.png'> No has introducido ningun criterio para la busqueda </label></center>");
	}
	else
	{
		echo ("<hr><center><br> LISTADO DE LOS RESULTADOS DE LA BUSQUEDA <br> <br>");
		echo("<table id='listadoemp'><tr>");
		echo("<th> IdEmpleado </th>");
		echo("<th> Tipo Contrato </th>");
		echo("<th> Fecha Inicio </th>");
		echo("<th> Fecha Fin </th>");
		echo("<th> Estado Contrato </th></tr>");
		include("../conectarbbdd.php");
		$result=mysql_query($resultquery);
			//cargar listado de tipo Contratos
		$opciones = array();
		include("conectarbbdd.php");
		$resultado = mysql_query("SELECT * FROM  `t_tipocontrato`");
		while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
    		$opciones[] = $fila[1];
		}

	//cargar listado de estado Contratos
	$opestado = array();
	include("conectarbbdd.php");
	$resultado2 = mysql_query("SELECT * FROM  `t_estadoscont`");
	while ($fila2 = mysql_fetch_array($resultado2, MYSQL_NUM)) {
    	$opestado[] = $fila2[1];
	}

		while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
			printf ("<tr>");
			printf("<td>  %s </td>", $row[1]);
			printf("<td>  %s </td> ", $opciones[$row[2]]);
			printf("<td>  %s </td>", $row[4]);
			printf("<td>  %s </td>", $row[5]);
			printf("<td>  %s </td></tr>", $opestado[$row[7]]);
		}
		echo("</table></center>");
		mysql_close();
	}
?>
</table>
</form> 
</center>
</body>
</html>


