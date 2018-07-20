<?php
//Inicia la sesion
session_start();

$ruta = $_SERVER["DOCUMENT_ROOT"] . "/MyDA";

//Recupera los parametros del config.ini
$parametros = parse_ini_file($ruta . "/config.ini");

//Incluye las clases
include($ruta . "/clases/Conexion.php");
include($ruta . "/clases/Funciones.php");
include($ruta . "/clases/Usuario.php");

$user = $_POST["usuario"];
$clave = $_POST["clave"];
$usuario = new Usuario();
$usuario->Logea($user, $clave);
Redirige("index.php");
?>
