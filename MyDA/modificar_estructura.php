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
                <p>
                    <table align=center cellpadding=5 class=Tabla>
                        <tr>
                            <td align="center" valign="middle" colspan="3">
                                <b><?php echo strtoupper($tabla->nombre) ?></b> (Estructura de tabla)
                                <br/>
                                <br/>
                                <a href='nuevo_campo.php?tabla=<?php echo $idTabla ?>'><img alt=""  src='/MyDA/img/nuevo_campo.png' border=0 align=middle /></a> Nuevo Campo
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor=#D3DCE3></td>
                            <td bgcolor=#D3DCE3></td>
                            <td bgcolor=#D3DCE3><u>Campo</u></td>
                        </tr>
                        <?php
                        $rs = $conexion->Consulta("SELECT * FROM fw_campos WHERE nombreBD<>'id' AND idTablas=" . $idTabla . " ORDER BY orden");
                        $color = "#E5E5E5";
                        while ($reg = mysql_fetch_array($rs)) {
                            $campo = new Campo($reg["id"]);
                            echo "<tr>";
                            //Opción editar
                            echo "<td bgcolor=$color><a href='editar_campo.php?id=" . $reg["id"] . "'><img src='/MyDA/img/editar.png' border=0></a></td>";
                            //Opción suprimir
                            echo "<td bgcolor=$color><a href='borrar_campo.php?id=" . $reg["id"] . "' onclick='javascript:return confirm(\"¿Borrar el campo?\");'><img src='/MyDA/img/borrar.png' border=0></a></td>";
                            echo "<td bgcolor=$color>" . $reg["orden"] . " - " . $reg["nombre"] . " (" . $campo->nombreTipo . ")</td>";
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
                <p align="center"><a href="ver_tabla.php?tabla=<?php echo $tabla->id ?>">Ver tabla</a></p>
            </div>
        </div>
    <p><?php VerPie(); ?></p></body>
</html>
