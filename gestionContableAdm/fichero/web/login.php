<?php

require_once 'common.php';
################################################################################
# Crea la instancia de Smarty
$smarty = new Smarty();

$user = $_POST['user'];
$pass = $_POST['pass'];

if(!empty($_GET['action'])){
    if($_GET['action'] == 'login'){

        if(empty($user)) Fichero::addErrorMessage("ERROR: El usuario es requerido.<br>");
        if(empty($pass)) Fichero::addErrorMessage("ERROR: La contrase&ntilde;a es requerida.<br>");

        if (!Fichero::hasErrorMessages()) {
            $usuario = validUser($user,$pass);
            if(!$usuario){
                Fichero::addErrorMessage("ERROR: Usuario o Contrase&ntilde;a NO v&aacute;lidos.");
            }else{
                $_SESSION['ID_USER_GESTION']    = $usuario->id_usuario;
                $_SESSION['id_usuario'] = $usuario->id_usuario;
                $_SESSION['nombre']     = $usuario->usuario;
                $_SESSION['tipo']       = $usuario->tipo;
                Fichero::redirect('index.php');
            }
        }
    }

    if($_GET['action'] == 'logout'){
        session_unset();
        Fichero::redirect('login.php');
    }
}


# Muestra el template
$smarty->display('login.tpl');

