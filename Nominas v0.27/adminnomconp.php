<?php
	require_once('login/comprobarweb.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title> Sitema de Empleados y Nominas Online </title>
<link rel=StyleSheet href="estilos.css" TYPE="text/css">
<link rel=StyleSheet href="menu/css/nav.css" TYPE="text/css">
</head>

<body>
<?php
	include("menu/menu.php");
	include("funciones/crear_dropdown.php");
?>
<center>

<h2><img src="imagenes/permisosmenu.png"  alt="permisosmenu"> Administraci&oacute;n de Conceptos de las Nominas</h2>
<form method="post" action="<?=$_SERVER['PHP_SELF']?>"> 
<br>
<div id="tabs">
<button type='submit' name='modificarconcepto'><img src="./imagenes/editar.png" alt="modificarconcepto"> <strong>Modificar Concepto Nomina</strong> </button>
<button type='submit' name='crearconcepto'> <img src="./imagenes/creacion.png" alt="crearconcepto"> <strong>A&ntilde;adir Concepto Nomina </strong> </button>
 </form>
</div>
<?php
if(isset($_POST["modificarconcepto"])) 
{ 
echo('
<form method="post"/>
 <div id="error"> ADVERTENCIA: Una vez pulsado el bot&oacute;n Modificar, todos las Nominas con el concepto seleccionado, 
 pasar&aacute;n a tener el nuevo estado. </div>
<br>
<table class="tablaazul" bgcolor="white" border="1" bordercolor="#6396BB" cellpadding="4" cellspacing="0">
<tr> <td> Seleccione el Concepto a editar: </td> </tr>
</table>
<br>
<table class="tablaazul" bgcolor="white" border="1" bordercolor="#6396BB" cellpadding="4" cellspacing="0">
');

include("conectarbbdd.php");

 $result = mysql_query("SELECT * FROM  `t_conceptos`");
echo('<tr> <th> &nbsp </th> <th> IdConcepto </th> <th> Descripci&oacute;n Concepto Actual </th> <th> Tipo Concepto Actual </th> </tr> ');
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    echo('<tr><td> <input type="radio" name="idconcepto" value="'.$row[0].'"> &nbsp </td>
	<td> '.$row[0].' </td>
	<td>  '.$row[1].' </td>');
	if ($row[2]=='0'){
		echo('<td>  DEVENGO </td>');
	}
	else {
		echo('<td>  DEDUCCION </td>');
	}
	echo('</tr>');
}
echo('
</table>
<br><br>
<table class="tablaazul" bgcolor="white" border="1" bordercolor="#6396BB" cellpadding="4" cellspacing="0">
<tr> <td> Introduzca el nuevo Valor para el Concepto: <input name="nuevoconcepto"> </td> </tr>
</table>
<br><br>

<button type="submit" name="modconcepto"> Modificar Concepto Seleccionado </button>
</form>
');
}
if(isset($_POST["modconcepto"])) 
{ 
	$idconcepto=$_REQUEST['idconcepto'];
	$nuevoconcepto=$_REQUEST['nuevoconcepto'];
	
if (empty($idconcepto)) {
	echo ("<label id='error'> <img src='imagenes/cuidado.png'> No hay Concepto valido seleccionado. Contacte con el administrador. </label>");
}
elseif (empty($nuevoconcepto)) {
	echo ("<label id='error'> <img src='imagenes/cuidado.png'> El nuevo valor para el Concepto no es valido. Contacte con el administrador. </label>");
}
else {
	include("conectarbbdd.php");
	
	$result = mysql_query("UPDATE `t_conceptos` SET  `denominacion` =  '$nuevoconcepto'  WHERE  `t_conceptos`.`idconcepto` = '$idconcepto'; ");
	if($result)
	{
		echo('<center> <div id="noerror"> Concepto Modificado Correctamente </div> </center>');
	} else {
		echo('<center> <div id="error"> Ha habido un error al modificar el Concepto. Contacte con el adminsitrador </div> </center>');
		}
	
	mysql_close();	
} 
} 

if(isset($_POST["crearconcepto"])) 
{ 
echo('
<table id="contenidoperm">
<tr> <th colspan="4"> <b> Crear Nuevo Concepto para las Nominas: </b> </th> </tr>
<tr><td>&nbsp </td></tr>
<form method="post"/>

 <tr><td colspan="4"><b>Datos del Nuevo Concepto para las Nominas: </b></td></tr>
<tr><td>&nbsp</td></tr>
 <tr> 
  		  <td> <label> Nombre del Concepto de Nomina: </label></td>
 </tr>
<tr>
   	 <td colspan="4"> <textarea cols="72" rows="1" name="nuevoconcepto"> </textarea></td> 
</tr> <tr> <td> Escoge el Tipo de Concepto:  ');
    $name = 'tipoconcepto';
    $options = array('Devengo', 'Deduccion');
	 //opcion seleccionada en el dropdown
	 $selected = $_POST['tipoconcepto'];
	 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
	 echo crear_dropdown( $name, $options, $selected );
echo('</td> </tr> <tr></tr>
<tr>
	<td colspan="4"> <center><INPUT type="submit" name="altaconcepto" value="Crear Nuevo Concepto de Nomina" size="20"> </center></td>
</tr>

 </table>
 </form>

 ');
}

if(isset($_POST["altaconcepto"])) 
{ 
$nuevoconcepto=$_REQUEST['nuevoconcepto'];
$tipoconcepto=$_REQUEST['tipoconcepto'];	
	
if (empty($nuevoconcepto)) {
	echo ("<label id='error'> <img src='imagenes/cuidado.png'> No hay Concepto valido. Contacte con el administrador. </label>");
}
else {
	include("conectarbbdd.php");
	$result = mysql_query("INSERT INTO `t_conceptos` (`idconcepto` , `denominacion` , `tipoconcepto`) VALUES ( NULL ,  '$nuevoconcepto',  '$tipoconcepto' ); ");
	if($result)
	{
		echo('<center> <div id="noerror"> Nuevo Concepto para Nomina Creado con Exito </div> </center>');
	} else {
		echo('<center> <div id="error"> Ha habido un error al crear el nuevo Concepto. Contacte con el adminsitrador </div> </center>');
		}
	
	mysql_close();	
} 
}
?> 
<br>
</body>
</html>