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
                    <table align=center cellpadding="5" class=Tabla>
                        <tr>
                            <td align="center" valign="middle" colspan="6"><p><b>MANTENIMIENTO DE USUARIOS</b><br /><br />
                                    <a href="/MyDA/nuevo_usuario.php">
                                        <img src="/MyDA/img/nuevo.jpg" width="16" height="16" border="0" align="absmiddle" />
                                    </a> Nuevo Usuario</p>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor=#D3DCE3></td>
                            <td bgcolor=#D3DCE3></td>
                            <td bgcolor=#D3DCE3>Usuario</td>
                            <td bgcolor=#D3DCE3>Password</td>
                            <td bgcolor=#D3DCE3>Administrador</td>
                        </tr>
                        <?php
                        $conexion = new Conexion();
                        $rs = $conexion->Consulta("SELECT * FROM fw_usuarios");
                        $color = "#E5E5E5";
                        while ($reg = mysql_fetch_array($rs)) {
                            echo "<tr>";
                            //Opción editar
                            echo "<td bgcolor=$color><a title='Editar' href='editar_usuario.php?id=" . $reg["id"] . "'><img src='/MyDA/img/editar.png' border=0></a></td>";
                            //Opción suprimir
                            echo "<td bgcolor=$color><a title='Borrar' href='borrar_usuario.php?id=" . $reg["id"] . "' onclick='javascript:return confirm(\"¿Eliminar al usuario?\");'><img src='/MyDA/img/borrar.png' border=0></a></td>";
                            echo "<td bgcolor=$color>" . $reg["usuario"] . "</td>";
                            echo "<td bgcolor=$color>" . $reg["clave"] . "</td>";
                            echo "<td bgcolor=$color>" . CheckBox_List("admin", $reg["admin"]) . "</td>";
                            echo "</tr>";
                            if ($color == "#E5E5E5") {
                                $color = "#D5D5D5";
                            } else {
                                $color = "#E5E5E5";
                            }
                        }
                        ?>
                    </table>
                </p>
            </div>
        </div>
    <p><?php VerPie(); ?></p></body>
</html>