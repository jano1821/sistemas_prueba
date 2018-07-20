<?php
	require_once('login/comprobarweb.php');
?>
<html>
<head>
<title> Sitema de Empleados y Nominas Online </title>
<link rel=StyleSheet href="estilos.css" TYPE="text/css">
<link rel=StyleSheet href="menu/css/nav.css" TYPE="text/css">

<script language="JavaScript">
function abrir_popup(URL){
window.open(URL,"ventana1","width=600, height=450, directories=no ,scrollbars=no, menubar=no, location=no, resizable=no")
}
</script>

</head>

<body>
<?php
	include("menu/menu.php");
	include("funciones/crear_dropdown.php");
?>
<br>
<center>
<form method="post" action="<?=$_SERVER['PHP_SELF']?>"> 
<div id="contenidoperm">
<h1>Crear nueva Nomina: </h1>
<table>
 <tr><td colspan="3"><b>DATOS DEL EMPLEADO: </b></td></tr>
 <tr><td>
<?php
$datoempl=" ";
$datoempl= $_GET['idempleatu'];
echo('<label for="person3"> IdEmpleado </label> <label class="asteriskred"> * </label> </td> <td> <input name="idempleado" id="idcliente" class="requerido" value="'.$datoempl.'" readonly="true"/>');
?>
</td><td><a href="javascript:abrir_popup('popup_liclt.php')"><img src='./imagenes/buscar2.png'></a> </td>
<td><label for='person3'> Nombre:</label> </td> <td> <input id='nombre' value='' readonly="true" class="requerido"/></td>
</tr>
<tr>	
	<td><label for='person3'> 1er Apellido:</label> </td> <td>  <input id='apellido1' value='' readonly="true" class="requerido" /></td>
	<td>&nbsp;</td>
	<td><label for='person3'> 2ndo Apellido: </label> </td> <td>  <input id='apellido2' value='' readonly="true" class="requerido"/></td>
	<td><label for='person3'> DNI: </label> </td> <td>  <input id='dni' value='' readonly="true" class="requerido"/></td>
</tr>
<tr><td> <label> &nbsp </label> </td></tr>
 <tr><td colspan="3"><b>DATOS DE LA NOMINA: </b></td></tr>
<tr>
<?php
printf("<td><label> Mes: </label></td> <td>");
    //nombre del dropdown
    $name = 'mes';
    //opciones que tendra el dropdown
	 $options = array('', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' );
	 //opcion seleccionada en el dropdown
	 $selected = $_POST['mes'];
	 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
	 echo crear_dropdown( $name, $options, $selected );
	 printf("</td>");
?>
<td>&nbsp;</td>
<td><label for='person3'> A&ntilde;o </label> </td> <td>  <input name='urtea' value='2011'/> </td>
<?php
	printf("<td> Tipo Nomina: <label class='asteriskred'> * </label> </td><td>");
	$arraytipos = array();
	include("conectarbbdd.php");
	$resultipos = mysql_query("SELECT * FROM  `t_tiponom`");
	while ($filaemp = mysql_fetch_array($resultipos, MYSQL_NUM)) {
    		$arraytipos[] = $filaemp[1];
	}
	 $name = 'tiponom';
    //opciones que tendra el dropdown
	 //opcion seleccionada en el dropdown
	 $selected = $_POST['tiponom'];
	 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
	 echo crear_dropdown( $name, $arraytipos, $selected );
	 echo('</td>');
?>
<?php
echo('<tr><td><label for="person3"> IdContrato </label> <label class="asteriskred"> * </label> </td> <td> <input name="idcontrato" id="idcontrato" class="requerido" value="'.$datocontrato.'" readonly="true"/>');
?>
</td>
<?php
//echo('<input type="hidden" id="empleadocon">'); //Prueba de retorno doble -- NO TIENE UTILIDAD EN EL CODIGO ACTUAL
//$datoempl= $_GET['idempleatu'];
//echo('<a href="javascript:abrir_popup(\'popup_licont.php?idempleatu='.$datoempl.' \')">');
?>
</td><td><a href="javascript:abrir_popup('popup_licont.php')"><img src='./imagenes/buscar2.png'></a> </td>

<td><label for='person3'> Tipo Contrato:</label> </td> <td> <input id='tipocontrato' value='' readonly="true" class="requerido"/></td>
 </td>
<tr>	
	<td><label for='person3'> Inicio Contrato:</label> </td> <td>  <input id='fechainiciocont' value='' readonly="true" class="requerido" /></td>
	<td>&nbsp;</td>
	<td><label for='person3'> Fin Contrato: </label> </td> <td>  <input id='fechafincont' value='' readonly="true" class="requerido"/></td>
	<td><label for='person3'> Estado Contrato: </label> </td> <td>  <input id='estadocont' value='' readonly="true" class="requerido"/></td>
</tr>

</tr>
<tr><td> <label> &nbsp </label> </td></tr>
<tr><td colspan="3"><b>SALARIO CONTRATO: </b></td></tr>
<tr>
<td><label for='person3'> Horas Contrato: </label></td>
<td><input name='hcontrato' value="<?php echo $_POST['hcontrato']?>"/></td>
<td>&nbsp;</td>
<td><label for='person3'> Salario Base:</label> </td>
<td><input name='scontrato' value="<?php echo $_POST['scontrato']?>"/></td>
</tr>
<tr><td> <label> &nbsp </label> </td></tr>
 <tr><td colspan="3"><b>SALARIO EXTRA: </b></td></tr>
<tr>
<td><label for='person3'> Horas Extra:</label> </td>
 <td>  <input name='hextra' value="<?php echo $_POST['hextra']?>"/></td>
<td>&nbsp;</td>
<td><label for='person3'> Salario Hora Extra:</label> </td>
 <td> <input name='sextra' value="<?php echo $_POST['sextra']?>"/></td>
</tr>
<tr><td> <label> &nbsp </label> </td></tr>
 <tr><td colspan="3"><b>DIETAS Y PLUSES: </b></td></tr>
<tr>
<td><label for='person3'> Horas Dietas:</label> </td> 
<td>  <input name='hdieta' value="<?php echo $_POST['hdieta']?>"/></td>
<td>&nbsp;</td>
<td><label for='person3'> Salario Horas Dieta:</label> </td> <td>   <input name='sdieta' value="<?php echo $_POST['sdieta']?>"/></td>
</td><td>
<label for='person3'> Plus Transporte:</label> </td> <td>  <input name='plust' value="<?php echo $_POST['plust']?>"/>
</td></tr><tr>
<td>
<label for='person3'> Plus Actividad:</label> </td> <td>  <input name='plusa' value="<?php echo $_POST['plusa']?>"/>
</td></tr>
<tr><td> <label> &nbsp </label> </td></tr>
 <tr><td colspan="3"><b>OTROS COMPLEMENTOS: </b></td></tr>
<tr>
	<td><label for='person3'> Complemento Domingo:</label> </td>
	<td> <input name='compdomingo' value="<?php echo $_POST['compdomingo']?>"/></td>
	<td>&nbsp;</td>
	<td><label for='person3'> Vac. Pendientes Pago:</label> </td> 
	<td>  <input name='vacpendientes' value="<?php echo $_POST['vacpendientes']?>"/></td>
</tr>
<tr><td> <label> &nbsp </label> </td></tr>
 <tr><td colspan="3"><b>FESTIVOS Y NOCTURNOS: </b></td></tr>
<tr>
	<td><label for='person3'> Hora Festivo: </label> </td>
	 <td>  <input name='hfest' value="<?php echo $_POST['hfest']?>"/> </td>
	 <td>&nbsp;</td>
	<td><label for='person3'> Salario Hora Festivo </label> </td>
	 <td>  <input name='sfest' value="<?php echo $_POST['sfest']?>"/></td>
</tr>
<tr>
	<td><label for='person3'> Hora Nocturna: </label> </td> 
	<td>  <input name='hnocturn' value="<?php echo $_POST['hnocturn']?>"/></td>
	<td>&nbsp;</td>
	<td><label for='person3'> Salario Hora Nocturna: </label> </td>
	 <td>  <input name='snorcturn' value="<?php echo $_POST['snorcturn']?>"/></td>
</tr>
<tr><td> <label> &nbsp </label> </td></tr>
<tr><td colspan="3"><b>RETENCIONES Y DEDUCCIONES: </b></td></tr>
<tr>
<td><label for='person3'> IRPF %: </label> </td>
 <td>  <input name='irpf' value="<?php echo $_POST['irpf']?>"/></td>
 <td>&nbsp;</td>
 <td><label for='person3'> % por Desempleo: </label> </td> 
 <td>  <input name='desempleoa' value="<?php echo $_POST['desempleoa']?>"/></td>
</tr></table>

<?php
if(isset($_POST["gordenom"])) 
{ 
	$idempleado=$_REQUEST['idempleado'];
	$mes=$_REQUEST['mes'];
	$urtea=$_REQUEST['urtea'];
	$hcontrato=$_REQUEST['hcontrato'];
	$scontrato=$_REQUEST['scontrato'];
	$hextra=$_REQUEST['hextra'];
	$sextra=$_REQUEST['sextra'];
	$hdieta=$_REQUEST['hdieta'];
	$sdieta=$_REQUEST['sdieta'];
	$plust=$_REQUEST['plust'];
	$plusa=$_REQUEST['plusa']; //FALTA SUMAR
	$compdomingo=$_REQUEST['compdomingo']; //FALTA SUMAR
	$vacpendientes=$_REQUEST['vacpendientes']; //FALTA SUMAR
	$hfest=$_REQUEST['hfest'];
	$sfest=$_REQUEST['sfest'];
	$hnocturn=$_REQUEST['hnocturn'];
	$snorcturn=$_REQUEST['snorcturn'];
	$irpf=$_REQUEST['irpf'];
	$desempleoa=$_REQUEST['desempleoa'];
	$tiponom=$_REQUEST['tiponom'];
	$idcontrato=$_REQUEST['idcontrato'];
	
$totala=((($hcontrato)*($scontrato))+(($hextra)*($sextra))+(($hdieta)*($sdieta))+(($hfest)*($sfest))+(($hnocturn)*($snorcturn))+($plust)+($plusa)+($compdomingo)+($vacpendientes));
$totala=$totala-($totala*($irpf/100))-($totala*($desempleoa/100));
if (empty($irpf)) {
	echo ("<label id='error'> <img src='imagenes/cuidado.png'> No has introducido el valor del IRPF </label>");
}
elseif (empty($desempleoa)) {
	echo ("<label id='error'> <img src='imagenes/cuidado.png'> No has introducido el valor por Desempleo </label>");
}
elseif (empty($urtea)) {
	echo ("<label id='error'> <img src='imagenes/cuidado.png'> No has escrito nig&uacute;n A&ntilde;o </label>");
}
elseif(empty($totala)) {
	echo ("<label id='error'> <img src='imagenes/cuidado.png'> Imposible Calcular: Revise los conceptos introducidos </label>");
}
elseif (empty($idempleado)) {
	echo ("<label id='error'> <img src='imagenes/cuidado.png'> No has seleccionado nig&uacute;n empleado </label>");
}
elseif (empty($mes)) {
	echo ("<label id='error'> <img src='imagenes/cuidado.png'> No has seleccionado nig&uacute;n mes </label>");
}
else {
	echo ('<label for="person4"> Total a pagar </label>  <input value="'.$totala.'"/>');	
	include("conectarbbdd.php");
	$opciones = array( '', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' );
	$mes=$opciones[$mes];
	//guardar la nomina
	$result = mysql_query(" INSERT INTO `nominas` (`idnomina`, `idemp`, `mes`, `urtea`, `total`, `idcontrato`,
 	`fechapago`, `estadonom`, `tiponom`) VALUES ('NULL', '$idempleado', '$mes', '$urtea', '$totala',
  '$idcontrato', '0000-00-00', '0', '$tiponom'); ");
	//gurdar los conceptos de la nomina
	$query = mysql_query("SELECT LAST_INSERT_ID()");
	$idnomina = mysql_result($query, 0, 0);
	//guardar concepto de salario contrato/base
	$devengobase=$hcontrato*$scontrato;
	if (!empty($devengobase)) {
		$query = mysql_query("INSERT INTO `conceptosnom` (`IdConceptoNom` ,`IdNomina` , `IdConcepto` , `CantidadConcepto` ,
	 	`PrecioConcepto` , `Devengado` , `Adeducir`) VALUES ( NULL ,  '$idnomina',  '1',  '$hcontrato',  '$scontrato',  '$devengobase',  '0' );");
	}
	//guardar concepto de salario horasextra	
	$devengoextra=$hextra*$sextra;
	if (!empty($devengoextra)) {
		$query = mysql_query("INSERT INTO `conceptosnom` (`IdConceptoNom` ,`IdNomina` , `IdConcepto` , `CantidadConcepto` ,
	 	`PrecioConcepto` , `Devengado` , `Adeducir`) VALUES ( NULL ,  '$idnomina',  '2',  '$hextra',  '$sextra',  '$devengoextra',  '0' );");
	}	
	//guardar concepto de salario horasdieta
	$devengodieta=$hdieta*$sdieta;
	if (!empty($devengodieta)) {
		$query = mysql_query("INSERT INTO `conceptosnom` (`IdConceptoNom` ,`IdNomina` , `IdConcepto` , `CantidadConcepto` ,
	 	`PrecioConcepto` , `Devengado` , `Adeducir`) VALUES ( NULL ,  '$idnomina',  '3',  '$hdieta',  '$sdieta',  '$devengodieta',  '0' );");
	}
	//guardar concepto de Plus Transporte
	if (!empty($plust)) {
		$query = mysql_query("INSERT INTO `conceptosnom` (`IdConceptoNom` ,`IdNomina` , `IdConcepto` , `CantidadConcepto` ,
	 	`PrecioConcepto` , `Devengado` , `Adeducir`) VALUES ( NULL ,  '$idnomina',  '4',  '1',  '$plust',  '$plust',  '0' );");
	}
	//guardar concepto de plus actividad
	if (!empty($plusa)) {
		$query = mysql_query("INSERT INTO `conceptosnom` (`IdConceptoNom` ,`IdNomina` , `IdConcepto` , `CantidadConcepto` ,
	 	`PrecioConcepto` , `Devengado` , `Adeducir`) VALUES ( NULL ,  '$idnomina',  '5',  '1',  '$plusa',  '$plusa',  '0' );");
	}
	//guardar concepto de Complemento Domingo
	if (!empty($compdomingo)) {
		$query = mysql_query("INSERT INTO `conceptosnom` (`IdConceptoNom` ,`IdNomina` , `IdConcepto` , `CantidadConcepto` ,
	 	`PrecioConcepto` , `Devengado` , `Adeducir`) VALUES ( NULL ,  '$idnomina',  '6',  '1',  '$compdomingo',  '$compdomingo',  '0' );");
	}
	//guardar concepto de Vac. Pendientes Pago
	if (!empty($vacpendientes)) {
		$query = mysql_query("INSERT INTO `conceptosnom` (`IdConceptoNom` ,`IdNomina` , `IdConcepto` , `CantidadConcepto` ,
	 	`PrecioConcepto` , `Devengado` , `Adeducir`) VALUES ( NULL ,  '$idnomina',  '7',  '1',  '$vacpendientes',  '$vacpendientes',  '0' );");
	}
	//guardar concepto de Festivos
	$devengofest=$hfest*$sfest;
	if (!empty($devengofest)) {
		$query = mysql_query("INSERT INTO `conceptosnom` (`IdConceptoNom` ,`IdNomina` , `IdConcepto` , `CantidadConcepto` ,
	 	`PrecioConcepto` , `Devengado` , `Adeducir`) VALUES ( NULL ,  '$idnomina',  '8',  '$hfest',  '$sfest',  '$devengofest',  '0' );");
	}
	//guardar concepto de Nocturnos
	$devengonoct=$hnocturn*$snocturn;
	if (!empty($devengonoct)) {
		$query = mysql_query("INSERT INTO `conceptosnom` (`IdConceptoNom` ,`IdNomina` , `IdConcepto` , `CantidadConcepto` ,
	 	`PrecioConcepto` , `Devengado` , `Adeducir`) VALUES ( NULL ,  '$idnomina',  '9',  '$hnocturn',  '$snocturn',  '$devengonoct',  '0' );");
	}
	//guardar concepto de contingencia desempleo
	$deduciremple=$totala*($desempleoa/100);
	if (!empty($desempleoa)) {
		$query = mysql_query("INSERT INTO `conceptosnom` (`IdConceptoNom` ,`IdNomina` , `IdConcepto` , `CantidadConcepto` ,
	 	`PrecioConcepto` , `Devengado` , `Adeducir`) VALUES ( NULL ,  '$idnomina',  '11',  '1',  '$desempleoa',  '0',  '$deduciremple' );");
	}
	//guardar concepto de retencion irpf
	$deducirirpf=$totala*($irpf/100);
	if (!empty($irpf)) {
		$query = mysql_query("INSERT INTO `conceptosnom` (`IdConceptoNom` ,`IdNomina` , `IdConcepto` , `CantidadConcepto` ,
	 	`PrecioConcepto` , `Devengado` , `Adeducir`) VALUES ( NULL ,  '$idnomina',  '14',  '1',  '$irpf',  '0',  '$deducirirpf' );");
	}
	if($result)
	{
		echo('<center> <img src="./imagenes/errorok2.png"> </center>');
		if($idempleado>=1){
				//REGISTRAR CAMBIO EN EL HISTORICO
				$usuario = $_SESSION['SESS_USERNAME'];
				$desccambio = "Creacion Nomina";
				$tabla = "NOMINAS";
				$idemplhist = $idempleado;
				$query = mysql_query("SELECT LAST_INSERT_ID()");
				$idregistro = mysql_result($query, 0, 0);
				include("funciones/registrarcambio.php");
			echo ('<meta http-equiv="Refresh" content="0.1; URL=vernominasemp.php?idempleatu='.$idempleado.'">');
		}
	} else {
		echo('<center> <img src="./imagenes/error2.png"> </center>');
		}
	
	mysql_close();	
} //fin del else que comprueba si se ha seleccionado un empleado
} 
?> 
 <p><INPUT type="submit" name="gordenom" value="Crear Nueva Nomina" size="20"> </p>
  </div>
 </form>
</center> 
</body>
</html>


