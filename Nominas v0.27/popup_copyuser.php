<?php
	require_once('login/comprobarweb.php');
?>
<html>
<head>
<title> Copiar Permisos de Usuario </title>
<link rel=StyleSheet href="estilos.css" TYPE="text/css">

<script> 
function cerrarpopup(){ 
   window.close(); 
} 
</script>  

</head>

<body>
<?php
	include("funciones/crear_dropdown.php");
	$iduser= $_GET['iduser'];
?>
<form name='formulario' method="post" action="<?=$_SERVER['PHP_SELF']?>"> 

<table class="tablaazul" bgcolor="white" border="3" bordercolor="#6396BB" cellpadding="4" cellspacing="0">
<tr>
<th>Seleccionar el Usuario a Copiar: </th>
<?php
echo('<input type="hidden" name="iduser" value="'.$iduser.'">');
//crear array
$options2 = array();
$options2[] = '&nbsp';
include("conectarbbdd.php");
$resultado2 = mysql_query("SELECT * FROM  `miembros` LIMIT 0 , 30");
//opciones que tendra el dropdown
while ($fila2 = mysql_fetch_array($resultado2, MYSQL_NUM)) {
    $options2[] = $fila2[1];
}

printf("<td>");
//nombre del dropdown
$name2 = 'tipouser';
//opciones que tendra el dropdown
//opcion seleccionada en el dropdown
$selected2 = $_POST['tipouser'];
//crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
echo crear_dropdown( $name2, $options2, $selected2 );
printf("</td>");

printf("<td> <button type='submit' name='cargaruser'> Cargar Usuario <img src='./imagenes/seleccionar2.png' > </button> </td> </tr>");

?>
<?php
if(isset($_POST["cargaruser"])) 
{ 
	$tipouser = $_POST['tipouser'];
	$iduser= $_POST['iduser'];
	if (!empty($tipouser)) {
			echo('<script>');
			echo('document.formulario.cargaruser.disabled = true;');
			echo('document.formulario.tipouser.disabled = true;');
			echo('</script>');	
			$tipouser=$tipouser;
			//saber si es devengo o deduccion
			include("conectarbbdd.php");
			//saber el tipo de concepto    
			$sqlnumpermis="SELECT  count(*) as num_perm FROM `permisos` WHERE `idmiembro` = '$tipouser' ";
			$resulnump=mysql_query($sqlnumpermis);
			while ($numperm = mysql_fetch_array($resulnump, MYSQL_NUM)) {
					//guardar en un array todos los tipos de conceptos de la nomina
					echo('<th> Numero de Permisos Asociados al Usuario: </th>');
					echo('<td> <input name="numperm" value ="'.$numperm[0].'" ></td>');
					echo('</tr>');
			}
			echo('<input type="hidden" name="iduser" value="'.$iduser.'">');
			echo('<input type="hidden" name="tipouser" value="'.$tipouser.'">');
			printf("<tr><td colspan='3'> <button type='submit' name='copypermsuser'> Copiar Todos Los Permisos al Nuevo Usuario<img src='./imagenes/seleccionar2.png' > </button> </td> </tr>");
	}
		echo('<input type="hidden" name="iduser" value="'.$iduser.'">');
}

if(isset($_POST["copypermsuser"])) 
{ 
	$tipouser = $_POST['tipouser']; //usuario nuevo
	$iduser= $_POST['iduser']; //usuarioroginial
	//saber el idusuario del usuario original
	$resultuseror = mysql_query("SELECT * FROM  `miembros` WHERE  `usuario` LIKE  '$iduser'");
	while ($filaorig = mysql_fetch_array($resultuseror, MYSQL_NUM)) {
		$idusuariorig=$filaorig[0];
	}
	//buscar todos los permisos del usuario al que copiarle
   include("conectarbbdd.php");
   $sqlperm="SELECT * FROM  `permisos` WHERE  `idmiembro` LIKE  '$tipouser'";
	$resulperm=mysql_query($sqlperm);
	while ($miembro = mysql_fetch_array($resulperm, MYSQL_NUM)) {
		//copiar permiso al nuevo usuario
		$addresul = mysql_query("INSERT INTO  `permisos` (`idpermiso` , `idmiembro` , `idtipo`) VALUES (NULL ,  '$idusuariorig',  '$miembro[2]'); ");
		$addresul=mysql_query($result);
	}
		echo('<script>');
		echo('window.opener.location.reload(true);');
		echo('alert("Permisos del Usuario Copiados");');
		echo('window.opener.location.reload(true);');
		echo('window.opener.location.reload(true);');
		echo('window.close();');
		echo('</script>');	
}
?>
</table>
</form> 
</center>
</body>
</html>


