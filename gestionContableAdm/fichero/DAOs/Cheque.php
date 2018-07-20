<?php
/**
 * Table Definition for cheque
 */
require_once 'DB/DataObject.php';

class DataObjects_Cheque extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'cheque';                          // table name
    public $id_cheque;                       // int(11)  not_null primary_key
    public $fecha_cobro;                     // datetime(19)  binary
    public $cuenta;                          // string(45)  
    public $nro_cheque;                      // string(45)  
    public $persona;                         // string(45)  
    public $pesos;                           // string(45)  
    public $destino;                         // string(45)  
    public $eliminado;                       // string(1)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Cheque',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE


    function buscarCheque($cuenta,$nro_cheque){
        if(empty($cuenta)) return false;
        if(empty($nro_cheque)) return false;

        $this->cuenta = $cuenta;
        $this->cheque = $nro_cheque;
        $this->eliminado = 0;
        if($this->find(true)) return $this;
        return false;
    }

    // $orderByMode=SORT_ASC o $orderByMode=SORT_DESC
    function ordenarPorFechaCobroCheque($arrCheques,$orderByMode=SORT_ASC){
        //print_r($arrCheques); exit;
        $cont = 0;
        foreach($arrCheques as $c => $key) {
            $sort_ref[$cont] = $key['fecha_cobro'].','.$key['cuenta'];
            $cont++;
        }
        //print_r($sort_ref);
        array_multisort($sort_ref, $orderByMode, $arrCheques);
        return $arrCheques;
    }

    // $orderByMode=SORT_ASC o $orderByMode=SORT_DESC
    function ordenarPorPersona($arrCheques,$orderByMode=SORT_ASC){
        //print_r($arrCheques); exit;
        $cont = 0;
        foreach($arrCheques as $c => $key) {
            $sort_ref[$cont] = $key['persona'].','.$key['fecha_cobro'];
            $cont++;
        }
        //print_r($sort_ref);
        array_multisort($sort_ref, $orderByMode, $arrCheques);
        return $arrCheques;
    }

    // $orderByMode=SORT_ASC o $orderByMode=SORT_DESC
    function ordenarPorImporte($arrCheques,$orderByMode=SORT_DESC){
        //print_r($arrCheques); exit;
        $cont = 0;
        foreach($arrCheques as $c => $key) {
            $sort_ref[$cont] = $key['pesos'].','.$key['fecha_cobro'];
            $cont++;
        }
        //print_r($sort_ref);
        array_multisort($sort_ref, $orderByMode, SORT_NUMERIC, $arrCheques);
        return $arrCheques;
    }


    function buscarChequePorId($id_cheque){
        if(empty($id_cheque)) return false;

        $this->id_cheque = $id_cheque;
        if($this->find(true)) return $this;
        return false;
    }

    function buscarCheques($cuenta=NULL, $nro_cheque=NULL, $order=1){
        $arr = "";
        
        if(empty($nro_cheque) && empty($cuenta)) return false;
        
        if(!empty($nro_cheque)) $this->whereAdd('nro_cheque like "%'.$nro_cheque.'%"');
        if(!empty($cuenta)) $this->whereAdd('cuenta like "%'.$cuenta.'%"');
        if(!empty($nro_cheque) && !empty($cuenta)) $this->whereAdd('cheque like "%'.$nro_cheque.'%" OR cuenta like "%'.$cuenta.'%"');
        
        if($this->find()){
            $cont=0;
            while($this->fetch()){
                if($this->eliminado) continue;
                $arr[$cont]['id_cheque']            = $this->id_cheque;
                $arr[$cont]['fecha_cobro']          = $this->fecha_cobro;
                $arr[$cont]['cuenta']               = $this->cuenta;
                $arr[$cont]['nro_cheque']           = $this->nro_cheque;
                $arr[$cont]['persona']              = $this->persona;
                $arr[$cont]['pesos']                = $this->pesos;
                $arr[$cont]['destino']              = $this->destino;
                $cont++;
            }
        }

        if(!empty($order) && $order == 1) $arr = $this->ordenarPorFechaCobroCheque($arr);
        if(!empty($order) && $order == 2) $arr = $this->ordenarPorPersona($arr);
        if(!empty($order) && $order == 3) $arr = $this->ordenarPorImporte($arr);

        if(empty($order)) $arr = $this->ordenarPorFechaCobroCheque($arr);

        return $arr;
    }

    function getCheques($order=1){
        $arr = "";
        
        if($this->find()){
            $cont=0;
            while($this->fetch()){
                if($this->eliminado) continue;
                $arr[$cont]['id_cheque']            = $this->id_cheque;
                $arr[$cont]['fecha_cobro']          = $this->fecha_cobro;
                $arr[$cont]['cuenta']               = $this->cuenta;
                $arr[$cont]['nro_cheque']           = $this->nro_cheque;
                $arr[$cont]['persona']              = $this->persona;
                $arr[$cont]['pesos']                = $this->pesos;
                $arr[$cont]['destino']              = $this->destino;
                $cont++;
            }
        }

        if(!empty($order) && $order == 1) $arr = $this->ordenarPorFechaCobroCheque($arr);
        if(!empty($order) && $order == 2) $arr = $this->ordenarPorPersona($arr);
        if(!empty($order) && $order == 3) $arr = $this->ordenarPorImporte($arr);

        if(empty($order)) $arr = $this->ordenarPorFechaCobroCheque($arr);
        
        return $arr;
        
    }


    function deleteCheque($id_cheque){
        if(empty($id_cheque)) return false;

        $cheque = $this->buscarChequePorId($id_cheque);
        
        if(!$cheque) return false;
        
        $cheque->eliminado = true;
        if(!$cheque->update()) return false;
        
        return true;
    }

}
