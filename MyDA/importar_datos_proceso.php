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
            $idTabla = $_POST["idTabla"];

            $tabla = new Tabla();
            $tabla->BuscaId($idTabla);

            //Obtiene la lista de campos
            $campos = array();
            $conexion = new Conexion();
            $rs = $conexion->Consulta("SELECT * FROM fw_campos WHERE nombreBD<>'id' AND idTablas=" . $idTabla . " ORDER BY orden");
            $c = 0;
            while ($reg = mysql_fetch_array($rs)) {
                $campos[$c] = $reg["nombreBD"];
                $c++;
            }
            $numCampos = $c;

            $Ruta = $_SERVER['DOCUMENT_ROOT'] . "/MyDA/archivos/DatosExcel.csv";
            if (move_uploaded_file($_FILES['archivo']['tmp_name'], $Ruta)) {
                //El archivo ha sido cargado correctamente
                $fila = 1;
                $datosSQL = array();
                if (($gestor = fopen($Ruta, "r")) !== FALSE) {
                    while (($datos = fgetcsv($gestor, 0, ";")) !== FALSE) {
                        for ($c = 0; $c < $numCampos; $c++) {
                            $datosSQL[$campos[$c]] = $datos[$c];
                        }
                        $id = $tabla->GuardarNuevoRegistro($datosSQL);
                        //Añade el Id en el nombre de los campos Imagen o Archivo
                        for ($c = 0; $c < $numCampos; $c++) {
                            if ($datos[$c]!="" && ($tabla->TipoCampo($campos[$c]) == 4 || $tabla->TipoCampo($campos[$c]) == 5)) {
                                $nuevoNombre = "'($id) " . $tabla->LeerValorCampo($id, $campos[$c])."'";
                                $tabla->CambiarValorCampo($id, $campos[$c], $nuevoNombre);
                            }
                        }
                        $fila++;
                    }
                    fclose($gestor);
                }
                Redirige("ver_tabla.php?tabla=" . $idTabla);
            } else {
                echo "Ocurrio algun error al subir el fichero. No pudo guardarse.";
            }
            ?>
        </p>
        <p><?php VerPie(); ?></p></body>
</html>
