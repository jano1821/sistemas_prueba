<?php
	//Inciar la sesión
	session_start();
	//Eliminar las variables de sesión (con esas son necesarias)
	unset($_SESSION['SESS_MEMBER_ID']);
	unset($_SESSION['SESS_FIRST_NAME']);
	unset($_SESSION['SESS_LAST_NAME']);
?>
<head>
<title>Has sido deslogado del sistema</title>
<link href="./estilos.css" rel="stylesheet" type="text/css" />
</head>
<body>
<br><br>
<center><h1><img src='../imagenes/prohibido.png'> Salida del Sistema </h1> </center>
<p align="center">&nbsp;</p>
<h4 align="center" id="error">Has sido deslogado del sistema.</h4>
<p align="center">Pulsa para <a href="login.php">ACCEDER</a></p>
</body>
</html>
