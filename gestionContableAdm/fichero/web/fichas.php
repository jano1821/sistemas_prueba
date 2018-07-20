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

function agregarFicha(){
    $arrErrors = "";
    global $smarty;
    //print_r($_POST);exit;
    if(empty($_POST['valor'])){
        $arrErrors[] = "Error: El Valor es requerido";
    }else{
        $valor = $_POST['valor'];
        if(!is_numeric($valor)) $arrErrors[] = "Error: El Valor debe ser numerico";
    }

    if(empty($_POST['fecha'])){
        $arrErrors[] = "Error: La Fecha es requerida";
    }else{
        $fecha = $_POST['fecha'];
    }
    
    if(empty($_GET['tipo'])){
        $arrErrors[] = "Error: No se pudo definir el movimiento";
    }else{
        $tipo = $_GET['tipo'];
    }
    
    if(empty($_GET['id_persona'])){
        $arrErrors[] = "Error: No se pudo definir el movimiento";
    }else{
        $id_persona = $_GET['id_persona'];
    }

    if(empty($arrErrors)){

        if(empty($_POST['descripcion'])){
            $descripcion = "";
        }else{
            $descripcion = $_POST['descripcion'];
        }

        $daoFicha = DB_DataObject :: factory('ficha');
        
        if($tipo == 1){ // Tipo = 1 -> Debe .... Tipo = 2 -> Haber
            $daoFicha->entrada = 0;
            $daoFicha->salida = $valor;
        }else{
            $daoFicha->entrada = $valor;
            $daoFicha->salida = 0;
        }
        
        $daoFicha->fecha = $fecha." ".date("H:i:s");
        $daoFicha->descripcion = $descripcion;
        $daoFicha->eliminado = false;
        $daoFicha->id_persona = $id_persona;

//print_r($daoFicha);exit;
        
        if(!$daoFicha->insert()){
            $arrErrors[] = "Error: No se pudo agregar el movimiento";
        }
        unset($daoFicha);
    }
    
    if(empty($arrErrors)){
        $msj = "El Movimiento ha sido agregado ...";
        Fichero::redirect('personas.php?id_persona='.$id_persona.'&section=7&msj='.$msj);
        exit;
    }

    return $arrErrors;
}

function editarFicha(){
    $arrErrors = "";
    global $smarty;
    //print_r($_POST);exit; print_r($_GET); exit;
    
    if(empty($_GET['id_ficha'])){
        $arrErrors[] = "Error: No se puede editar la Ficha.";
    }else{
        $id_ficha = $_GET['id_ficha'];
    }
    
    if(empty($_POST['valor'])){
        $arrErrors[] = "Error: El Valor es requerido";
    }else{
        $valor = $_POST['valor'];
        if(!is_numeric($valor)) $arrErrors[] = "Error: El Valor debe ser numerico";
    }

    if(empty($_POST['fecha'])){
        $arrErrors[] = "Error: La Fecha es requerida";
    }else{
        $fecha = $_POST['fecha'];
    }
    
    if(empty($_GET['tipo'])){
        $arrErrors[] = "Error: No se pudo definir el movimiento";
    }else{
        $tipo = $_GET['tipo'];
    }
    
    if(empty($_GET['id_persona'])){
        $arrErrors[] = "Error: No se pudo definir el movimiento";
    }else{
        $id_persona = $_GET['id_persona'];
    }

    if(empty($arrErrors)){

        if(empty($_POST['descripcion'])){
            $descripcion = "";
        }else{
            $descripcion = $_POST['descripcion'];
        }

        $daoFicha = DB_DataObject :: factory('ficha');
        $ficha = $daoFicha->buscarFichaPorId($id_ficha);
                
        if(!$ficha){
            $smarty->assign('mostrarMsj',true);
            $arrErrors[] = "Error: La ficha no existe.";
            unset($ficha);
            return $arrErrors;
        }
        
        if($tipo == 1){ // Tipo = 1 -> Debe .... Tipo = 2 -> Haber
            $ficha->entrada = 0;
            $ficha->salida = $valor;
        }else{
            $ficha->entrada = $valor;
            $ficha->salida = 0;
        }
        
        $ficha->fecha = $fecha." ".date("H:i:s");
        $ficha->descripcion = $descripcion;
        $ficha->eliminado = false;
        $ficha->id_persona = $id_persona;

//print_r($daoFicha);exit;
        
        if(!$ficha->update()){
            $arrErrors[] = "Error: No se pudo editar el movimiento";
        }
        unset($daoFicha);
    }
    
    if(empty($arrErrors)){
        $msj = "El Movimiento ha sido editado ...";
        Fichero::redirect('personas.php?id_persona='.$id_persona.'&section=7&msj='.$msj);
        exit;
    }

    return $arrErrors;
}


if(!empty($_GET['action'])){
    switch ($_GET['action']){
        case 'add':
            $mostrarMsj = true;
            $arrErrors = agregarFicha();
            if(empty($arrErrors)) $msjOk = 'El movimiento ha sido agregado con &eacute;xito!.';
            break;
        case 'edit':
            $mostrarMsj = true;
            $arrErrors = editarFicha();
            if(empty($arrErrors)) $msjOk = 'El movimiento ha sido editado con &eacute;xito!.';
            break;
        case 'delete':
            $mostrarMsj = true;
            if(empty($_GET['id_ficha'])){
                $arrErrors[] = "Error: No se puede borrar la Ficha.";
            }else{
                $id_ficha = $_GET['id_ficha'];
                $daoFicha = DB_DataObject :: factory('ficha');
                if($daoFicha->deleteFicha($id_ficha)){
                    $msjOk = "La Ficha ha sido eliminada con &eacute;xito";
                }else{
                    $arrErrors[] = "Error: No se pudo borrar la Ficha";
                }
            }
            unset($daoFicha);
            break;
        
    }
}


$smarty->assign('arrErrors',$arrErrors);
$smarty->assign('arrWarns',$arrWarns);
$smarty->assign('msjOk',$msjOk);
$smarty->assign('mostrarMsj',$mostrarMsj);

function listarMovimientos($id_persona){
    global $smarty;
    if(!empty($id_persona)){
        $daoFicha = DB_DataObject :: factory('ficha');
        $fichas = $daoFicha->getFichasPorPersona($id_persona);
        unset($daoFicha);
        $smarty->assign('fichas',$fichas);
        
        $daoPersonas = DB_DataObject :: factory('persona');
        $persona = $daoPersonas->buscarPersonaPorId($id_persona);
        unset($daoPersonas);
        if($persona){
            $smarty->assign('nombre',$persona->nombre." ".$persona->apellido);
        }
        unset($persona);
        
        $smarty->assign('id_persona',$id_persona);
    }
	$smarty->display('listar_movimientos.tpl');
}

if (!empty($_GET['section'])){
    switch ($_GET['section']){
        case 1: //Listar
            listarMovimientos($_GET['id_persona']);
			break;
        case 2: //Agregar
            $smarty->assign('tipo',$_GET['tipo']);
			$smarty->display('agregar_movimiento.tpl');
			break;
        case 3: //Editar
			if(empty($_GET['id_ficha'])){
                listarMovimientos($_GET['id_persona']);
            }else{
                $id_ficha = $_GET['id_ficha'];
                $daoFicha = DB_DataObject :: factory('ficha');
                $ficha = $daoFicha->buscarFichaPorId($id_ficha);
                
                if(!$ficha){
                    $smarty->assign('mostrarMsj',true);
                    $arrErrors[] = "Error: La ficha no existe.";
                    unset($ficha);
                    return $arrErrors;
                }else{
                    if(empty($ficha->entrada)){
                        $smarty->assign('valor',$ficha->salida);
                        $smarty->assign('tipo',1);
                    }else{
                        $smarty->assign('valor',$ficha->entrada);
                        $smarty->assign('tipo',2);
                    }
                    
                    $smarty->assign('descripcion',$ficha->descripcion);
                    $smarty->assign('fecha',$ficha->fecha);
                    $smarty->assign('id_persona',$ficha->id_persona);
                }
                $smarty->display('agregar_movimiento.tpl');
            }
            break;
        default:
            listarMovimientos($_GET['id_persona']);
			break;
    }
}else{
	listarMovimientos($_GET['id_persona']);
}

//listarMovimientos($_GET['id_persona']);

# Muestra el template
//$smarty->display('personas.tpl');
