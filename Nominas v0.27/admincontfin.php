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

<h2><img src="imagenes/permisosmenu.png"  alt="permisosmenu"> Administraci&oacute;n de los Motivos Fin de los Contratos</h2>
<form method="post" action="<?=$_SERVER['PHP_SELF']?>"> 
<br>
<div id="tabs">
<button type='submit' name='modificarmotivo'><img src="./imagenes/editar.png" alt="modificarmotivo"> <strong>Modificar Motivos Fin de Contratos</strong> </button>
<button type='submit' name='crearmotivo'> <img src="./imagenes/creacion.png" alt="crearmotivo"> <strong>A&ntilde;adir Motivo Fin de Contrato </strong> </button>
 </form>
</div>
<?php
if(isset($_POST["modificarmotivo"])) 
{ 
echo('
<form method="post"/>
 <div id="error"> ADVERTENCIA: Una vez pulsado el bot&oacute;n Modificar, todos los Contratos con el Motivo Fin seleccionado, 
 pasar&aacute;n a tener el nuevo estado. </div>
<br><br>
<table class="tablaazul" bgcolor="white" border="1" bordercolor="#6396BB" cellpadding="4" cellspacing="0">
<tr> <td> Seleccione el estado a editar: </td> </tr>
</table>
<br><br>
<table class="tablaazul" bgcolor="white" border="1" bordercolor="#6396BB" cellpadding="4" cellspacing="0">
');

include("conectarbbdd.php");

 $result = mysql_query("SELECT * FROM  `t_fincont`");
echo('<tr> <th> &nbsp </th> <th> IdMotivo </th> <th> Descripci&oacute;n Actual del Motivo Fin </th> </tr> ');
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    echo('<tr><td> <input type="radio" name="idmotivofin" value="'.$row[0].'"> &nbsp </td>
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

<button type="submit" name="modmotivo"> Modificar Motivo Fin Seleccionado </button>
</form>
');
}
if(isset($_POST["modmotivo"])) 
{ 
	$idmotivofin=$_REQUEST['idmotivofin'];
	$nombreestado=$_REQUEST['nombreestado'];
	
if (empty($idmotivofin)) {
	echo ("<label id='error'> <img src='imagenes/cuidado.png'> No hay estado valido seleccionado. Contacte con el administrador. </label>");
}
elseif (empty($nombreestado)) {
	echo ("<label id='error'> <img src='imagenes/cuidado.png'> El nuevo valor para el Estado no es valido. Contacte con el administrador. </label>");
}
else {
	include("conectarbbdd.php");
	
	$result = mysql_query("UPDATE `t_fincont` SET `descmotivo` = '$nombreestado'  WHERE `t_fincont`.`idmotivofin` = '$idmotivofin'; ");
	if($result)
	{
		echo('<center> <div id="noerror"> Estado Modificado Correctamente </div> </center>');
	} else {
		echo('<center> <div id="error"> Ha habido un error al modificar el Estado. Contacte con el adminsitrador </div> </center>');
		}
	
	mysql_close();	
} 
} 

if(isset($_POST["crearmotivo"])) 
{ 
echo('
<table id="contenidoperm">
<tr> <th colspan="4"> <b> Crear Nuevo Motivo Fin de Contratos: </b> </th> </tr>
<tr><td>&nbsp </td></tr>
<form method="post"/>

 <tr><td colspan="4"><b>Datos del Motivo Fin de Contratos: </b></td></tr>
<tr><td>&nbsp</td></tr>
 <tr> 
  		  <td> <label> Nombre del Motivo Fin de Contratos: </label></td>
 </tr>
<tr>
   	 <td colspan="4"> <textarea cols="72" rows="1" name="descmotivo"> </textarea></td> 
</tr>
<tr>
	<td colspan="4"> <center><INPUT type="submit" name="altamotivo" value="Crear Nuevo Motivo Fin del Contrato" size="20"> </center></td>
</tr>
 </table>
 </form>

 ');
}

if(isset($_POST["altamotivo"])) 
{ 
$descmotivo=$_REQUEST['descmotivo'];
	
if (empty($descmotivo)) {
	echo ("<label id='error'> <img src='imagenes/cuidado.png'> No hay Estado valido. Contacte con el administrador. </label>");
}
else {
	include("conectarbbdd.php");
	$result = mysql_query("INSERT INTO `t_fincont` (`idmotivofin`, `descmotivo`) VALUES (NULL, '$descmotivo'); ");
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