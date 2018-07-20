<?php
include($_SERVER["DOCUMENT_ROOT"] . "/MyDA/clases/clases.php");
?>
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
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p align="center"><img alt="" src="/MyDA/img/framework.jpg"/></p>
                <p>&nbsp;</p>
            </div>
        </div>
        <p><?php VerPie(); ?></p>
    </body>
</html>
