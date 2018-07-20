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
        alert ( "No puede crear una nueva Ausencia sobre un Empleado con estado Inactivo" );
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
<?php include("menu/botoneraaus.php"); ?>
<div id="principal">
<center>
<?php
$resulta = mysql_query("SELECT * FROM  `ausencias` WHERE  `idempleado` = '$idemplega'");

echo ('<center><h3>Listado de AUSENCIAS de: '.$idemplega.' - '.$nombrecompleto.'</h3></center> ');

$numerofilas=mysql_num_rows($resulta);

if ($numerofilas==0){
	echo("<div id='error'><img src='imagenes/cuidado.png'>  Este Empleado no tiene ninguna ausencia registrada </div>");
	}
else { //mostrar la tabla


echo ('<table border="0" cellspacing="1" cellpadding="4" width="100%" id="tablahover">');
echo('<tr><th></th><th>Tipo de Ausencia</th>');
echo('<th>Estado de Validaci&oacute;n</th>');
echo('<th>Fecha Incio</th>');
echo('<th>Fecha Fin</th>');
echo('<th>Horas</th>');

while ($row = mysql_fetch_array($resulta, MYSQL_NUM)) {
	?>
	<tr><td><a href="javascript:abrir_popup('verausencia.php?IdAusencia=<?php echo $row[0]; ?>')">
	<img src='./imagenes/buscar2.png'></a></td>
	<?php
   	//CArgar los valores de Tipo de Ausencia desde la BD
   //crear array
	include("conectarbbdd.php");
	$tiposaus = array();
	$resultado = mysql_query("SELECT * FROM  `t_tipoausencia`");
	while ($filas = mysql_fetch_array($resultado, MYSQL_NUM)) {
    	$tiposaus[] = $filas[1];
	}
   echo('<td>'.$tiposaus[$row[3]-1].'</td>');
   //CAmbiar el numero por el estado
		//crear array
		$options2 = array();
		include("conectarbbdd.php");
		$resultado2 = mysql_query("SELECT * FROM  `t_estadosaus`");
		//opciones que tendra el dropdown
		while ($fila2 = mysql_fetch_array($resultado2, MYSQL_NUM)) {
		    $options2[] = $fila2[1];
		}
		printf("<td>%s</td>", $options2[$row[4]]);
		
     printf("<td>%s</td>", $row[5]);
     printf("<td>%s</td>", $row[6]);
     printf("<td>%s</td>", $row[7]);
}
echo('</table><br><br>');
}
mysql_close();
?>

<?php
if(isset($_POST["actualizar"])) 
{ 
	$idemplega=$_REQUEST['idemple'];
	echo ('<meta http-equiv="Refresh" content="0; URL=verausenciaemp.php?idempleatu='.$idemplega.'">');
}
?>

<?php
if(isset($_POST["crearausencia"])) 
{ 
	$idemplega=$_REQUEST['idemple'];
	echo ('<meta http-equiv="Refresh" content="0; URL=nuevaausencia.php?idempleatu='.$idemplega.'">');
}

?>

</center>
</div>
</div>
</div>
</body>
</html>


