<?php include($_SERVER["DOCUMENT_ROOT"] . "/MyDA/clases/clases.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $conexion = new Conexion();
        //Crea fw_tablas
        echo "Creando tablas...<br>";
        $sql = "CREATE TABLE IF NOT EXISTS `fw_tablas` (
                `id` int(11) NOT NULL auto_increment,
                `nombre` varchar(50) NOT NULL,
                `nombreBD` varchar(50) NOT NULL,
                PRIMARY KEY  (`id`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=latin1;";
        $rs = $conexion->Consulta($sql);

        //Crea fw_campos
        echo "Creando campos...<br>";
        $sql = "CREATE TABLE IF NOT EXISTS `fw_campos` (
                `id` int(11) NOT NULL auto_increment,
                `idTablas` int(11) default NULL,
                `nombre` varchar(50) NOT NULL,
                `nombreBD` varchar(50) NOT NULL,
                `tipo` int(11) NOT NULL default '0',
                `orden` int(11) NOT NULL default '0' COMMENT '-1 = no visible en listado',
                `idTablaLista` int(11) default '0',
                `campoValores` varchar(50) default NULL,
                `campoTextos` varchar(50) default NULL,
                PRIMARY KEY  (`id`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=latin1;";
        $rs = $conexion->Consulta($sql);

        //Crea fw_tiposCampos
        echo "Creando tipos de campos...<br>";
        $sql = "CREATE TABLE IF NOT EXISTS `fw_tiposCampos` (
                `codigo` int(11) NOT NULL,
                `valor` varchar(50) NOT NULL
                ) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
        $rs = $conexion->Consulta($sql);

        //Crea fw_menus
        echo "Creando menus...<br>";
        $sql = "CREATE TABLE IF NOT EXISTS `fw_menus` (
                `id` int(11) NOT NULL auto_increment,
                `orden` int(11) NOT NULL default '0',
                `nombre` varchar(50) NOT NULL,
                `idTabla` int(11) default '0',
                `url` varchar(100) default NULL,
                PRIMARY KEY  (`id`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=latin1;";
        $rs = $conexion->Consulta($sql);
        
        echo "Instalación finalizada.<br><br>Iniciando...";
        Redirige("index.php");
        ?>
    </body>
</html>
