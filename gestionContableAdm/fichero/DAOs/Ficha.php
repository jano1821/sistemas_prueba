<?php
/**
 * Table Definition for ficha
 */
require_once 'DB/DataObject.php';

class DataObjects_Ficha extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'ficha';                           // table name
    public $id_ficha;                        // int(11)  not_null primary_key
    public $entrada;                         // real(22)  
    public $salida;                          // real(22)  
    public $descripcion;                     // string(9999)  
    public $fecha;                           // datetime(19)  binary
    public $eliminado;                       // string(1)  
    public $id_persona;                      // int(11)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Ficha',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
    
    
    function buscarFichaPorId($id_ficha){
        if(empty($id_ficha)) return false;

        $this->id_ficha = $id_ficha;
        if($this->find(true)) return $this;
        return false;
    }
    
    // $orderByMode='ASC' o $orderByMode='DESC'
    function getFichasPorPersona($id_persona,$orderBy='fecha',$orderByMode='ASC'){
        if(empty($id_persona)) return "";
        $arr = "";
        $this->id_persona = $id_persona;
        $this->orderBy($orderBy.' '.$orderByMode);
        if($this->find()){
            $cont=0;
            while($this->fetch()){
                if($this->eliminado) continue;
                $arr[$cont]['id_ficha'] = $this->id_ficha;
                $arr[$cont]['entrada'] = $this->entrada;
                $arr[$cont]['salida'] = $this->salida;
                $arr[$cont]['descripcion'] = $this->descripcion;
                $arr[$cont]['fecha'] = $this->fecha;
                //$arr[$cont]['total'] = $this->salida - $this->entrada;
                $cont++;
            }
        }
        return $arr;
    }
    
    function getDeudaPersona($id_persona){
        if(empty($id_persona)) return -9999999;
        $this->id_persona = $id_persona;
        $deuda=0;
        if($this->find()){
            while($this->fetch()){
                if($this->eliminado) continue;
                $deuda += $this->entrada - $this->salida;
            }
        }
        return $deuda;
    }
    
    function getFechaUltimaEntrada($id_persona){
        if(empty($id_persona)) return "";
        $orderBy='fecha';
        $orderByMode='DESC';
        $this->id_persona = $id_persona;
        $this->orderBy($orderBy.' '.$orderByMode);
        $this->whereAdd("entrada > 0");
        if($this->find(true)){
            //print_r($this);exit;
            return $this->fecha;
        }
        return "";
    }
    
     function getFechaUltimoMovimiento($id_persona){
        if(empty($id_persona)) return "";
        $orderBy='fecha';
        $orderByMode='DESC';
        $this->id_persona = $id_persona;
        $this->orderBy($orderBy.' '.$orderByMode);
        if($this->find(true)){
            //print_r($this);exit;
            return $this->fecha;
        }
        return "";
    }
        
    function deleteFicha($id_ficha){
        if(empty($id_ficha)) return false;

        $ficha = $this->buscarFichaPorId($id_ficha);
        
        if(!$ficha) return false;
        
        $ficha->eliminado = true;
        if(!$ficha->update()) return false;
        
        return true;
    }
    
}
