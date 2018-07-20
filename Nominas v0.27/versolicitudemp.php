<?php
	require_once('login/comprobarweb.php');
?>
<html>
<head>
<title> Sitema de Empleados y Nominas Online </title>
<link rel=StyleSheet href="estilos.css" TYPE="text/css">
<link rel=StyleSheet href="menu/css/nav.css" TYPE="text/css">

<script language="JavaScript">
function abrir_popup(URL){
window.open(URL,"ventana1","width=600, height=670, directories=no ,scrollbars=no, menubar=no, location=no, resizable=no")
}
</script>

<script language="Javascript">

function validar_estadoemp ( )
{
    valid = true;

    if ( document.formulario.estadoemp.value == "1" )
    {
        alert ( "No puede crear una nueva Solicitud sobre un Empleado con estado Inactivo" );
        valid = false;
    }

    return valid;
}

</script>

</head>

<body>
<?php
	include("menu/menu.php");
?>
<form name='formulario' method="post" action="<?=$_SERVER['PHP_SELF']?>"> 
    
<?php
$idemplega= $_GET['idempleatu'];

include("conectarbbdd.php");

$result = mysql_query("SELECT * FROM  `empleados` WHERE  `idemp` LIKE  '$idemplega' LIMIT 0 , 30");

while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    $nombrecompleto=$row[1].' '.$row[2].' '.$row[3];
    echo('<input type="hidden" name="idemple" value="'.$idemplega.'" >');
    echo('<input type="hidden" name="estadoemp" value="'.$row[6].'" >');
}

mysql_free_result($result);
?>
<?php include("funciones/menu_empleado.php"); ?>
<div id="contenido">
<?php include("menu/botonerasol.php"); ?>
<div id="principal">
<center>
<?php
$resulta = mysql_query("SELECT * FROM  `solicitudes` WHERE  `idemp` LIKE  '$idemplega' LIMIT 0 , 999");

$numerofilas=mysql_num_rows($resulta);

if ($numerofilas==0){
	echo("<div id='error'><img src='imagenes/cuidado.png'>  Este Empleado no tiene ninguna solicitud creada </div>");
	}
else { //mostrar la tabla


echo ('<br><table border="0" cellspacing="1" cellpadding="4" width="100%" id="tablahover">');
echo('<tr><th></th><th>Tipo de Solicitud</th>');
echo('<th>Fecha Inicio</th>');
echo('<th>Fecha Fin</th>');
echo('<th>Aprobado</th>');
echo('<th>Fecha Revisi&oacute;n</th>');
echo('<th>Motivo</th></tr>');

while ($row = mysql_fetch_array($resulta, MYSQL_NUM)) {
	?>
	<tr><td><a href="javascript:abrir_popup('versolicitud.php?IdSolicitud=<?php echo $row[0]; ?>')">
	<img src='./imagenes/buscar2.png'></a></td>
	<?php
	//CArgar los valores de Tipo de Permiso desde la BD
	   $options = array();
		$result = mysql_query("SELECT * FROM  `t_tiposol`");
		while ($filaops = mysql_fetch_array($result, MYSQL_NUM)) {
    		$options[] = $filaops[1];
		}
   //CAmbiar el numero por el tipo de Permiso
    echo('<td>'.$options[$row[2]-1].'</td>');

    printf("<td>%s</td>", $row[3]);
     printf("<td>%s</td>", $row[4]);
     //Cambiar el numero de aprobado por si o no
     switch ($row[6]) {
     case 1:
        printf("<td>SI</td>");
        break;
    default:
        printf("<td>NO</td>");
        break;
		}
     printf("<td>%s</td>", $row[7]);
     printf("<td>%s</td>", $row[5]);
}
echo('</table><br><br>');
}
mysql_close();

?>

<?php
if(isset($_POST["crearpermiso"])) 
{ 
	$idemplega=$_REQUEST['idemple'];
	echo ('<meta http-equiv="Refresh" content="0; URL=nuevasolicitud.php?idempleatu='.$idemplega.'">');
}

if(isset($_POST["actualizar"])) 
{ 
	$idemplega=$_REQUEST['idemple'];
	echo ('<meta http-equiv="Refresh" content="0; URL=versolicitudemp.php?idempleatu='.$idemplega.'">');
}
?>
</center>
</div>
</div>
</div>
</form> 
</body>
</html>


