<?php

require_once 'common.php';
checkUserLogged();
################################################################################
# Crea la instancia de Smarty
$smarty = new Smarty();

$cheques = NULL;
$mostrarMsj = false;
$arrErrors = NULL;
$arrWarns = NULL;
$msjOk = "";

function agregarCheque(){
    //print_r($_POST);
    $arrErrors = "";
    if(empty($_POST['fecha_cobro'])){
        $arrErrors[] = "Error: La Fecha de Cobro es requerida";
    }else{
        $fecha_cobro = $_POST['fecha_cobro'];
    }

    if(empty($_POST['cuenta'])){
        $arrErrors[] = "Error: La Cuenta es requerida";
    }else{
        $cuenta = $_POST['cuenta'];
    }

    if(empty($_POST['nro_cheque'])){
        $arrErrors[] = "Error: El Nro. de Cheque es requerido";
    }else{
        $nro_cheque = $_POST['nro_cheque'];
    }

    if(empty($_POST['persona'])){
        $arrErrors[] = "Error: La Persona es requerida";
    }else{
        $persona = $_POST['persona'];
    }

    if(empty($_POST['pesos'])){
        $arrErrors[] = "Error: El Valor del cheque es requerido";
    }else{
        $pesos = $_POST['pesos'];
    }

    if(empty($arrErrors)){

        if(empty($_POST['destino'])){
            $destino = "";
        }else{
            $destino = $_POST['destino'];
        }

        $daoCheque = DB_DataObject :: factory('cheque');
        $cheque = $daoCheque->buscarCheque($cuenta,$nro_cheque);
        if($cheque != false){
            $arrErrors[] = "Error: El Cheque $nro_cheque ya existe!";
            unset($cheque);
            unset($daoCheque);
            return $arrErrors;
        }

        $daoCheque->fecha_cobro = $fecha_cobro." ".date("H:i:s");
        $daoCheque->cuenta = $cuenta;
        $daoCheque->nro_cheque = $nro_cheque;
        $daoCheque->persona = $persona;
        $daoCheque->pesos = $pesos;
        $daoCheque->destino = $destino;
        $daoCheque->eliminado = false;

        if(!$daoCheque->insert()){
            $arrErrors[] = "Error: No se pudo agregar el Cheque";
        }
        unset($cheque);
        unset($daoCheque);
    }

    
    if(empty($arrErrors)){
        $msj = "El Cheque ha sido agregado ...";
        Fichero::redirect('cheques.php?msj='.$msj);
        exit;
    }
    
    return $arrErrors;
}


function editarCheque(){
    global $arrWarns;
    $arrErrors = "";

    if(empty($_GET['id_cheque'])){
        $arrErrors[] = "Error: No se puede agregar el Destinatario.";
    }else{
        $id_cheque = $_GET['id_cheque'];
    }

    if(empty($_POST['fecha_cobro'])){
        $arrErrors[] = "Error: La Fecha de Cobro es requerida";
    }else{
        $fecha_cobro = $_POST['fecha_cobro'];
    }

    if(empty($_POST['cuenta'])){
        $arrErrors[] = "Error: La Cuenta es requerida";
    }else{
        $cuenta = $_POST['cuenta'];
    }

    if(empty($_POST['nro_cheque'])){
        $arrErrors[] = "Error: El Nro. de Cheque es requerido";
    }else{
        $nro_cheque = $_POST['nro_cheque'];
    }

    if(empty($_POST['persona'])){
        $arrErrors[] = "Error: La Persona es requerida";
    }else{
        $persona = $_POST['persona'];
    }

    if(empty($_POST['pesos'])){
        $arrErrors[] = "Error: El Valor del cheque es requerido";
    }else{
        $pesos = $_POST['pesos'];
    }

    if(empty($arrErrors)){

        if(empty($_POST['destino'])){
            $destino = "";
        }else{
            $destino = $_POST['destino'];
        }

        $daoCheque = DB_DataObject :: factory('cheque');
        $cheque = $daoCheque->buscarChequePorId($id_cheque);
        if(!$cheque){
            $arrErrors[] = "Error: El cheque no existe.";
            unset($cheque);
            unset($daoCheque);
            return $arrErrors;
        }

        $cheque->fecha_cobro = $fecha_cobro." ".date("H:i:s");
        $cheque->cuenta = $cuenta;
        $cheque->nro_cheque = $nro_cheque;
        $cheque->persona = $persona;
        $cheque->pesos = $pesos;
        $cheque->destino = $destino;

        if(!$cheque->update()) $arrErrors[] = "Error: No se pudo editar el Cheque";
        unset($cheque);
        unset($daoCheque);
    }
    
    if(empty($arrErrors)){
        $msj = "El Cheque ha sido editado ...";
        Fichero::redirect('cheques.php?msj='.$msj);
        exit;
    }
    return $arrErrors;
}


function agregarEditarDestinatarioCheque(){
    global $arrWarns;
    $arrErrors = "";
    
    if(empty($_GET['id_cheque'])){
        $arrErrors[] = "Error: No se puede agregar el Destinatario.";
    }else{
        $id_cheque = $_GET['id_cheque'];
    }
    
    if(empty($_POST['nombre'])){
        $arrErrors[] = "Error: El Nombre es requerido";
    }else{
        $nombre = $_POST['nombre'];
    }

    if(empty($arrErrors)){
     
        $daoCheque = DB_DataObject :: factory('cheque');
        $cheque = $daoCheque->buscarChequePorId($id_cheque);
        if(!$cheque){
            $arrErrors[] = "Error: El cheque no existe.";
            unset($cheque);
            unset($daoCheque);
            return $arrErrors;
        }

        $cheque->destino = ucwords(strtolower($nombre));

        if(!$cheque->update()) $arrErrors[] = "Error: No se pudo agregar el Destinatario";
        unset($cheque);
        unset($daoCheque);
    }
    
    if(empty($arrErrors)){
        $msj = "El destinatario ha sido agregado ...";
        Fichero::redirect('cheques.php?msj='.$msj);
        exit;
    }
    
    return $arrErrors;
}


if(!empty($_GET['action'])){
    switch ($_GET['action']){
        case 'add':
            $mostrarMsj = true;
            $arrErrors = agregarCheque();
            if(empty($arrErrors)) $msjOk = 'El Cheque: '.$_POST['nro_cheque'].' ha sido cargado con &eacute;xito!.';
            break;
        case 'edit':
            $mostrarMsj = true;
            $arrErrors = editarCheque();
            if(empty($arrErrors)) $msjOk = 'El Cheque: '.$_POST['nro_cheque'].' ha sido editado con &eacute;xito!.';
            break;
        case 'add_destinatario':
            $mostrarMsj = true;
            $arrErrors = agregarEditarDestinatarioCheque();
            if(empty($arrErrors)) $msjOk = 'El Destinatario del Cheque ha sido cargado con &eacute;xito!.';
            break;
        case 'edit_destinatario':
            $mostrarMsj = true;
            $arrErrors = agregarEditarDestinatarioCheque();
            if(empty($arrErrors)) $msjOk = 'El Destinatario del Cheque ha sido editado con &eacute;xito!.';            
            break;
        case 'search':
            $mostrarMsj = true;
            $cuenta = $_POST['cuenta'];
            $cheque = $_POST['cheque'];
            if(empty($cuenta) && empty($cheque)){
                $arrErrors[] = "Error: El campo de b&uacute;squeda es obligatorio.";
                break;
            }
            $daoCheque = DB_DataObject :: factory('cheque');
            $order = 1;
            if(!empty($_GET['order'])) $order = $_GET['order'];
            $cheques = $daoCheque->buscarCheques($cuenta,$cheque,$order);
            if(empty($cheques)) $arrWarns[] = "No se encontraron resultados con $cuenta o $cheque.";
            break;
        case 'delete':
            $mostrarMsj = true;
            if(empty($_GET['id_cheque'])){
                $arrErrors[] = "Error: No se puede borrar el Cheque.";
            }else{
                $id_cheque = $_GET['id_cheque'];
                $daoCheque = DB_DataObject :: factory('cheque');
                if($daoCheque->deleteCheque($id_cheque)){
                    $msjOk = "El Cheque ha sido eliminado con &eacute;xito";
                }else{
                    $arrErrors[] = "Error: No se pudo borrar el Cheque por completo";
                }
            }
            unset($daoCheque);
            break;
    }
}


$smarty->assign('arrErrors',$arrErrors);
$smarty->assign('arrWarns',$arrWarns);
$smarty->assign('msjOk',$msjOk);
$smarty->assign('mostrarMsj',$mostrarMsj);

function listarCheques($cheques=NULL, $listarTodos = false){
    global $smarty;
//    echo $order; exit;
    $order = 1;
    if(!empty($_GET['order'])) $order = $_GET['order'];
    if($listarTodos){
        if(empty($cheques)){
            $daoCheque = DB_DataObject :: factory('cheque');
            $cheques = $daoCheque->getCheques($order);
            unset($daoCheque);
        }
        $smarty->assign('cheques',$cheques);
    }
    if(!empty($_GET['msj'])){
        $smarty->assign('arrWarns',$_GET['msj']);
        $smarty->assign('mostrarMsj',true);
    }
	$smarty->display('listar_cheques.tpl');
}


# Muestra el template
if (!empty($_GET['section'])){
    switch ($_GET['section']){
        case 1: //Listar
            $listar = false;
            if((!empty($_GET['action'])) && ($_GET['action'] == 'search')) $listar = true;
            listarCheques($cheques,$listar);
			break;
        case 2: //Agregar Destinatario
			$smarty->display('agregar_cheque_destinatario.tpl');
			break;
        case 3: //Editar Destinatario
            if(empty($_GET['id_cheque'])){
                listarCheques($cheques,false);
            }else{
                $id_cheque = $_GET['id_cheque'];
                $daoCheque = DB_DataObject :: factory('cheque');
                $cheque = $daoCheque->buscarChequePorId($id_cheque);
                if(!$cheque){
                    $smarty->assign('mostrarMsj',true);
                    $arrErrors[] = "Error: El cheque no existe.";
                    unset($cheque);
                    return $arrErrors;
                }else{
        			$smarty->assign('nombre',$cheque->destino);
                }
                $smarty->display('agregar_cheque_destinatario.tpl');
            }
			break;
        case 4: //Listar todos (LENTO!!)
            listarCheques($cheques,true);
			break;
        case 5: //Agregar Cheque
            $smarty->display('agregar_cheque.tpl');
            break;
        case 6: //Editar Cheque
           if(empty($_GET['id_cheque'])){
                listarCheques($cheques,false);
            }else{
                $id_cheque = $_GET['id_cheque'];

                $daoCheque = DB_DataObject :: factory('cheque');
                $cheque = $daoCheque->buscarChequePorId($id_cheque);
                if(!$cheque){
                    $arrErrors[] = "Error: El cheque no existe.";
                    unset($cheque);
                    unset($daoCheque);
                    return $arrErrors;
                }else{
                    $smarty->assign('fecha_cobro',$cheque->fecha_cobro);
                    $smarty->assign('cuenta',$cheque->cuenta);
                    $smarty->assign('nro_cheque',$cheque->nro_cheque);
                    $smarty->assign('persona',$cheque->persona);
                    $smarty->assign('pesos',$cheque->pesos);
                    $smarty->assign('destino',$cheque->destino);
                }
                $smarty->display('agregar_cheque.tpl');
            }
			break;
        default:
            listarCheques($cheques);
			break;
    }
}else{
	listarCheques($cheques);
}

