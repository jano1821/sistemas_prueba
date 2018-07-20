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
                $id = $_GET["id"];
                $campo = new Campo($id);
                ?>
                <p>
                    <form id="formEditCampo" name="formEditCampo" method="post" action="guardar_campo.php">
                        <table align=center cellpadding=5 class=Tabla>
                            <tr>
                                <td colspan="2" align="center" valign="middle" bgcolor=#D3DCE3><b>EDITAR CAMPO</b></td>
                            </tr>
                            <tr>
                                <td align="center" valign="middle"><div align="left">Tabla</div></td>
                                <td align="center" valign="middle">
                                    <label>
                                        <div align="left">
                                            <?php
                                            echo strtoupper($campo->nombreTabla);
                                            ?>
                                        </div>
                                    </label>                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="middle"><div align="left">Nombre visible</div></td>
                                <td align="center" valign="middle">
                                    <label>
                                        <div align="left">
                                            <input type="hidden" name="id" id="id" value="<?php echo $campo->id ?>" />
                                            <input type="text" name="nombre" id="nombre" value="<?php echo $campo->nombre ?>" />
                                        </div>
                                    </label>                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="middle"><div align="left">Orden</div></td>
                                <td align="center" valign="middle"><div align="left">
                                        <label>
                                            <input type="text" name="orden" id="orden" value="<?php echo $campo->orden ?>" />
                                        </label>
                                    </div></td>
                            </tr>
                            <tr>
                                <td align="center" valign="middle"><div align="left">Visible en listado</div></td>
                                <td align="center" valign="middle"><div align="left">
                                        <label>
                                            <?php echo CheckBox("visible", $campo->visible)?>
                                        </label>
                                    </div></td>
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
                <p align="center"><a href="modificar_estructura.php?tabla=<?php echo $campo->idTablas ?>">Cancelar</a></p>
            </div>
        </div>
        <p><?php VerPie(); ?></p></body>
</html>
