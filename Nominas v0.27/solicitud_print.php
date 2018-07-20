<?php
	require_once('login/comprobarweb.php');
?>
<html>
<head>
<title>IMPRESION DE SOLICITUD</title>
</head> 
</head>
<center>
<form name='formulario' method="post" action="<?=$_SERVER['PHP_SELF']?>"> 
 <?php
$idperm= $_GET['IdSolicitud'];

include("conectarbbdd.php");

$result = mysql_query("SELECT * FROM  `solicitudes` WHERE  `IdSolicitud` LIKE  '$idperm' LIMIT 0 , 999");

echo('<table bgcolor="green" border="1"> <tr><td> DATOS DE LA SOLICITUD </td></tr></table><br><br>');

while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	$idempleado=$row[1];
	echo('<input type="hidden" name="IdSolicitud" value="'.$idperm.'">');
}

$result2 = mysql_query("SELECT * FROM  `empleados` WHERE  `idemp` LIKE  '$idempleado' LIMIT 0 , 30");
echo('<table border="1">');
while ($fila = mysql_fetch_array($result2, MYSQL_NUM)) {
	echo('<tr><td>NOMBRE:</td><td> '.$fila[1].' '.$fila[2].' '.$fila[3].'</td> <td> DNI </td><td>'.$fila[5].' </td> </tr>');
	echo('<tr><td> Departamento: </td><td> <input> </td> <td> Telefono Contacto: </td> <td>'.$fila[10].'</td> </tr>');
}
$result = mysql_query("SELECT * FROM  `solicitudes` WHERE  `IdSolicitud` LIKE  '$idperm' LIMIT 0 , 999");
while ($filas = mysql_fetch_array($result, MYSQL_NUM)) {
echo('</table><br>');
echo('<table border="1">');
switch ($filas[2]) {
    case 1:
			echo ('<tr><td> Solicita un </td> <td colspan="3"> Permiso Reglamentario </td> </tr>');
         break;
    case 2:
			echo ('<tr><td> Solicita un </td> <td colspan="3"> Permiso Especial </td> </tr>');
         break;
    case 3:
			echo ('<tr><td> Solicita un </td> <td colspan="3"> Permiso Sin Sueldo </td> </tr>');
         break;
    default:
			echo ('<tr><td> Solicita </td> <td colspan="3"> Vacaciones </td> </tr>');
         break;
  }
echo ('<tr><td> Fecha Comienzo </td><td>&nbsp;'.$filas[3].'&nbsp;</td>');
echo ('<td> &nbsp;Fecha Fin </td> <td>&nbsp;'.$filas[4].'&nbsp;</td><tr>');
echo ('<tr><td> Con Motivo: </td> <td colspan="3">'.$filas[5].'</td><tr>');
echo('</table><br>');
echo('<table border="1">');
  switch ($filas[6]) {
    case 1:
        echo ('<tr><td> Solicitud est&aacute;: </td><td>&nbsp; APROBADO &nbsp;</td>');
        echo('<td> Fecha Aprobado: </td><td>&nbsp;'.$filas[7].'&nbsp;</td></tr>');
        break;
    default:
        echo ('<tr><td> Solicitud est&aacute;: </td><td>&nbsp; RECHAZADO &nbsp;</td>');
        echo('<td> Fecha Rechazado: </td><td>&nbsp;'.$filas[7].'&nbsp;</td></tr>');
        break;
		}
echo('</table><br>');
echo('<table border="1">');
echo ('<tr><td> Anotaciones: </td> </tr> <tr><td><textarea cols="61" rows="4">'.$filas[8].'</textarea></td></tr>');
echo('</table><br>');
echo('<table border="1">');
echo('<tr> </tr> <tr> <td> FIRMA EMPLEADO </td> <td> FIRMA DELEG. DPTO </td> <td> FIRMA DPTO. PERSONAL </td> </tr>');
echo('<tr> </tr> <tr> <td> <textarea rows="6"></textarea></td> <td> <textarea rows="6"></textarea> </td> <td> <textarea rows="6"></textarea> </td> </tr>');
echo('</table><br>');
}
mysql_close();
?>
<button type='submit' name="imprimir" onclick="window.print()">  <img src='./imagenes/imprimir.png'> </button>
<button type='submit' name="volver">  <img src='./imagenes/volver.png'> </button>
</center>
</form>

<?php
if(isset($_POST["imprimir"])) 
{ 
   $IdSolicitud=$_REQUEST['IdSolicitud'];
	echo ('<meta http-equiv="Refresh" content="0; URL=solicitud_print.php?IdSolicitud='.$IdSolicitud.'">');
}
if(isset($_POST["volver"])) 
{ 
   $IdSolicitud=$_REQUEST['IdSolicitud'];
	echo ('<meta http-equiv="Refresh" content="0; URL=versolicitud.php?IdSolicitud='.$IdSolicitud.'">');
}
?>
</body>
</html>