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
<form method="post" name="formsol" action="<?=$_SERVER['PHP_SELF']?>"> 
<div id="contenidoperm">
<h1>Crear nueva Solicitud </h1>
<table>
 <tr><td colspan="6"><b>DATOS DEL EMPLEADO: </b></td></tr>
 <tr><td>
<?php
$datoempl=" ";
$datoempl= $_GET['idempleatu'];
echo('<label for="person3"> IdEmpleado </label> <label class="asteriskred"> * </label> </td> <td> <input name="idempleado" id="idcliente" class="requerido" value="'.$datoempl.'" readonly="true"/> </td>');
?>
<td><a href="javascript:abrir_popup('popup_cltsol.php')"><img src='./imagenes/buscar2.png'></a> </td>
</tr>
<tr><td> <label> &nbsp </label> </td></tr>
 <tr><td colspan="6"><b>DATOS DE LA SOLICITUD: </b></td></tr>
<?php
//crear array
$options = array();
$options[] = '&nbsp';
include("conectarbbdd.php");
$result = mysql_query("SELECT * FROM  `t_tiposol`");
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    $options[] = $row[1];
}
printf("<td><label> Tipo de Solicitud </label> </td> <td>");
    //nombre del dropdown
    $name = 'tipopermiso';
	 //opcion seleccionada en el dropdown
	$selected = $_POST['tipopermiso'];
	 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
	 echo crear_dropdown( $name, $options, $selected );
	 	 printf("</td></tr>")
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
</tr><tr>
<tr><td> <label> &nbsp </label> </td></tr>
<td><label for='person3'> Motivo de la solicitud: </label> </td> 
<td colspan="6"> <input name='motivo' size="62" value="<?php echo $_POST['motivo']?>"></td>
</tr>
<tr><td> <label> &nbsp </label> </td></tr>
<tr>
<td><label for='person3'> Fecha Aprobado </label> 
</td> 
<td>  
<?php
$hoy = date("Y-m-j");
echo('<input name="fechaaprobado" value="'.$hoy.'" />');
?>
</td>
<td>
<A HREF="#" onClick="cal.select(document.forms['formsol'].fechaaprobado,'anchor3','yyyy/MM/dd'); return false;"  NAME="anchor3" ID="anchor3"><img src='./imagenes/calendario.gif'></A>
</td>
<?php
printf("<td><label> Aprobado </label> </td> <td>");
    //nombre del dropdown
    $name = 'aprobado';
    //opciones que tendra el dropdown
	 $options = array( '', 'Si', 'No');
	 //opcion seleccionada en el dropdown
	 $selected = $_POST['aprobado'];
	 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
	 echo crear_dropdown( $name, $options, $selected );
	 printf("</td></tr>");
?>
 <tr> 
  		  <td colspan="6"> Observaciones: </td>
   </tr>
<tr>
   	 <td rowspan='4' colspan='6'> <textarea cols='72' rows='5' name='observacion'><?php echo($_REQUEST['observacion']); ?></textarea></td> 
   </tr>
</table>

 <p><INPUT type="submit" name="crearsolicitud" value="Crear Nueva Solicitud" size="20"> </p> <br>
  </div>
 </form>
 
<?php
if(isset($_POST["crearsolicitud"])) 
{ 
	$idcliente=$_REQUEST['idempleado'];
	$observacion=$_REQUEST['observacion'];
	$aprobado=$_REQUEST['aprobado'];
	$motivo=$_REQUEST['motivo'];
	$tipopermiso=$_REQUEST['tipopermiso'];
	$fechafin=$_REQUEST['fechafin'];
	$fechainicio=$_REQUEST['fechainicio'];
	$fechaaprobado=$_REQUEST['fechaaprobado'];
	
if (empty($idcliente)) {
	echo ("<label id='error'> <img src='imagenes/cuidado.png'> No has seleccionado ningun empleado </label>");
	$observacion = $_POST['observacion'];
}
elseif (empty($tipopermiso)) {
	echo ("<label id='error'> <img src='imagenes/cuidado.png'> No has seleccionado nig&uacute;n tipo de permiso </label>");
	$observacion = $_POST['observacion'];
}
else {
	include("conectarbbdd.php");
	
	$result = mysql_query("
		INSERT INTO `solicitudes` (`IdSolicitud`, `IdEmp`, `Tipo`, `FechaInicio`, `FechaFin`,
		 `Motivo`, `Aprobado`, `FechaAprobado`, `Anotaciones`) VALUES 
		 (NULL, '$idcliente', '$tipopermiso', '$fechainicio', '$fechafin', '$motivo',
		  '$aprobado', '$fechaaprobado', '$observacion');
	");
	if($result)
	{
		echo('<center> <div id="noerror"> La nueva solicitud se ha creado correctamente </div> </center>');
		if($idcliente>=1){
				//REGISTRAR CAMBIO EN EL HISTORICO
				$usuario = $_SESSION['SESS_USERNAME'];
				$desccambio = "Creacion Solicitud";
				$tabla = "SOLICITUDES";
				$idemplhist = $idcliente;
				$query = mysql_query("SELECT LAST_INSERT_ID()");
				$idregistro = mysql_result($query, 0, 0);
				include("funciones/registrarcambio.php");
			echo ('<meta http-equiv="Refresh" content="0.1; URL=versolicitudemp.php?idempleatu='.$idcliente.'">');
		}
	} else {
		echo('<center> <div id="error"> Ha habido un error al crear la solicitud en la BD </div> </center>');
		$observacion = $_POST['observacion'];
		}
	
	mysql_close();	
} //fin del else que comprueba si se ha seleccionado un empleado
} 
?> 
</center> 
</body>
</html>


