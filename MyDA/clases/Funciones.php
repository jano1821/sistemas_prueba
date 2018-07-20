<?php

function tabla_existe($nombre_tb) {
    global $parametros;
    $conexion = new Conexion();
    $tabla = $conexion->Consulta("SHOW TABLES LIKE '$nombre_tb'");
    if (mysql_num_rows($tabla) == 1) {
        return true;
    } else {
        return false;
    }
}

function VerPie() {
    global $parametros;
    echo "<font size='2' face='Arial, Helvetica, sans-serif'>MyDataAccess v" . $parametros["version"] . " </font>";
}

function Combo($Nombre, $Tabla, $CampoValor, $CampoTexto, $Seleccionado=0, $Bloqueado=FALSE, $Estilo='', $Filtro='') {
    $conexion = new Conexion();
    $cad = "";
    if ($Bloqueado == FALSE) {
        //Devuelve un desplegable
        $cad.= "<select name='" . $Nombre . "' id='" . $Nombre . "'";
        if ($Estilo != "") {
            $cad.= " class='" . $Estilo . "'";
        }
        $cad.= ">";
        $sql = "SELECT * FROM " . $Tabla;
        if ($Filtro != '') {
            $sql.= " WHERE " . $Filtro;
        }
        $sql .= " ORDER BY " . $CampoTexto;
        $result = $conexion->Consulta($sql);
        $cad.= "<option value='0'>Seleccionar</option>";
        while ($registro = mysql_fetch_array($result)) {
            if ($registro[$CampoValor] == $Seleccionado) {
                $cad.= "<option value=" . $registro[$CampoValor] . " selected>" . $registro[$CampoTexto] . "</option>";
            } else {
                $cad.= "<option value=" . $registro[$CampoValor] . ">" . $registro[$CampoTexto] . "</option>";
            }
        }
        $cad.= "</select>";
    } else {
        // Devuelve una cadena de texto
        if ($Seleccionado == "") {
            $Seleccionado = 0;
        }
        $sql = "SELECT * FROM " . $Tabla . " WHERE " . $CampoValor . "=" . $Seleccionado;
        if ($Filtro != '') {
            $sql.= " AND " . $Filtro;
        }
        $result = $conexion->Consulta($sql);
        while ($registro = mysql_fetch_array($result)) {
            $cad.= "<span class='" . $Estilo . "'>" . $registro[$CampoTexto] . "</span>";
        }
    }
    return $cad;
}

function Redirige($pagina) {
    echo "<script language='javascript'>location.href='" . $pagina . "'</script>";
}

function CheckBox($nombreBD, $valor) {
    $cad = "<input type='radio' name='$nombreBD'  id='" . $nombreBD . "_1' value='1'";
    if ($valor == 1) {
        $cad.=" checked='checked'";
    }
    $cad.="/>Si";
    $cad.= "<input type='radio' name='$nombreBD'  id='" . $nombreBD . "_0' value='0'";
    if ($valor == 0) {
        $cad.=" checked='checked'";
    }
    $cad.="/>No";
    return $cad;
}

function CheckBox_List($nombreBD, $valor) {
    if ($valor == 1) {
        return "Si";
    } else {
        return "No";
    }
}

function GuardaArchivo($idRegistro, $NombreCampo, $Imagen) {
    // Guarda un archivo en el servidor
    // $Imagen=TRUE o FALSE

    $Guardar = TRUE;
    $Motivo = "";

    if (trim($_FILES[$NombreCampo]['name']) != "") {
        $Archivo = $_FILES[$NombreCampo]['name'];
        $extension = Extension($Archivo);
        $tamano_Archivo = $_FILES[$NombreCampo]['size'];

        //Comprueba tamaño
        if ($tamano_Archivo > 1000000) {
            $Motivo = "<center>El archivo es demasiado grande. <br>Solo se permiten archivos de un maximo de 1 Mb.</center>";
            $Guardar = FALSE;
        }
    } else {
        $Guardar = FALSE;
    }
    if ($Guardar == TRUE) {
        $Ruta = $_SERVER['DOCUMENT_ROOT'] . "/MyDA/archivos/";
        $NombreArchivo = "($idRegistro) $Archivo";
        if ($Imagen == TRUE) {
            /*
              if (move_uploaded_file($_FILES[$NombreCampo]['tmp_name'], $Ruta . $NombreArchivo)) {
              //El archivo ha sido cargado correctamente
              } else {
              echo "Ocurrio algun error al subir el fichero. No pudo guardarse.";
              }
             *
             */
            // Sube imagenes haciendo un Thumbnail
            if (isset($_FILES[$NombreCampo])) {
                $temp = $_FILES[$NombreCampo]["tmp_name"];
                $thumb = new Thumbnail($temp);
                if ($thumb->error) {
                    $Motivo = $thumb->error;
                } else {
                    $thumb->resize(500, 500);
                    $Archivo = substr($NombreArchivo, 0, strlen($NombreArchivo) - strlen(Extension($NombreArchivo)) - 1); //Le quita la extension al nombre de archivo
                    switch (Extension($NombreArchivo)) {
                        case "jpg":
                            $thumb->save_jpg($Ruta, $Archivo);
                            break;
                        case "gif":
                            $thumb->save_gif($Ruta, $Archivo);
                            break;
                        case "png":
                            $thumb->save_png($Ruta, $Archivo);
                            break;
                        default:
                            break;
                    }
                }
            }
        } else {
            //Sube ficheros
            //mkdir($Ruta); //Crea el directorio (si no existe)
            if (move_uploaded_file($_FILES[$NombreCampo]['tmp_name'], $Ruta . $NombreArchivo)) {
                //El archivo ha sido cargado correctamente
            } else {
                echo "Ocurrio algun error al subir el fichero. No pudo guardarse.";
            }
        }
        if ($Motivo == "") {
            //Establece permisos del archivo
            chmod($Ruta . $NombreArchivo, 0777);
        } else {
            //Ocurrio un error
            echo $Motivo;
        }
    } else {
        //Ocurrio un error o no hay archivo a guardar
        echo $Motivo;
    }
}

function Extension($Archivo) {
    //Devuelve la extension de un archivo
    return strtolower(trim(end(explode(".", $Archivo))));
}

function EsImagen($Archivo) {
    $extension = strtolower(Extension($Archivo));
    if ($extension != "jpg" && $extension != "gif" && $extension != "png" && $extension != "jpeg") {
        return FALSE;
    } else {
        return TRUE;
    }
}

?>
