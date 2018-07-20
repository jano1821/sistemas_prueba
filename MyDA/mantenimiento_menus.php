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
                            <td align="center" valign="middle" colspan="6"><p><b>MANTENIMIENTO DE MENUS</b><br /><br />
                                    <a href="/MyDA/nuevo_menu.php">
                                        <img src="/MyDA/img/nuevo.jpg" width="16" height="16" border="0" align="absmiddle" />
                                    </a> Nuevo Menu</p>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor=#D3DCE3></td>
                            <td bgcolor=#D3DCE3></td>
                            <td bgcolor=#D3DCE3>Nombre</td>
                            <td bgcolor=#D3DCE3>Orden</td>
                            <td bgcolor=#D3DCE3>Tabla</td>
                            <td bgcolor=#D3DCE3>Url</td>
                        </tr>
                        <?php
                        $conexion = new Conexion();
                        $rs = $conexion->Consulta("SELECT * FROM fw_menus");
                        $color = "#E5E5E5";
                        while ($reg = mysql_fetch_array($rs)) {
                            echo "<tr>";
                            //Opción editar
                            echo "<td bgcolor=$color><a title='Editar' href='editar_menu.php?id=" . $reg["id"] . "'><img src='/MyDA/img/editar.png' border=0></a></td>";
                            //Opción suprimir
                            echo "<td bgcolor=$color><a title='Borrar' href='borrar_menu.php?id=" . $reg["id"] . "' onclick='javascript:return confirm(\"¿Borrar el menu?\");'><img src='/MyDA/img/borrar.png' border=0></a></td>";
                            echo "<td bgcolor=$color>" . $reg["nombre"] . "</td>";
                            echo "<td bgcolor=$color>" . $reg["orden"] . "</td>";
                            echo "<td bgcolor=$color>"
                            . Combo("", "fw_tablas", "id", "nombre", $reg["idTabla"], TRUE)
                            . "</td>";
                            echo "<td bgcolor=$color>" . $reg["url"] . "</td>";
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
