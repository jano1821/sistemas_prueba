<?php include($_SERVER["DOCUMENT_ROOT"] . "/MyDA/clases/clases.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>MyDataAccess</title>
        <link href="/MyDA/estilos.css" rel="stylesheet" type="text/css" />
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
                <?php
                $idTabla = $_GET["tabla"];
                $conexion = new Conexion();
                $rsDato = $conexion->Consulta("SELECT * FROM fw_tablas WHERE id=$idTabla");
                while ($reg = mysql_fetch_array($rsDato)) {
                    $nombre = $reg["nombre"];
                    $nombreBD = $reg["nombreBD"];
                }
                ?>
                <p>
                    <form id="formEdit" name="formEdit" method="post" action="guardar_tabla.php">
                        <table align=center cellpadding="5" class=Tabla>
                            <tr>
                                <td colspan="2" align="center" valign="middle" bgcolor=#D3DCE3><b>EDITAR TABLA</b></td>
                            </tr>
                            <tr>
                                <td align="center" valign="middle"><div align="left">Nombre en base de datos</div></td>
                                <td align="left" valign="middle">
                                    <?php echo $nombreBD ?>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="middle"><div align="left">Nombre visible</div></td>
                                <td align="center" valign="middle">
                                    <label>
                                        <div align="left">
                                            <input type="hidden" name="Edit" id="Edit" value="<?php echo $idTabla ?>" />
                                            <input type="text" name="nombre" id="nombre" value="<?php echo $nombre ?>" />
                                        </div>
                                    </label>                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center" valign="middle">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center" valign="middle"><label>
                                        <input type="submit" name="button" id="button" value="Guardar cambios" />
                                    </label></td>
                            </tr>
                        </table>
                    </form>
                </p>
            </div>
        </div>
        <p><?php VerPie(); ?></p></body>
</html>
