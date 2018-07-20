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
<br>
<h2>Bienvenido, </h2> <br>
<form method="post" action="<?php echo $PHP_SELF;?>">
<table>
<tr>
<td rowspan="3"><img src="imagenes/usuario.png" alt="logousuario" ></td>
<td>IdUsuario: </td>
<td><?php echo('<input name="iduser" value="'.$_SESSION['SESS_MEMBER_ID'].'" readonly="true" >'); ?></td>
<td></td>
</tr>
<tr>
<td>Nombre de Usuario</td>
<td><?php echo('<input value="'.$_SESSION['SESS_USERNAME'].'" readonly="true">'); ?></td>
<td></td>
</tr>
<tr>
<td>Contrase&ntilde;a</td>
<td> <input type="password" name="password" value="password"> </td>
<td><input type="submit" value="Cambiar Password" name="guardarpass"></td>
</tr>
<tr><td></td></tr>
<tr>
<td colspan="4"> Notificaciones </td>
</tr>
<tr>
<td colspan="4"> <textarea cols='62' rows='4' readonly>  <?php echo($_SESSION['NOTIFICACIONES']); ?> </textarea> </td>
</tr>
</table>
</form>
<?php
if(isset($_POST["guardarpass"])) 
{ 
	//RECOGER DATOS DE LAS VARIABLES
	$password=$_REQUEST['password'];
	$iduser=$_REQUEST['iduser'];
	include("conectarbbdd.php");
	$resultquery="UPDATE  `miembros` SET  `userpass` =  '$password' WHERE  `miembros`.`idusario` =$iduser";
	$result=mysql_query($resultquery);
	echo('<div id="noerror"> Password cambiada correctamente </div>');
}
?>
</center>
</body>
</html>