<?php
//Inicia la sesion
session_start();

$ruta = $_SERVER["DOCUMENT_ROOT"] . "/MyDA";

//Recupera los parametros del config.ini
$parametros = parse_ini_file($ruta . "/config.ini");

//Incluye las clases
include($ruta . "/clases/Conexion.php");
include($ruta . "/clases/Tabla.php");
include($ruta . "/clases/Funciones.php");
include($ruta . "/clases/Campo.php");
include($ruta . "/clases/Menu.php");
include($ruta . "/clases/Thumbnail.php");
include($ruta . "/clases/Usuario.php");

//Comprueba que existan las tablas del programa
$tablas = TRUE;
if (!tabla_existe("fw_tablas")) {
    $tablas = FALSE;
}
if (!tabla_existe("fw_campos")) {
    $tablas = FALSE;
}
if (!tabla_existe("fw_tiposCampos")) {
    $tablas = FALSE;
}
if (!tabla_existe("fw_menus")) {
    $tablas = FALSE;
}
if (!tabla_existe("fw_usuarios")) {
    $tablas = FALSE;
}
if (!$tablas) {
    Redirige("doc/instalar.html");
}

//Comprueba el acceso del usuario
$usuario = new Usuario();
$usuario->CheckLogin();
?>
