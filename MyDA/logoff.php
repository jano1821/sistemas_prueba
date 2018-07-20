<?php
//Inicia la sesion
session_start();

$ruta = $_SERVER["DOCUMENT_ROOT"] . "/MyDA";

//Incluye las clases
include($ruta . "/clases/Funciones.php");
include($ruta . "/clases/Usuario.php");

$usuario = new Usuario();
$usuario->Desconectar();
Redirige("index.php");
?>
