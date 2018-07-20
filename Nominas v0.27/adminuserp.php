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
<br>
<h2><img src="imagenes/permisosmenu.png"  alt="permisosmenu"> Administraci&oacute;n de Permisos de Usuarios</h2>

<br>
<form method="post" action="<?=$_SERVER['PHP_SELF']?>">   
	<form method="post"/>
	Introducir Usuario: <input name="username" value="" >
	<input type="submit" name="finduser" value="Buscar Usuario"/>
</form>

 <?php
if(isset($_POST["finduser"])) 
{
	$username=$_REQUEST['username'];
	if (empty($username)) {
		echo ("<center><br><label id='error'> <img src='imagenes/cuidado.png'> No has escrito ningun nombre de usuario. </label></center>");
	}
	else{ //si el nombre de usuario no esta en blanco
			include("conectarbbdd.php");
			//contar cuandos registros hay
			$usercont = mysql_query("SELECT COUNT( * ) FROM miembros WHERE  `usuario` LIKE  '$username'");
			$total= mysql_fetch_array($usercont, MYSQL_NUM);
			if ($total[0]=='0')
			{
					echo ("<center><br><label id='error'> <img src='imagenes/cuidado.png'> El usuario introducido no existe. </label></center>");
			}
			elseif($total[0]=='1') {
				$result = mysql_query("SELECT * FROM  `miembros` WHERE  `usuario` LIKE  '$username'");
				if($result)
				{ 
					echo('<form method="post"/>');
					echo('<center><form method="post"/><hr><table class="tablaazul"><tr> <th colspan="4"> Datos del Usuario: </th></tr>	
					<tr>');
					while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
					echo('<td>IdUsuario: </td> <td><input name="iduser" value="'.$row[0].'" readonly="true"> </td>
					<td></td> </tr> <tr> <td>Nombre de Usuario</td>
					<td><input name="nameuser" value="'.$row[1].'" readonly="true"> </td> <td></td> </tr> <tr>');
					$iduservar=$row[0];

					}
					echo('</td></tr> </table></center>');
					//Cargar Permisos de los que dispone el usuario
					echo('<table class="tablaazul"> <tr> <th colspan="4"> Permisos de Usuario </th> </tr>');
					echo('<tr> <th> &nbsp; </th> <th> IdPermiso </th> <th> CodigoPermiso </th> <th> Descripcion de Permiso </th> </tr>');
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
					// cargar permisos del usuario
					$sqlperm="SELECT * FROM  `permisos` WHERE  `idmiembro` LIKE  '$iduservar'";
					$resulperm=mysql_query($sqlperm);
					while ($miembro = mysql_fetch_array($resulperm, MYSQL_NUM)) {
						echo('<tr><td> <input type="radio" name="idmpermiso" value="'.$miembro[0].'"> &nbsp </td>');
						echo('<td>'.$miembro[0].'</td>');
						echo('<td>'.$options2[$miembro[2]-1].'</td>');
						echo('<td>'.$descpermiso[$miembro[2]-1].'</td></tr>');
					}
					echo('</table><br>');
					echo('<input type="submit" name="borrarperm" value="Borrar Permiso de Usuario"/><br>');
					//funcion de agregar permisos
					printf("<br><label> Permisos Existentes: </label>");
					//nombre del dropdown
					$name2 = 'idpermdropdown';
					//opcion seleccionada en el dropdown
					//crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
					echo crear_dropdown( $name2, $descpermiso, $selected2 );
					echo('<input type="submit" name="agregarperm" value="Agregar Permiso al Usuario"/ <br><br><br>');
					echo('</form>');
				}
			}
			else {
					echo ("<center><br><label id='error'> <img src='imagenes/errorbd.png'> Usuarios Duplicados: Contacte con el administrador. </label></center>");
			}
	}
}
if(isset($_POST["borrarperm"])) 
{
	$idmpermiso=$_REQUEST['idmpermiso'];
	if (empty($idmpermiso)) {
		echo ("<label id='error'> <img src='imagenes/cuidado.png'> No has seleccionado ningun permiso. Contacte con el administrador. </label>");
	}
	else {
		include("conectarbbdd.php");
		$result = mysql_query("DELETE FROM `permisos` WHERE `idpermiso` = '$idmpermiso'; ");
	if($result)
	{
		echo('<center> <div id="noerror"> Permiso Borrado con Exito </div> </center>');
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
		if (empty($idpermdropdown)) {
		echo ("<label id='error'> <img src='imagenes/cuidado.png'> No has seleccionado ningun permiso. Contacte con el administrador. </label>");
	}
	else {
		include("conectarbbdd.php");
		$result = mysql_query("INSERT INTO  `permisos` (`idpermiso` , `idmiembro` , `idtipo`) VALUES (NULL ,  '$iduser',  '$idpermdropdown'); ");
	if($result)
	{
		echo('<center> <div id="noerror"> Nuevo Permiso Agregado con Exito </div> </center>');
	} else {
		echo('<center> <div id="error"> Ha habido un error al agregar el permiso seleccionado. Contacte con el adminsitrador </div> </center>');
	}
		mysql_close();	
	} 
}
?>

</body>
</html>