<?php
	require_once('login/comprobarweb.php');
?>
<html>
<head>
<title> Datos de la Ausencia del cliente </title>
<link rel=StyleSheet href="estilos.css" TYPE="text/css">

<SCRIPT LANGUAGE="JavaScript" SRC="javascript/CalendarPopup.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
	var cal = new CalendarPopup();
</SCRIPT>


<script language="JavaScript">
function abrir_popup(URL){
window.open(URL,"ventana1","width=600, height=670, directories=no ,scrollbars=no, menubar=no, location=no, resizable=no")
}
</script>

</head> 
<body>

<?php

function crear_dropdown( $name, array $options, $selected=null )
{
    $dropdown = '<select name="'.$name.'" id="'.$name.'">'."\n";
    $selected = $selected;
    foreach( $options as $key=>$option )
    {
        $select = $selected==$key ? ' selected' : null;
        $dropdown .= '<option value="'.$key.'"'.$select.'>'.$option.'</option>'."\n";
    }

    $dropdown .= '</select>'."\n";
    return $dropdown;
}
?>
<center>
<form name='formulario' method="post" action="<?=$_SERVER['PHP_SELF']?>"> 
 <?php
 
$idcontrato= $_GET['IdContrato'];
echo ('<input type="hidden" name="idcontrato" value="'.$idcontrato.'">');
include("funciones/validarccc.php");
include("conectarbbdd.php");

$result = mysql_query("SELECT * FROM  `contratos` WHERE  `idcontrato` =  '$idcontrato'");

echo ('<div id="contenidoperm">');

echo('<br><h1> DATOS DEL CONTRATO</h1> <br>');

while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	$idempleado=$row[1];
}

$result2 = mysql_query("SELECT * FROM  `empleados` WHERE  `idemp` LIKE  '$idempleado' LIMIT 0 , 30");
echo('<table class="tablaazul" bgcolor="white" border="1" bordercolor="#6396BB" cellpadding="4" cellspacing="0">');
while ($fila = mysql_fetch_array($result2, MYSQL_NUM)) {
	echo('<tr><th>Nombre del Empleado:</th><td> <input name="nombreemp" value="'.$fila[1].' '.$fila[2].' '.$fila[3].'" readonly="true"></td></tr>');
	echo('<tr><th> IdEmpleado: </th><td> <input name="idempleado" value="'.$idempleado.'" readonly="true"> </td></tr>');
}
echo ('<input type="hidden" name="idcontrato" value="'.$idcontrato.'">');
$result = mysql_query("SELECT * FROM  `contratos` WHERE  `idcontrato` LIKE  '$idcontrato'");
while ($filas = mysql_fetch_array($result, MYSQL_NUM)) {
echo('</table><br>');
echo('<table class="tablaazul" bgcolor="white" border="1" bordercolor="#6396BB" cellpadding="4" cellspacing="0">');
//Cargar tabla de Tipos Contratos
printf("<tr><th colspan='2'> Tipo de Contrato: </th> <td colspan='2'>");
    //nombre del dropdown
    $name = 'tipocontrato';
    //opciones que tendra el dropdown
 	//crear array para guardar las opciones
	$options = array();
	include("conectarbbdd.php");
	$result = mysql_query("SELECT * FROM  `t_tipocontrato`");
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    	$options[] = $row[1];
	}	
 	//opcion seleccionada en el dropdown
	 $selected = $filas[2];
	 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
	 echo crear_dropdown( $name, $options, $selected );
	 printf("</td></tr>");
//FIN de carga tabla de Tipos Contratos

//estado del contrato
printf("<tr><th> Estado Contrato </th> <td>");
    //nombre del dropdown
    $name = 'estadocontrato';
    //opciones que tendra el dropdown
 	  	//crear array para guardar las opciones
		$options = array();
		include("conectarbbdd.php");
		$result = mysql_query("SELECT * FROM  `t_estadoscont`");
		while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    		$options[] = $row[1];
		}	
 	 //opcion seleccionada en el dropdown
	 $selected = $filas[7];
	 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
	 echo crear_dropdown( $name, $options, $selected );
	 printf("</td>"); 
// fecha de inicio
printf("<th> Fecha Inicio </th> <td>");
echo('<input name="fechainicio" size="10" value="'.$filas[4].'" /> ');
echo('<a href="#" onClick="cal.select(document.forms[\'formulario\'].fechainicio,\'anchor1\',\'yyyy/MM/dd\'); return false;"  NAME="anchor1" ID="anchor1"><img src="./imagenes/calendario.gif"></a>');

echo('</td> </tr></table><br>');

echo('<table class="tablaazul" bgcolor="white" border="1" bordercolor="#6396BB" cellpadding="4" cellspacing="0">');
printf("<th> &nbsp; </th> <th> Entidad </th> <th> Oficina </th><th> DC </th><th> Numero Cuenta </th> </tr>");
printf("<tr><th> Cuenta Bancaria </th>");
echo('<td><input name="entidad" size="4" maxlength="4" value="'.$filas[11].'" /> </td> '); 
echo('<td><input name="oficina" size="4" maxlength="4" value="'.$filas[12].'" /> </td> '); 
echo('<td><input name="dc" size="2" maxlength="2" value="'.$filas[13].'" /> </td> '); 
echo('<td><input name="ncuenta" size="10" maxlength="10" value="'.$filas[14].'" /> </td> '); 
echo('</tr>');

$resultent = mysql_query("SELECT *  FROM `t_entidades` WHERE `CodigoEntidad` LIKE '$filas[11]'");
while ($filaent = mysql_fetch_array($resultent, MYSQL_NUM)) {
   	$nombreentidad = $filaent[2];
}	
echo('<th> Entidad Financiera: </th> <td colspan="4"> '.$nombreentidad.' &nbsp; </td> '); 

echo('</table><br>');


echo('<table class="tablaazul" bgcolor="white" border="1" bordercolor="#6396BB" cellpadding="4" cellspacing="0">');
printf("<th> Motivo Fin </th> <td>");
    //nombre del dropdown
    $name = 'motivofin';
    //opciones que tendra el dropdown
	  	//crear array para guardar las opciones
		$options = array();
		include("conectarbbdd.php");
		$result = mysql_query("SELECT * FROM  `t_fincont`");
		$options[] = '&nbsp';
		while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    		$options[] = $row[1];
		}	
	 //opcion seleccionada en el dropdown
	 $selected = $filas[3];
	 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
	 echo crear_dropdown( $name, $options, $selected );
	 printf("</td>");
printf("<th> Fecha Fin </th> <td>");
echo('<input name="fechafin" size="10" maxlength="10" value="'.$filas[5].'" /> '); 
echo('<a href="#" onClick="cal.select(document.forms[\'formulario\'].fechafin,\'anchor2\',\'yyyy/MM/dd\'); return false;"  NAME="anchor2" ID="anchor2"><img src="./imagenes/calendario.gif"></a></td> </tr>');

printf("<th> Fecha Expiraci&oacute;n </th> <td>");
echo('<input name="fechaexp" size="10" maxlength="10" value="'.$filas[9].'" />'); 
echo('<a href="#" onClick="cal.select(document.forms[\'formulario\'].fechaexp,\'anchor3\',\'yyyy/MM/dd\'); return false;"  NAME="anchor3" ID="anchor3"><img src="./imagenes/calendario.gif"></a></td>');

printf("<th> Fecha Firma </th> <td>");
echo('<input name="fechafirma"size="10" maxlength="10" value="'.$filas[8].'" /> '); 
echo('<a href="#" onClick="cal.select(document.forms[\'formulario\'].fechafirma,\'anchor4\',\'yyyy/MM/dd\'); return false;"  NAME="anchor4" ID="anchor4"><img src="./imagenes/calendario.gif"></a>');

echo('</td> </tr></table><br>');

echo('<table class="tablaazul" bgcolor="white" border="1" bordercolor="#6396BB" cellpadding="4" cellspacing="0">');
echo ('<tr><th> Anotaciones: </th> </tr> <tr><td><textarea cols="61" rows="4" name="anotaciones">'.$filas[10].'</textarea></td></tr>');
echo('</table><br>');

}
mysql_close();

if ($_SESSION['BTNMODCONT'] == '1'){
	printf ("<br> <button type='submit' name='guardarcontr'>  <img src='./imagenes/gorde.png'> </button>"); 
}

?>

<?php
if(isset($_POST["guardarcontr"])) 
{ 
	$idcontrato=$_REQUEST['idcontrato'];
	$anotaciones=$_REQUEST['anotaciones'];
	$tipocontrato=$_REQUEST['tipocontrato'];
	$estadocontrato=$_REQUEST['estadocontrato'];
	$fechafin=$_REQUEST['fechafin'];
	$fechainicio=$_REQUEST['fechainicio'];
	//recoger datos cuenta bancaria
	$ncuenta=$_REQUEST['ncuenta'];
	$oficina=$_REQUEST['oficina'];
	$entidad=$_REQUEST['entidad'];
	$dc=$_REQUEST['dc'];
	//fin datos cuenta bancaria
	$fechaexp=$_REQUEST['fechaexp'];
	$motivofin=$_REQUEST['motivofin'];
	$fechafirma=$_REQUEST['fechafirma'];
	$idempleado=$_REQUEST['idempleado'];
	//validar cuenta bancaria
	$parte1=$entidad."".$oficina;
	$parte2=$ncuenta;
	$error="0";
	$cc="";
	if (($entidad<>"") && ($oficina<>"") && ($dc<>"") && ($ncuenta<>"") ){
		$resultado=ccc_valido($parte1,$parte2);
		if ($resultado==$dc){
			$error="1";
			$cc=$entidad."-".$oficina."-".$dc."-".$ncuenta;
		}
	}

	if ( $error == '1' ){ //en este caso la cuenta es valida
			include("conectarbbdd.php");
			$result = mysql_query("
			UPDATE  `contratos` SET  `tipocontrato` =  '$tipocontrato', `motivofin` =  '$motivofin',
			`fechainicio` =  '$fechainicio', `fechafin` =  '$fechafin',
			`estado` =  '$estadocontrato', `fechafirma` =  '$fechafirma', `fechaexp` =  '$fechaexp',
			`anotacion` =  '$anotaciones', `entidad` =  '$entidad', `oficina` =  '$oficina', `dc` =  '$dc',
			`ncuenta` =  '$ncuenta'  WHERE  `contratos`.`idcontrato` = '$idcontrato'; ");
			 
			 	//REGISTRAR CAMBIO EN EL HISTORICO
				$usuario = $_SESSION['SESS_USERNAME'];
				$desccambio = "Modificar Contrato Empleado";
				$tabla = "CONTRATOS";
				$idemplhist = $idempleado;
				$idregistro = $idcontrato;
				include("funciones/registrarcambio.php");
				
			mysql_close();
	}
	else{ //en este caso la cuenta no es valida
		echo('<script>');
		echo('alert("La cuenta Bancaria introducida no es valida. Compruebe nuevamente o pongase en contacto con el administrador.");');
		echo('</script>');	
	}

	echo ('<meta http-equiv="Refresh" content="0; URL=vercontrato.php?IdContrato='.$idcontrato.'">');
} 
?> 
</center>
</form>
</div>
</body>
</html>