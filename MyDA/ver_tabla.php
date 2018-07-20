<?php include($_SERVER["DOCUMENT_ROOT"] . "/MyDA/clases/clases.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>MyDataAccess</title>
        <link href="/MyDA/estilos.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/MyDA/js/funciones.js"></script>
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
                    <?php
                    $idTabla = $_GET["tabla"];
                    $tabla = new Tabla();
                    $tabla->BuscaId($idTabla);
                    if (isset($_GET["orden"])) {
                        $CampoOrden = $_GET["orden"];
                        $dirOrden = $_GET["dir"];
                        $tabla->campoOrden = $CampoOrden;
                        $tabla->dirOrden = $dirOrden;
                    }
                    $filtro = "";
                    //Extrae los criterios de filtrado
                    foreach ($_POST as $nombre_campo => $valor) {
                        $campo = new Campo();
                        $campo->BuscaCampo($idTabla, $nombre_campo);
                        if ($valor != "" && $valor != "0") {
                            switch ($campo->tipo) {
                                case 0:
                                    //Texto
                                    $filtro.=" AND $nombre_campo LIKE '%$valor%'";
                                    break;
                                case 1:
                                    //Numero
                                    $filtro.=" AND $nombre_campo=$valor";
                                    break;
                                case 2:
                                    //Notas
                                    break;
                                case 3:
                                    //Si-No
                                    $filtro.=" AND $nombre_campo=$valor";
                                    break;
                                case 4:
                                    //Archivo
                                    break;
                                case 5:
                                    //Imagen
                                    break;
                                case 6:
                                    //Combo
                                    $filtro.=" AND $nombre_campo=$valor";
                                    break;
                                case 7:
                                    //Fecha
                                    $filtro.=" AND $nombre_campo LIKE '%$valor%'";
                                    break;
                                case 99:
                                    $filtro.=" AND $nombre_campo=$valor";
                                    break;
                                default:
                                    break;
                            }
                        }
                    }
                    $tabla->filtro = $filtro;

                    //Paginación
                    $tabla->tamanoPagina = 50;

                    //Obtiene la página a mostrar y el inicio del registro a mostrar
                    if (!isset($_GET["pagina"])) {
                        $inicio = 0;
                        $pagina = 1;
                    } else {
                        $pagina = $_GET["pagina"];
                        $inicio = ($pagina - 1) * $tabla->tamanoPagina;
                    }
                    $tabla->pagina = $pagina;
                    $tabla->primerRegistro = $inicio;

                    $tabla->estilo = "Tabla";
                    $tabla->Ver();
                    ?>
                </p>
            </div>
        </div>
        <p><?php VerPie(); ?></p></body>
</html>
