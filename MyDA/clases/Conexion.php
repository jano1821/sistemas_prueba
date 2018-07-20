<?php

class Conexion {

// Gestiona las conexiones con la base de datos

    private $conexion;

    public function Conexion() {
        global $parametros;
        $conectado = TRUE;
        if (mysql_connect($parametros["servidor"], $parametros["usuario"], $parametros["password"])) {
            $this->conexion = mysql_connect($parametros["servidor"], $parametros["usuario"], $parametros["password"]);
            if(!mysql_select_db($parametros["base_datos"], $this->conexion)){
                $conectado = FALSE;
            }
        } else {
            $conectado = FALSE;
        }
        if (!$conectado) {
           echo "<script language='javascript'>location.href='doc/instalar.html'</script>"; 
        }
    }

    public function Consulta($sql) {
        $resultado = mysql_query($sql) or die(mysql_error());
        return $resultado;
    }

}

?>
