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
?>
<br>
<center>
<table id="contenidoperm">
<tr> <th colspan="6"> <b> REGISTRAR NUEVA AUSENCIA: </b> </th> </tr>
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
 <tr><td colspan="6"><b>Datos de la Ausencia: </b></td></tr>
<?php
//crear array
$options = array();
include("conectarbbdd.php");
$result = mysql_query("SELECT * FROM  `t_tipoausencia`");
$options[] = '&nbsp';
//opciones que tendra el dropdown
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    $options[] = $row[1];
}
printf("<tr><td><label> Tipo de Ausencia </label> </td> <td>");
    //nombre del dropdown
    $name = 'tipoausencia';
    //opciones que tendra el dropdown
	 //opcion seleccionada en el dropdown
	 $selected = $_POST['tipoausencia'];
	 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
	 echo crear_dropdown( $name, $options, $selected );
	 printf("</td></tr>");
?>
<tr>
<td><label for='person3'> Fecha Inicio </label> </td>
<td>  
<?php
$hoy = date("Y-m-j");
echo('<input name="fechainicio" value="'.$hoy.'" />');
?>
</td>
<td>
<A HREF="#" onClick="cal.select(document.forms['formsol'].fechainicio,'anchor2','yyyy/MM/dd'); return false;"  NAME="anchor2" ID="anchor2"><img src='./imagenes/calendario.gif'></A>
</td>
<td><label for='person3'> Fecha Fin </label> </td> 
<td>
<?php
$hoy = date("Y-m-j");
echo('<input name="fechafin" value="'.$hoy.'" />');
?>
</td>
<td>
<A HREF="#" onClick="cal.select(document.forms['formsol'].fechafin,'anchor1','yyyy/MM/dd'); return false;"  NAME="anchor1" ID="anchor1"><img src='./imagenes/calendario.gif'></A>
</td>
</tr>
<tr><td>&nbsp</td></tr>
<tr>
<?php
printf("<td><label> Estado </label> </td> <td>");
    //nombre del dropdown
    $name = 'estado';
    //opciones que tendra el dropdown
		//crear array
		$options2 = array();
		include("conectarbbdd.php");
		$erantzun = mysql_query("SELECT * FROM  `t_estadosaus`");
		//opciones que tendra el dropdown
		while ($lerroa = mysql_fetch_array($erantzun, MYSQL_NUM)) {
		    $options2[] = $lerroa[1];
		}
	 //opcion seleccionada en el dropdown
	 $selected = $_POST['estado'];
	 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
	 echo crear_dropdown( $name, $options2, $selected );
	 printf("</td>");
?>
<td></td>
<td>
	<label for='person3'> Horas de Ausencia </label> 
</td>
<td>  
<?php
echo('<input name="horas" value="'.$_POST['horas'].'" >');
?>
</td>
</tr>
 <tr> 
  		  <td colspan="6"> Anotaciones:</td>
 </tr>
<tr>
   	 <td colspan='6'> <textarea cols='72' rows='5' name='anotaciones'><?php echo($_REQUEST['anotaciones']); ?></textarea></td> 
</tr>
<tr>
	<td colspan="6"> <center><INPUT type="submit" name="crearausencia" value="Registrar Nueva Ausencia" size="20"> </center></td>
</tr>
 </form>
 </table>
<?php
if(isset($_POST["crearausencia"])) 
{ 
	$idcliente=$_REQUEST['idempleado'];
	$anotaciones=$_REQUEST['anotaciones'];
	$tipoausencia=$_REQUEST['tipoausencia'];
	$estado=$_REQUEST['estado'];
	$fechafin=$_REQUEST['fechafin'];
	$fechainicio=$_REQUEST['fechainicio'];
	$horas=$_REQUEST['horas'];
	
if (empty($idcliente)) {
	echo ("<label id='error'> <img src='imagenes/cuidado.png'> No has seleccionado ningun empleado </label>");
	$observacion = $_POST['observacion'];
}
elseif (empty($tipoausencia)) {
	echo ("<label id='error'> <img src='imagenes/cuidado.png'> No has seleccionado nig&uacute;n tipo de ausencia </label>");
	$observacion = $_POST['observacion'];
}
else {
	include("conectarbbdd.php");
	
	$result = mysql_query("
		INSERT INTO `ausencias` (`idausencia`, `idempleado`, `idsolicitud`, `tipoausencia`, `estado`,
		 `fechainicio`, `fechafin`, `horas`, `anotaciones`) VALUES 
		 (NULL, '$idcliente', '0', '$tipoausencia', '$estado', '$fechainicio',
		  '$fechafin', '$horas', '$anotaciones');
	");
	if($result)
	{
		echo('<center> <div id="noerror"> La nueva ausencia se ha registardo correctamente </div> </center>');
		if($idcliente>=1){
				//REGISTRAR CAMBIO EN EL HISTORICO
				$usuario = $_SESSION['SESS_USERNAME'];
				$desccambio = "Creacion Ausencia";
				$tabla = "AUSENCIAS";
				$idemplhist = $idcliente;
				$query = mysql_query("SELECT LAST_INSERT_ID()");
				$idregistro = mysql_result($query, 0, 0);
				include("funciones/registrarcambio.php");
			echo ('<meta http-equiv="Refresh" content="0.1; URL=verausenciaemp.php?idempleatu='.$idcliente.'">');
		}
	} else {
		echo('<center> <div id="error"> Ha habido un error al registrar la ausencia en la BD </div> </center>');
		$observacion = $_POST['observacion'];
		}
	
	mysql_close();	
} //fin del else que comprueba si se ha seleccionado un empleado
} 
?> 
</center> 
</body>
</html>


