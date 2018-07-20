<?php include($_SERVER["DOCUMENT_ROOT"] . "/MyDA/clases/clases.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <script type="text/javascript" src="/MyDA/js/ckeditor/ckeditor.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Framework MA</title>
        <link href="/MyDA/estilos.css" rel="stylesheet" type="text/css" />
    </head>
    <?php
//*************************************************************
// Listado de archivos en el servidor para pasarlos al ckeditor
//*************************************************************
// CKEditor sends automatically ($_GET[]) some additional arguments to the filebrowser:
//
// •CKEditor - name of the CKEditor instance
// •langCode - CKEditor language ("en" for English)
// •CKEditorFuncNum - anonymous function number used to pass the url of a file to CKEditor
//
// Passing the URL of selected file
// To send back the file url from an external file browser, simply call CKEDITOR.tools.callFunction and pass there CKEditorFuncNum as the first argument:
//  CKEDITOR.tools.callFunction( funcNum, fileUrl [, data] );
// If data (the third argument) is a string, it will be displayed by CKEditor (usually used to display an error message if problem occurs during file upload).
    ?>

    <body bgcolor="#888888" >
        <form id="form1" name="form1" method="post" action="">
            <div style="height:370px; overflow:auto">
                <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
                    <tr class="texto_naranja">
                        <td colspan="2"><div align="center">Imagenes en el Servidor
                            </div></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table align="left" width="100%">
                                <tr>
                                    <?php
                                    $FuncionCKEditor = $_GET["CKEditorFuncNum"];
                                    $path = "/MyDA/archivos";
                                    $directorio = dir($_SERVER['DOCUMENT_ROOT'] . $path);

                                    $col = 1;
                                    while ($archivo = $directorio->read()) {
                                        if (EsImagen($archivo)) {
                                            $RutaWeb = "/MyDA/archivos/" . $archivo;
                                    ?>
                                            <td width="25%" class="texto_marfil" align="center">
                                                <input name="imagenes" id="imagenes" type="Radio" value="<?php echo $RutaWeb ?>" checked="checked" />
                                        <?php echo $archivo; ?><br />
                                            <img src="<?php echo $RutaWeb ?>" border="1" width="150" /></td>
                                    <?php
                                            $col++;
                                            if ($col > 4) {
                                                //Nueva fila
                                    ?>
                                            </tr>
                                <?php
                                                $col = 1;
                                            }
                                        }
                                    }
                                    $directorio->close();
                                    //Termina la fila
                                    for ($i = $col; $i < 5; $i++) {
                                        echo "<td width='25%' class='FilaTabla'></td>";
                                    }
                                ?>
                                </table>      </td>
                        </tr>
                    </table>
                </div>
                <table width="300" align="center">
                    <tr>
                        <td width="25%"><div align="left">
                                <br /><input type="button" value="Cerrar" onclick="self.close();"/>
                            </div></td>
                        <td width="25%"><div align="left">
                                <br /><input type="button" value="Actualizar" onclick="Actualizar();"/>
                            </div></td>
                        <td width="25%"><div align="center">
                                <br /><input type="button" name="Borrar" id="Borrar" value="Eliminar" onclick="javascript:EliminarImagen();"/>
                            </div></td>
                        <td width="25%"><div align="center"> <br />
                                <input type="button" name="Seleccionar" id="Seleccionar" value="Seleccionar" onclick="javascript:SeleccionarImagen();" />
                            </div></td>
                    </tr>
                </table>
            </form>
            <script language="javascript">
                function Cerrar(){
                    window.close();
                }
                function Actualizar(){
                    window.location.reload(true);
                }
                function SeleccionarImagen(){
                    //Comprueba que imagen esta seleccionada
                    var sel_imagenes = document.getElementsByName("imagenes");
                    for (var i=0; i<sel_imagenes.length;i++){
                        if (sel_imagenes[i].checked)
                            break;
                    }
                    valor = sel_imagenes[i].value;

                    //Le pasamos el valor al CKEDITOR
                    window.opener.CKEDITOR.tools.callFunction(<?php echo $FuncionCKEditor ?>, valor);
                close();
            }
            function EliminarImagen()
            {
                //Comprobamos que imagen esta seleccionada
                var sel_imagenes = document.getElementsByName("imagenes");
                for (var i=0; i<sel_imagenes.length;i++){
                    if (sel_imagenes[i].checked)
                        break;
                }
                valor = sel_imagenes[i].value;

                pagina='borrar_archivo.php?archivo=' + valor;
                if (confirm('¿Desea borrar la imagen?'))
                {
                    window.location=pagina;
                }
            }
        </script>
    </body>
</html>
