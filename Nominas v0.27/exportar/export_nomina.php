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
$idnom= $_POST['idnomina'];
include("../conectarbbdd.php");
$result = mysql_query("SELECT * FROM  `nominas` WHERE  `idnomina` LIKE  '$idnom' LIMIT 0 , 30");
echo('<br><br><table>');
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo('<tr><td><b>IdNomina:</b></td><td>'.$row[0].'</td>');
	printf("<td><b> Mes: </b></td><td> %s </td>",$row[2]);
	printf("<td><b> A&ntilde;o: </b></td><td> %s </td></tr>", $row[3]);
	printf("<tr><td><b> Fecha Pago: </b></td><td> %s </td>", $row[6]);
	printf("<td><b> Tipo Nomina: </b> </td>");
	$arraytipos = array();
	$resultipos = mysql_query("SELECT * FROM  `t_tiponom`");
	while ($filatipos = mysql_fetch_array($resultipos, MYSQL_NUM)) {
    		$arraytipos[] = $filatipos[1];
	}
	printf("<td> %s </td>", $arraytipos[$row[8]]);
	printf("<td><b> Estado Nomina: </b> </td>");	
		$arrayestados = array();
	$resulestados = mysql_query("SELECT * FROM  `t_estadosnom`");
	while ($filaemp = mysql_fetch_array($resulestados, MYSQL_NUM)) {
    		$arrayestados[] = $filaemp[1];
	}
	printf("<td> %s </td></tr>", $arrayestados[$row[7]]);
	
	
   echo('<tr><td>   &nbsp   </td></tr>');
	echo('<tr><td colspan="5"> <b>Datos del Empleado:</b> </td></tr>');
   printf("<tr><td> IdEmpleado </td> <td>  %s </td>  ", $row[1]);
  $sqlemp = mysql_query ("SELECT * FROM  `empleados` WHERE  `idemp` =  '$row[1]' ");	
		while ($filaemp = mysql_fetch_array($sqlemp, MYSQL_NUM)) {
			echo('<td><b>DNI:</b></td> <td>  '.$filaemp[5].'</td>');
			echo('<td><b>NUSS:</b></td> <td>  '.$filaemp[7].'</td>');
			echo('</tr><td><b>Nombre:</b> </td> <td>   '.$filaemp[1].'</td>');
			echo('<td><b>Apellido 1:</b> </td> <td>   '.$filaemp[2].'</td>');
			echo('<td><b>Apellido 2:</b> </td> <td>   '.$filaemp[3].'</td>');
		}
	echo('</tr>');   
	
	echo('<tr><td> <label> &nbsp </label> </td></tr>');
	echo('<tr><td colspan="5"> <b>Datos del Contrato:</b> </td></tr>');
   printf("<tr><td><label > IdContrato</label></td> <td> %s </td>  ", $row[5]);
  	$sqlcont = mysql_query ("SELECT * FROM  `contratos` WHERE  `idcontrato` =  '$row[5]' ");	
	while ($filacont = mysql_fetch_array($sqlcont, MYSQL_NUM)) {
				//cargar listado de tipo contratos
				$opciones = array();
				$resultado = mysql_query("SELECT * FROM  `t_tipocontrato`");
				while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
    				$opciones[] = $fila[1];
				}
			echo('<td>Tipo Contrato:</td> <td> '.$opciones[$filacont[2]].'</td>');
			echo('<td>Fecha Inicio:</td> <td> '.$filacont[4].'</td>');
			echo('</tr><td>Fecha Fin: </td> <td> '.$filacont[5].'</td>');
			//cargar listado de estado contratos
			$opestado = array();
			$resultado3 = mysql_query("SELECT * FROM  `t_estadoscont`");
			while ($fila3 = mysql_fetch_array($resultado3, MYSQL_NUM)) {
    			$opestado[] = $fila3[1];
			}
			echo('<td>Estado: </td> <td> '.$opestado[$filacont[7]].'</td>');
			echo('<td>Cuenta: </td> <td> '.$filacont[6].'</td>');
		}
	echo('</tr>');	
	
	
	
  echo('<tr><td> <label> &nbsp </label> </td></tr>');
	echo('<tr><td colspan="5"> <b>Direccion de Domiciliacion:</b> </td></tr><tr>');
  $sqldir = mysql_query ("SELECT * FROM  `empleados` WHERE  `idemp` =  '$row[1]' ");	
		while ($filadir = mysql_fetch_array($sqldir, MYSQL_NUM)) {
			echo('<td><b>Localidad:</b></td> <td> '.$filadir[16].'</td> ');
			echo('<td><b>Provincia:</b></td> <td> '.$filadir[17].'</td>');
			echo('<td><b>Codigo Postal: </b></td> <td>'.$filadir[15].'</td></tr>');
			echo('<td><b>Calle:</b> </td> <td>'.$filadir[12].'</td>');
			echo('<td><b>Piso: </b></td> <td> '.$filadir[13].'</td>');
			echo('<td><b>Puerta: </b></td> <td>'.$filadir[14].'</td>');
		}
	echo('</tr>');
   echo('<tr><td>   &nbsp      </td></tr>');
	echo ('<tr> <th colspan="6"> Conceptos de la nomina: </th> </tr>');
	echo('<input type="hidden" name="idnom" value="'.$idnom.'">');
	echo('<tr> <th> Concepto </th> <th> Tipo Concepto </th> <th> Cantidad Concepto </th> <th> Precio Concepto </th> <th> Devengado </th> <th> A deducir </th> </tr>');
	//cargar todos los tipos de conceptos de la nomina
	$options2 = array();
	$arraytipocon2 = array();
	$sqltconcepto="SELECT * FROM  `t_conceptos`";
	$resultipo=mysql_query($sqltconcepto);
	while ($tconcepto = mysql_fetch_array($resultipo, MYSQL_NUM)) {
		//guardar en un array todos los tipos de conceptos de la nomina
			$options2[]= $tconcepto[1];
			$arraytipocon[]= $tconcepto[2];
	}
	// cargar los conceptos de la nomina
	$sqlnomconp = "SELECT * FROM  `conceptosnom` WHERE  `IdNomina` = '$idnom'";

	$resulsql=mysql_query($sqlnomconp);
	while ($filanom = mysql_fetch_array($resulsql, MYSQL_NUM)) {
		echo('<tr>');
		echo('<td>'.$options2[$filanom[2]-1].'</td>');
		if ($arraytipocon[$filanom[2]-1]=='1'){ //si el tipo de concepto de nomina es 1, escibir deduccion
			echo('<td> DEDUCCION </td>');
		}
		else{ //sino escibir devengo
			echo('<td> DEVENGO </td>');
		}
		echo('<td>'.$filanom[3].'</td>');			
		echo('<td>'.$filanom[4]);
		if ($arraytipocon[$filanom[2]-1]=='1'){ //si el tipo de concepto de nomina es 1, escibir simbolo %
			echo(' %');
		}
		echo('</td>');		
		echo('<td>'.$filanom[5].'</td>');
		echo('<td>'.$filanom[6].'</td></tr>');
	}

	echo('<tr><td>   &nbsp      </td></tr>');
	echo('<tr><td></td><td></td><td> <b> Total a Pagar:  </b> </td>');
	printf("<td> %s </td></tr>  ", $row[4]);
}
echo('</table>');
?>
</table>
</form> 
</center>
</body>
</html>


