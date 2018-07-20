<?php

# Este require_once debe estar SI O SI
require_once '../commons/common.php';
Fichero::sessionStart();
################################################################################
#  ESTE ARCHIVO ES COMUN SOLO A ESTE SITIO.
# A PARTIR DE ACÁ PUEDE SER MODIFICADO Y/O ADAPTADO PARA EL SITIO.

function getGlobalConfig(){
    return parse_ini_file('config.ini',true);
}

function userLogged(){
    if(empty($_SESSION['ID_USER_GESTION'])) return false;
    return true;
}

function checkUserLogged($soloAdmin=false){
    //print_r($_SESSION); return;
/*
    $_SESSION['ID_USER_GESTION']    = 99999;
    $_SESSION['id_usuario'] = 99999;
    $_SESSION['nombre']     = 'Admin Sin Login';
    $_SESSION['tipo']       = 1;

    return true;
  */  
    
    if(!userLogged()){
        header('Location: login.php');
        exit;
    }

    return true;
}

function validUser($user,$pass){
    if(empty($user) || empty($pass)){
        return false;
    }
    $usuario = DB_DataObject::factory('usuario');
    $usuario->user = $user;
    $usuario->password = $pass;
    //echo "User: $user -> Pass: $pass";
    if($usuario->find(true)){
        return $usuario;
    }
    return false;
}


