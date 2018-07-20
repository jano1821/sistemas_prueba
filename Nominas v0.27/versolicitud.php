<?php
	require_once('login/comprobarweb.php');
?>
<html>
<head>
<title> Datos de la Solicitud del permiso </title>
<link rel=StyleSheet href="estilos.css" TYPE="text/css">

</head> 
<body>

<SCRIPT LANGUAGE="JavaScript" SRC="javascript/CalendarPopup.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
	var cal = new CalendarPopup();
</SCRIPT>

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
$idperm= $_GET['IdSolicitud'];
echo ('<input type="hidden" name="IdSolicitud" value="'.$idperm.'">');
include("conectarbbdd.php");

$result = mysql_query("SELECT * FROM  `solicitudes` WHERE  `IdSolicitud` LIKE  '$idperm' LIMIT 0 , 999");

echo ('<div id="contenidoperm">');

echo('<br><h1> DATOS DE LA SOLICITUD</h1> <br>');

while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	$idempleado=$row[1];
}

$result2 = mysql_query("SELECT * FROM  `empleados` WHERE  `idemp` LIKE  '$idempleado' LIMIT 0 , 30");
echo('<table class="tablaazul" bgcolor="white" border="1" bordercolor="#6396BB" cellpadding="4" cellspacing="0">');
while ($fila = mysql_fetch_array($result2, MYSQL_NUM)) {
	echo('<tr><th>Nombre del Empleado:</th><td> <input name="nombreemp" value="'.$fila[1].' '.$fila[2].' '.$fila[3].'" readonly="true"></td></tr>');
	echo('<tr><th> IdEmpleado: </th><td> <input name="idempleado" value="'.$idempleado.'" readonly="true"> </td></tr>');
}
$result = mysql_query("SELECT * FROM  `solicitudes` WHERE  `IdSolicitud` LIKE  '$idperm' LIMIT 0 , 999");
while ($filas = mysql_fetch_array($result, MYSQL_NUM)) {
echo('</table><br>');
echo('<table class="tablaazul" bgcolor="white" border="1" bordercolor="#6396BB" cellpadding="4" cellspacing="0">');
echo('<tr><th colspan="2"> Tipo de Solicitud: </th> <td colspan="2">');

//nombre del dropdown
$name = 'tipopermiso';
//opciones que tendra el dropdown
//crear array
$options = array();
include("conectarbbdd.php");
$result = mysql_query("SELECT * FROM  `t_tiposol`");
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    $options[] = $row[1];
}
//opcion seleccionada en el dropdown
$selected = $filas[2]-1;
//crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
echo crear_dropdown( $name, $options, $selected );


echo('</td> </tr>');
echo ('<tr><th> Fecha Comienzo </th><td><input name="fechacom" size="10" value="'.$filas[3].'">');
echo('<a href="#" onClick="cal.select(document.forms[\'formulario\'].fechacom,\'anchor1\',\'yyyy/MM/dd\'); return false;"  NAME="anchor1" ID="anchor1"><img src="./imagenes/calendario.gif"></a></td>');

echo ('<th> &nbsp;Fecha Fin </th> <td><input name="fechafin" size="10" value="'.$filas[4].'">');
echo('<a href="#" onClick="cal.select(document.forms[\'formulario\'].fechafin,\'anchor2\',\'yyyy/MM/dd\'); return false;"  NAME="anchor2" ID="anchor2"><img src="./imagenes/calendario.gif"></a></td></tr>');

echo ('<tr><th> Con Motivo: </th> <td colspan="3"><input name="motivo" size="60" maxlength="60"  value="'.$filas[5].'"></td><tr>');
echo('</table><br>');
echo('<table class="tablaazul" bgcolor="white" border="1" bordercolor="#6396BB" cellpadding="4" cellspacing="0">');
echo ('<tr><th> Solicitud est&aacute;: </th><td>');
//nombre del dropdown
$name2 = 'aprobado';
//opciones que tendra el dropdown
$options2 = array( 'Aprobado', 'Rechazado');
//opcion seleccionada en el dropdown
$selected2 = $filas[6]-1;
//crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
echo crear_dropdown( $name2, $options2, $selected2 );
echo('</td><th> Fecha Revisado: </th><td><input name="fechaapro" value="'.$filas[7].'">');
echo('<a href="#" onClick="cal.select(document.forms[\'formulario\'].fechaapro,\'anchor3\',\'yyyy/MM/dd\'); return false;"  NAME="anchor3" ID="anchor3"><img src="./imagenes/calendario.gif"></a></td></tr>');

echo('</table><br>');
echo('<table class="tablaazul" bgcolor="white" border="1" bordercolor="#6396BB" cellpadding="4" cellspacing="0">');
echo ('<tr><th> Anotaciones: </th> </tr> <tr><td><textarea cols="61" rows="4" name="observaciones">'.$filas[8].'</textarea></td></tr>');
echo('</table><br>');
}
mysql_close();

if ($_SESSION['BTNMODSOL'] == '1'){
	printf ("<br> <button type='submit' name='guardarsol'>  <img src='./imagenes/gorde.png'> </button>"); 
}
printf ("<button type='submit' name='printsol'>  <img src='./imagenes/verimpresion.png'> </button>");

?>

<?php
if(isset($_POST["printsol"])) 
{ 
   $IdSolicitud=$_REQUEST['IdSolicitud'];
	echo ('<meta http-equiv="Refresh" content="0; URL=solicitud_print.php?IdSolicitud='.$IdSolicitud.'">');
}
?>
<?php
if(isset($_POST["guardarsol"])) 
{ 
	$IdSolicitud=$_REQUEST['IdSolicitud'];
	$tipopermiso=$_REQUEST['tipopermiso']+1;
	$fechacom=$_REQUEST['fechacom'];
	$fechafin=$_REQUEST['fechafin'];
	$motivo=$_REQUEST['motivo'];
	$aprobado=$_REQUEST['aprobado']+1;
	$fechaapro=$_REQUEST['fechaapro'];
	$observaciones=$_REQUEST['observaciones'];
	$idempleado=$_REQUEST['idempleado'];
	include("conectarbbdd.php");

	$result = mysql_query("
		UPDATE `solicitudes` SET `Tipo` = '$tipopermiso', `FechaInicio` = '$fechacom', 
		`FechaFin` = '$fechafin', `Motivo` = '$motivo', `Aprobado` = '$aprobado',
		 `FechaAprobado` = '$fechaapro', `Anotaciones` = '$observaciones' 
		 WHERE `solicitudes`.`IdSolicitud` = '$IdSolicitud';
		 ");
	 	//REGISTRAR CAMBIO EN EL HISTORICO
		$usuario = $_SESSION['SESS_USERNAME'];
		$desccambio = "Modificar Solicitud Empleado";
		$tabla = "SOLICITUDES";
		$idemplhist = $idempleado;
		$idregistro = $IdSolicitud;
		include("funciones/registrarcambio.php");
	mysql_close();
	echo ('<meta http-equiv="Refresh" content="0; URL=versolicitud.php?IdSolicitud='.$IdSolicitud.'">');
} 
?> 
</center>
</form>
</div>
</body>
</html>