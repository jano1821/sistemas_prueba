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
                $conexion = new Conexion();
                $rsDato = $conexion->Consulta("SELECT * FROM fw_usuarios WHERE id=$id");
                while ($reg = mysql_fetch_array($rsDato)) {
                    $usuario = $reg["usuario"];
                    $clave = $reg["clave"];
                    $admin = $reg["admin"];
                }
                ?>
                <p>
                    <form id="formEdit" name="formEdit" method="post" action="guardar_usuario.php">
                        <table align=center cellpadding="5" class=Tabla>
                            <tr>
                                <td colspan="2" align="center" valign="middle" bgcolor=#D3DCE3><b>EDITAR USUARIO</b></td>
                            </tr>
                            <tr>
                                <td align="center" valign="middle"><div align="left">Usuario </div></td>
                                <td align="center" valign="middle">
                                    <label>
                                        <div align="left">
                                            <input type="hidden" name="id" id="id" value="<?php echo $id ?>" />
                                            <input type="text" name="usuario" id="usuario" value="<?php echo $usuario ?>" />
                                        </div>
                                    </label>                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="middle"><div align="left">Password</div></td>
                                <td align="center" valign="middle"><div align="left">
                                        <label>
                                            <input type="text" name="clave" id="clave" value="<?php echo $clave ?>" />
                                        </label>
                                    </div></td>
                            </tr>
                            <tr>
                                <td align="center" valign="middle"><div align="left">Administrador</div></td>
                                <td align="center" valign="middle"><div align="left">
                                        <?php
                                        echo CheckBox("admin", $admin);
                                        ?>
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
            </div>
        </div>
    <p><?php VerPie(); ?></p></body>
</html>
