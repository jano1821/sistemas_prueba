<body bgcolor="#888888">
    <div align="center">
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p><strong><font face="Arial, Helvetica, sans-serif">Archivo eliminado</font></strong></p>
        <p><a href="javascript:history.back();">&lt;&lt; Volver</a> - <a href="#" onClick="Cerrar();">Cerrar ventana</a></p>
    </div>
    <?php
//***************************************
// Borra el archivo pasado como parametro
//***************************************
    $archivo = $_SERVER['DOCUMENT_ROOT'] . $_GET['archivo'];

    if (file_exists($archivo)) {
        unlink($archivo);
    }
    ?>
</body>
<script type='text/javascript'>
    function Cerrar()
    {
        window.close();
    }
</script>
