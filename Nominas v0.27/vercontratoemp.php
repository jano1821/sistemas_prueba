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
        alert ( "No puede dar de alta un nuevo Contrato sobre un Empleado con estado Inactivo" );
        valid = false;
    }

    return valid;
}

</script>

</head>

<body>
<?php
	include("menu/menu.php");
	include("funciones/crear_dropdown.php");
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
<?php include("menu/botoneracont.php"); ?>
<div id="principal">
<center>
<?php
$resulta = mysql_query("SELECT * FROM  `contratos` WHERE  `idempleado` = '$idemplega' ");

echo ('<center><h3>Listado de CONTRATOS de: '.$idemplega.' - '.$nombrecompleto.'</h3></center> ');

$numerofilas=mysql_num_rows($resulta);

if ($numerofilas==0){
	echo("<div id='error'><img src='imagenes/cuidado.png'>  Este Empleado no tiene ninguna contrato dado de alta </div>");
	}
else { //mostrar la tabla

echo ('<table border="0" cellspacing="1" cellpadding="4" width="100%" id="tablahover">');
echo('<tr><th></th>');
echo('<th>Tipo de Contrato</th>');
echo('<th>Fecha Inicio</th>');
echo('<th>Fecha Fin</th>');
echo('<th>Estado Contrato</th>');
echo('<th>Motivo Fin Contrato</th>');
echo('<th>Fecha Firma </th></tr>');

while ($row = mysql_fetch_array($resulta, MYSQL_NUM)) {
	?>
	<tr><td><a href="javascript:abrir_popup('vercontrato.php?IdContrato=<?php echo $row[0]; ?>')">
	<img src='./imagenes/buscar2.png'></a></td>
	<?php
	 //Cargar los valores de Tipo de Contrato desde la BD
   //crear array
	include("conectarbbdd.php");
	$tipocontrato = array();
	$resultado = mysql_query("SELECT * FROM  `t_tipocontrato`");
	while ($filas = mysql_fetch_array($resultado, MYSQL_NUM)) {
    	$tipocontrato[] = $filas[1];
	}
   echo('<td>'.$tipocontrato[$row[2]].'</td>');
   //FIN Carga de valores de Tipo de Contrato desde la BD
   
   //Cargar la fecha inicio del contrato
    printf("<td>%s</td>", $row[4]);
    //comporbar si fechasin es 0000-00-00
    if ($row[5]=='0000-00-00')
    {
     	 printf("<td>&nbsp</td>");
    }
    else {
    	 printf("<td>%s</td>", $row[5]);
     }
     ////Cargar los valores de estado de Contrato desde la BD
   //crear array
	include("conectarbbdd.php");
	$tipocontrato = array();
	$resultado = mysql_query("SELECT * FROM  `t_estadoscont`");
	while ($filas = mysql_fetch_array($resultado, MYSQL_NUM)) {
    	$tipocontrato[] = $filas[1];
	}
   echo('<td>'.$tipocontrato[$row[7]].'</td>');
	//cambiar el motivo fin de contrato	
	//crear array
	include("conectarbbdd.php");
	$tipocontrato = array();
	$resultado = mysql_query("SELECT * FROM  `t_fincont`");
	while ($filas = mysql_fetch_array($resultado, MYSQL_NUM)) {
    	$tipocontrato[] = $filas[1];
	}
   echo('<td>'.$tipocontrato[$row[3]-1].'</td>');
   printf("<td>%s</td></tr>", $row[8]);
   
}
echo('</table><br><br>');
}
mysql_close();


?>

<?php

if(isset($_POST["actualizar"])) 
{ 
	$idemplega=$_REQUEST['idemple'];
	echo ('<meta http-equiv="Refresh" content="0; URL=vercontratoemp.php?idempleatu='.$idemplega.'">');
}
?>

<?php
if(isset($_POST["altacontrato"])) 
{ 
	$idemplega=$_REQUEST['idemple'];
	echo ('<meta http-equiv="Refresh" content="0; URL=nuevocontrato.php?idempleatu='.$idemplega.'">');
}

?>

</center>
</div>
</div>
</div>
</body>
</html>


