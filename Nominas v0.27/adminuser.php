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
<h2>Administraci&oacute;n de usuarios y permisos</h2>

<br>
<form method="post" action="<?=$_SERVER['PHP_SELF']?>"> 
<div id="tabs">
 <?php
  if ($_SESSION['TABUSERA'] == '1'){
		echo('<button type="submit" name="nuevouser"> <img src="./imagenes/nuevouser.png" alt="nuevouser"> <strong>A&ntilde;adir Usuario</strong> </button>');
	}
 if ($_SESSION['TABUSERAPERM'] == '1'){
   echo('<button type="submit" name="buscaruser"> <img src="./imagenes/buscaruser.png" alt="buscaruser"> <strong>Buscar/Modificar Usuario</strong> </button>');
 }
 ?>
</div>
 </form>
</center>
 <br> <br><br>
 
 <?php
if(isset($_POST["nuevouser"])) 
{
	echo('<center>
	<h2> A&ntilde;adir Usuario Nuevo </h2><br>
	<form method="post"/>
	
<table class="tablaazul">
<tr> <th colspan="3"> DATOS USUARIOS </th></tr>	
<tr>
	<td rowspan="2"><img src="imagenes/usuario.png" alt="logousuario" ></td>
	<td>Nombre de Usuario</td>
	<td><input name="username" value="" ></td>
</tr>
<tr>
	<td>Contrase&ntilde;a</td>
	<td> <input type="password" name="password" value=""> </td>
</tr>
</table>
<br>
<button type="submit" name="guardaruser"> <img src="./imagenes/gorde.png"  alt="guardaruser"> <strong>Guardar Usuario</strong> </button>
</form>');

printf("<label id='error'> <img src='imagenes/cuidado.png'> La asignaci&oacute;n de permisos se realizar&aacute; una vez creado el usuario. </label> </center>");

}
?>
 <?php
if(isset($_POST["guardaruser"])) 
{
	//recoger nombre usuario y contraseña
	$username=$_REQUEST['username'];
	$password=$_REQUEST['password'];
	if (empty($username)) {
		echo ("<center><br><label id='error'> <img src='imagenes/cuidado.png'> No has escrito ningun nombre de usuario. </label></center>");
	}
	elseif(empty($password)) {
		echo ("<center><br><label id='error'> <img src='imagenes/cuidado.png'> No has escrito ningun contrase&ntilde;a para el usuario. </label></center>");
	}
	else{ //si el nombre de usuario y la contraseña no estan en blanco
	    include("conectarbbdd.php");
		//comprobar que no existe en la base de datos
		$usuarcont = mysql_query("SELECT * FROM miembros WHERE  `usuario` LIKE  '$username'");
		$numfilas=mysql_num_rows($usuarcont);
		if ($numfilas>0){
		echo('<center> <div id="error"><img src="imagenes/cuidado.png">  El usuario ya existe en la base de datos. </div> </center>');
		}
		else {
			//guardar en la base de datos
			$crearresult = mysql_query ("INSERT INTO `miembros` (`idusario`, `usuario`, `userpass`, `anotaciones`) VALUES
	   	(NULL, '$username', '$password', ' ') ; ");
			if($crearresult)
			{
				echo ("<center><br><label id='noerror'> <img src='imagenes/conexionbd.png'> El usuario se ha creado correctamente el la Base de Datos. </label></center>");
				echo ('<meta http-equiv="Refresh" content="0; URL=verdetalleuser.php?username='.$username.'">');
			} else {
				echo ("<center><br><label id='error'> <img src='imagenes/errorbd.png'> Error al crear el usuario. Contacte con el administrador. </label></center>");
				$error=mysql_error($crearresult);
				echo ('<center><br><label id="error"> El error es: '.$error.'  </label></center>');
			}
		}
		mysql_close();
	}
}
?>

 <?php
if(isset($_POST["buscaruser"])) 
{
	echo('<center>
	<h2> Buscar/Modificar Usuario </h2><br>
	<form method="post"/>
	<input name="username" value="" >
	<input type="submit" name="finduser" value="Buscar Usuario"/>
</form></center>');
}
?>

 <?php
if(isset($_POST["finduser"])) 
{
	$username=$_REQUEST['username'];
	if (empty($username)) {
		echo('<center> <h2> Buscar/Modificar Usuario </h2><br> <form method="post"/> <input name="username" value="" >
		<input type="submit" name="finduser" value="Buscar Usuario"/> </form></center>');
		echo ("<center><br><label id='error'> <img src='imagenes/cuidado.png'> No has escrito ningun nombre de usuario. </label></center>");
	}
	else{ //si el nombre de usuario no esta en blanco
			include("conectarbbdd.php");
			//contar cuandos registros hay
			$usercont = mysql_query("SELECT COUNT( * ) FROM miembros WHERE  `usuario` LIKE  '$username'");
			$total= mysql_fetch_array($usercont, MYSQL_NUM);
			echo('<center> <h2> Buscar Usuario </h2><br> <form method="post"/> <input name="username" value="'.$username.'" >
			<input type="submit" name="finduser" value="Buscar Usuario"/> </form></center>');
			if ($total[0]=='0')
			{
					echo ("<center><br><label id='error'> <img src='imagenes/cuidado.png'> El usuario introducido no existe. </label></center>");
			}
			elseif($total[0]=='1') {
				$result = mysql_query("SELECT * FROM  `miembros` WHERE  `usuario` LIKE  '$username'");
				if($result)
				{ 
					echo ('<meta http-equiv="Refresh" content="0; URL=verdetalleuser.php?username='.$username.'">');
				}
			}
			else {
					echo ("<center><br><label id='error'> <img src='imagenes/errorbd.png'> Usuarios Duplicados: Contacte con el administrador. </label></center>");
			}
	}
}
?>

<?php
if(isset($_POST["guardarpass"])) 
{
	$password=$_REQUEST['password'];
	$iduser=$_REQUEST['iduser'];
	if(empty($password)) {
		echo ("<center><br><label id='error'> <img src='imagenes/cuidado.png'> No has escrito ninguna contrase&ntilde;a para el usuario. </label></center>");
	}
	else{ //si la contraseña no esta en blanco guardala
		include("conectarbbdd.php");
		$resultquery="UPDATE  `miembros` SET  `userpass` =  '$password' WHERE  `miembros`.`idusario` =$iduser";
		$result=mysql_query($resultquery);
		if($result)
		{
			echo ("<center><br><label id='noerror'> <img src='imagenes/conexionbd.png'> Contrase&ntilde;a cambiada con &eacute;xito </label></center>");
		} else {
			echo ("<center><br><label id='error'> <img src='imagenes/errorbd.png'> Fallo al cambiar la Contrase&ntilde;a . Contacte con el administrador. </label></center>");
		}
		mysql_close();
	}
}
?>

</body>
</html>