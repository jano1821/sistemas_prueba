<?php
	require_once('login/comprobarweb.php');
?>
<html>
<head>
<title> Sitema de Empleados y Nominas Online </title>
<link rel=StyleSheet href="estilos.css" TYPE="text/css">
<link rel=StyleSheet href="menu/css/nav.css" TYPE="text/css">

<SCRIPT LANGUAGE="JavaScript" SRC="javascript/CalendarPopup.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
	var cal = new CalendarPopup();
</SCRIPT>

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
	include("funciones/validarccc.php");
?>
<br>
<center>
<table id="contenidoperm">
<tr> <th colspan="6"> <b> DAR DE ALTA UN NUEVO CONTRATO: </b> </th> </tr>
<tr><td>&nbsp</td></tr>
<form method="post" name="formsol" action="<?=$_SERVER['PHP_SELF']?>"> 

 <tr><td colspan="6"><b>Datos del Empleado: </b></td></tr>
 <tr><td>
<?php
$datoempl=" ";
$datoempl= $_GET['idempleatu'];
echo('<label for="person3"> IdEmpleado </label> <label class="asteriskred"> * </label> </td> <td> <input name="idempleado" id="idcliente" class="requerido" value="'.$datoempl.'" readonly="true"/> </td>');
?>
<td><a href="javascript:abrir_popup('popup_cltsol.php')"><img src='./imagenes/buscar2.png'></a> </td>
</tr>
<tr><td> <label> &nbsp </label> </td></tr>
 <tr><td colspan="6"><b>Datos del Contrato: </b></td></tr>
<?php
//crear array
$options = array();
include("conectarbbdd.php");
$result = mysql_query("SELECT * FROM  `t_tipocontrato`");
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    $options[] = $row[1];
}
printf("<tr><td><label> Tipo de Contrato </label> </td> <td colspan='3'>");
    //nombre del dropdown
    $name = 'tipocontrato';
	 //opcion seleccionada en el dropdown
	$selected = $_POST['tipocontrato'];
	 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
	 echo crear_dropdown( $name, $options, $selected );
	 	 printf("</td></tr>")
?>
<tr><td>&nbsp</td></tr>
<?php
printf("<tr><td><label> Estado del Contrato </label> </td><td>");
    //nombre del dropdown
    $name = 'estadocontrato';
    //opciones que tendra el dropdown
	//crear array
	$options = array();
	include("conectarbbdd.php");
	$result = mysql_query("SELECT * FROM  `t_estadoscont`");
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	    $options[] = $row[1];
	}
 	 //opcion seleccionada en el dropdown
	 $selected = $_POST['estadocontrato'];
	 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
	 echo crear_dropdown( $name, $options, $selected );
	 printf("</td>");
?>
<td></td>
<td><label for='person3'> Fecha Firma </label> </td>
<td>  
<?php
$hoy = date("Y-m-j");
echo('<input name="fechafirma" value="'.$hoy.'" />');
?>
</td>
<td>
<A HREF="#" onClick="cal.select(document.forms['formsol'].fechafirma,'anchor1','yyyy/MM/dd'); return false;"  NAME="ancho1" ID="anchor1"><img src='./imagenes/calendario.gif'></A>
</td>
</tr>
<tr><td>&nbsp</td></tr>
<tr>
<td><label for='person3'> Fecha Inicio </label> </td>
<td>  
<?php
$hoy = date("Y-m-j");
echo('<input name="fechainicio" value="'.$hoy.'" />');
?>
</td>
<td>
<A HREF="#" onClick="cal.select(document.forms['formsol'].fechainicio,'anchor2','yyyy/MM/dd'); return false;"  NAME="ancho2" ID="anchor2"><img src='./imagenes/calendario.gif'></A>
</td>
<td><label for='person3'> Fecha Fin </label> </td> 
<td>
<?php
$hoy = date("Y-m-j");
echo('<input name="fechafin" value="'.$hoy.'" />');
?>
</td>
<td>
<A HREF="#" onClick="cal.select(document.forms['formsol'].fechafin,'anchor3','yyyy/MM/dd'); return false;"  NAME="ancho3" ID="anchor3"><img src='./imagenes/calendario.gif'></A>
</td>
</tr>
<tr><td>&nbsp</td></tr>
<tr>
<?php
printf("<td><label> Motivo Fin Contrato </label> </td> <td>");
    //nombre del dropdown
    $name = 'motivofin';
    //opciones que tendra el dropdown
	//crear array
	$options = array();
	include("conectarbbdd.php");
	$result = mysql_query("SELECT * FROM  `t_fincont`");
	$options[] = '&nbsp';
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	    $options[] = $row[1];
	}
	 //opcion seleccionada en el dropdown
	 $selected = $_POST['motivofin'];
	 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
	 echo crear_dropdown( $name, $options, $selected );
	 printf("</td>");
?>
<td></td>
<td>
	<label for='person3'> Fecha Expiraci&oacute;n </label> 
</td>
<td>  
<?php
echo('<input name="fechaexp" value="'.$_POST['fechaexp'].'" >');
?>
</td>
<td>
<A HREF="#" onClick="cal.select(document.forms['formsol'].fechaexp,'anchor4','yyyy/MM/dd'); return false;"  NAME="ancho4" ID="anchor4"><img src='./imagenes/calendario.gif'></A>
</td>
</tr>
<tr><td>&nbsp</td></tr>

<?php
printf(" <tr><td colspan='6'><b>Datos Cuenta Bancaria: </b></td></tr>");
printf("<tr><td> Entidad </td>");
echo('<td><input name="entidad" size="4" maxlength="4" value="'.$_POST['entidad'].'" /> </td> '); 
printf("<td></td><td> Oficina </td>");
echo('<td><input name="oficina" size="4" maxlength="4" value="'.$_POST['oficina'].'" /> </td></tr> '); 
printf("<tr><td> Digitol Control </td>");
echo('<td><input name="dc" size="2" maxlength="2" value="'.$_POST['dc'].'" /> </td> '); 
printf("<td></td><td> Numero Cuenta </td>");
echo('<td><input name="ncuenta" size="10" maxlength="10" value="'.$_POST['ncuenta'].'" /> </td></tr> '); 
?>
</tr>
<tr><td>&nbsp</td></tr>
 <tr> 
  		  <td> <label> Anotaciones: </label></td>
 </tr>
<tr>
   	 <td colspan='4'> <textarea cols='72' rows='5' name='anotaciones'><?php echo($_REQUEST['anotaciones']); ?></textarea></td> 
</tr>
<tr>
	<td colspan="4"> <center><INPUT type="submit" name="altacontrato" value="Dar de Alta el Contrato" size="20"> </center></td>
</tr>
 </form>
 </table>
<?php
if(isset($_POST["altacontrato"])) 
{ 
	$idcliente=$_REQUEST['idempleado'];
	$anotaciones=$_REQUEST['anotaciones'];
	$tipocontrato=$_REQUEST['tipocontrato'];
	$estadocontrato=$_REQUEST['estadocontrato'];
	$fechafin=$_REQUEST['fechafin'];
	$fechainicio=$_REQUEST['fechainicio'];
	$fechaexp=$_REQUEST['fechaexp'];
	$motivofin=$_REQUEST['motivofin'];
	$fechafirma=$_REQUEST['fechafirma'];
	//recoger datos cuenta bancaria
	$ncuenta=$_REQUEST['ncuenta'];
	$oficina=$_REQUEST['oficina'];
	$entidad=$_REQUEST['entidad'];
	$dc=$_REQUEST['dc'];
	
	//validar cuenta bancaria
	$parte1=$entidad."".$oficina;
	$parte2=$ncuenta;
	$valido="0";
	$cc="";
	if (($entidad<>"") && ($oficina<>"") && ($dc<>"") && ($ncuenta<>"") ){
		$resultado=ccc_valido($parte1,$parte2);
		if ($resultado==$dc){
			$valido="1";
			$cc=$entidad."-".$oficina."-".$dc."-".$ncuenta;
		}
	}

if (empty($idcliente)) {
	echo ("<label id='error'> <img src='imagenes/cuidado.png'> No has seleccionado ningun empleado </label>");
	$anotaciones = $_POST['anotaciones'];
}
elseif (empty($fechainicio)) {
	echo ("<label id='error'> <img src='imagenes/cuidado.png'> No has seleccionado introducido ninguna fecha de inicio </label>");
	$anotaciones = $_POST['anotaciones'];
}
elseif ( $valido == '0' ) {
	echo ("<label id='error'> <img src='imagenes/cuidado.png'> La cuenta Bancaria introducida no es valida. Compruebe nuevamente o pongase en contacto con el administrador. </label>");
	$anotaciones = $_POST['anotaciones'];
}
else {
	include("conectarbbdd.php");
	
	$result = mysql_query("
	INSERT INTO `contratos` (`idcontrato`, `idempleado`, `tipocontrato`, `motivofin`, 
	`fechainicio`, `fechafin`, `idcuenta`, `estado`, `fechafirma`, `fechaexp`, `anotacion`,
	`entidad` , `oficina` , `dc` , `ncuenta`)
 	VALUES (NULL, '$idcliente', '$tipocontrato', '$motivofin', '$fechainicio', '$fechafin', '0',
  	'$estadocontrato', '$fechafirma', '$fechaexp', '$anotaciones', '$entidad', '$oficina',
  	'$dc', '$ncuenta'); ");
	if($result)
	{
		echo('<center> <div id="noerror"> El nuevo contrato se ha dado de alta correctamente </div> </center>');
		if($idcliente>=1){
				//REGISTRAR CAMBIO EN EL HISTORICO
				$usuario = $_SESSION['SESS_USERNAME'];
				$desccambio = "Creacion Contrato";
				$tabla = "CONTRATOS";
				$idemplhist = $idcliente;
				$query = mysql_query("SELECT LAST_INSERT_ID()");
				$idregistro = mysql_result($query, 0, 0);
				include("funciones/registrarcambio.php");
			echo ('<meta http-equiv="Refresh" content="0.1; URL=vercontratoemp.php?idempleatu='.$idcliente.'">');
		}
	} else {
		echo('<center> <div id="error"> Ha habido un error al dar de alta el nuevo contrato en la BD </div> </center>');
		$anotaciones = $_POST['anotaciones'];
		}
	
	mysql_close();	
} //fin del else que comprueba si se ha seleccionado un empleado
} 
?> 
</center> 
</body>
</html>


