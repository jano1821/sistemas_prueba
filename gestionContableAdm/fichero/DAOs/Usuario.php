<?php
/**
 * Table Definition for usuario
 */
require_once 'DB/DataObject.php';

class DataObjects_Usuario extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'usuario';                         // table name
    public $id_usuario;                      // int(11)  not_null primary_key
    public $usuario;                         // string(100)  
    public $password;                        // string(45)  
    public $tipo;                            // string(45)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Usuario',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
    
    
    function buscarUsuario($usuario){
        if(empty($usuario)) return false;

        $this->usuario = $usuario;
        if($this->find(true)) return $this;
        return false;
        
    }

    function buscarUsuarioPorId($id_usuario){
        if(empty($id_usuario)) return false;

        $this->id_usuario = $id_usuario;
        if($this->find(true)) return $this;
        return false;
    }
    
    function getUsuarios(){
        $arr = "";
        
        if($this->find()){
            $cont=0;
            while($this->fetch()){
                $arr[$cont]['id_usuario']     = $this->id_usuario;
                $arr[$cont]['usuario']         = $this->usuario;
                $arr[$cont]['password']      = $this->password;
                $arr[$cont]['tipo']               = $this->tipo;
                $cont++;
            }
        }
        return $arr;
        
    }
    
    function deleteUsuario($id_usuario){
        if(empty($id_usuario)) return false;

        $usuario = $this->buscarUsuarioPorId($id_usuario);
        
        if(!$usuario) return false;
        
        $usuario->eliminado = true;
        if(!$usuario->delete()) return false;
        
        return true;
    }
}
