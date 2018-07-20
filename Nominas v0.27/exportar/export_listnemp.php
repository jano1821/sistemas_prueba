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

$resulta = mysql_query("SELECT * FROM  `nominas` WHERE  `idemp` LIKE  '$idemplega' LIMIT 0 , 999");

echo ('<table> <tr> <td> Listado de Nominas de: '.$idemplega.' - '.$nombrecompleto.'</td> </tr> <tr> </tr>');

$numerofilas=mysql_num_rows($resulta);

echo('<tr>');
echo('<td>IdNomina</td>');
echo("<th> Mes </th>");
echo("<th> A&ntilde;o </th>");
echo("<th> Fecha Pago </th>");
echo("<th> Estado Nomina </th>");
echo("<th> Tipo Nomina </th>");
echo("<th> H.Contrato </th>");
echo("<th> Total </th></tr>");

	//CARGAR LOS ESTADOS DE LAS NOMINAS
		$arrayestados = array();
		$resulestados = mysql_query("SELECT * FROM  `t_estadosnom`");
		while ($filaemp = mysql_fetch_array($resulestados, MYSQL_NUM)) {
		 		$arrayestados[] = $filaemp[1];
		}
		//CARGAR LOS TIPOS DE LAS NOMINAS
		$arraytipos = array();
		$resultipos = mysql_query("SELECT * FROM  `t_tiponom`");
		while ($filatipos = mysql_fetch_array($resultipos, MYSQL_NUM)) {
	    		$arraytipos[] = $filatipos[1];
		}
		
while ($row = mysql_fetch_array($resulta, MYSQL_NUM)) {
			printf ("<tr>");
			printf("<td>  %s </td>", $row[0]);
			printf("<td>  %s </td> ", $row[2]);
			printf("<td>  %s </td>", $row[3]);
			printf("<td>  %s </td>", $row[6]);
			printf("<td>  %s </td>", $arrayestados[$row[7]]);
			printf("<td>  %s </td>", $arraytipos[$row[8]]);
			//buscar si tiene horas de contrato
			$sqlnomconp = "SELECT * FROM  `conceptosnom` WHERE  `IdNomina` = '$row[0]' AND  `IdConcepto` = 1 ";
			$resulsql=mysql_query($sqlnomconp);
			$existefilanom=0;
			while ($filanom = mysql_fetch_array($resulsql, MYSQL_NUM)) {
					printf("<td>  %s </td>", $filanom[3]);
					$existefilanom=1;
			}
			if ($existefilanom == '0'){
				printf("<td>  0 </td>");
			}
			printf("<td> %s </td></tr>", $row[4]);
}
echo('</table>');

mysql_close();
 
?>
</table>
</form> 
</center>
</body>
</html>