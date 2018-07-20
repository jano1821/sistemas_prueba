<?php

require_once 'common.php';
checkUserLogged();
################################################################################
# Crea la instancia de Smarty
$smarty = new Smarty();


$mostrarMsj = false;
$arrErrors = NULL;
$arrWarns = NULL;
$msjOk = "";



function editarPersona(){
    global $arrWarns;
    $arrErrors = "";
    
    if(empty($_POST['usuario'])){
        $arrErrors[] = "Error: El nombre de Usuario es requerido";
    }else{
        $usuario = $_POST['usuario'];
    }    

    if(empty($_POST['contrasena'])){
        $arrErrors[] = "Error: La Contrase&ntilde;a es requerida";
    }else{
        $contrasena = $_POST['contrasena'];
    }

    if(empty($arrErrors)){

        $daoUsuario = DB_DataObject :: factory('usuario');
        $daoUsuario->id_usuario = $_SESSION['ID_USER_GESTION'];
        if($daoUsuario->find(true)){
            if(($daoUsuario->usuario == $usuario) && ($daoUsuario->password == $contrasena)){
                unset($daoUsuario);
                $msj = "Se ha sido editado correctamente.";
                Fichero::redirect('contrasena.php?msj='.$msj);
                exit;
            }
            $daoUsuario->usuario = $usuario;
            $daoUsuario->password = $contrasena;
            $daoUsuario->tipo = $_SESSION['tipo'];
        }else{
            $arrErrors[] = "Error: No se pudo editar la contrase&ntilde;a.";
            unset($daoUsuario);
            return $arrErrors;
        }

        if(!$daoUsuario->update()) $arrErrors[] = "Error: No se pudo editar la Contrase&ntilde;a.";
        unset($daoUsuario);
    }
    
    if(empty($arrErrors)){
        $msj = "Se ha sido editado correctamente.";
        Fichero::redirect('contrasena.php?msj='.$msj);
        exit;
    }
    
    return $arrErrors;
}


if(!empty($_GET['action'])){
    switch ($_GET['action']){
        case 'edit':
            $mostrarMsj = true;
            $arrErrors = editarPersona();
            break;
    }
}


if(!empty($_GET['msj'])) {
    $mostrarMsj = true;
    $msjOk = $_GET['msj'];
}

$smarty->assign('arrErrors',$arrErrors);
$smarty->assign('arrWarns',$arrWarns);
$smarty->assign('msjOk',$msjOk);
$smarty->assign('mostrarMsj',$mostrarMsj);

# Muestra el template
$daoUsuario = DB_DataObject :: factory('usuario');
$daoUsuario->id_usuario = $_SESSION['ID_USER_GESTION'];
if($daoUsuario->find(true)){
     $smarty->assign('contrasena',$daoUsuario->password);
     $smarty->assign('usuario',$daoUsuario->usuario);
}else{
    $smarty->assign('mostrarMsj',true);
    $arrErrors[] = "Error: Comunicarse con el administrador.";
}



$smarty->display('editar_contrasena.tpl');

