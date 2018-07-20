<?php

class Menu {

    public function Ver() {
        echo "<table width=100%>";
        echo "<tr><td align=center><img src=/MyDA/img/logo.GIF></td></tr>";
        echo "<tr><td></td></tr>";
        echo "<tr><td></td></tr>";
        echo "<tr><td bgcolor=#D3DCE3><img src='/MyDA/img/abrirMenu.png' align=middle> <b>MENU PRINCIPAL</b></td><tr>";
        echo "<tr><td></td></tr>";
        echo "<tr><td><a href='index.php'>Inicio</a></td></tr>";
        $conexion = new Conexion();
        $rs = $conexion->Consulta("SELECT * FROM fw_menus ORDER BY orden");
        while ($reg = mysql_fetch_array($rs)) {
            $cad = "<tr><td><a href=";
            if ($reg["idTabla"] != 0) {
                $cad.="'ver_tabla.php?tabla=" . $reg["idTabla"] . "'>";
            } else {
                $cad.="'" . $reg["url"] . "' target=_blank>";
            }
            $cad.= $reg["nombre"] . "</a>";
            echo $cad . "</td></tr>";
        }
        echo "<tr><td bgcolor=#D3DCE3></td></tr>";
        echo "<tr><td><a href='logoff.php'>Desconectar</a></td></tr>";

        global $usuario;
        if ($usuario->admin == 1) {
            //Opciones fijas de administración
            echo "<tr><td></td></tr>";
            echo "<tr><td bgcolor=#D3DCE3><img src='/MyDA/img/abrirMenu.png' align=middle> <b>Menu Administracion</b></td</tr>";
            echo "<tr><td><a href='mantenimiento_tablas.php'>Mantenimiento de Tablas</a></td></tr>";
            //echo "<tr><td><a href='relaciones_maestro-detalle.php'>Relaciones Maestro-Detalle</a></td></tr>";
            echo "<tr><td><a href='mantenimiento_menus.php'>Mantenimiento de Menus</a></td></tr>";
            echo "<tr><td><a href='mantenimiento_usuarios.php'>Mantenimiento de Usuarios</a></td></tr>";
        }
        echo "<tr><td bgcolor=#D3DCE3></td></tr>";
        echo "<tr><td><a href='http://mydataaccess.blogspot.com/' target=_blank>MyDataAccess Blog</a></td></tr>";
        echo "</table>";
    }

}

?>
