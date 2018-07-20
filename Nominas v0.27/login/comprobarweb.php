<?php
	//Inciar la sesión
	session_start();
	//Comrpbar si la variable de la sesión SESS_MEMBER_ID existe,
	// y eliminar los espacios para asegurarme que no es un idconexion falso, o "vacio"
	if(!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '')) {
		header("location: login/login.php");
		exit();
	}
?>