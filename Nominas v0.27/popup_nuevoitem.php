<?php
	require_once('login/comprobarweb.php');
?>
<html>
<head>
<title> Crear nuevo concepto para la nomina </title>
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
	$idnom= $_GET['idnomina'];
?>
<form name='formulario' method="post" action="<?=$_SERVER['PHP_SELF']?>"> 

<table class="tablaazul" bgcolor="white" border="3" bordercolor="#6396BB" cellpadding="4" cellspacing="0">
<tr>
<th>Seleccionar el Tipo de Concepto: </th>
<?php
echo('<input type="hidden" name="idnomina" value="'.$idnom.'">');
//crear array
$options2 = array();
$options2[] = '&nbsp';
include("conectarbbdd.php");
$resultado2 = mysql_query("SELECT * FROM  `t_conceptos`");
//opciones que tendra el dropdown
while ($fila2 = mysql_fetch_array($resultado2, MYSQL_NUM)) {
    $options2[] = $fila2[1];
}

printf("<td>");
//nombre del dropdown
$name2 = 'tipoitem';
//opciones que tendra el dropdown
//opcion seleccionada en el dropdown
$selected2 = $_POST['tipoitem'];
//crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
echo crear_dropdown( $name2, $options2, $selected2 );
printf("</td>");

printf("<td> <button type='submit' name='verconcepto'> Seleccionar Concepto <img src='./imagenes/seleccionar2.png' > </button> </td> </tr>");

?>
<?php
if(isset($_POST["verconcepto"])) 
{ 
	$tipoitem = $_POST['tipoitem'];
	$idnom= $_POST['idnomina'];
	if (!empty($tipoitem)) {
			echo('<script>');
			echo('document.formulario.verconcepto.disabled = true;');
			echo('document.formulario.tipoitem.disabled = true;');
			echo('</script>');	
			$tipoitem=$tipoitem-1;
			//saber si es devengo o deduccion
			include("conectarbbdd.php");
			//saber el tipo de concepto    
		   //cargar todos los tipos de conceptos de la nomina
			$arraytipocon = array();
			$sqltconcepto="SELECT * FROM  `t_conceptos`";
			$resultipo=mysql_query($sqltconcepto);
			while ($tconcepto = mysql_fetch_array($resultipo, MYSQL_NUM)) {
					//guardar en un array todos los tipos de conceptos de la nomina
					$arraytipocon[]= $tconcepto[2];
			}
			
			if ($arraytipocon[$tipoitem]=='1'){ //si el tipo de concepto de nomina es 1, es deduccion
				$tipoconcepto=1;
				echo('<th>% a Aplicar de Deduccion: </th>');
				echo('<td> <input name="preciodeduc"> </td>');
				echo('</tr>');
			}
			else {
				$tipoconcepto=0;
				echo('<th> Cantidad de Conceptos: </th>');
				echo('<td> <input name="cantdeven"> </td>');
				echo('</tr>');
				echo('<th> Precio del Concepto: </th>');
				echo('<td> <input name="preciodeven"> </td>');
				echo('</tr>');
			}
			echo('<input type="hidden" name="tipoconcepto" value="'.$tipoconcepto.'">');
			echo('<input type="hidden" name="idnom" value="'.$idnom.'">');
			echo('<input type="hidden" name="tipoitem" value="'.$tipoitem.'">');
			printf("<tr><td colspan='3'> <button type='submit' name='nuevoitem'> Agregar Concepto a la Nomina <img src='./imagenes/seleccionar2.png' > </button> </td> </tr>");
	}
		echo('<input type="hidden" name="idnomina" value="'.$idnom.'">');
}

if(isset($_POST["nuevoitem"])) 
{ 
	$idnom= $_POST['idnom'];
	$tipoconcepto= $_POST['tipoconcepto'];
	$preciodeduc= $_POST['preciodeduc'];
	$cantdeven= $_POST['cantdeven'];
	$tipoitem= $_POST['tipoitem']+1;
	$preciodeven= $_POST['preciodeven'];
	if ($tipoconcepto=='1'){ //si el tipo de concepto de nomina es 1, es deduccion
		//recoger el total para la nomina
		$resultado = mysql_query("SELECT * FROM  `nominas` WHERE  `idnomina` LIKE  '$idnom' LIMIT 0 , 30");
		while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
    		$total=$fila[4];
		}
		$totaldeduc=$total*($preciodeduc/100);
		//insertar el valor
		include("conectarbbdd.php");
		$sqldevelgo="INSERT INTO `conceptosnom` (`IdConceptoNom` , `IdNomina` , `IdConcepto` ,`CantidadConcepto` , `PrecioConcepto` ,
		`Devengado` , `Adeducir` ) VALUES ( NULL ,  '$idnom',  '$tipoitem',  '1',  '$preciodeduc',  '0',  '$totaldeduc'); ";
		$resuldevengo=mysql_query($sqldevelgo);
	}
	else {
		$totaldevengo=$cantdeven*$preciodeven;
		//insertar el valor
		include("conectarbbdd.php");
		$sqldevelgo="INSERT INTO `conceptosnom` (`IdConceptoNom` , `IdNomina` , `IdConcepto` ,`CantidadConcepto` , `PrecioConcepto` ,
		`Devengado` , `Adeducir` ) VALUES ( NULL ,  '$idnom',  '$tipoitem',  '$cantdeven',  '$preciodeven',  '$totaldevengo',  '0'); ";		
		$resuldevengo=mysql_query($sqldevelgo);
		//echo($sqldevelgo);
		
	}
	 //recalcular total de la nomina, y todas las deducciones nuevamente
		$idnomina= $idnom;
	   include("funciones/recalcularnom.php");
	   
	   //registrar accion en historico de cambios	
	   $resulempnom = mysql_query("SELECT * FROM  `nominas` WHERE  `idnomina` LIKE  '$idnom' LIMIT 0 , 30");
		while ($filanomemp = mysql_fetch_array($resulempnom, MYSQL_NUM)) {
    		$idempleado=$filanomemp[1];
		}	   
   	//REGISTRAR CAMBIO EN EL HISTORICO
		$usuario = $_SESSION['SESS_USERNAME'];
		$desccambio = "Agregar Concepto Nomina ";
		$tabla = "CONCEPTOS NOMINAS";
		$idemplhist = $idempleado;
		$idregistro = $idnomina;
		include("funciones/registrarcambio.php");
   
		echo('<script>');
		echo('window.opener.location.reload(true);');
		echo('alert("Concepto agregado con exito");');
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


