<?php include($_SERVER["DOCUMENT_ROOT"] . "/MyDA/clases/clases.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>MyDataAccess</title>
        <link href="/MyDA/estilos.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <p>
            <?php
            $nombre = $_POST["nombre"];
            if (isset($_POST["Edit"])) {
                //Edición de tabla
                $idTabla = $_POST["Edit"];
                $conexion = new Conexion();
                $sql = "UPDATE fw_tablas SET nombre='$nombre' WHERE id=$idTabla";
                $rs = $conexion->Consulta($sql);
                Redirige("mantenimiento_tablas.php");
            } else {
                //Nueva tabla
                $nombreBD = $_POST["nombreBD"];
                $tabla = new Tabla();
                $tabla->CreaNueva($nombre, $nombreBD);
                $tabla->BuscaNombre($nombreBD);
                $idTabla = $tabla->id;
                Redirige("ver_tabla.php?tabla=$idTabla");
            }
            ?>
        </p>
        <p><?php VerPie(); ?></p></body>
</html>
