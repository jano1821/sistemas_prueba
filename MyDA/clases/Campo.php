<?php

class Campo {

    public $id = 0;
    public $tipo = 0;
    public $nombreTipo = "";
    public $nombre = "";
    public $nombreBD = "";
    public $idTablaLista = 0;
    public $nombreTablaLista = "";
    public $idTablas = 0;
    public $nombreTabla = "";
    public $campoValores = "";
    public $campoTextos = "";
    public $orden = 0;
    public $visible = 1;

    public function Borrar() {
        $conexion = new Conexion();
        $rs = $conexion->Consulta("DELETE FROM fw_campos WHERE id=" . $this->id);
        $rs = $conexion->Consulta("ALTER TABLE " . $this->nombreTabla . " DROP COLUMN " . $this->nombreBD);
    }

    public function Campo($id=0) {
        $conexion = new Conexion();
        $result = $conexion->Consulta("SELECT * FROM fw_campos WHERE id=$id");
        while ($reg = mysql_fetch_array($result)) {
            $this->id = $reg["id"];
            $this->nombre = $reg["nombre"];
            $this->nombreBD = $reg["nombreBD"];
            $this->tipo = $reg["tipo"];
            $this->nombreTipo = Combo("", "fw_tiposCampos", "codigo", "valor", $this->tipo, TRUE);
            $this->campoTextos = $reg["campoTextos"];
            $this->campoValores = $reg["campoValores"];
            $this->idTablaLista = $reg["idTablaLista"];
            $tablaLista = new Tabla();
            $tablaLista->BuscaId($this->idTablaLista);
            $this->nombreTablaLista = $tablaLista->nombreBD;
            $this->idTablas = $reg["idTablas"];
            $tabla = new Tabla();
            $tabla->BuscaId($this->idTablas);
            $this->nombreTabla = $tabla->nombreBD;
            $this->orden = $reg["orden"];
            $this->visible = $reg["visible"];
        }
    }

    public function BuscaCampo($idTabla, $nombreCampoBD) {
        $conexion = new Conexion();
        $result = $conexion->Consulta("SELECT * FROM fw_campos WHERE idTablas=$idTabla AND nombreBD='$nombreCampoBD'");
        while ($reg = mysql_fetch_array($result)) {
            $this->id = $reg["id"];
            $this->nombre = $reg["nombre"];
            $this->nombreBD = $reg["nombreBD"];
            $this->tipo = $reg["tipo"];
            $this->nombreTipo = Combo("", "fw_tiposCampos", "codigo", "valor", $this->tipo, TRUE);
            $this->campoTextos = $reg["campoTextos"];
            $this->campoValores = $reg["campoValores"];
            $this->idTablaLista = $reg["idTablaLista"];
            $tablaLista = new Tabla();
            $tablaLista->BuscaId($this->idTablaLista);
            $this->nombreTablaLista = $tablaLista->nombreBD;
            $this->idTablas = $reg["idTablas"];
            $tabla = new Tabla();
            $tabla->BuscaId($this->idTablas);
            $this->nombreTabla = $tabla->nombreBD;
            $this->orden = $reg["orden"];
            $this->visible = $reg["visible"];
        }
    }

    public function VerNuevo() {
        switch ($this->tipo) {
            case 0:
                //Texto
                return "<input type='text' size='70' name='" . $this->nombreBD . "' id='" . $this->nombreBD . "' />";
                break;
            case 1:
                //Numero
                return "<input type='text' size='10' maxlength='10'
                    name='" . $this->nombreBD . "' id='" . $this->nombreBD . "'
                    onChange='validarSiNumero(this.value);'/>";
                break;
            case 2:
                //Notas
                $cad = "<textarea name='" . $this->nombreBD . "' cols='70' rows='10' id='" . $this->nombreBD . "'></textarea>"
                        . "<script language='javascript'>
                                CKEDITOR.replace( '" . $this->nombreBD . "',
                                {
                                        width : '700',
                                        toolbarStartupExpanded : false,
                                        filebrowserUploadUrl : '/MyDA/js/ckeditor/upload.php',
                                        filebrowserBrowseUrl : '/MyDA/js/ckeditor/browser.php',
                                        toolbar :
                                                [
                                                ['Source','Preview'],
                                                ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print'],
                                                ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
                                                '/',
                                                ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
                                                ['NumberedList','BulletedList','-','Outdent','Indent'],
                                                ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                                                ['Link','Unlink'],
                                                ['Image','Table','HorizontalRule','SpecialChar'],
                                                '/',
                                                ['Styles','Format','Font','FontSize'],
                                                ['TextColor','BGColor'],
                                                ['Maximize']
                                        ]
                                });
			</script>";
                return $cad;
                break;
            case 3:
                //Si-No
                return CheckBox($this->nombreBD, 0);
                break;
            case 4:
                //Archivo
                return "<input type='file' name='" . $this->nombreBD . "' id='" . $this->nombreBD . "' />";
                break;
            case 5:
                //Imagen
                return "<input type='file' name='" . $this->nombreBD . "' id='" . $this->nombreBD . "' />";
                break;
            case 6:
                //Combo
                return Combo($this->nombreBD, $this->nombreTablaLista, $this->campoValores, $this->campoTextos, 0);
                break;
            case 7:
                //Fecha
                return "<input type='text' size='10' name='" . $this->nombreBD . "' id='" . $this->nombreBD . "' />";
                break;
            case 99:
                return "Auto";
                break;
            default:
                break;
        }
    }

    public function VerEdit($idDatos) {
        $conexion = new Conexion();
        $rsValor = $conexion->Consulta("SELECT * FROM " . $this->nombreTabla . " WHERE id=" . $idDatos);
        while ($regValor = mysql_fetch_array($rsValor)) {
            $valor = $regValor[$this->nombreBD];
        }
        switch ($this->tipo) {
            case 0:
                //Texto
                return "<input type='text' size='70' name='" . $this->nombreBD . "' id='" . $this->nombreBD . "' value='" . $valor . "' />";
                break;
            case 1:
                //Numero
                return "<input type='text' size='10' maxlength='10'
                    name='" . $this->nombreBD . "' id='" . $this->nombreBD . "' value='" . $valor . "'
                    onChange='validarSiNumero(this.value);'/>";
                break;
            case 2:
                //Notas
                $cad = "<textarea name='" . $this->nombreBD . "' cols='70' rows='10' id='" . $this->nombreBD . "'>$valor</textarea>"
                        . "<script language='javascript'>
                                CKEDITOR.replace( '" . $this->nombreBD . "',
                                {
                                        width : '700',
                                        toolbarStartupExpanded : false,
                                        filebrowserUploadUrl : '/MyDA/js/ckeditor/upload.php',
                                        filebrowserBrowseUrl : '/MyDA/js/ckeditor/browser.php',
                                        toolbar :
                                                [
                                                ['Source','Preview'],
                                                ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print'],
                                                ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
                                                '/',
                                                ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
                                                ['NumberedList','BulletedList','-','Outdent','Indent'],
                                                ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                                                ['Link','Unlink'],
                                                ['Image','Table','HorizontalRule','SpecialChar'],
                                                '/',
                                                ['Styles','Format','Font','FontSize'],
                                                ['TextColor','BGColor'],
                                                ['Maximize']
                                        ]
                                });
			</script>";
                return $cad;
                break;
            case 3:
                //Si-No
                return CheckBox($this->nombreBD, $valor);
                break;
            case 4:
                //Archivo
                $cad = "";
                if ($valor != "" && file_exists($_SERVER["DOCUMENT_ROOT"] . "/MyDA/archivos/$valor")) {
                    $cad.= "<a href='/MyDA/archivos/$valor' target='_blank'>"
                            . "<img border=0 src='/MyDA/img/archivo.jpg' />"
                            . "</a><br>"
                            . "$valor"
                            . " - <a href='borrar_fichero.php?tabla=" . $this->idTablas . "&id=$idDatos&campo=" . $this->nombreBD . "'"
                            . " onclick='javascript:return confirm(\"¿Borrar el archivo?\");'>Eliminar</a><br>";
                }
                $cad.= "<input type='file' name='" . $this->nombreBD . "' id='" . $this->nombreBD . "' />";
                return $cad;
                break;
            case 5:
                //Imagen
                $cad = "";
                if ($valor != "" && file_exists($_SERVER["DOCUMENT_ROOT"] . "/MyDA/archivos/$valor")) {
                    $cad.= "<a href='/MyDA/archivos/$valor' target='_blank'>"
                            . "<img border=0 src='/MyDA/archivos/$valor' height='70' />"
                            . "</a><br>"
                            . "$valor"
                            . " - <a href='borrar_fichero.php?tabla=" . $this->idTablas . "&id=$idDatos&campo=" . $this->nombreBD . "'"
                            . " onclick='javascript:return confirm(\"¿Borrar la imagen?\");'>Eliminar</a><br>";
                }
                $cad.="<input type='file' name='" . $this->nombreBD . "' id='" . $this->nombreBD . "' />";
                return $cad;
                break;
            case 6:
                //Combo
                return Combo($this->nombreBD, $this->nombreTablaLista, $this->campoValores, $this->campoTextos, $valor);
                break;
            case 7:
                //Fecha
                return "<input type='text' size='10' name='" . $this->nombreBD . "' id='" . $this->nombreBD . "' value='" . $valor . "' />";
                break;
            case 99:
                return $valor;
                break;
            default:
                break;
        }
    }

    public function VerList($valor) {
        switch ($this->tipo) {
            case 0:
                //Texto
                return $valor;
                break;
            case 1:
                //Numero
                return $valor;
                break;
            case 2:
                //Notas
                return "...";
                break;
            case 3:
                //Si-No
                return CheckBox_List($this->nombreBD, $valor);
                break;
            case 4:
                //Archivo
                $cad = "";
                if ($valor != "" && file_exists($_SERVER["DOCUMENT_ROOT"] . "/MyDA/archivos/$valor")) {
                    $cad.= "<a href='/MyDA/archivos/$valor' target='_blank'>"
                            . "<img border=0 src='/MyDA/img/archivo_peq.jpg' />"
                            . "</a>";
                }
                return $cad;
                break;
            case 5:
                //Imagen
                $cad = "";
                if ($valor != "" && file_exists($_SERVER["DOCUMENT_ROOT"] . "/MyDA/archivos/$valor")) {
                    $cad.= "<a href='/MyDA/archivos/$valor' target='_blank'>"
                            . "<img border=0 src='/MyDA/img/imagen.jpg' />"
                            . "</a>";
                }
                return $cad;
                break;
            case 6:
                //Combo
                return Combo($this->nombreBD, $this->nombreTablaLista, $this->campoValores, $this->campoTextos, $valor, TRUE);
                break;
            case 7:
                //Fecha
                return $valor;
                break;
            case 99:
                return $valor;
                break;
            default:
                break;
        }
    }

    public function VerFiltro() {
        switch ($this->tipo) {
            case 0:
                //Texto
                return "<input type='text' size='10' name='" . $this->nombreBD . "' id='" . $this->nombreBD . "' value='' />";
                break;
            case 1:
                //Numero
                return "<input type='text' size='6' name='" . $this->nombreBD . "' id='" . $this->nombreBD . "'
                    onChange='validarSiNumero(this.value);'/>";
                break;
            case 2:
                //Notas
                return "";
                break;
            case 3:
                //Si-No
                return "<input name=" . $this->nombreBD . " type='checkbox' id=" . $this->nombreBD . " value='1' />";
                break;
            case 4:
                //Archivo
                return "";
                break;
            case 5:
                //Imagen
                return "";
                break;
            case 6:
                //Combo
                return Combo($this->nombreBD, $this->nombreTablaLista, $this->campoValores, $this->campoTextos);
                break;
            case 7:
                //Fecha
                return "<input type='text' size='10' name='" . $this->nombreBD . "' id='" . $this->nombreBD . "' value='' />";
                break;
            case 99:
                //Indice
                return "<input type='text' size='1' name='" . $this->nombreBD . "' id='" . $this->nombreBD . "'
                    onChange='validarSiNumero(this.value);'/>";
                break;
            default:
                break;
        }
    }

}

?>
