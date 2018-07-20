<?php
	require_once('login/comprobarweb.php');
?>
<html>
<head>
<title> Sitema de Empleados y Nominas Online </title>
<link rel=StyleSheet href="estilos.css" TYPE="text/css">
<link rel=StyleSheet href="menu/css/nav.css" TYPE="text/css">
</head>

<body>
<center>
<br><br>
<form name='formulario' method="post" action="<?=$_SERVER['PHP_SELF']?>"> 
    
<?php
$idemplega= $_GET['idempleatu'];

include("conectarbbdd.php");

$result = mysql_query("SELECT * FROM  `empleados` WHERE  `idemp` LIKE  '$idemplega' LIMIT 0 , 30");

while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo('<input type="hidden" name="idemple" value="'.$idemplega.'" >');
	echo ('<h3>Datos del IdEmpleado: <b>'.$row[0].' </b> </h3>');
	echo('<table><tr><td></td>');
	echo ('<td><input value="Nombre" size="15"></td>');
	echo ('<td><input value="1er Apellido" size="15"></td>');
	echo ('<td><input value="2ndo Apellido" size="15"></td>');
	echo ('<td><input value="Email" size="25"></td>');
	echo ('<td><input value="DNI" size="10"></td>');
	echo ('<td><input value="Estado" size="15"></td></tr>');
	printf ("<tr><td><a href='verempleado.php?idempleatu=%s' target='empleado'><img src='./imagenes/buscar2.png'></a></td>", $row[0]);
    printf("<td><input id='person1' value='%s' size='15'/></td> ", $row[1]);
    printf("<td><input id='person1' value='%s' size='15'/></td>", $row[2]);
    printf("<td><input id='person1' value='%s' size='15'/></td>", $row[3]);
    printf("<td><input id='person1' value='%s' size='25'/></td>", $row[4]);
    printf("<td><input id='person1' value='%s' size='10'/></td>", $row[5]);
    //Cambiar el numero del estado por el valor correspondiente
    $opciones = array( 'Activo', 'Inactivo', 'Practicas', 'Maternidad', 'Permiso', 'Otro', 'Baja' );
	 $estado = $opciones[$row[6]];
    printf("<td><input id='person16' value='%s' size='15'/></td></tr>", $estado);
    $nombrecompleto=$row[1].' '.$row[2].' '.$row[3];
    echo('</table>');
}

mysql_free_result($result);

$resulta = mysql_query("SELECT * FROM  `nominas` WHERE  `idemp` LIKE  '$idemplega' LIMIT 0 , 999");

echo ('<h3>Listado de Nominas de: '.$nombrecompleto.'</h3> ');
echo('<table><tr><td></td>');
echo('<td><input id="person1" value="IdNomina" size="6"></td>');
echo('<td><input id="person3" value="Mes" size="8"></td>');
echo('<td><input id="person4" value="A&ntilde;o" size="5"></td>');
echo("<th><input value='Fecha Pago' size='9' readonly></th>");
echo("<th><input value='Estado Nomina' size='11' readonly></th>");
echo("<th><input value='Tipo Nomina' size='11' readonly></th>");
echo("<th><input value='H.Contrato' size='9' readonly></th>");
echo("<th><input value='Total' size='8' readonly></th></tr>");
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
	printf ("<tr><td><a href='lnomina1.php?idnomina=%s' target='empleado'><img src='./imagenes/buscar2.png'></a></td>", $row[0]);
   printf("<td><input id='person10' value='%s' size='6'/></td>", $row[0]);
   printf("<td><input id='person12' value='%s' size='8'/></td>", $row[2]);
   printf("<td><input id='person13' value='%s' size='5'/></td>", $row[3]);
	printf("<td><input id='person11' value='%s' size='9'/></td> ", $row[6]);
	printf("<td><input id='person11' value='%s' size='11'/></td> ", $arrayestados[$row[7]]);
	printf("<td><input id='person11' value='%s' size='11'/></td> ", $arraytipos[$row[8]]);
	//buscar si tiene horas de contrato
	$sqlnomconp = "SELECT * FROM  `conceptosnom` WHERE  `IdNomina` = '$row[0]' AND  `IdConcepto` = 1 ";
	$resulsql=mysql_query($sqlnomconp);
	while ($filanom = mysql_fetch_array($resulsql, MYSQL_NUM)) {
			printf("<td><input id='person13' value='%s' size='9'/></td>", $filanom[3]);
			$existefilanom=1;
	}
	if (!isset($existefilanom)){
		printf("<td><input id='person13' value='0' size='9'/></td>");
	}
	printf("<td><input id='person17' value='%s' size='8'/></td></tr>", $row[4]);	
}
echo('</table>');
mysql_close();
?>
<br><br> <button type='submit' name="imprimir" onclick="window.print()">  <img src='./imagenes/imprimir.png'> </button>
<button type='submit' name="volver">  <img src='./imagenes/volver.png'> </button>
<?php
if(isset($_POST["imprimir"])) 
{ 
   $idempleatu=$_REQUEST['idemple'];
	echo ('<meta http-equiv="Refresh" content="0; URL=linomina1.php?idempleatu='.$idempleatu.'">');
}
if(isset($_POST["volver"])) 
{ 
   $idempleatu=$_REQUEST['idemple'];
	echo ('<meta http-equiv="Refresh" content="0; URL=vernominasemp.php?idempleatu='.$idempleatu.'">');
}
?>

</form> 
</center>
</body>
</html>


