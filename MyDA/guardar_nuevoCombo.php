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
            $idCampo = $_POST["idCampo"];
            $idTablaLista = $_POST["idTablaLista"];
            $campoValores = $_POST["campoValores"];
            $campoTextos = $_POST["campoTextos"];

            //Guarda los datos en fw_campos
            $conexion = new Conexion();
            $sql = "UPDATE fw_campos SET idTablaLista=$idTablaLista, campoValores='$campoValores', campoTextos='$campoTextos' WHERE id=$idCampo";
            $rs = $conexion->Consulta($sql);

            $sql = "SELECT * FROM fw_campos WHERE id=$idCampo";
            $rs = $conexion->Consulta($sql);
            while ($reg = mysql_fetch_array($rs)) {
                Redirige("modificar_estructura.php?tabla=" . $reg["idTablas"]);
            }
            ?>
        </p>
    <p><?php VerPie(); ?></p></body>
</html>
