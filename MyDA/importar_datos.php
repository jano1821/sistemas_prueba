<?php include($_SERVER["DOCUMENT_ROOT"] . "/MyDA/clases/clases.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>MyDataAccess</title>
        <link href="/MyDA/estilos.css" rel="stylesheet" type="text/css" />
        <?php
        $idTabla = $_GET["tabla"];
        $tabla = new Tabla();
        $tabla->BuscaId($idTabla);
        $conexion = new Conexion();
        ?>
    </head>

    <body>
        <br/>
        <div id="marco_contenedor">
            <div id="marco_menu">
                <?php
                $menu = new Menu();
                $menu->Ver();
                ?>
            </div>
            <div id="marco_contenido">
                <p align="center"><b><font size="2">Instrucciones para importar datos en la tabla <?php echo strtoupper($tabla->nombre) ?></font></b></p>
                <p align="left"><font size="2"><strong>Paso 1:</strong> Genere un archivo con el programa Excel en el que haya una columna por cada uno de los campos de la tabla (mostrados abajo) y una fila por cada registro que quiera añadir. Las columnas del archivo deben estar en el mismo orden que el mostrado abajo.
                    </font></p>
                <p align="left"><font size="2">En los campos del tipo Imagen o Archivo solo se guarda el nombre del archivo. Posteriormente deberá subir por FTP todos los archivos o imagenes a la carpeta "archivos" del servidor. Los campos que no aparezcan en el listado mostrado abajo no se pueden importar.
                    </font></p>
                <p align="left"><font size="2">Los campos de los que no tenga datos déjelos como celdas en blanco en Excel.
                        La primera fila debe ser el primer dato. No añada títulos a las columnas.
                    </font></p>
                <p align="left"><font size="2"><strong>Paso 2:</strong> Guarde este archivo con la opción de Excel &quot;Guardar como...&quot; y seleccione la opción &quot;CSV (delimitado por comas) (*.csv)&quot;
                    </font></p>
                <p align="left"><font size="2"><strong>Paso 3:</strong> Suba el archivo al servidor.
                    </font></p>
                <form id="form1" name="form1" enctype="multipart/form-data" method="post" action="importar_datos_proceso.php">
                    <label>
                        <div align="center"><font size="2">Archivo csv con los datos
                                <input type="hidden" name="idTabla" id="idTabla" value="<?php echo $idTabla ?>"/>
                                <input type="file" name="archivo" id="archivo" />
                            </font></div>
                    </label>
                    <p align="center">
                        <label>
                            <input type="submit" name="upload" id="upload" value="Importar datos" />
                        </label>
                    </p>
                </form>
                <p align="center"><strong><font size="2">Campos de la tabla (columnas en el fichero Excel):</font></strong>
                    <table align=center cellpadding=5 class=Tabla>
                        <tr>
                            <td bgcolor=#D3DCE3><u>Campo</u></td>
                        </tr>
                        <?php
                        $rs = $conexion->Consulta("SELECT * FROM fw_campos WHERE nombreBD<>'id' AND idTablas=" . $idTabla . " ORDER BY orden");
                        $color = "#E5E5E5";
                        while ($reg = mysql_fetch_array($rs)) {
                            $campo = new Campo($reg["id"]);
                            if ($campo->tipo != 99) {
                                //Los campos tipo Indices no se pueden importar
                                echo "<tr>";
                                switch ($campo->tipo) {
                                    case 0:
                                        //Texto
                                        $nomTipo = "Texto max 50";
                                        break;
                                    case 1:
                                        //Numero
                                        $nomTipo = "Numero";
                                        break;
                                    case 2:
                                        //Notas
                                        $nomTipo = "Texto ilimitado";
                                        break;
                                    case 3:
                                        //Si-No
                                        $nomTipo = "1=Si, 0=No";
                                        break;
                                    case 4:
                                        //Archivo
                                        $nomTipo = "Nombre Archivo - Texto max 50";
                                        break;
                                    case 5:
                                        //Imagen
                                        $nomTipo = "Nombre Imagen - Texto max 50";
                                        break;
                                    case 6:
                                        //Combo
                                        $nomTipo = "Numero";
                                        break;
                                    case 7:
                                        //Fecha
                                        $nomTipo = "Texto max 50";
                                        break;
                                    default:
                                        break;
                                }
                                echo "<td bgcolor=$color>" . $reg["nombre"] . " (" . $nomTipo . ")</td>";
                                echo "</tr>";
                                if ($color == "#E5E5E5") {
                                    $color = "#D5D5D5";
                                } else {
                                    $color = "#E5E5E5";
                                }
                            }
                        }
                        ?>
                    </table>
                </p>
            </div>
        </div>
        <p><?php VerPie(); ?></p></body>
</html>
