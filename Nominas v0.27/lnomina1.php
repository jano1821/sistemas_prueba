<?php
	require_once('login/comprobarweb.php');
?>
<html>
<head>
<title> Sitema de Empleados y Nominas Online </title>
<link rel=StyleSheet href="estilos.css" TYPE="text/css">
<link rel=StyleSheet href="menu/css/nav.css" TYPE="text/css">

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

<script language="Javascript">
function confirmDel()
{
var agree=confirm("Realmente desea eliminarlo ? ");
if (agree) {
	document.formulario.submitted.value='0';
	}
else{
	document.formulario.submitted.value='1';
	}
}

</script>

<script type="text/javascript">

function validar_anio ( )
{
    valid = true;

    if ( document.formulario.anionom.value == "" )
    {
        alert ( "EL A\u00f1o no puede estar en blanco" );
        valid = false;
    }

    return valid;
}

</script>

<body>
<?php
	include("menu/menu.php");
	include("funciones/crear_dropdown.php");
?>

<form name='formulario' method="post" action="<?=$_SERVER['PHP_SELF']?>"> 
    
<?php
$idnom= $_GET['idnomina'];
$datonom=$idnom;
include("conectarbbdd.php");

$resultado = mysql_query("SELECT * FROM  `nominas` WHERE  `idnomina` LIKE  '$idnom' LIMIT 0 , 30");

while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
    echo('<input type="hidden" name="idnomina" value="'.$idnom.'" >');
    $idempleado= $fila[1];
}



?>

<?php include("funciones/menu_nomina.php"); ?>
<div id="contenido">
<?php include("menu/botoneravernom.php"); ?>
<div id="principal">
<center>
<?php
	$result = mysql_query("SELECT * FROM  `nominas` WHERE  `idnomina` LIKE  '$idnom' LIMIT 0 , 30");
	include("funciones/mostrarnom.php");


	include("funciones/botones_nom.php");

?>
</center>

</div>
</div>
</div>
</body>
</html>


