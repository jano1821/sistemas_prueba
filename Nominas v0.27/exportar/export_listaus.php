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
$resulta = mysql_query("SELECT * FROM  `ausencias` WHERE  `idempleado` LIKE  '$idemplega' LIMIT 0 , 999");

echo ('<center><h3>Listado de Ausencias de: '.$idemplega.' - '.$nombrecompleto.'</h3></center> ');

echo('<table><tr>');
echo("<th> Tipo Ausencia </th>");
echo("<th> Fecha Inicio </th>");
echo("<th> Fecha Fin </th>");
echo("<th> Horas Ausencia </th>");
echo("<th> Estado </th></tr>");

while ($row = mysql_fetch_array($resulta, MYSQL_NUM)) {
	echo('<tr>');
   //CAmbiar el numero por el tipo de Permiso, valor guardado en row[2]
    //CArgar los valores de Tipo de Permiso desde la BD
	   $options = array();
		$result = mysql_query("SELECT * FROM  `t_tipoausencia`");
		while ($filaops = mysql_fetch_array($result, MYSQL_NUM)) {
    		$options[] = $filaops[1];
		}
   //CAmbiar el numero por el tipo de Permiso
    echo('<td> '.$options[$row[3]-1].' </td>');

    printf("<td> %s </td>", $row[5]);
     printf("<td> %s </td>", $row[6]);
     printf("<td> %s </td>", $row[7]);
     //Cambiar el numero de aprobado por si o no
     $options2 = array();
		$result2 = mysql_query("SELECT * FROM  `t_estadosaus`");
		while ($filaestado = mysql_fetch_array($result2, MYSQL_NUM)) {
    		$options2[] = $filaestado[1];
		}
 	echo('<td> '.$options2[$row[4]].' </td>');
}
echo('</table>');
mysql_close($result);
 
?>
</table>
</form> 
</center>
</body>
</html>


