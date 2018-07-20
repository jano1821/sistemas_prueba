<?php
/**
 * Table Definition for persona
 */
require_once 'DB/DataObject.php';

class DataObjects_Persona extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'persona';                         // table name
    public $id_persona;                      // int(11)  not_null primary_key
    public $nombre;                          // string(100)  
    public $apellido;                        // string(100)  
    public $direccion;                       // string(300)  
    public $telefono;                        // string(45)  
    public $dni;                             // string(45)  
    public $email;                           // string(100)  
    public $descripcion;                     // string(999)  
    public $eliminado;                       // string(1)  
    public $cuit;                            // string(45)  
    public $celular;                         // string(45)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Persona',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
    
    function buscarPersona($nombre, $apellido){
        if(empty($nombre)) return false;
        if(empty($apellido)) return false;

        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->eliminado = 0;
        if($this->find(true)) return $this;
        return false;
    }
    
    function calcularDeuda($id_persona){
        $daoFicha = DB_DataObject :: factory('ficha');
        $deuda = $daoFicha->getDeudaPersona($id_persona);
        unset($daoFicha);
        return $deuda;
    }
    
    function getFechaUltimaEntrada($id_persona){
        $daoFicha = DB_DataObject :: factory('ficha');
        $fecha = $daoFicha->getFechaUltimaEntrada($id_persona);
        unset($daoFicha);
        return $fecha;
    }
    
     function getFechaUltimoMovimiento($id_persona){
        $daoFicha = DB_DataObject :: factory('ficha');
        $fecha = $daoFicha->getFechaUltimoMovimiento($id_persona);
        unset($daoFicha);
        return $fecha;
    }
    
     // $orderByMode=SORT_ASC o $orderByMode=SORT_DESC
    function ordenarPorApellido($arrPersonas,$orderByMode=SORT_ASC){
        $cont = 0;
        foreach($arrPersonas as $c => $key) {
            $sort_ref[$cont] = ucwords(strtolower($key['apellido'])).', '.ucwords(strtolower($key['nombre']));
            $cont++;
        }
        //print_r($sort_ref);
        array_multisort($sort_ref, $orderByMode, $arrPersonas);
        return $arrPersonas;
    }
    
    // $orderByMode=SORT_ASC o $orderByMode=SORT_DESC
    function ordenarPorDeuda($arrPersonas,$orderByMode=SORT_ASC){
        $cont = 0;
        foreach($arrPersonas as $c => $key) {
            $sort_ref[$cont] = $key['deuda'].','.ucwords(strtolower($key['apellido'])).', '.ucwords(strtolower($key['nombre']));
            $cont++;
        }
        //print_r($sort_ref);
        array_multisort($sort_ref, $orderByMode, $arrPersonas);
        return $arrPersonas;
    }
    
    // $orderByMode=SORT_ASC o $orderByMode=SORT_DESC
    function ordenarPorFechaUltimoMovimiento($arrPersonas,$orderByMode=SORT_ASC){
        //print_r($arrPersonas); exit;
        $cont = 0;
        foreach($arrPersonas as $c => $key) {
            $sort_ref[$cont] = $key['fechaUltimoMovimiento'].','.$key['apellido'].','.$key['nombre'];
            $cont++;
        }
        //print_r($sort_ref);
        array_multisort($sort_ref, $orderByMode, $arrPersonas);
        return $arrPersonas;
    }
    
    
    function buscarPersonas($nombre=NULL,$apellido=NULL, $order=1){
        $arr = "";
        
        if(empty($nombre) && empty($apellido)) return false;
        
        if(!empty($nombre)) $this->whereAdd('nombre like "%'.$nombre.'%"');
        if(!empty($apellido)) $this->whereAdd('apellido like "%'.$apellido.'%"');
        if(!empty($nombre) && !empty($apellido)) $this->whereAdd('nombre like "%'.$nombre.'%" OR apellido like "%'.$apellido.'%"');
        
        if($this->find()){
            $cont=0;
            while($this->fetch()){
                if($this->eliminado) continue;
                $arr[$cont]['id_persona']    = $this->id_persona;
                $arr[$cont]['nombre']         = $this->nombre;
                $arr[$cont]['apellido']         = $this->apellido;
                $arr[$cont]['direccion']       = $this->direccion;
                $arr[$cont]['telefono']        = $this->telefono;
                $arr[$cont]['celular']           = $this->celular;
                $arr[$cont]['dni']                 = $this->dni;
                $arr[$cont]['email']             = $this->email;
                $arr[$cont]['descripcion']   = $this->descripcion;
                $arr[$cont]['deuda']           = $this->calcularDeuda($this->id_persona);
                $arr[$cont]['cuit']               = $this->cuit;
                $arr[$cont]['fechaUltimaEntrada'] = $this->getFechaUltimaEntrada($this->id_persona);
                $arr[$cont]['fechaUltimoMovimiento'] = $this->getFechaUltimoMovimiento($this->id_persona);
                $cont++;
            }
        }
        
        if(!empty($order) && $order == 3) $arr = $this->ordenarPorFechaUltimoMovimiento($arr);
        if(!empty($order) && $order == 2) $arr = $this->ordenarPorDeuda($arr);
        if(!empty($order) && $order == 1) $arr = $this->ordenarPorApellido($arr);
        if(empty($order)) $arr = $this->ordenarPorApellido($arr);
        return $arr;
    }

    function buscarPersonaPorId($id_persona){
        if(empty($id_persona)) return false;

        $this->id_persona = $id_persona;
        if($this->find(true)) return $this;
        return false;
    }
    
    function getDeudores($order=1){
        $arr = "";
        
        if($this->find()){
            $cont=0;
            while($this->fetch()){
                if($this->eliminado) continue;
                $deuda = $this->calcularDeuda($this->id_persona);
                echo $deuda;
                if($deuda >= 0) continue;
                $arr[$cont]['id_persona']    = $this->id_persona;
                $arr[$cont]['nombre']         = $this->nombre;
                $arr[$cont]['apellido']         = $this->apellido;
                $arr[$cont]['direccion']       = $this->direccion;
                $arr[$cont]['telefono']        = $this->telefono;
                $arr[$cont]['celular']           = $this->celular;
                $arr[$cont]['dni']                 = $this->dni;
                $arr[$cont]['email']             = $this->email;
                $arr[$cont]['descripcion']   = $this->descripcion;
                $arr[$cont]['deuda']           = $deuda;
                $arr[$cont]['cuit']                = $this->cuit;
                $arr[$cont]['fechaUltimaEntrada'] = $this->getFechaUltimaEntrada($this->id_persona);
                $arr[$cont]['fechaUltimoMovimiento'] = $this->getFechaUltimoMovimiento($this->id_persona);
                $cont++;
            }
        }
        
        if(!empty($order) && $order == 3) $arr = $this->ordenarPorFechaUltimoMovimiento($arr);
        if(!empty($order) && $order == 2) $arr = $this->ordenarPorDeuda($arr);
        if(!empty($order) && $order == 1) $arr = $this->ordenarPorApellido($arr);
        if(empty($order)) $arr = $this->ordenarPorApellido($arr);
        return $arr;
        
    }
    
    function getPersonas($order=1){
        $arr = "";
        
        if($this->find()){
            $cont=0;
            while($this->fetch()){
                if($this->eliminado) continue;
                $arr[$cont]['id_persona']    = $this->id_persona;
                $arr[$cont]['nombre']         = $this->nombre;
                $arr[$cont]['apellido']         = $this->apellido;
                $arr[$cont]['direccion']       = $this->direccion;
                $arr[$cont]['telefono']        = $this->telefono;
                $arr[$cont]['celular']           = $this->celular;
                $arr[$cont]['dni']                 = $this->dni;
                $arr[$cont]['email']             = $this->email;
                $arr[$cont]['descripcion']   = $this->descripcion;
                $arr[$cont]['deuda']           = $this->calcularDeuda($this->id_persona);
                $arr[$cont]['cuit']                = $this->cuit;
                $arr[$cont]['fechaUltimaEntrada'] = $this->getFechaUltimaEntrada($this->id_persona);
                $arr[$cont]['fechaUltimoMovimiento'] = $this->getFechaUltimoMovimiento($this->id_persona);
                $cont++;
            }
        }
        //echo $order;
        
        if(!empty($order) && $order == 3) $arr = $this->ordenarPorFechaUltimoMovimiento($arr);
        if(!empty($order) && $order == 2) $arr = $this->ordenarPorDeuda($arr);
        if(!empty($order) && $order == 1) $arr = $this->ordenarPorApellido($arr);
        if(empty($order)) $arr = $this->ordenarPorApellido($arr);
        return $arr;
        
    }
    
    function deletePersona($id_persona){
        if(empty($id_persona)) return false;

        $persona = $this->buscarPersonaPorId($id_persona);
        
        if(!$persona) return false;
        
        $persona->eliminado = true;
        if(!$persona->update()) return false;
        
        return true;
    }
    
    
}
