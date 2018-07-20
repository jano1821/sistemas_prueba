<?php
	require_once('login/comprobarweb.php');
?>
<html>
<head>
<title> Sitema de Empleados y Nominas Online </title>
<link rel=StyleSheet href="estilos.css" TYPE="text/css">
<link rel=StyleSheet href="menu/css/nav.css" TYPE="text/css">
</head>

<SCRIPT LANGUAGE="JavaScript" SRC="javascript/CalendarPopup.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
	var cal = new CalendarPopup();
</SCRIPT>

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

function validar_dni ( )
{
    valid = true;

    if ( document.formulario.dni.value == "" )
    {
        alert ( "EL DNI no puede estar en blanco" );
        valid = false;
    }

    return valid;
}

</script>

<body>
<?php
	include("menu/menu.php");
?>
<form name='formulario' method="post" action="<?=$_SERVER['PHP_SELF']?>"> 
<?php
$datoempl= $_GET['idempleatu'];
$idemplega=$datoempl;
?>
 <script language="JavaScript">
function abrir_foto(){
window.open('popup_foto.php?idempleado=<?php echo $datoempl; ?>',"ventana1","width=400, height=520, directories=no ,scrollbars=no, menubar=no, location=no, resizable=no")
}
</script>
<?php
include("conectarbbdd.php");
$result = mysql_query("SELECT * FROM  `empleados` WHERE  `idemp` LIKE  '$datoempl' LIMIT 0 , 30");

while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    $nombrecompleto=$row[1].' '.$row[2].' '.$row[3];
}
$result = mysql_query("SELECT * FROM  `empleados` WHERE  `idemp` LIKE  '$datoempl' LIMIT 0 , 30");
?>

<?php include("funciones/menu_empleado.php"); ?>
<div id="contenido">
<?php include("menu/botoneraemp.php"); ?>
<div id="principal">
<?php

function crear_dropdown( $name, array $options, $selected=null)
{
    $dropdown = '<select name="'.$name.'" id="'.$name.'" >'."\n";
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
<br>
<center>
<table class="tablaazul" bgcolor="white" border="1" bordercolor="#6396BB" cellpadding="3" cellspacing="0">
  <tbody>
<?php
include("funciones/mostrar_emp.php");
mysql_free_result($result);
?>

<?php
include("funciones/botones_emp.php");
?>
</center>
</form> 
</div>
</div>
</body>
</html>



