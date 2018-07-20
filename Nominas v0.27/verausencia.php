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
$idausencia= $_GET['IdAusencia'];
echo ('<input type="hidden" name="idausencia" value="'.$idausencia.'">');
include("conectarbbdd.php");

$result = mysql_query("SELECT * FROM  `ausencias` WHERE  `idausencia` =  '$idausencia'");

echo ('<div id="contenidoperm">');

echo('<br><h1> DATOS DE LA AUSENCIA</h1> <br>');

while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	$idempleado=$row[1];
}

$result2 = mysql_query("SELECT * FROM  `empleados` WHERE  `idemp` LIKE  '$idempleado' LIMIT 0 , 30");
echo('<table class="tablaazul" bgcolor="white" border="1" bordercolor="#6396BB" cellpadding="4" cellspacing="0">');
while ($fila = mysql_fetch_array($result2, MYSQL_NUM)) {
	echo('<tr><th>Nombre del Empleado:</th><td> <input name="nombreemp" value="'.$fila[1].' '.$fila[2].' '.$fila[3].'" readonly="true"></td></tr>');
	echo('<tr><th> IdEmpleado: </th><td> <input name="idempleado" value="'.$idempleado.'" readonly="true"> </td></tr>');
}
echo ('<input type="hidden" name="idausencia" value="'.$idausencia.'">');
$result = mysql_query("SELECT * FROM  `ausencias` WHERE  `idausencia` LIKE  '$idausencia'");
while ($filas = mysql_fetch_array($result, MYSQL_NUM)) {
echo('</table><br>');
echo('<table class="tablaazul" bgcolor="white" border="1" bordercolor="#6396BB" cellpadding="4" cellspacing="0">');
echo('<tr><th colspan="3"> Tipo de Ausencia: </th> <td colspan="2">');

//crear array
$options = array();
include("conectarbbdd.php");
$result = mysql_query("SELECT * FROM  `t_tipoausencia`");
//opciones que tendra el dropdown
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    $options[] = $row[1];
}
//nombre del dropdown
$name = 'tipoausencia';
//opcion seleccionada en el dropdown
$selected = $filas[3]-1;
//crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
echo crear_dropdown( $name, $options, $selected );
if ($selected==0){
	//buscar el idcolicitud y mostrarlo
	echo('</tr><th> IdSolicitud </th> <td> ');
	echo('<a href="javascript:abrir_popup(\'versolicitud.php?IdSolicitud='.$filas[2].' \')"> <img src="./imagenes/buscar2.png"></a>');
	echo('</td> <td> <input value="'.$filas[2].'" name="idasolicitud" > </td>');
	$result = mysql_query("SELECT * FROM  `solicitudes` WHERE  `IdSolicitud` LIKE  '$filas[2]'");
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		$tiposol=$row[2]-1;
		$iniciosol=$row[3];
		$finsol=$row[4];
	}
	$options = array( 'Permiso Reglamentario', 'Permiso Especial', 'Permiso Sin Sueldo', 'Vacaciones');
	echo('<th> Solicitud: </th> <td> '.$options[$tiposol].' </td> </tr>');
	echo ('<tr><th colspan="2"> Fecha Inicio </th><td><input name="fechainicio" value="'.$iniciosol.'" readonly></td>');	
	echo ('<th> &nbsp;Fecha Fin </th> <td><input name="fechafin" value="'.$finsol.'" readonly></td><tr>');
}
else {
	echo("</td></tr>");
	echo ('<tr><th colspan="2"> Fecha Inicio </th><td><input name="fechainicio" size="10" value="'.$filas[5].'">');
	echo('<a href="#" onClick="cal.select(document.forms[\'formulario\'].fechainicio,\'anchor1\',\'yyyy/MM/dd\'); return false;"  NAME="anchor1" ID="anchor1"><img src="./imagenes/calendario.gif"></a></td>');
	echo ('<th> &nbsp;Fecha Fin </th> <td><input name="fechafin" size="10" value="'.$filas[6].'">');
	echo('<a href="#" onClick="cal.select(document.forms[\'formulario\'].fechafin,\'anchor2\',\'yyyy/MM/dd\'); return false;"  NAME="anchor2" ID="anchor2"><img src="./imagenes/calendario.gif"></a></td></tr>');
}
echo('</table><br>');
echo('<table class="tablaazul" bgcolor="white" border="1" bordercolor="#6396BB" cellpadding="4" cellspacing="0">');
echo ('<tr><th> Estado: </th><td>');
//nombre del dropdown
$name2 = 'estado';
//opciones que tendra el dropdown

//crear array
$options2 = array();
include("conectarbbdd.php");
$erantzun = mysql_query("SELECT * FROM  `t_estadosaus`");
$options2[] = '&nbsp';
//opciones que tendra el dropdown
while ($lerroa = mysql_fetch_array($erantzun, MYSQL_NUM)) {
    $options2[] = $lerroa[1];
}

//opcion seleccionada en el dropdown
$selected2 = $filas[4]+1;
//crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
echo crear_dropdown( $name2, $options2, $selected2 );
echo('</td><th> Horas de Ausencia: </th><td><input name="horas" value="'.$filas[7].'"></td></tr>');
echo('</table><br>');
echo('<table class="tablaazul" bgcolor="white" border="1" bordercolor="#6396BB" cellpadding="4" cellspacing="0">');
echo ('<tr><th> Anotaciones: </th> </tr> <tr><td><textarea cols="61" rows="4" name="anotaciones">'.$filas[8].'</textarea></td></tr>');
echo('</table><br>');
}
mysql_close();

if ($_SESSION['BTNMODAUS'] == '1'){
	printf ("<br> <button type='submit' name='guardarsol'>  <img src='./imagenes/gorde.png'> </button>"); 
}
?>

<?php
if(isset($_POST["guardarsol"])) 
{ 
	$idausencia=$_REQUEST['idausencia'];
	$tipoausencia=$_REQUEST['tipoausencia']+1;
	$fechainicio=$_REQUEST['fechainicio'];
	$fechafin=$_REQUEST['fechafin'];
	$estado=$_REQUEST['estado']-1;
	$horas=$_REQUEST['horas'];
	$anotaciones=$_REQUEST['anotaciones'];
	$idsolicitud=$_REQUEST['idasolicitud'];
	$idempleado=$_REQUEST['idempleado'];

	include("conectarbbdd.php");

	$result = mysql_query("
		UPDATE `ausencias` SET `tipoausencia` = '$tipoausencia', `fechainicio` = '$fechainicio', 
		`fechafin` = '$fechafin', `estado` = '$estado', `horas` = '$horas',
		 `anotaciones` = '$anotaciones', `idsolicitud` = '$idsolicitud'  
		 WHERE `ausencias`.`idausencia` = '$idausencia';
		 ");
	 	//REGISTRAR CAMBIO EN EL HISTORICO
		$usuario = $_SESSION['SESS_USERNAME'];
		$desccambio = "Modificar Ausencia Empleado";
		$tabla = "AUSENCIAS";
		$idemplhist = $idempleado;
		$idregistro = $idausencia;
		include("funciones/registrarcambio.php");
	mysql_close();
	echo ('<meta http-equiv="Refresh" content="0; URL=verausencia.php?IdAusencia='.$idausencia.'">');
} 
?> 
</center>
</form>
</div>
</body>
</html>