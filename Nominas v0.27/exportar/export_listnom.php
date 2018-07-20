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
$anio=$_REQUEST['anio'];
$hilabetea=$_REQUEST['mes'];
include("../conectarbbdd.php");

$result = mysql_query("SELECT * FROM  `nominas` WHERE  `mes` LIKE  '%$hilabetea%' AND  `urtea` LIKE  '$anio' LIMIT 0 , 999");


echo('<table class="tablaazul" bgcolor="white" border="3" bordercolor="ivory" cellpadding="4" cellspacing="0">');
echo ('<tr> <th>Listado de los Nominas: </th> <td> '.$hilabetea.' '.$anio.'</td> </tr>');
echo ('</table><br>');
echo('<table id="listadoemp"> <tr>');
echo('<td> IdNomina </td>');
echo('<td> IdEmpleado </td>');
echo('<td> H.Contrato </td>');
echo('<td> H.Extra </td>');
echo('<td> H.Dietas </td>');
echo('<td> H.Festivo </td>');
echo('<td> H.Nocturna </td>');
echo('<td> Total </td>');
echo('</tr>');


while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	
    printf("<td> %s </td>", $row[0]);
    printf("<td> %s </td>", $row[1]);
     printf("<td> %s </td>", $row[4]);
     printf("<td> %s </td>", $row[6]);
     printf("<td> %s </td>", $row[8]);
     printf("<td> %s </td>", $row[11]);
      printf("<td> %s </td>", $row[13]);
     printf("<td> %s </td> </tr>", $row[17]);
}

mysql_close($result);
 
?>
</table>
</form> 
</center>
</body>
</html>


