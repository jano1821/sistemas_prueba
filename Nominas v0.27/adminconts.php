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

<h2><img src="imagenes/permisosmenu.png"  alt="permisosmenu"> Administraci&oacute;n de Estados de los Contratos</h2>
<form method="post" action="<?=$_SERVER['PHP_SELF']?>"> 
<br>
<div id="tabs">
<button type='submit' name='modificarestado'><img src="./imagenes/editar.png" alt="modificarestado"> <strong>Modificar Estado</strong> </button>
<button type='submit' name='crearestado'> <img src="./imagenes/creacion.png" alt="crearestado"> <strong>A&ntilde;adir Estado </strong> </button>
 </form>
</div>
<?php
if(isset($_POST["modificarestado"])) 
{ 
echo('
<form method="post"/>
 <div id="error"> ADVERTENCIA: Una vez pulsado el bot&oacute;n Modificar, todos los Contratos con el estado seleccionado, 
 pasar&aacute;n a tener el nuevo estado. </div>
<br><br>
<table class="tablaazul" bgcolor="white" border="1" bordercolor="#6396BB" cellpadding="4" cellspacing="0">
<tr> <td> Seleccione el estado a editar: </td> </tr>
</table>
<br><br>
<table class="tablaazul" bgcolor="white" border="1" bordercolor="#6396BB" cellpadding="4" cellspacing="0">
');

include("conectarbbdd.php");

 $result = mysql_query("SELECT * FROM  `t_estadoscont`");
echo('<tr> <th> &nbsp </th> <th> IdEstado</th> <th> Descripci&oacute;n Actual </th> </tr> ');
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    echo('<tr><td> <input type="radio" name="idestado" value="'.$row[0].'"> &nbsp </td>
	<td> '.$row[0].' </td>
	<td>  '.$row[1].' </td>
	</tr>');
}
echo('
</table>
<br><br>
<table class="tablaazul" bgcolor="white" border="1" bordercolor="#6396BB" cellpadding="4" cellspacing="0">
<tr> <td> Introduzca el nuevo Valor para el Estado: <input name="nombreestado"> </td> </tr>
</table>
<br><br>

<button type="submit" name="modestado"> Modificar Estado Seleccionado </button>
</form>
');
}
if(isset($_POST["modestado"])) 
{ 
	$idestado=$_REQUEST['idestado'];
	$nombreestado=$_REQUEST['nombreestado'];
	
if (empty($idestado)) {
	echo ("<label id='error'> <img src='imagenes/cuidado.png'> No hay estado valido seleccionado. Contacte con el administrador. </label>");
}
elseif (empty($nombreestado)) {
	echo ("<label id='error'> <img src='imagenes/cuidado.png'> El nuevo valor para el Estado no es valido. Contacte con el administrador. </label>");
}
else {
	include("conectarbbdd.php");
	
	$result = mysql_query("UPDATE `t_estadoscont` SET `descestado` = '$nombreestado'  WHERE `t_estadoscont`.`idestado` = '$idestado'; ");
	if($result)
	{
		echo('<center> <div id="noerror"> Estado Modificado Correctamente </div> </center>');
	} else {
		echo('<center> <div id="error"> Ha habido un error al modificar el Estado. Contacte con el adminsitrador </div> </center>');
		}
	
	mysql_close();	
} 
} 

if(isset($_POST["crearestado"])) 
{ 
echo('
<table id="contenidoperm">
<tr> <th colspan="4"> <b> Crear Nuevo Estado del Contratos: </b> </th> </tr>
<tr><td>&nbsp </td></tr>
<form method="post"/>

 <tr><td colspan="4"><b>Datos del Estado del Contratos: </b></td></tr>
<tr><td>&nbsp</td></tr>
 <tr> 
  		  <td> <label> Nombre del Estado del Contratos: </label></td>
 </tr>
<tr>
   	 <td colspan="4"> <textarea cols="72" rows="1" name="descestado"> </textarea></td> 
</tr>
<tr>
	<td colspan="4"> <center><INPUT type="submit" name="altaestado" value="Crear Nuevo Estado del Contratos" size="20"> </center></td>
</tr>
 </table>
 </form>

 ');
}

if(isset($_POST["altaestado"])) 
{ 
$descestado=$_REQUEST['descestado'];
	
if (empty($descestado)) {
	echo ("<label id='error'> <img src='imagenes/cuidado.png'> No hay Estado valido. Contacte con el administrador. </label>");
}
else {
	include("conectarbbdd.php");
	$result = mysql_query("INSERT INTO `t_estadoscont` (`idestado`, `descestado`) VALUES (NULL, '$descestado'); ");
	if($result)
	{
		echo('<center> <div id="noerror"> Nuevo Estado Creado con Exito </div> </center>');
	} else {
		echo('<center> <div id="error"> Ha habido un error al crear el nuevo estado. Contacte con el adminsitrador </div> </center>');
		}
	
	mysql_close();	
} 
}
?> 
<br>
</body>
</html>