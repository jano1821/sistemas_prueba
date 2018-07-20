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
            $idTablas = $_POST["idTablas"];
            $tabla = new Tabla();
            $tabla->BuscaId($idTablas);

            $nombre = $_POST["nombre"];
            $nombreBD = $_POST["nombreBD"];
            $tipo = $_POST["tipo"];
            $orden = $_POST["orden"];
            $visible = $_POST["visible"];

            // Crea el campo en la tabla en MySQL
            switch ($tipo) {
                case 0:
                    //Texto
                    $tipoSQL = "VARCHAR(50) NULL";
                    break;
                case 1:
                    //Numero
                    $tipoSQL = "INT";
                    break;
                case 2:
                    //Notas
                    $tipoSQL = "TEXT";
                    break;
                case 3:
                    //Si-No
                    $tipoSQL = "INT";
                    break;
                case 4:
                    //Archivo
                    $tipoSQL = "VARCHAR(50) NULL";
                    break;
                case 5:
                    //Imagen
                    $tipoSQL = "VARCHAR(50) NULL";
                    break;
                case 6:
                    //Lista
                    $tipoSQL = "INT";
                    break;
                case 7:
                    //Fecha
                    $tipoSQL = "VARCHAR(10) NULL";
                    break;
                default:
                    break;
            }
            $sql = "ALTER TABLE " . $tabla->nombreBD . " ADD $nombreBD $tipoSQL;";
            $conexion = new Conexion();
            $rs = $conexion->Consulta($sql);

            //Guarda el campo en fw_campos
            $sql = "INSERT INTO fw_campos (id,idTablas,nombre,nombreBD,tipo,orden,visible) VALUES (NULL,$idTablas,'$nombre','$nombreBD',$tipo,$orden,$visible);";
            $rs = $conexion->Consulta($sql);
            $idCampo = mysql_insert_id();

            if ($tipo == 6) {
                Redirige("campos_combo.php?idCampo=" . $idCampo);
            } else {
                Redirige("modificar_estructura.php?tabla=" . $idTablas);
            }
            ?>
        </p>
    <p><?php VerPie(); ?></p></body>
</html>
