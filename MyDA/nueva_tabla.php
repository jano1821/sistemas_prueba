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
                <p>
                    <form id="formNuevaTabla" name="formNuevaTabla" method="post" action="guardar_tabla.php">
                        <table align=center class=Tabla>
                            <tr>
                                <td colspan="2" align="center" valign="middle"><u>Nueva tabla</u></td>
                            </tr>
                            <tr>
                                <td align="center" valign="middle"><div align="left">Nombre visible</div></td>
                                <td align="center" valign="middle">
                                    <label>
                                        <div align="left">
                                            <input type="text" name="nombre" id="nombre" />
                                        </div>
                                    </label>                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="middle"><div align="left">Nombre en BD</div></td>
                                <td align="center" valign="middle"><div align="left">
                                        <label>
                                            <input type="text" name="nombreBD" id="nombreBD" />
                                        </label>
                                    </div></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center" valign="middle">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center" valign="middle"><label>
                                        <input type="submit" name="button" id="button" value="Crear tabla" />
                                    </label></td>
                            </tr>
                        </table>
                    </form>
                </p>
            </div>
        </div>
    <p><?php VerPie(); ?></p></body>
</html>
