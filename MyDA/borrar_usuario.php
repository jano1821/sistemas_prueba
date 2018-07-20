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
            $id = $_GET["id"];
            $conexion = new Conexion();
            $sql = "DELETE FROM fw_usuarios WHERE id=$id";
            $rs = $conexion->Consulta($sql);

            Redirige("mantenimiento_usuarios.php");
            ?>
        </p>
    <p><?php VerPie(); ?></p></body>
</html>
