<?php

class Usuario {

    public function EstaLogeado() {
        if (!isset($_SESSION["usuario"])) {
            return false;
        } else {
            if ($_SESSION["usuario"] == "") {
                return false;
            } else {
                $this->BuscaUsuarioPorId($_SESSION["usuario"]);
                return true;
            }
        }
    }

    public function BuscaUsuarioPorId($idUsuario) {
        $conexion = new Conexion();
        $sql = "SELECT * FROM fw_usuarios WHERE id=" . $idUsuario;
        $rs = $conexion->Consulta($sql);
        $dato = mysql_fetch_array($rs);
        if (!is_null($dato["id"])) {
            $this->id = $dato["id"];
            $this->usuario = $dato["usuario"];
            $this->clave = $dato["clave"];
            $this->admin = $dato["admin"];
        }
    }

    public function Logea($usuario, $clave) {
        $_SESSION["usuario"] = "";
        $conexion = new Conexion();
        if (strlen($usuario) > 0 && strlen($clave) > 0) {
            $consulta = $conexion->Consulta("SELECT * FROM fw_usuarios WHERE usuario='" . $usuario . "' AND clave='" . $clave . "'");
            $rs = mysql_fetch_array($consulta);
            if (!is_null($rs["id"])) {
                //Usuario encontrado, actualiza los datos de sesion y la clase
                $_SESSION["usuario"] = $rs["id"];
                $this->BuscaUsuarioPorId($_SESSION["usuario"]);
                echo "Entrando...";
                Redirige("index.php");
            }
        }
        if ($_SESSION["usuario"] == "") {
            //Lo devuelve a la pantalla de login
            $this->CheckLogin();
        }
    }

    public function Desconectar() {
        $_SESSION["usuario"] = "";
        $this->id = "";
    }

    public function CheckLogin() {
        //Comprueba que el usuario este logeado
        if (!$this->EstaLogeado()) {
            Redirige("/MyDA/login.php");
        }
    }

}

?>
