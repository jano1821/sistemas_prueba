<?php
	require_once('login/comprobarweb.php');
?>
<html>
<head>
<title> Sitema de Empleados y Nominas Online </title>
</head>

<body>
 <center>
 <form name='formulario' method="post" action="<?=$_SERVER['PHP_SELF']?>"> 
  <?php
 include("funciones/crear_dropdown.php");
  include("funciones/empresa.php");
$idnom=$_REQUEST['idnom'];
include("conectarbbdd.php");

$result = mysql_query("SELECT * FROM  `nominas` WHERE  `idnomina` LIKE  '$idnom' LIMIT 0 , 30");
echo('<input type="hidden" name="idnomina" value="'.$idnom.'" >');
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	$idempleado=$row[1];
	$result2 = mysql_query("SELECT * FROM  `empleados` WHERE  `idemp` LIKE  '$idempleado'");
	while ($fila = mysql_fetch_array($result2, MYSQL_NUM)) {
?>

<table border="1" bordercolor="#6396BB">
	<tr><th bgcolor='BBD1E1'>DATOS NOMINA:</th> <td><?php echo('<input value="'.$idnom.'" readonly="true">'); ?></td> 
	<th bgcolor='BBD1E1'>Fecha: </th> <td><?php echo('<input value="'.$row[2].' '.$row[3].'" readonly="true">'); ?></td></tr>
	
	<?php
	printf("<th bgcolor='BBD1E1'> Tipo Nomina: </th><td>");
	$arraytipos = array();
	$resultipos = mysql_query("SELECT * FROM  `t_tiponom`");
	while ($filatipos = mysql_fetch_array($resultipos, MYSQL_NUM)) {
    		$arraytipos[] = $filatipos[1];
	}
	 printf("%s", $arraytipos[$row[8]]);
	 echo('</td></tr>');
	?>

	<tr><td colspan="4">&nbsp</td></tr>
    <tr>
      <th colspan="2" bgcolor='BBD1E1'> DATOS EMPRESA </th>
      <th colspan="2" bgcolor='BBD1E1'> DATOS EMPLEADO</th>
    </tr>
    <tr>
      <td colspan="2"><label><b>Nombre: </b></label>  <?php echo($nombreemp); ?> </td>
	  <th bgcolor='BBD1E1'>Nº del Empleado</th>
      <?php echo('<td><input value="'.$row[1].'" readonly="true"></td>'); ?>
    </tr>
    <tr>
      <th bgcolor='BBD1E1'>CIF</th>
      <th bgcolor='BBD1E1'>Actividad</th>
      <th bgcolor='BBD1E1'>Nombre</th>
      <?php echo('<td><input value="'.$fila[1].'" readonly="true"></td>'); ?>
    </tr>
    <tr>
      <td><?php echo($cifemp); ?></td>
      <td><input size="30"></td>
      <th bgcolor='BBD1E1'>Apellidos</td>
      <?php echo('<td><input value="'.$fila[2].' '.$fila[3].'" readonly="true"></td>'); ?>
    </tr>
    <tr>
      <th bgcolor='BBD1E1'>Convenio</th>
      <td><input size="30"></td>
      <th bgcolor='BBD1E1'>DNI</th>
       <?php echo('<td><input value="'.$fila[5].'" readonly="true"></td>'); ?>
    </tr>
<tr><td colspan="4">&nbsp</td></tr>
    <tr>	<th colspan="2" bgcolor='BBD1E1'>DENOMINACION</th>
    <th colspan="1" bgcolor='BBD1E1'>CANTIDAD</th>
    <th colspan="1" bgcolor='BBD1E1'>PRECIO</th>
    </tr>


<?php
  	echo('<tr><th colspan="4">&nbsp</th></tr>');
	echo('<tr><th colspan="4" bgcolor="BBD1E1">DEVENGOS</th></tr>');
	//buscar todos los devengos
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
	$sumadevengo=0;
	$resulsql=mysql_query($sqlnomconp);
	//mostrar todos los devengos
	while ($filanom = mysql_fetch_array($resulsql, MYSQL_NUM)) {
		if ($arraytipocon[$filanom[2]-1]=='0'){ //si el tipo de concepto de nomina es 1, escibir la deduccion
			echo('<tr> <td colspan="2"> '.$options2[$filanom[2]-1].' </td>');
			echo ( '<td> <input id="person1" value="'.$filanom[3].'" readonly="true"></td>');
			echo ( '<td colspan="2"> <input id="person1" value="'.$filanom[4].' &euro;" readonly="true"></td> </tr>');
			$sumadevengo=$sumadevengo+$filanom[5];
		}
	}
	echo('<tr><th colspan="4">&nbsp</th></tr>');
	echo('<tr><th colspan="4" bgcolor="BBD1E1" >DEDUCCIONES</th></tr>');
		// cargar los conceptos de la nomina
	$sqlnomconp = "SELECT * FROM  `conceptosnom` WHERE  `IdNomina` = '$idnom'";
	$sumadeduccuion=0;
	$resulsql=mysql_query($sqlnomconp);
	//mostrar todos los devengos
	while ($filanom = mysql_fetch_array($resulsql, MYSQL_NUM)) {
		if ($arraytipocon[$filanom[2]-1]=='1'){ //si el tipo de concepto de nomina es 1, escibir el devengo
			echo('<tr><th bgcolor="BBD1E1" colspan="2">'.$options2[$filanom[2]-1].' % :</th>');
			echo ( '<td> <input id="person1" value="'.$filanom[4].' %" readonly="true"></td> </tr>');
			$sumadeduccuion=$sumadeduccuion+$filanom[6];
		}
	}
	echo('<tr><td colspan="4">&nbsp</td></tr>');
	$sqlcont = mysql_query ("SELECT * FROM  `contratos` WHERE  `idcontrato` =  '$row[5]' ");	
	while ($filacont = mysql_fetch_array($sqlcont, MYSQL_NUM)) {
		//Dividor digitos de la cuenta bancaria en un array
		$digitos = str_split($filacont[14]);
		$digitos[6]='*';
		$digitos[7]='*';
		$digitos[8]='*';
		$digitos[9]='*';
		$listadigitos = implode(" ", $digitos);
	echo('<tr><th bgcolor="BBD1E1">Cuenta Bancaria: </th>');
	echo('<td colspan="2">');
	echo('<input size="4" maxlength="4" value="'.$filacont[11].'" /> '); 
	echo('<input size="4" maxlength="4" value="'.$filacont[12].'" /> '); 
	echo('<input size="2" maxlength="2" value="'.$filacont[13].'" /> '); 
	echo('<input value="'.$listadigitos.'" readonly="true">');
	echo('<td colspan="1"></td></tr>');
	}
	echo('<tr><th bgcolor="BBD1E1">Fecha Pago: </th><td colspan="1"><input value="'.$row[6].'" readonly="true"></td><th bgcolor="BBD1E1">Tipo de Pago</th><td> Transferencia </td></tr>');

	echo('<tr><td colspan="4">&nbsp</td></tr>');
	echo('<tr><td colspan="2"></td><th bgcolor="BBD1E1">Total Devengos: </th><td><input value="'.$sumadevengo.' &euro;" readonly="true"></td></tr>');
	echo('<tr><td colspan="2"></td><th bgcolor="BBD1E1">Total a Deducir: </th><td><input value="'.$sumadeduccuion.' &euro;" readonly="true"></td></tr>');
	echo('<tr><td colspan="2"></td><th bgcolor="BBD1E1">TOTAL a Cobrar: </th><td><input value="'.$row[4].' &euro;" readonly="true"></td></tr>');
	}
}
mysql_close();
?>

</table>

<br><br> <button type='submit' name='imprimir' onclick="window.print()">  <img src='./imagenes/imprimir.png'> </button>
<button type='submit' name="volver">  <img src='./imagenes/volver.png'> </button>
<?php
if(isset($_POST["imprimir"])) 
{ 
   $idnomina=$_REQUEST['idnomina'];
	echo ('<meta http-equiv="Refresh" content="0; URL=bnominap.php?idnom='.$idnomina.'">');
}
if(isset($_POST["volver"])) 
{ 
   $idnomina=$_REQUEST['idnomina'];
	echo ('<meta http-equiv="Refresh" content="0; URL=lnomina1.php?idnomina='.$idnomina.'">');
}
?>
</form> 
 </center>
</body>
</html>