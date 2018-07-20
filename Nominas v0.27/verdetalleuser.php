<?php
	require_once('login/comprobarweb.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title> Sitema de Empleados y Nominas Online </title>
<link rel=StyleSheet href="estilos.css" TYPE="text/css">
<link rel=StyleSheet href="menu/css/nav.css" TYPE="text/css">

<script language="Javascript">
function confirmDel()
{
var agree=confirm("Realmente desea eliminarlo ? ");
if (agree) {
	document.formulario.submitted.value='0';
	}
else{
	document.formulario.submitted.value='1';
	}
}

</script>

</head>
<body>

<form method="post" name='formulario' action="<?=$_SERVER['PHP_SELF']?>">
<?php
	include("menu/menu.php");
	include("funciones/crear_dropdown.php");
	$username=$_REQUEST['username'];
?>

 <script language="JavaScript">
function abrir_popup(){
window.open('popup_copyuser.php?iduser=<?php echo $username; ?>',"ventana1","width=700, height=370, directories=no ,scrollbars=no, menubar=no, location=no, resizable=no")
}
</script>

<br>
<?php include("funciones/menu_usuario.php"); ?>
<div id="contenido">
<?php include("menu/botonerauser.php"); ?>
<div id="principal">
<?php
	if (empty($username)) {
		echo ("<center><br><label id='error'> <img src='imagenes/cuidado.png'> No has escrito ningun nombre de usuario. </label></center>");
	}
	else{
		
			include("conectarbbdd.php");
			//contar cuandos registros hay
			$usercont = mysql_query("SELECT COUNT( * ) FROM miembros WHERE  `usuario` LIKE  '$username'");
			$total= mysql_fetch_array($usercont, MYSQL_NUM);
			if ($total[0]=='0')
			{
					echo ("<center><br><label id='error'> <img src='imagenes/cuidado.png'> El usuario introducido no existe. </label></center>");
					exit();
			}
			elseif($total[0]=='1') {
				$result = mysql_query("SELECT * FROM  `miembros` WHERE  `usuario` LIKE  '$username'");
				if($result)
				{ 
					echo('<br><table> <tr>');
					while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
					//DATOS USUARIO
					echo('<td> Login </td> <td><input name="namelogin" id="namelogin" value="'.$row[1].'" readonly>
					<input type="hidden" name="iduser" id="iduser" value="'.$row[0].'"> </td>');
					$iduservar=$row[0];
					echo('<td> Estado </td><td> <select disabled="true">  <option selected>Activo</option> <option>Bloqueado</option> </select></td></tr>');
					echo('<tr><td> Anotaciones </td><td> <textarea cols="35" name="anotaciones" id="anotaciones">'.$row[3].'</textarea></td>');
					echo('<td> Password </td>');
					echo('<td> <input type="password" name="password" id="password" value="12345"> </td> </tr>
					<tr><td> &nbsp; </td> <td> &nbsp; </td> <td> &nbsp; </td> <td> <button type="submit" name="guardarpass" id="guardarpass"> Cambiar Contraseña </button> </td></tr>');
					echo('<tr><td> &nbsp; </td></tr>');
					//DATOS PERMISOS
					echo('<tr><td colspan="4"> Permisos </td>  </tr> <tr> <td colspan="3" rowspan="5">');
					echo('<table id="tablahover100">');
					echo('<tr> <th> &nbsp; </th> <th> CodPermiso </th> <th width="100%"> Descripcion de Permiso </th> </tr>');
						//cargar todos los tipos de permisos
						$options2 = array();
						$descpermiso = array();
						$sqltipoperm="SELECT * FROM  `t_tipoperm`";
						$resultipo=mysql_query($sqltipoperm);
						while ($tpermiso = mysql_fetch_array($resultipo, MYSQL_NUM)) {
							//guardar en un array todos los tipos de permisos
								$options2[]= $tpermiso[1];
								$descpermiso[]= $tpermiso[2];
						}
						//incluir permiso inicial de acceso (no borrable)
						echo('<tr><td> <input type="radio" name="iddefault" disabled="true"/> &nbsp </td>');
						echo('<td> DEFECTO </td>');
						echo('<td> Permiso de Acceso Al Sistema (Defecto) </td></tr>');
						// cargar permisos del usuario
						$sqlperm="SELECT * FROM  `permisos` WHERE  `idmiembro` LIKE  '$iduservar'";
						$resulperm=mysql_query($sqlperm);
						while ($miembro = mysql_fetch_array($resulperm, MYSQL_NUM)) {
							echo('<tr><td> <input type="radio" name="idmpermiso" value="'.$miembro[0].'"/> &nbsp </td>');
							//echo('<td>'.$miembro[0].'</td>');
							echo('<td>'.$options2[$miembro[2]-1].'</td>');
							echo('<td width="100%">'.$descpermiso[$miembro[2]-1].'</td></tr>');
						}
					echo('</table>');
					echo('</td><td>');
					//nombre del dropdown
					$name2 = 'idpermdropdown';
					//opcion seleccionada en el dropdown
					//crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
					echo crear_dropdown( $name2, $descpermiso, $selected2 );
					echo('</td></tr>');
					echo('<tr><td>');
					echo('<input type="submit" name="agregarperm" value="Agregar Permiso al Usuario">');
					echo('</td></tr>');
					echo('<tr><td>');
					echo('<input type="submit" name="borrarperm" value="Borrar Permiso de Usuario"/>');
					echo('</td></tr>'); 
					echo('<tr><td>');
					echo('<input type="submit" name="resetperm" value="Eliminar Todos los Permisos"/>');
					echo('</td></tr>');
					echo('</table><br>');
					}
				}
			}
			
	}
?>


<?php
if(isset($_POST["guardarpass"])) 
{
	$password=$_REQUEST['password'];
	$iduser=$_REQUEST['iduser'];
	$namelogin=$_REQUEST['namelogin'];
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
	echo ('<meta http-equiv="Refresh" content="0.1; URL=verdetalleuser.php?username='.$namelogin.'">');
}

if(isset($_POST["borrarperm"])) 
{
	$idmpermiso=$_REQUEST['idmpermiso'];
	$namelogin=$_REQUEST['namelogin'];
	if (empty($idmpermiso)) {
		echo ("<label id='error'> <img src='imagenes/cuidado.png'> No has seleccionado ningun permiso. Contacte con el administrador. </label>");
	}
	else {
		include("conectarbbdd.php");
		$result = mysql_query("DELETE FROM `permisos` WHERE `idpermiso` = '$idmpermiso'; ");
	if($result)
	{
		echo('<center> <div id="noerror"> Permiso Borrado con Exito </div> </center>');
				echo ('<meta http-equiv="Refresh" content="0.1; URL=verdetalleuser.php?username='.$namelogin.'">');
	} else {
		echo('<center> <div id="error"> Ha habido un error al borrar el permiso seleccionado. Contacte con el adminsitrador </div> </center>');
	}
		mysql_close();	
	} 
}
if(isset($_POST["agregarperm"])) 
{
	$idpermdropdown=$_REQUEST['idpermdropdown']+1;
	$iduser=$_REQUEST['iduser'];
	$namelogin=$_REQUEST['namelogin'];
		if (empty($idpermdropdown)) {
		echo ("<label id='error'> <img src='imagenes/cuidado.png'> No has seleccionado ningun permiso. Contacte con el administrador. </label>");
	}
	else {
		include("conectarbbdd.php");
		$result = mysql_query("INSERT INTO  `permisos` (`idpermiso` , `idmiembro` , `idtipo`) VALUES (NULL ,  '$iduser',  '$idpermdropdown'); ");
	if($result)
	{
		echo('<center> <div id="noerror"> Nuevo Permiso Agregado con Exito </div> </center>');
		echo ('<meta http-equiv="Refresh" content="0.1; URL=verdetalleuser.php?username='.$namelogin.'">');
	} else {
		echo('<center> <div id="error"> Ha habido un error al agregar el permiso seleccionado. Contacte con el adminsitrador </div> </center>');
	}
		mysql_close();	
	} 
}

if(isset($_POST["actualizar"])) 
{ 
	$namelogin=$_REQUEST['namelogin'];
	echo ('<meta http-equiv="Refresh" content="0.1; URL=verdetalleuser.php?username='.$namelogin.'">');
}

if(isset($_POST["guardar"])) 
{ 
	$iduser=$_REQUEST['iduser'];
	$namelogin=$_REQUEST['namelogin'];
	$anotaciones=$_REQUEST['anotaciones'];
	include("conectarbbdd.php");
	$resultquery="UPDATE  `miembros` SET  `anotaciones` =  '$anotaciones' WHERE  `miembros`.`idusario` =$iduser";
	$result=mysql_query($resultquery);
	if($result)
	{
		echo ("<center><br><label id='noerror'> <img src='imagenes/conexionbd.png'> Cambio Realizado con &eacute;xito </label></center>");
	} else {
		echo ("<center><br><label id='error'> <img src='imagenes/errorbd.png'> Fallo al realizar el cambio . Contacte con el administrador. </label></center>");
	}
		mysql_close();
	echo ('<meta http-equiv="Refresh" content="0.1; URL=verdetalleuser.php?username='.$namelogin.'">');
}

if(isset($_POST["copyuser"])) 
{ 
	$namelogin=$_REQUEST['namelogin'];
	echo ('<meta http-equiv="Refresh" content="0.1; URL=verdetalleuser.php?username='.$namelogin.'">');
}

if(isset($_POST["resetperm"])) 
{ 
	$iduser=$_REQUEST['iduser'];
	$namelogin=$_REQUEST['namelogin'];
	include("conectarbbdd.php");
	//buscar y eliminar por idmienbro
	$sqlperm="SELECT * FROM  `permisos` WHERE  `idmiembro` LIKE  '$iduser'";
	echo($sqlperm);
	$resulperm=mysql_query($sqlperm);
	while ($miembro = mysql_fetch_array($resulperm, MYSQL_NUM)) {
		$result = "DELETE FROM `permisos` WHERE `idpermiso` = '$miembro[0]'; ";
		echo($result);
		$delresult=mysql_query($result);
	}
	echo ('<meta http-equiv="Refresh" content="0.1; URL=verdetalleuser.php?username='.$namelogin.'">');
}

if(isset($_POST["borraruser"])) 
{ 
	$submitted=$_REQUEST['submitted'];
	$namelogin=$_REQUEST['namelogin'];
	if ($submitted==1){
		echo ('<meta http-equiv="Refresh" content="0; URL=verdetalleuser.php?username='.$namelogin.'">');
	}
	else 
	{
	include("conectarbbdd.php");
	$result = mysql_query("DELETE FROM `miembros` WHERE `usuario` LIKE '$namelogin'");
	echo ('<meta http-equiv="Refresh" content="0; URL=verdetalleuser.php">');
	}
}

?>
</div>
</div>
</form>
</body>
</html>