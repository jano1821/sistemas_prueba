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
$estado=$_REQUEST['estado'];
include("../conectarbbdd.php");

$result = mysql_query("SELECT * FROM `empleados` WHERE `estado` = '$estado' LIMIT 0, 30 ");

//Cambiar el numero del estado por el valor correspondiente
$opciones = array( 'ACTIVO', 'INACTIVO', 'PRACTICAS', 'MATERNIDAD', 'PERMISO', 'OTRO', 'BAJA' );
$estado2 = $opciones[$estado];

echo('<table class="tablaazul" bgcolor="white" border="3" bordercolor="ivory" cellpadding="4" cellspacing="0">');
echo(' <tr> <th>Listado de los Empleados en: </th> <td> '.$estado2.' </hd> </tr>');
echo('</table>');
echo ('<table id="listadoemp"> <tr>');
echo ('<td>IdEmpleado</td>');
echo ('<td>Nombre </td>');
echo ('<td>Apellidos </td>');
echo ('<td>Email </td>');
echo ('<td>DNI </td> ');
echo ('</tr><br>');

while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    printf("<tr> <td> %s </td>", $row[0]);
    printf("<td> %s </td>", $row[1]);
     printf("<td> %s  %s </td>", $row[2], $row[3]);
     printf("<td> %s </td>", $row[4]);
    printf("<td> %s </td> </tr>", $row[5]);
}
mysql_close();
echo('</table><br>');
 
?>
</table>
</form> 
</center>
</body>
</html>


