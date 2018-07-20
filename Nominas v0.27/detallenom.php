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
<form name='formulario' method="post" action="<?=$_SERVER['PHP_SELF']?>"> 
<?php

	$idnom= $_GET['idnomina'];
?>

 <script language="JavaScript">
function abrir_popup(){
window.open('popup_nuevoitem.php?idnomina=<?php echo $idnom; ?>',"ventana1","width=700, height=370, directories=no ,scrollbars=no, menubar=no, location=no, resizable=no")
}
</script>
<?php


include("conectarbbdd.php");

$resultado = mysql_query("SELECT * FROM  `nominas` WHERE  `idnomina` LIKE  '$idnom' LIMIT 0 , 30");

while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
    echo('<input type="hidden" name="idnomina" id="idnomina" value="'.$idnom.'" >');
    echo('<input type="hidden" name="idempleado" id="idempleado" value="'.$fila[1].'" >');
}

?>
<?php include("funciones/menu_nomina.php"); ?>
<div id="contenido">
<?php include("menu/botoneradetnom.php"); ?>
<div id="principal"><br>
<center>
<?php
$resulta = mysql_query("SELECT * FROM  `conceptosnom` WHERE  `IdNomina` = '$idnom'");

$numerofilas=mysql_num_rows($resulta);

if ($numerofilas==0){
	echo("<div id='error'><img src='imagenes/cuidado.png'>  Esta Nomina no tiene ninguna conceptos </div>");
	}
else { //mostrar la tabla

					echo ('<table border="0" cellspacing="1" cellpadding="4" width="100%" id="tablahover">');
					echo ('<tr> <th colspan="7" align="center">  Conceptos de la nomina: </th> </tr>');
					echo('<input type="hidden" name="idnom" value="'.$idnom.'">');
					echo('<tr> <th> &nbsp; </th> <th> Concepto </th> <th> Tipo Concepto </th> <th> Cantidad Concepto </th> <th> Precio Concepto </th> <th> Devengado </th> <th> A deducir </th> </tr>');
					//cargar todos los tipos de conceptos de la nomina
					$options2 = array();
					$arraytipocon2 = array();
					$sqltconcepto="SELECT * FROM  `t_conceptos`";
					$resultipo=mysql_query($sqltconcepto);
					while ($tconcepto = mysql_fetch_array($resultipo, MYSQL_NUM)) {
						//guardar en un array todos los tipos de conceptos de la nomina
							$options2[]= $tconcepto[1];
							$arraytipocon[]= $tconcepto[2];
					}
					// cargar los ceptos de la nomina
					$sqlnomconp = "SELECT * FROM  `conceptosnom` WHERE  `IdNomina` = '$idnom'";

					$resulsql=mysql_query($sqlnomconp);
					while ($filanom = mysql_fetch_array($resulsql, MYSQL_NUM)) {
						echo('<tr><td> <input type="radio" name="IdConceptoNom" value="'.$filanom[0].'"> &nbsp </td>');
						echo('<td>'.$options2[$filanom[2]-1].'</td>');
						if ($arraytipocon[$filanom[2]-1]=='1'){ //si el tipo de concepto de nomina es 1, escibir deduccion
							echo('<td> DEDUCCION </td>');
						}
						else{ //sino escibir devengo
							echo('<td> DEVENGO </td>');
						}
						echo('<td>'.$filanom[3].'</td>');			
						echo('<td>'.$filanom[4]);
						if ($arraytipocon[$filanom[2]-1]=='1'){ //si el tipo de concepto de nomina es 1, escibir simbolo %
							echo(' %');
						}
						else {
							echo(' &euro;');
						}
						echo('</td>');		
						echo('<td>'.$filanom[5].' &euro;</td>');
						echo('<td>'.$filanom[6].' &euro;</td></tr>');
					}
					echo('</table><br>');
}
mysql_close();
include("funciones/imprimir_btn.php");
include("funciones/items_btn.php");
?>
</center>

</div>
</div>
</div>
</body>
</html>


