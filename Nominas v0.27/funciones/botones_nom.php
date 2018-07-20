<?php

if(isset($_POST["gordenom"])) 
{ 
	$fechapago=$_REQUEST['fechapago'];
	$tiponom=$_REQUEST['tiponom'];
	$estadonom=$_REQUEST['estadonom'];
	$ida=$_REQUEST['idnom'];
	$anionom=$_REQUEST['anionom'];
	$idemplea2=$_REQUEST['idemplea2'];
	$idcontrato2=$_REQUEST['idcontrato2'];
		
	include("./conectarbbdd.php");
	
	if (empty($anionom)) {
	echo ("<label id='error'> <img src='imagenes/cuidado.png'> No puedes dejar el A&ntilde;o en blanco </label>");
	echo ('<meta http-equiv="Refresh" content="0.5; URL=lnomina1.php?idnomina='.$ida.'">'); 
	}
	else {
		$result = "UPDATE  `nominas` SET  `urtea` =  '$anionom', `fechapago` =  '$fechapago',
		`estadonom` =  '$estadonom', `idcontrato` =  '$idcontrato2', `idemp` =  '$idemplea2'
		, `tiponom` =  '$tiponom' WHERE  `nominas`.`idnomina` = '$ida'; ";
		$sqlresult= mysql_query($result);
		//REGISTRAR CAMBIO EN EL HISTORICO
		$usuario = $_SESSION['SESS_USERNAME'];
		$desccambio = "Modificar Nomina";
		$tabla = "NOMINAS";
		$idemplhist = $idemplea2;
		$idregistro = $ida;
		include("funciones/registrarcambio.php");
		echo ('<meta http-equiv="Refresh" content="0; URL=lnomina1.php?idnomina='.$ida.'">'); 
	}
}

if(isset($_POST["printnom"])) 
{ 
   $ida=$_REQUEST['idnom'];
	echo ('<meta http-equiv="Refresh" content="0; URL=bnominap.php?idnom='.$ida.'">');
}

if(isset($_POST["actualizar"])) 
{ 
   $ida=$_REQUEST['idnom'];
	echo ('<meta http-equiv="Refresh" content="0; URL=lnomina1.php?idnomina='.$ida.'">');
}

if(isset($_POST["nuevoemp"])) 
{ 
   $ida=$_REQUEST['idnom'];
	echo ('<meta http-equiv="Refresh" content="0; URL=lnomina1.php?idnomina='.$ida.'">');
}

if(isset($_POST["nuevocont"])) 
{ 
   $ida=$_REQUEST['idnom'];
	echo ('<meta http-equiv="Refresh" content="0; URL=lnomina1.php?idnomina='.$ida.'">');
}

if(isset($_POST["borrarnom"])) 
{ 
	$submitted=$_REQUEST['submitted'];
	$idnom=$_REQUEST['idnom'];
	$idemplea2=$_REQUEST['idemplea2'];
	if ($submitted==1){
		echo ('<meta http-equiv="Refresh" content="0; URL=lnomina1.php?idnomina='.$idnom.'">');
	}
	else 
	{
	include("./conectarbbdd.php");
	$result = mysql_query("DELETE FROM `nominas` WHERE  `idnomina` = $idnom");
		//REGISTRAR CAMBIO EN EL HISTORICO
		$usuario = $_SESSION['SESS_USERNAME'];
		$desccambio = "Eliminar Nomina";
		$tabla = "NOMINAS";
		$idemplhist = $idemplea2;
		$idregistro = $idnom;
		include("funciones/registrarcambio.php");
	echo ('<meta http-equiv="Refresh" content="0; URL=buscarnom.php">');
	}
} 

?>