<?php include($_SERVER["DOCUMENT_ROOT"] . "/MyDA/clases/clases.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>MyDataAccess</title>
        <link href="/MyDA/estilos.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
            <?php
            $id = $_POST["id"];
            $campo = new Campo($id);

            $nombre = $_POST["nombre"];
            $visible = $_POST["visible"];
            $orden = $_POST["orden"];

            $conexion = new Conexion();
            
            //Guarda el campo en fw_campos
            $sql = "UPDATE fw_campos SET nombre='$nombre',orden=$orden,visible=$visible WHERE id=$id";
            $rs = $conexion->Consulta($sql);

            Redirige("modificar_estructura.php?tabla=" . $campo->idTablas);
            ?>
    <p><?php VerPie(); ?></p></body>
</html>