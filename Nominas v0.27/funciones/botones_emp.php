<?php
if(isset($_POST["gordeemp"])) 
{ 
	$ida=$_REQUEST['ida'];
	$ape1=$_REQUEST['ape1'];
	$telcont1=$_REQUEST['telcont1'];
	$ape2=$_REQUEST['ape2'];
   $telcont2=$_REQUEST['telcont2'];	
   $nombre=$_REQUEST['nombre'];
   $state=$_REQUEST['state'];
   $sexo=$_REQUEST['sexo'];
	$dni=$_REQUEST['dni'];
	$calle=$_REQUEST['calle'];
	$cp=$_REQUEST['cp'];
	$piso=$_REQUEST['piso'];
	$puerta=$_REQUEST['puerta'];
	$localidad=$_REQUEST['localidad'];
	$provincia=$_REQUEST['provincia'];	
	$email=$_REQUEST['email'];
	$numss=$_REQUEST['numss'];
	$nhijos=$_REQUEST['nhijos'];
	$estadocivil=$_REQUEST['estadocivil'];
	$fechasal=$_REQUEST['fechasal'];
	$fechaent=$_REQUEST['fechaent'];
	$masdatos=$_REQUEST['masdatos'];

		include("./conectarbbdd.php");
		$result = mysql_query("UPDATE  `empleados` SET  `nombre` =  '$nombre',
		`apellidouno` =  '$ape1',
		`apellidodos` =  '$ape2',
		`email` =  '$email',
		`dni` =  '$dni',
		`estado` =  '$state',
		`nuss` =  '$numss',
		`sexo` =  '$sexo',
		`observaciones` =  '$masdatos',
		`telfcont` =  '$telcont1',
		`telfcont2` =  '$telcont2',
		`calle` =  '$calle',
		`piso` =  '$piso',
		`puerta` =  '$puerta',
		`cp` =  '$cp',
		`localidad` =  '$localidad',
		`provincia` =  '$provincia',
		`fechaent` =  '$fechaent',
		`fechasal` =  '$fechasal',
		`hijos` =  '$nhijos',
		`estadocivil` =  '$estadocivil' WHERE  `empleados`.`idemp` =$ida;");
		//REGISTRAR CAMBIO EN EL HISTORICO
		$usuario = $_SESSION['SESS_USERNAME'];
		$desccambio = "Modificacion Ficha Empleado";
		$tabla = "EMPLEADOS";
		$idemplhist = $ida;
		$idregistro = $ida;
		include("funciones/registrarcambio.php");
		printf("DATOS DEL EMPLEADO %s, GUARDADOS CORRECTAMENTE", $ida);
		echo ('<meta http-equiv="Refresh" content="0; URL=verempleado.php?idempleatu='.$ida.'">');
}

if(isset($_POST["ezabatuemp"])) 
{ 
	$submitted=$_REQUEST['submitted'];
	$ida=$_REQUEST['ida'];
	if ($submitted==1){
		echo ('<meta http-equiv="Refresh" content="0; URL=verempleado.php?idempleatu='.$ida.'">');
	}
	else 
	{
		include("./conectarbbdd.php");
		$result = mysql_query("DELETE FROM `empleados` WHERE `empleados`.`idemp` = $ida");
		//REGISTRAR CAMBIO EN EL HISTORICO
		$usuario = $_SESSION['SESS_USERNAME'];
		$desccambio = "Eliminar Ficha Empleado";
		$tabla = "EMPLEADOS";
		$idemplhist = $ida;
		$idregistro = $ida;
		include("funciones/registrarcambio.php");
		echo ('<meta http-equiv="Refresh" content="0; URL=buscaremp.php">');
	}
}

/*if(isset($_POST["listarnom"])) 
{ 
	$ida=$_REQUEST['ida'];
	echo ('<meta http-equiv="Refresh" content="0; URL=linomina1.php?idempleatu='.$ida.'">');
}

if(isset($_POST["crearnom2"])) 
{ 
	$ida=$_REQUEST['ida'];
	echo ('<meta http-equiv="Refresh" content="0; URL=nuevonom.php?idempleatu='.$ida.'">');
} */

if(isset($_POST["printlistnom"])) 
{ 
   $ida=$_REQUEST['ida'];
	echo ('<meta http-equiv="Refresh" content="0; URL=verempprint.php?idempleatu='.$ida.'">');
}

if(isset($_POST["fotoemp"])) 
{ 
   $ida=$_REQUEST['ida'];
	echo ('<meta http-equiv="Refresh" content="0; URL=verempleado.php?idempleatu='.$ida.'">');
}

if(isset($_POST["actualizar"])) 
{ 
	$ida=$_REQUEST['ida'];
	echo ('<meta http-equiv="Refresh" content="0; URL=verempleado.php?idempleatu='.$ida.'">');
}

?>