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
                            <td align="center" valign="middle" colspan="5"><p><b>MANTENIMIENTO DE TABLAS</b><br /><br/>
                                    <a href="/MyDA/nueva_tabla.php">
                                        <img src="/MyDA/img/nuevo.jpg" width="16" height="16" border="0" align="absmiddle" />
                                    </a> Nueva Tabla</p>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor=#D3DCE3></td>
                            <td bgcolor=#D3DCE3></td>
                            <td bgcolor=#D3DCE3></td>
                            <td bgcolor=#D3DCE3></td>
                            <td bgcolor=#D3DCE3>Nombre</td>
                        </tr>
                        <?php
                        $conexion = new Conexion();
                        $rs = $conexion->Consulta("SELECT * FROM fw_tablas");
                        $color = "#E5E5E5";
                        while ($reg = mysql_fetch_array($rs)) {
                            echo "<tr>";
                            //Opción ver
                            echo "<td bgcolor=$color><a href='ver_tabla.php?tabla=" . $reg["id"] . "' title='Ver tabla'><img src='/MyDA/img/lupa.png' border=0></a></td>";
                            //Opción editar
                            echo "<td bgcolor=$color><a href='editar_tabla.php?tabla=" . $reg["id"] . "' title='Editar nombre'><img src='/MyDA/img/editar.png' border=0></a></td>";
                            //Opción modificar estructura
                            echo "<td bgcolor=$color><a href='modificar_estructura.php?tabla=" . $reg["id"] . "' title='Estructura'><img src='/MyDA/img/modif_estructura.png' border=0></a></td>";
                            //Opción suprimir
                            echo "<td bgcolor=$color><a href='borrar_tabla.php?tabla=" . $reg["id"] . "' title='Borrar' onclick='javascript:return confirm(\"¿Borrar la tabla y todos sus datos?\");'><img src='/MyDA/img/borrar.png' border=0></a></td>";
                            echo "<td bgcolor=$color>" . $reg["nombre"] . "</td>";
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
