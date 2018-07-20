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
?>
<center>
<h2><img src="imagenes/permisosmenu.png"  alt="permisosmenu"> Administraci&oacute;n de Tipos de Solicitudes</h2>
<form method="post" action="<?=$_SERVER['PHP_SELF']?>"> 
<br>
<div id="tabs">
<button type='submit' name='modificartipo'><img src="./imagenes/editar.png" alt="modificartipo"> <strong>Modificar Tipo Solicitud</strong> </button>
<button type='submit' name='creartipo'> <img src="./imagenes/creacion.png" alt="creartipo"> <strong>A&ntilde;adir Tipo Solicitud </strong> </button>
 </form>
</div>

<?php
if(isset($_POST["modificartipo"])) 
{ 
echo('
<form method="post"/>
 <div id="error"> ADVERTENCIA: Una vez pulsado el bot&oacute;n Modificar, todos las solicitudes con el tipo seleccionado, 
 pasar&aacute;n a tener el nuevo tipo. </div>
<br><br>
<table class="tablaazul" bgcolor="white" border="1" bordercolor="#6396BB" cellpadding="4" cellspacing="0">
<tr> <td> Seleccione el Tipo a editar: </td> </tr>
</table>
<br><br>
<table class="tablaazul" bgcolor="white" border="1" bordercolor="#6396BB" cellpadding="4" cellspacing="0">
');

include("conectarbbdd.php");

 $result = mysql_query("SELECT * FROM  `t_tiposol`");
echo('<tr> <th> &nbsp </th> <th> IdTipo </th> <th> Descripci&oacute;n Actual </th> </tr> ');
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    echo('<tr><td> <input type="radio" name="idtiposol" value="'.$row[0].'"> &nbsp </td>
	<td> '.$row[0].' </td>
	<td>  '.$row[1].' </td>
	</tr>');
}
echo('
</table>
<br><br>
<table class="tablaazul" bgcolor="white" border="1" bordercolor="#6396BB" cellpadding="4" cellspacing="0">
<tr> <td> Introduzca el nuevo Valor para el Tipo: <input name="desctiposol"> </td> </tr>
</table>
<br><br>

<button type="submit" name="modtipo"> Modificar Tipo Seleccionado </button>
 </form>
');
}
?>

<?php
if(isset($_POST["modtipo"])) 
{ 
	$idtiposol=$_REQUEST['idtiposol'];
	$desctiposol=$_REQUEST['desctiposol'];
	
if (empty($idtiposol)) {
	echo ("<label id='error'> <img src='imagenes/cuidado.png'> No hay estado valido seleccionado. Contacte con el administrador. </label>");
}
elseif (empty($desctiposol)) {
	echo ("<label id='error'> <img src='imagenes/cuidado.png'> El nuevo valor para el Estado no es valido. Contacte con el administrador. </label>");
}
else {
	include("conectarbbdd.php");
	
	$result = mysql_query("UPDATE `t_tiposol` SET `desctiposol` = '$desctiposol'  WHERE `t_tiposol`.`idtiposol` = '$idtiposol'; ");
	if($result)
	{
		echo('<center> <div id="noerror"> Tipo Modificado Correctamente </div> </center>');
	} else {
		echo('<center> <div id="error"> Ha habido un error al modificar el Tipo. Contacte con el adminsitrador </div> </center>');
		}
	
	mysql_close();	
} 
} 
?> 

<?php
if(isset($_POST["creartipo"])) 
{ 
echo('
<table id="contenidoperm">
<tr> <th colspan="4"> <b> Crear Nuevo Tipo de Solicitud: </b> </th> </tr>
<tr><td>&nbsp </td></tr>
<form method="post"/>

 <tr><td colspan="4"><b>Datos del Tipo de Solicitud: </b></td></tr>
<tr><td>&nbsp</td></tr>
 <tr> 
  		  <td> <label> Nombre del Tipo de Solicitud: </label></td>
 </tr>
<tr>
   	 <td colspan="4"> <textarea cols="72" rows="1" name="desctiposol"> </textarea></td> 
</tr>
<tr>
	<td colspan="4"> <center><INPUT type="submit" name="altatipo" value="Crear Nuevo Tipo de Solicitud" size="20"> </center></td>
</tr>
 </table>
 </form>

 ');
}

if(isset($_POST["altatipo"])) 
{ 
$desctiposol=$_REQUEST['desctiposol'];
	
if (empty($desctiposol)) {
	echo ("<label id='error'> <img src='imagenes/cuidado.png'> No hay Tipo de Solicitud valido. Contacte con el administrador. </label>");
}
else {
	include("conectarbbdd.php");
	$result = mysql_query("INSERT INTO `t_tiposol` (`idtiposol`, `desctiposol`) VALUES (NULL, '$desctiposol'); ");
	if($result)
	{
		echo('<center> <div id="noerror"> Nuevo Tipo Solicitud Creada con Exito </div> </center>');
	} else {
		echo('<center> <div id="error"> Ha habido un error al crear el nuevo Tipo Solicitud. Contacte con el adminsitrador </div> </center>');
		}
	
	mysql_close();	
} 
}
?> 
<br>
</body>
</html>