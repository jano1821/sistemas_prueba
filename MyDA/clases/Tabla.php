<?php

class Tabla {

    public $nombre = "";
    public $nombreBD = "";
    public $id = "";
    public $estilo = "";
    public $filtro = "";
    public $campoOrden = "";
    public $dirOrden = "DESC";
    public $pagina = 1;
    public $tamanoPagina = 50;
    public $primerRegistro = 0;

    public function BuscaNombre($nombreBD) {
        $conexion = new Conexion();
        $sql = "SELECT * FROM fw_tablas WHERE nombreBD='" . $nombreBD . "'";
        $rs = $conexion->Consulta($sql);
        while ($reg = mysql_fetch_array($rs)) {
            $this->id = $reg["id"];
            $this->nombre = $reg["nombre"];
            $this->nombreBD = $nombreBD;
        }
    }

    public function BuscaId($id) {
        $conexion = new Conexion();
        $sql = "SELECT * FROM fw_tablas WHERE id=" . $id;
        $rs = $conexion->Consulta($sql);
        while ($reg = mysql_fetch_array($rs)) {
            $this->id = $id;
            $this->nombre = $reg["nombre"];
            $this->nombreBD = $reg["nombreBD"];
        }
    }

    public function LeerValorCampo($id, $campo) {
        $conexion = new Conexion();
        $rsDato = $conexion->Consulta("SELECT $campo FROM " . $this->nombreBD . " WHERE id=$id");
        while ($reg = mysql_fetch_array($rsDato)) {
            return $reg[$campo];
        }
    }

    public function CambiarValorCampo($id, $campo, $valor) {
        $conexion = new Conexion();
        $sql = "UPDATE " . $this->nombreBD . " SET $campo=$valor WHERE id=$id";
        $rsDato = $conexion->Consulta($sql);
    }

    public function Ver() {
        $conexion = new Conexion();
//Campos de la tabla
        $rsCampos = $conexion->Consulta("SELECT * FROM fw_campos WHERE idTablas=" . $this->id . " AND visible=1 ORDER BY orden,nombre");
        $numCampos = mysql_num_rows($rsCampos);
        $nomCampos = array($numCampos);
        $tipoCampos = array($numCampos);

//Datos de los campos
        $sql = "SELECT * FROM " . $this->nombreBD;
        $rsDatos = $conexion->Consulta($sql);
        $num_total_registros = mysql_num_rows($rsDatos);

//Filtro de datos
        if ($this->filtro != "") {
            $sql.=" WHERE True=True " . $this->filtro;
        }
        if ($this->campoOrden != "") {
            $sql.=" ORDER BY " . $this->campoOrden . " " . $this->dirOrden;
        } else {
            $sql.=" ORDER BY id";
        }

//Paginación de datos
        $TAMANO_PAGINA = $this->tamanoPagina;
        $total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);

        $sql.=" LIMIT " . $this->primerRegistro . "," . $this->tamanoPagina;
        $rsDatos = $conexion->Consulta($sql);
        $num_registros_mostrados = mysql_num_rows($rsDatos);

        //Crea un fichero temporal para exportar a Excel
        $fExcel = fopen("export/DatosExcel.xls", "w");
        $textExcel = ""; //Almacena el texto que será escrito en el fichero Excel en el formato "nuevoDato\tnuevaLinea\n"
        //Cabecera
        echo "<table align=center cellpadding=5 class=" . $this->estilo . "><tr><td align=center colspan=" . ($numCampos + 2) . ">";
        echo "<b>" . strtoupper($this->nombre) . "</b><br>";
        echo "Mostrando $num_registros_mostrados de $num_total_registros registro(s)<br>";
        if ($total_paginas > 1) {
            echo "Páginas: ";
            for ($i = 1; $i <= $total_paginas; $i++) {
                if ($i == $this->pagina) {
                    //Página actual, no coloca enlace
                    echo "<u>$i</u> ";
                } else {
                    //Coloca el enlace para ir a esa página
                    echo "<a href='ver_tabla.php?tabla=" . $this->id . "&pagina=" . $i . "'>" . $i . "</a> ";
                }
            }
        }
        echo "<br><br>";
        global $usuario;
        if ($usuario->admin == 1) {

            echo "<a href='modificar_estructura.php?tabla=" . $this->id . "'><img src='/MyDA/img/modif_estructura.png' border=0 align=middle></a> Modificar estructura - ";
        }
        echo "<a href='export/DatosExcel.xls' target=_blank><img src='/MyDA/img/icon-excel.gif' border=0 align=middle></a> Exportar a Excel - ";
        echo "<a href='importar_datos.php?tabla=" . $this->id . "'><img src='/MyDA/img/importar.jpg' border=0 align=middle></a> Importar datos de Excel - ";
        echo "<a href='nuevo_dato.php?tabla=" . $this->id . "'><img src='/MyDA/img/nuevo.jpg' border=0 align=middle></a> Nuevo dato";
        echo "</td></tr>";

        if ($numCampos > 0) {
//Titulos
            echo "<tr>";
            echo "<td bgcolor=#D3DCE3></td>"; //Titulo editar
            echo "<td bgcolor=#D3DCE3></td>"; //Titulo suprimir
            $c = 0;
            while ($reg = mysql_fetch_array($rsCampos)) {
                echo "<td bgcolor=#D3DCE3><u>"
                . "<a title='Ordenar' href='ver_tabla.php?tabla=" . $this->id . "&orden=" . $reg["nombreBD"] . "&dir=";
                if ($this->dirOrden == "ASC") {
                    echo "DESC";
                } else {
                    echo "ASC";
                }
                echo "'>"
                . $reg["nombre"]
                . "</a></u>";
                if ($this->campoOrden == $reg["nombreBD"]) {
                    if ($this->dirOrden == "ASC") {
                        echo "<img src='/MyDA/img/flecha_down.png' border=0 align=middle>";
                    } else {
                        echo "<img src='/MyDA/img/flecha_up.png' border=0 align=middle>";
                    }
                }
                echo "</td>";
                $textExcel.=$reg["nombre"] . "\t";
                $idCampos[$c] = $reg["id"];
                $nomCampos[$c] = $reg["nombreBD"];
                $c++;
            }
            echo "</tr>";
            $textExcel.="\n";

//Filtros
            echo "<form id='formFiltro' name='formFiltro' method='post' action='ver_tabla.php?tabla=" . $this->id . "'>";
            echo "<tr>";
            echo "<td colspan=2><input type='submit' value='Filtrar:' class=Tabla /></td>"; //Boton filtrar
            for ($c = 0; $c < $numCampos; $c++) {
                $campo = new Campo($idCampos[$c]);
                echo "<td>";
                echo $campo->VerFiltro();
                echo "</td>";
                unset($campo); //Destruye el objeto
            }
            echo "</tr>";
            echo "</form>";

//Datos
            $color = "#E5E5E5";
            while ($reg = mysql_fetch_array($rsDatos)) {
                echo "<tr>";
//Opción editar
                echo "<td bgcolor=$color><a title='Editar' href='editar_dato.php?tabla=" . $this->id . "&id=" . $reg["id"] . "'><img src='/MyDA/img/editar.png' border=0></a></td>";
//Opción suprimir
                echo "<td bgcolor=$color><a title='Borrar' href='borrar_dato.php?tabla=" . $this->id . "&id=" . $reg["id"] . "' onclick='javascript:return confirm(\"¿Borrar el registro?\");'><img src='/MyDA/img/borrar.png' border=0></a></td>";
                for ($c = 0; $c < $numCampos; $c++) {
                    $campo = new Campo($idCampos[$c]);
                    echo "<td bgcolor=$color>" . $campo->VerList($reg[$nomCampos[$c]]) . "</td>";
                    $textExcel.=$reg[$nomCampos[$c]] . "\t";
                }
                echo "</tr>";
                $textExcel.="\n";
                if ($color == "#E5E5E5") {
                    $color = "#D5D5D5";
                } else {
                    $color = "#E5E5E5";
                }
            }
        }
//Exporta los datos al fichero Excel
        fputs($fExcel, $textExcel);
//Cierra el archivo Excel
        fclose($fExcel);

//Pie
        echo "</table>";
    }

    public function FormEditDato($idDatos) {
        $conexion = new Conexion();
        $rsCampos = $conexion->Consulta("SELECT * FROM fw_campos WHERE idTablas=" . $this->id . " ORDER BY ABS(orden)");
        $numCampos = mysql_num_rows($rsCampos);
        $nomCampos = array($numCampos);

//Cabecera
        echo '<form id="formEditDato" name="formEditDato" enctype="multipart/form-data" method="post" action="guardar_dato.php?idTabla=' . $this->id . '&Edit=' . $idDatos . '">';
        echo "<table align=center cellpadding=5 class=" . $this->estilo . "><tr><td align=center colspan=2>";
        echo "<b>" . strtoupper($this->nombre) . "</b>";
        echo "</td></tr>";
        echo "<tr><td bgcolor=#D3DCE3><u>Campo</u></td><td bgcolor=#D3DCE3><u>Dato</u></td></tr>";

//Titulos de los campos (en filas)
        while ($reg = mysql_fetch_array($rsCampos)) {
            echo "<tr>";
            echo "<td valign=top><b>" . $reg["nombre"] . ":</b></td>";
            $campo = new Campo($reg["id"]);
            echo "<td>" . $campo->VerEdit($idDatos) . "<td>";
            echo "</tr>";
        }

//Pie
        echo '<tr><td align=center colspan=2><input type="submit" value="Guardar" /></td></tr>';
        echo "</table>";
        echo '</form>';
    }

    public function FormNuevoDato() {
        $conexion = new Conexion();
        $rsCampos = $conexion->Consulta("SELECT * FROM fw_campos WHERE idTablas=" . $this->id . " ORDER BY ABS(orden)");
        $numCampos = mysql_num_rows($rsCampos);
        $nomCampos = array($numCampos);

//Cabecera
        echo '<form id="formNuevoDato" name="formNuevoDato" enctype="multipart/form-data" method="post" action="guardar_dato.php?idTabla=' . $this->id . '">';
        echo "<table align=center cellpadding=5 class=" . $this->estilo . "><tr><td align=center colspan=2>";
        echo "<b>" . strtoupper($this->nombre) . "</b>";
        echo "</td></tr>";
        echo "<tr><td bgcolor=#D3DCE3><u>Campo</u></td><td bgcolor=#D3DCE3><u>Dato</u></td></tr>";

//Titulos de los campos (en filas)
        while ($reg = mysql_fetch_array($rsCampos)) {
            echo "<tr>";
            echo "<td valign=top><b>" . $reg["nombre"] . ":</b></td>";
            $campo = new Campo($reg["id"]);
            echo "<td>" . $campo->VerNuevo() . "<td>";
            echo "</tr>";
        }

//Pie
        echo '<tr><td align=center colspan=2><input type="submit" value="Guardar" /></td></tr>';
        echo "</table>";
        echo '</form>';
    }

    public function BorrarRegistro($idDato) {
        $conexion = new Conexion();
//Borra los archivos asociados al registro
//Busca todos los campos de la tabla del tipo 4 (Archivo) o 5 (Imagen)
        $sql = "SELECT * FROM fw_campos WHERE idTablas=" . $this->id . " AND (tipo=4 OR tipo=5)";
        $rs = $conexion->Consulta($sql);
        while ($campos = mysql_fetch_array($rs)) {
            $archivo = $this->LeerValorCampo($idDato, $campos["nombreBD"]);
//Borra el archivo
            if ($archivo != "" && file_exists($_SERVER["DOCUMENT_ROOT"] . "/MyDA/archivos/$archivo")) {
                unlink($_SERVER["DOCUMENT_ROOT"] . "/MyDA/archivos/$archivo");
            }
        }

//Borra el registro de la tabla
        $sql = "DELETE FROM " . $this->nombreBD . " WHERE id=" . $idDato;
        $rs = $conexion->Consulta($sql);
        Redirige("ver_tabla.php?tabla=" . $this->id);
    }

    public function Borrar() {
        $conexion = new Conexion();
        $sql = "DELETE FROM fw_campos WHERE idTablas=" . $this->id;
        $rs = $conexion->Consulta($sql);

        $sql = "DELETE FROM fw_tablas WHERE id=" . $this->id;
        $rs = $conexion->Consulta($sql);

        $sql = "DROP TABLE " . $this->nombreBD;
        $rs = $conexion->Consulta($sql);
        Redirige("mantenimiento_tablas.php");
    }

    public function GuardarNuevoRegistro($datos) {
//Extrae los datos del array
        $nomCampos = "id";
        $valores = "NULL";
        foreach ($datos as $nombre_campo => $valor) {
            $nomCampos.="," . $nombre_campo;

            switch ($this->TipoCampo($nombre_campo)) {
                case 0:
//Texto
                    $valores.=",'" . $valor . "'";
                    break;
                case 2:
//Notas
                    $valores.=",'" . $valor . "'";
                    break;
                case 3:
//Si-No
                    if ($valor == "1") {
                        $valores.=",1";
                    } else {
                        $valores.=",0";
                    }
                    break;
                case 4:
//Archivo
                    $valores.=",'" . $valor . "'";
                    break;
                case 5:
//Imagen
                    $valores.=",'" . $valor . "'";
                    break;
                case 7:
//Fecha
                    $valores.=",'" . $valor . "'";
                    break;
                default:
//Numero o Lista
                    if ($valor == "") {
                        $valor = "0";
                    }
                    $valores.= "," . $valor;
                    break;
            }
        }
        $conexion = new Conexion();
        $sql = "INSERT INTO " . $this->nombreBD . " (" . $nomCampos . ") VALUES (" . $valores . ")";
        $rs = $conexion->Consulta($sql);
        return mysql_insert_id();
    }

    public function CreaNueva($nombre, $nombreBD) {
        $conexion = new Conexion();
//Guarda el nombre en fw_tablas
        $sql = "INSERT INTO fw_tablas (id,nombre,nombreBD) VALUES (NULL,'" . $nombre . "','" . $nombreBD . "')";
        $rs = $conexion->Consulta($sql);

//Crea la tabla en MySQL
        $sql = "CREATE TABLE " . $nombreBD . " (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY);";
        $rs = $conexion->Consulta($sql);

        $tablaNueva = new Tabla();
        $tablaNueva->BuscaNombre($nombreBD);
//Guarda el campo id en fw_campos
        $sql = "INSERT INTO fw_campos (id,idTablas,nombre,nombreBD,tipo,orden) VALUES (NULL," . $tablaNueva->id . ",'Id','id',99,1)";
        $rs = $conexion->Consulta($sql);
    }

    public function ModificarRegistro($idRegistro, $datos) {
//Extrae los datos del array
        $valores = "";
        $primero = TRUE;
        foreach ($datos as $nombre_campo => $valor) {
            if ($primero) {
                $valores.= $nombre_campo . "=";
                $primero = FALSE;
            } else {
                $valores.="," . $nombre_campo . "=";
            }
            switch ($this->TipoCampo($nombre_campo)) {
                case 0:
//Texto
                    $valores.="'" . $valor . "'";
                    break;
                case 2:
//Notas
                    $valores.="'" . $valor . "'";
                    break;
                case 3:
//Si-No
                    if ($valor == "1") {
                        $valores.="1";
                    } else {
                        $valores.="0";
                    }
                    break;
                case 4:
//Archivo
                    $valores.="'" . $valor . "'";
                    break;
                case 5:
//Imagen
                    $valores.="'" . $valor . "'";
                    break;
                case 7:
//Fecha
                    $valores.="'" . $valor . "'";
                    break;
                default:
//Numero o Lista
                    if ($valor == "") {
                        $valor = "0";
                    }
                    $valores.= $valor;
                    break;
            }
        }
        $conexion = new Conexion();
        $sql = "UPDATE " . $this->nombreBD . " SET " . $valores . " WHERE id=" . $idRegistro;
        $rs = $conexion->Consulta($sql);
    }

    public function TipoCampo($nombreCampo) {
        $conexion = new Conexion();
        $rs = $conexion->Consulta("SELECT * FROM fw_campos WHERE idTablas=" . $this->id . " AND nombreBD='" . $nombreCampo . "'");
        while ($reg = mysql_fetch_array($rs)) {
            return $reg["tipo"];
        }
    }

    public function NumCampos() {
        $conexion = new Conexion();
        $rs = $conexion->Consulta("SELECT * FROM fw_campos WHERE idTablas=" . $this->id);
        return mysql_num_rows($rs);
    }

    public function NumRegistros() {
        $conexion = new Conexion();
        $rs = $conexion->Consulta("SELECT * FROM " . $this->nombreBD);
        return mysql_num_rows($rs);
    }

}

?>
