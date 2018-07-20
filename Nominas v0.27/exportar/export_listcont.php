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

$idemplega= $_POST['idempleatu'];

include("../conectarbbdd.php");

$result = mysql_query("SELECT * FROM  `empleados` WHERE  `idemp` LIKE  '$idemplega' LIMIT 0 , 30");

while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    $nombrecompleto=$row[1].' '.$row[2].' '.$row[3];
    echo('<input type="hidden" name="idemple" value="'.$idemplega.'" >');
}

mysql_free_result($result);
?>

<?php

$resulta = mysql_query("SELECT * FROM  `contratos` WHERE  `idempleado` = '$idemplega' ");

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
 
?>
</table>
</form> 
</center>
</body>
</html>


