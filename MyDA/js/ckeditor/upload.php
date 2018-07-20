<?php
//***********************************************************
// Upload de archivo enviado por el ckeditor
//***********************************************************
//Guarda la imagen el el servidor
include($_SERVER["DOCUMENT_ROOT"] . "/MyDA/clases/clases.php");

$Guardar = "True";
$FuncionCKEditor = $_GET["CKEditorFuncNum"];
if (trim($_FILES['upload']["name"]) != "" && !is_null($_FILES['upload']["name"])) {
    $Archivo = $_FILES['upload']['name'];
    $tamano_Archivo = $_FILES['upload']['size'];

    //Comprueba tamaño
    if ($tamano_Archivo > 1000000) {
        //echo "<center>El archivo es demasiado grande. <br>Solo se permiten archivos de un maximo de 1 Mb.</center>";
        $Guardar = "False";
    }
    //Comprueba extension
    $extensiones = array("jpg", "jpeg", "gif", "png");
    if (!in_array(end(explode(".", strtolower($_FILES['upload']['name']))), $extensiones)) {
        $Guardar = "False";
    }
} else {
    $Guardar = "False";
}

if ($Guardar == "True") {
    $Ruta = $_SERVER['DOCUMENT_ROOT'] . "/MyDA/archivos/";
    $RutaWeb = "http://" . $_SERVER['SERVER_NAME'] . "/MyDA/archivos/" . $Archivo;

    if (isset($_FILES['upload'])) {
        $temp = $_FILES['upload']['tmp_name'];
        move_uploaded_file($_FILES['upload']['tmp_name'], $Ruta . $Archivo);
        //Establece permisos del archivo
        chmod($Ruta . $Archivo, 0777);
?>
        <script language="javascript">
            window.parent.CKEDITOR.tools.callFunction(<?php echo $FuncionCKEditor ?>, "<?php echo $RutaWeb ?>", "");
            alert("Imagen '<?php echo $Archivo ?>' subida correctamente al servidor");
        </script>
<?php
    }
} else {
?>
    <script language="javascript">
        window.parent.CKEDITOR.tools.callFunction(<?php echo $FuncionCKEditor ?>, "", "Error: La imagen no ha podido subirse al servidor");
    </script>
<?php
}
?>
