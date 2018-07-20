<?php include($_SERVER["DOCUMENT_ROOT"] . "/MyDA/clases/clases.php"); ?>
<?php
$idTabla = $_GET["tabla"];
?>
<div id="CamposTabla">
    <a href="#" rel="scatter" id="enlace" name="enlace">Ver campos</a>
    <table>
        <tr>
            <td align="center" valign="middle"><div align="left">Campo origen de textos</div></td>
            <td align="center" valign="middle">
                <label>
                    <div align="left">
                        <?php
                        echo Combo("campoTextos", "fw_campos", "nombreBD", "nombre", "Seleccionar", FALSE, '', 'idTablas='.$idTabla);
                        ?>
                    </div>
                </label>
            </td>
        </tr>
        <tr>
            <td align="center" valign="middle"><div align="left">Campo origen de valores</div></td>
            <td align="center" valign="middle">
                <label>
                    <div align="left" >
                        <?php
                        echo Combo("campoValores", "fw_campos", "nombreBD", "nombre", "Seleccionar", FALSE, '', 'idTablas='.$idTabla);
                        ?> 
                    </div>
                </label>
            </td>
        </tr>
    </table>
</div>
