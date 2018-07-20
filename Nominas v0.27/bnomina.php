<?php
	require_once('login/comprobarweb.php');
?>
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
<form name='formulario' method="post" action="<?=$_SERVER['PHP_SELF']?>"> 
 <?php
$idnom=$_REQUEST['idnom'];

include("conectarbbdd.php");

$result = mysql_query("SELECT * FROM  `nominas` WHERE  `idnomina` LIKE  '$idnom' LIMIT 0 , 30");

$numerofilas=mysql_num_rows($result);

if ($numerofilas==0){
	echo('<div id="error"><img src="imagenes/cuidado.png">  La Nomina con identificador:'.$idnom.' no existe. </div>');
	}
else {
		include("funciones/mostrarnom.php");
		printf ("<button type='submit' name='printnom'>  <img src='./imagenes/verimpresion.png'> </button>");
		mysql_close();
		include("funciones/imprimir_btn.php");
}
?>

<br><br>

</form>

 </center>
</body>
</html>