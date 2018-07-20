<?php

require_once 'common.php';
checkUserLogged();
################################################################################
# Crea la instancia de Smarty
$smarty = new Smarty();

$personas = NULL;
$mostrarMsj = false;
$arrErrors = NULL;
$arrWarns = NULL;
$msjOk = "";

function agregarPersona(){
    //print_r($_POST);
    $arrErrors = "";
    if(empty($_POST['nombre'])){
        $arrErrors[] = "Error: El Nombre es requerido";
    }else{
        $nombre = $_POST['nombre'];
    }

    if(empty($_POST['apellido'])){
        $arrErrors[] = "Error: El Apellido es requerido";
    }else{
        $apellido = $_POST['apellido'];
    }

    if(empty($_POST['direccion'])){
        $arrErrors[] = "Error: El Direcci&oacute;n es requerido";
    }else{
        $direccion = $_POST['direccion'];
    }

    if(empty($_POST['telefono'])){
        $arrErrors[] = "Error: El Tel&eacute;fono es requerido";
    }else{
        $telefono = $_POST['telefono'];
    }

    if(empty($arrErrors)){

        if(empty($_POST['celular'])){
            $celular = "";
        }else{
            $celular = $_POST['celular'];
        }
        
        if(empty($_POST['dni'])){
            $dni = "";
        }else{
            $dni = $_POST['dni'];
        }
        
        if(empty($_POST['cuit'])){
            $cuit = "";
        }else{
            $cuit = $_POST['cuit'];
        }

        if(empty($_POST['email'])){
            $email = "";
        }else{
            $email = $_POST['email'];
        }

        if(empty($_POST['descripcion'])){
            $descripcion = "";
        }else{
            $descripcion = $_POST['descripcion'];
        }

        $daoPersona = DB_DataObject :: factory('persona');
        $persona = $daoPersona->buscarPersona($nombre, $apellido);
        if($persona != false){
            $arrErrors[] = "Error: La Persona $nombre ya existe!";
            unset($persona);
            return $arrErrors;
        }

        $daoPersona->nombre = ucwords(strtolower($nombre));
        $daoPersona->apellido = ucwords(strtolower($apellido));
        $daoPersona->direccion = ucwords(strtolower($direccion));
        $daoPersona->telefono = $telefono;
        $daoPersona->celular = $celular;
        $daoPersona->dni = $dni;
        $daoPersona->cuit = $cuit;
        $daoPersona->email = $email;
        $daoPersona->descripcion = $descripcion;

        if(!$daoPersona->insert()){
            $arrErrors[] = "Error: No se pudo agregar la Persona";
        }
        unset($daoPersona);
    }

    
    if(empty($arrErrors)){
        $msj = "La persona ha sido agregada ...";
        Fichero::redirect('personas.php?msj='.$msj);
        exit;
    }
    
    return $arrErrors;
}


function editarPersona(){
    global $arrWarns;
    $arrErrors = "";
    
    if(empty($_GET['id_persona'])){
        $arrErrors[] = "Error: No se puede editar la Persona.";
    }else{
        $id_persona = $_GET['id_persona'];
    }
    
    if(empty($_POST['nombre'])){
        $arrErrors[] = "Error: El Nombre es requerido";
    }else{
        $nombre = $_POST['nombre'];
    }

    if(empty($_POST['apellido'])){
        $arrErrors[] = "Error: El Apellido es requerido";
    }else{
        $apellido = $_POST['apellido'];
    }

    if(empty($_POST['direccion'])){
        $arrErrors[] = "Error: El Direcci&oacute;n es requerido";
    }else{
        $direccion = $_POST['direccion'];
    }

    if(empty($_POST['telefono'])){
        $arrErrors[] = "Error: El Tel&eacute;fono es requerido";
    }else{
        $telefono = $_POST['telefono'];
    }

    if(empty($arrErrors)){
        
        if(empty($_POST['celular'])){
            $celular = "";
        }else{
            $celular = $_POST['celular'];
        }
        
        if(empty($_POST['dni'])){
            $dni = "";
        }else{
            $dni = $_POST['dni'];
        }

        if(empty($_POST['cuit'])){
            $cuit = "";
        }else{
            $cuit = $_POST['cuit'];
        }
        
        if(empty($_POST['email'])){
            $email = "";
        }else{
            $email = $_POST['email'];
        }

        if(empty($_POST['descripcion'])){
            $descripcion = "";
        }else{
            $descripcion = $_POST['descripcion'];
        }

        $daoPersona = DB_DataObject :: factory('persona');
        $persona = $daoPersona->buscarPersonaPorId($id_persona);
        if(!$persona){
            $arrErrors[] = "Error: La persona no existe.";
            unset($persona);
            return $arrErrors;
        }

        $persona->nombre = ucwords(strtolower($nombre));
        $persona->apellido = ucwords(strtolower($apellido));
        $persona->direccion = ucwords(strtolower($direccion));
        $persona->telefono = $telefono;
        $persona->celular = $celular;
        $persona->dni = $dni;
        $persona->cuit = $cuit;
        $persona->email = $email;
        $persona->descripcion = $descripcion;

        if(!$persona->update()) $arrErrors[] = "Error: No se pudo editar la Persona";
        unset($persona);
        unset($daoPersona);
    }
    
    if(empty($arrErrors)){
        $msj = "La persona ha sido editada ...";
        Fichero::redirect('personas.php?msj='.$msj);
        exit;
    }
    
    return $arrErrors;
}


if(!empty($_GET['action'])){
    switch ($_GET['action']){
        case 'add':
            $mostrarMsj = true;
            $arrErrors = agregarPersona();
            if(empty($arrErrors)) $msjOk = 'La Persona: '.$_POST['nombre'].' ha sido cargada con &eacute;xito!.';
            break;
        case 'edit':
            $mostrarMsj = true;
            $arrErrors = editarPersona();
            if(empty($arrErrors)) $msjOk = 'La Persona: '.$_POST['nombre'].' ha sido editada con &eacute;xito!.';
            break;
        case 'search':
            $mostrarMsj = true;
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            if(empty($nombre) && empty($apellido)){
                $arrErrors[] = "Error: El campo de b&uacute;squeda es obligatorio.";
                break;
            }
            $daoPersona = DB_DataObject :: factory('persona');
            $personas = $daoPersona->buscarPersonas($nombre,$apellido);
            if(empty($personas)) $arrWarns[] = "No se encontraron resultados con el nombre \"$nombre $apellido\".";
            break;
        case 'delete':
            $mostrarMsj = true;
            if(empty($_GET['id_persona'])){
                $arrErrors[] = "Error: No se puede borrar la Persona.";
            }else{
                $id_persona = $_GET['id_persona'];
                $daoPersona = DB_DataObject :: factory('persona');
                if($daoPersona->deletePersona($id_persona)){
                    $msjOk = "La Persona ha sido eliminada con &eacute;xito";
                }else{
                    $arrErrors[] = "Error: No se pudo borrar la Persona por completo";
                }
            }
            unset($daoPersona);
            break;
    }
}


$smarty->assign('arrErrors',$arrErrors);
$smarty->assign('arrWarns',$arrWarns);
$smarty->assign('msjOk',$msjOk);
$smarty->assign('mostrarMsj',$mostrarMsj);

function listarDeudores($order){
    global $smarty;
    $daoPersonas = DB_DataObject :: factory('persona');
    $personas = $daoPersonas->getDeudores($order);
    unset($daoPersonas);
    $smarty->assign('personas',$personas);
	$smarty->display('listar_personas.tpl');
}

function listarPersonas($personas=NULL, $listarTodos = false, $order=1){
    global $smarty;
//    echo $order; exit;
    if($listarTodos){
        if(empty($personas)){
            $daoPersonas = DB_DataObject :: factory('persona');
            $personas = $daoPersonas->getPersonas($order);
            unset($daoPersonas);
        }
        $smarty->assign('personas',$personas);
    }
    if(!empty($_GET['msj'])){
        $smarty->assign('arrWarns',$_GET['msj']);
        $smarty->assign('mostrarMsj',true);
    }
	$smarty->display('listar_personas.tpl');
}

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
            $smarty->assign('telefono',$persona->telefono);
        }
        unset($persona);
        
        $smarty->assign('id_persona',$id_persona);
    }
    if(!empty($_GET['msj'])){
        $smarty->assign('arrWarns',$_GET['msj']);
        $smarty->assign('mostrarMsj',true);
    }
	$smarty->display('listar_movimientos.tpl');
}

# Muestra el template
if (!empty($_GET['section'])){
    switch ($_GET['section']){
        case 1: //Listar
            $listar = false;
            if((!empty($_GET['action'])) && ($_GET['action'] == 'search')) $listar = true;
            listarPersonas($personas,$listar);
			break;
        case 2: //Agregar
			$smarty->display('agregar_persona.tpl');
			break;
        case 3: //Editar
            if(empty($_GET['id_persona'])){
                listarPersonas($personas,$listar);
            }else{
            
                $daoPersona = DB_DataObject :: factory('persona');
                $id_persona = $_GET['id_persona'];
                $persona = $daoPersona->buscarPersonaPorId($id_persona);
                if(!$persona){
                    $smarty->assign('mostrarMsj',true);
                    $arrErrors[] = "Error: La persona no existe.";
                    unset($persona);
                    return $arrErrors;
                }else{
                    $smarty->assign('nombre',$persona->nombre);
                    $smarty->assign('apellido',$persona->apellido);
                    $smarty->assign('direccion',$persona->direccion);
                    $smarty->assign('telefono',$persona->telefono);
                    $smarty->assign('celular',$persona->celular);
                    $smarty->assign('documento',$persona->dni);
                    $smarty->assign('cuit',$persona->cuit);
                    $smarty->assign('email',$persona->email);
                    $smarty->assign('descripcion',$persona->descripcion);
                    $smarty->assign('id_persona',$persona->id_persona);

                }
                $smarty->display('agregar_persona.tpl');

            }
			break;
        case 4: //Listar todos (LENTO!!)
            $listar = true;
            $order = 1;
            if(!empty($_GET['order'])) $order = $_GET['order'];
            listarPersonas($personas,$listar,$order);
			break;
		case 5: //Agregar Dinero
		    if(!empty($_GET['id_persona'])){
                $smarty->assign('tipo',1); // Tipo = 1 -> Debe
		        $smarty->display('agregar_movimiento.tpl');
            }
			break;
		case 6: //Descontar Dinero
		    if(!empty($_GET['id_persona'])){
                $smarty->assign('tipo',2); // Tipo = 2 -> Haber
		        $smarty->display('agregar_movimiento.tpl');
            }
			break;
    	case 7: //Listar Movimientos
    	    if(!empty($_GET['id_persona'])){
                listarMovimientos($_GET['id_persona']);
            }
			break;
		case 8: //Listar Deudores
		    $order = 1;
		    if(!empty($_GET['order'])) $order = $_GET['order'];
            listarDeudores($order);
			break;
        default:
            $order = 1;
            if(!empty($_GET['order'])) $order = $_GET['order'];
            listarPersonas($personas,$order);
			break;
    }
}else{
	listarPersonas($personas);
}


# Muestra el template
//$smarty->display('personas.tpl');
