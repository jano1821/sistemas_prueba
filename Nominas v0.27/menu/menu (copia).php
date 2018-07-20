<div id="tabs">
<br>
<h2> Sistema de Empleados y Nominas Online </h2>
  <ul>
  	<li><a href="index.php" title="Inicio"><span>Inicio</span></a></li>
  	 <?php
    if ($_SESSION['TABBEMP'] == '1'){
    	echo('<li><a href="buscaremp.php" title="Buscar Empleado"><span>Buscar Empleados</span></a></li>');
    }
    ?>
    <?php
    if ($_SESSION['TABBNOM'] == '1'){
    	echo('<li><a href="buscarnom.php" title="Buscar Nomina"><span>Buscar Nominas</span></a></li>');
    }
    ?>
    <?php
    if ($_SESSION['TABBSOL'] == '1'){
    	echo('<li><a href="buscarsol.php" title="Buscar Solicitudes"><span>Buscar Solicitudes</span></a></li>');
    }
    ?>
    <?php
    if ($_SESSION['TABBAUS'] == '1'){
    	echo('<li><a href="buscaraus.php" title="Buscar Ausencias"><span>Buscar Ausencias</span></a></li>');
    }
    ?>
	 <?php
    if ($_SESSION['TABNEMP'] == '1'){
    	echo('<li><a href="nuevoemp.php" title="Nuevo Empleado"><span>Nuevo Empleado</span></a></li>');
    }
    ?>
    <?php
    if ($_SESSION['TABNNOM'] == '1'){
	 	echo('<li><a href="nuevonom.php" title="Nueva Nomina"><span>Nueva Nomina</span></a></li>');
	 }
	 ?>
	 <?php
	 if ($_SESSION['TABNSOL'] == '1'){
    	echo ('<li><a href="nuevasolicitud.php" title="Nueva Solicitud"><span>Nueva Solicitud</span></a></li>');
    }
    ?>
	 <?php
    if ($_SESSION['TABNAUS'] == '1'){
    	echo('<li><a href="nuevaausencia.php" title="Registrar Ausencia"><span>Registrar Ausencia</span></a></li>');
    }
    ?>
    <?php
    if ($_SESSION['TABNCON'] == '1'){
    	echo('<li><a href="nuevocontrato.php" title="Dar Alta Contrato"><span>Dar Alta Contrato</span></a></li>');
    }
    ?>
	 <?php
	 if ($_SESSION['TABSTATS'] == '1'){
    	echo ('<li><a href="estadisticas.php" title="Estadisticas"><span>Estadisticas</span></a></li>');
    }
    ?>
    <?php
	 if ($_SESSION['TABUSERA'] == '1'){
     	echo('<li><a href="adminuser.php" title="Instalar"><span>Administrar Usuarios</span></a></li>');
    }
     ?>
    <?php
	 if ($_SESSION['TABINST'] == '1'){
     	echo('<li><a href="instalar.php" title="Instalar"><span>Instalar</span></a></li>');
    }
     ?>
	 <li><a href="login/logout.php" title="SALIR"><div id="tabespecial">SALIR</div></a></li>
  </ul>
</div>
<br> <br> <br> <br> <br>
