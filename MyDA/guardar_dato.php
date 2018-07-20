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
            $idTabla = $_GET["idTabla"];

            $tabla = new Tabla();
            $tabla->BuscaId($idTabla);
            $datos = array();
            foreach ($_POST as $nombre_campo => $valor) {
                $datos[$nombre_campo] = $valor;
            }

            if (isset($_GET["Edit"])) {
                $tabla->ModificarRegistro($_GET["Edit"], $datos);
                $idReg = $_GET["Edit"];
            } else {
                $idReg = $tabla->GuardarNuevoRegistro($datos);
            }

            //Gestiona los archivos subidos (si los hay)
            $campo = new Campo();
            $claves = array_keys($_FILES);
            $c = 0; //Contador del numero de campos upload del formulario
            foreach ($_FILES as $file) {
                $nomCampo = $claves[$c];
                $c++;
                if ($file['tmp_name'] != '') {
                    $campo->BuscaCampo($idTabla, $nomCampo);
                    if ($campo->tipo == 4) {
                        //Archivo
                        $extensiones = array("doc", "docx", "pdf", "txt", "xls", "xlsx", "ppt", "pptx");
                        $imagen = FALSE;
                    } else {
                        //Imagen
                        $extensiones = array("jpg", "jpeg", "gif", "png", "bmp");
                        $imagen = TRUE;
                    }
                    if (!in_array(end(explode(".", strtolower($file['name']))), $extensiones)) {
                        die($file['name'] . ' no es un archivo valido<br/>' .
                                '<a href="javascript:history.go(-1);">' .
                                '&lt;&lt Volver</a>');
                    } else {
                        //Guarda el archivo (upload)
                        GuardaArchivo($idReg, $nomCampo, $imagen);
                        //Guarda el nombre del archivo
                        $datosImagen = array();
                        $datosImagen[$nomCampo] = "($idReg) " . $file['name'];
                        $tabla->ModificarRegistro($idReg, $datosImagen);
                    }
                }
            }
            Redirige("ver_tabla.php?tabla=" . $idTabla);
            ?>
        </p>
    <p><?php VerPie(); ?></p></body>
</html>
