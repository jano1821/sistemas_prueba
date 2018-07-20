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
$resulta = mysql_query("SELECT * FROM  `solicitudes` WHERE  `idemp` LIKE  '$idemplega' LIMIT 0 , 999");

echo ('<center><h3>Listado de SOLICITUDES de: '.$idemplega.' - '.$nombrecompleto.'</h3></center> ');

echo('<table><tr>');
echo('<th> Tipo de Solicitud </th>');
echo('<th> Fecha Inicio </th>');
echo('<th> Fecha Fin </th>');
echo('<th> Aprobado </th>');
echo('<th> Fecha Revisi&oacute;n </th> </tr>');

while ($row = mysql_fetch_array($resulta, MYSQL_NUM)) {
	echo('<tr>');
   //CAmbiar el numero por el tipo de Permiso, valor guardado en row[2]
    //CArgar los valores de Tipo de Permiso desde la BD
	   $options = array();
		$result = mysql_query("SELECT * FROM  `t_tiposol`");
		while ($filaops = mysql_fetch_array($result, MYSQL_NUM)) {
    		$options[] = $filaops[1];
		}
   //CAmbiar el numero por el tipo de Permiso
    echo('<td> '.$options[$row[2]-1].' </td>');

    printf("<td> %s </td>", $row[3]);
     printf("<td> %s </td>", $row[4]);
     //Cambiar el numero de aprobado por si o no
     switch ($row[6]) {
     case 1:
        printf("<td> SI </td>");
        break;
    default:
        printf("<td> NO </td>");
        break;
		}
     printf("<td> %s </td> </tr>", $row[7]);
}
echo('</table>');
mysql_close($result);
 
?>
</table>
</form> 
</center>
</body>
</html>


