<?php include($_SERVER["DOCUMENT_ROOT"] . "/MyDA/clases/clases.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>MyDataAccess</title>
        <link href="/MyDA/estilos.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/MyDA/js/scatter.js"></script>
    </head>

    <body onload="Scatter.scanPage()">
        <br/>
        <div id="marco_contenedor">
            <div id="marco_menu">
                <?php
                $menu = new Menu();
                $menu->Ver();
                ?>
            </div>
            <div id="marco_contenido">
                <?php
                $idCampo = $_GET["idCampo"];

                $conexion = new Conexion();
                $sql = "SELECT * FROM fw_campos WHERE id=$idCampo";
                $rs = $conexion->Consulta($sql);
                while ($reg = mysql_fetch_array($rs)) {
                    $idTabla = $reg["idTablas"];
                    $nombre = $reg["nombre"];
                    $nombreBD = $reg["nombreBD"];
                }
                $tabla = new Tabla();
                $tabla->BuscaId($idTabla);
                ?>
                <p>
                    <form id="formNuevoCombo" name="formNuevoCombo" method="post" action="guardar_nuevoCombo.php">
                        <table align=center class=Tabla>
                            <tr>
                                <td colspan="2" align="center" valign="middle"><u>Nuevo campo tipo Lista</u></td>
                            </tr>
                            <tr>
                                <td align="center" valign="middle"><div align="left">Tabla</div></td>
                                <td align="center" valign="middle">
                                    <label>
                                        <div align="left">
                                            <input type="hidden" name="idCampo" id="idCampo" value="<?php echo $idCampo ?>"/>
                                            <?php
                                            echo $tabla->nombre;
                                            ?>
                                        </div>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="middle"><div align="left">Campo Lista</div></td>
                                <td align="center" valign="middle">
                                    <label>
                                        <div align="left">
                                            <?php
                                            echo $nombre;
                                            ?>
                                        </div>
                                    </label></td>
                            </tr>
                            <tr>
                                <td align="center" valign="middle"><div align="left">Tabla origen de datos</div></td>
                                <td align="center" valign="middle">
                                    <label>
                                        <div align="left">
                                            <select name='idTablaLista' id='idTablaLista' onchange="cambiaLink();" >
                                                <option value='0'>Seleccionar</option>
                                                <?php
                                                $sql = "SELECT * FROM fw_tablas ORDER BY nombre";
                                                $result = $conexion->Consulta($sql);
                                                $cad = "";
                                                while ($registro = mysql_fetch_array($result)) {
                                                    $cad.= "<option value=" . $registro["id"] . ">" . $registro["nombre"] . "</option>";
                                                }
                                                echo $cad;
                                                ?>
                                            </select>
                                        </div>
                                    </label>                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="middle" colspan="2">
                                    <div id="CamposTabla">
                                        <a href="#" rel="scatter" id="enlace" name="enlace">Ver campos</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center" valign="middle">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center" valign="middle"><label>
                                        <input type="submit" name="button" id="button" value="Guardar datos" />
                                    </label></td>
                            </tr>
                        </table>
                    </form>
                </p>
                <p align="center"><a href="ver_tabla.php?tabla=<?php echo $tabla->id ?>">Cancelar</a></p>
            </div>
        </div>
    <p><?php VerPie(); ?></p></body>
    <script language="javascript">
        function cambiaLink(){
            var tabla
            tabla = document.formNuevoCombo.idTablaLista.value
            document.getElementById('enlace').href = "ver_campos_tabla_combo.php?tabla="+tabla;
        }
    </script>
</html>
