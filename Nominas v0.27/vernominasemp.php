<?php
	require_once('login/comprobarweb.php');
?>
<html>
<head>
<title> Sitema de Empleados y Nominas Online </title>
<link rel=StyleSheet href="estilos.css" TYPE="text/css">
<link rel=StyleSheet href="menu/css/nav.css" TYPE="text/css">
</head>

<script language="Javascript">

function validar_estadoemp ( )
{
    valid = true;

    if ( document.formulario.estadoemp.value == "1" )
    {
        alert ( "No puede crear una nueva nomina sobre un Empleado con estado Inactivo" );
        valid = false;
    }
    else{
	    if ( document.formulario.numcontrato.value == "1" )
	    {
	        alert ( "No se puede crear ninguna nomina sobre un empleado que no dispone de ningun Contrato. Proceda a crear un nuevo contrato para este Empleado" );
	        valid = false;
	    }
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
<?php include("menu/botoneranom.php"); ?>
<div id="principal">
<center>
<?php
//Comprobar si exixte algun contrato sobre el empleado, ya que en caso contrario no se puede crear ninguna nomina
$resulcontrato = mysql_query("SELECT * FROM  `contratos` WHERE  `idempleado` = '$idemplega' ");

$numcontratos=mysql_num_rows($resulcontrato);

if ($numcontratos==0){
	echo('<input type="hidden" name="numcontrato" value="1" >');
}

//Cargar lista de nominas
$resulta = mysql_query("SELECT * FROM  `nominas` WHERE  `idemp` LIKE  '$idemplega' LIMIT 0 , 999");

$numerofilas=mysql_num_rows($resulta);

if ($numerofilas==0){
	echo("<div id='error'><img src='imagenes/cuidado.png'>  No hay ninguna nomina creada para este empleado </div>");
	}
else { //mostrar la tabla
		echo ('<br><br><table border="0" cellspacing="1" cellpadding="4" width="100%" id="tablahover">');
		echo("<tr><th></th><th>IDNomina</th>");
		echo("<th>IdEmpleado</th>");
		echo("<th>Mes</th>");
		echo("<th>A&ntilde;o</th>");
		echo("<th>Fecha Pago</th>");
		echo("<th>Estado Nomina</th>");
		echo("<th>Tipo Nomina</th>");
		echo("<th>H.Contrato</th>");
		echo("<th>Total</th></tr>");
		$result=mysql_query($resultquery);
		//CARGAR LOS ESTADOS DE LAS NOMINAS
		$arrayestados = array();
		$resulestados = mysql_query("SELECT * FROM  `t_estadosnom`");
		while ($filaemp = mysql_fetch_array($resulestados, MYSQL_NUM)) {
		 		$arrayestados[] = $filaemp[1];
		}
		//CARGAR LOS TIPOS DE LAS NOMINAS
		$arraytipos = array();
		$resultipos = mysql_query("SELECT * FROM  `t_tiponom`");
		while ($filatipos = mysql_fetch_array($resultipos, MYSQL_NUM)) {
	    		$arraytipos[] = $filatipos[1];
		}
		while ($row = mysql_fetch_array($resulta, MYSQL_NUM)) {
			printf ("<tr><th><a href='lnomina1.php?idnomina=%s' target='empleado%s'><img src='./imagenes/buscar2.png'></a></th>", $row[0], $row[0]);
			printf("<td>%s</td>", $row[0]);
			printf("<td>%s</td>", $row[1]);
			printf("<td>%s</td> ", $row[2]);
			printf("<td>%s</td>", $row[3]);
			printf("<td>%s</td> ", $row[6]);
			printf("<td>%s</td> ", $arrayestados[$row[7]]);
			printf("<td>%s</td> ", $arraytipos[$row[8]]);
			//buscar si tiene horas de contrato
			$sqlnomconp = "SELECT * FROM  `conceptosnom` WHERE  `IdNomina` = '$row[0]' AND  `IdConcepto` = 1 ";
			$resulsql=mysql_query($sqlnomconp);
			$existefilanom=0;
			while ($filanom = mysql_fetch_array($resulsql, MYSQL_NUM)) {
					printf("<td>%s</td>", $filanom[3]);
					$existefilanom=1;
			}
			if ($existefilanom == '0'){
				printf("<td>0</td>");
			}
			printf("<td>%s</td></tr>", $row[4]);
		}
		echo("</table></center>");
		echo('<br><br>');

}
mysql_close();

?>

<?php
if(isset($_POST["printlistnom"])) 
{ 
   $idempleatu=$_REQUEST['idemple'];
	echo ('<meta http-equiv="Refresh" content="0; URL=linomina1.php?idempleatu='.$idempleatu.'">');
}

if(isset($_POST["crearnomina"])) 
{ 
	$idemplega=$_REQUEST['idemple'];
	echo ('<meta http-equiv="Refresh" content="0; URL=nuevonom.php?idempleatu='.$idemplega.'">');
}


if(isset($_POST["actualizar"])) 
{ 
	$idemplega=$_REQUEST['idemple'];
	echo ('<meta http-equiv="Refresh" content="0; URL=vernominasemp.php?idempleatu='.$idemplega.'">');
}

?>



</center>
</div>
</div>
</body>
</html>


