<?php include($_SERVER["DOCUMENT_ROOT"] . "/MyDA/clases/clases.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>MyDataAccess</title>
        <link href="/MyDA/estilos.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <?php
        $usuario = $_POST["usuario"];
        $clave = $_POST["clave"];
        $admin = $_POST["admin"];

        if (isset($_POST["id"])) {
            $id = $_POST["id"];
        } else {
            $id = 0;
        }
        $conexion = new Conexion();

        //Guarda el menu
        if ($id == 0) {
            $sql = "INSERT INTO fw_usuarios (id,usuario,clave,admin) VALUES (NULL,'$usuario','$clave',$admin)";
        } else {
            $sql = "UPDATE fw_usuarios SET usuario='$usuario',clave='$clave',admin=$admin WHERE id=$id";
        }
        $rs = $conexion->Consulta($sql);

        Redirige("mantenimiento_usuarios.php");
        ?>
    <p><?php VerPie(); ?></p></body>
</html>
