
<html>

<title> Primera Instalacion : Sitema de Nominas y Empleados Online </title>
<link rel=StyleSheet href="estilos.css" TYPE="text/css">
</head>

<body>

<div id="tabs">
<br>
<h2> Primera Instalacion : Sistema de Nominas y Empleados Online </h2>
  <ul>
    <li><a href="instalar.php" title="Instalar"><span>Instalar</span></a></li>
</div>
<br> <br> <br> <br> <br>
 <center>
 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
 <table class="tablaazul">
<tr><th colspan="2">
 <h2>DATOS PARA CREAR LA BBDD Y LA ESTRUCTURA: </h2>
</th></tr>
<tr><td>
 <label> Escriba el servidor:</label> </td><td> <input type="text" name="host" value="localhost">
 </td></tr>
<tr><td>
 <label> Escriba el usuario root:</label> </td><td> <input type="text" name="user" value="root">
 </td></tr>
 <tr><td>
 <label> Escriba la password root:</label> </td><td> <input type="password" name="pass" value="toor">
 </td></tr>
  <tr><td>
 <label> Nombre de la BBDD:</label> </td><td> <input type="text" name="bbdd" value="facturacrm">
 </td><tr>
  </table>
  <br>
<table class="tablaazul">
<tr><th colspan="4">
<h2>CREACION DE USUARIOS ADMIN DEL SISTEMA:</h2>
 </th></tr>
 <tr><td>
 <label> Nombre de Usuario:</label> </td><td> <input type="text" name="useradmin" value="admin"></td><td> 
 <label> Contrase&ntilde;a:</label> </td><td> <input type="password" name="passadmin" value="password">
 </td></tr>
 </table>
   <br>
 <table class="tablaazul">
<tr><th colspan="4">
<h2>DATOS DE LA EMPRESA:</h2>
 </th></tr>
 <tr><td>
 <label> Nombre de La Empresa:</label> </td><td> <input type="text" name="nombreemp" value="NOMBRE EMPRESA"></td><td> 
 <label> CIF de la Empresa:</label> </td><td> <input type="text" name="cifemp" value="000000000F">
 </td></tr>
 </table>

<table><tr><td>
 <INPUT type="submit" name="botoninst" value="INSTALAR"> </form>
 </td></tr></table>
 <br>
<?php 
$version=phpversion();
if ($version){
echo(' <div id="noerror"> Comprobando si tienes instalado PHP: Tu versi&oacute;n es: '.$version.'</div>');
}
else{
	echo('<div id="error"> Comprobando si tienes instalado PHP: No se encuentra instalado PHP en tu servidor</div>');
	exit;
}
?>

 
 </center>
 
 <?php
 if(isset($_POST["botoninst"])) 
{ 
	$host=$_REQUEST['host'];
	$user=$_REQUEST['user'];
	$pass=$_REQUEST['pass'];
	$bbdd=$_REQUEST['bbdd'];
	$useradmin=$_REQUEST['useradmin'];
	$passadmin=$_REQUEST['passadmin'];
	$nombreemp=$_REQUEST['nombreemp'];
	$cifemp=$_REQUEST['cifemp'];
	if (empty($host)) {
		echo ("<center><label id='error'> <img src='imagenes/cuidado.png'> No has introducido el nombre del servidor (host) </label></center>");
		exit();
	}
	if (empty($user)) {
		echo ("<center><label id='error'> <img src='imagenes/cuidado.png'> No has introducido el nombre del usuario </label></center>");
		exit();
	}
	if (empty($bbdd)) {
		echo ("<center><label id='error'> <img src='imagenes/cuidado.png'> No has introducido el nombre de la base de datos </label></center>");
		exit();
	}
	echo("<center><table border='1'><tr><td>Establecer Conexi&oacute;n a la Base de Datos </td>");
    //conectar a la bbdd usando los datos introducidos por el usuario
  	 $result=mysql_connect($host, $user, $pass);
    if (!$result) {
	echo(" <td bgcolor='CC0000'> FALLO </td></tr></table>");
    echo ("<center><label id='error'> <img src='imagenes/errorbd.png'>");
    echo 'Imposible Conectar: ' . mysql_error();
    echo ("</label></center>");
    exit;
	 }
	 echo(" <td bgcolor='009900'> OK </td></tr>");
	 echo("<tr><td>Creaci&oacute;n de la Base de Datos: $bbdd </td>");
    //Crear base de datos
	if (mysql_query("CREATE DATABASE  $bbdd")){
		echo(" <td bgcolor='009900'> OK </td></tr>");
	}
	else{
		echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
	}
     
     mysql_select_db($bbdd);

 	echo("<tr><td>Creaci&oacute;n de la Tabla Empleados en la Base de Datos </td>");
    //Crear las tablas si no existen
    // Estructura de la tabla `empleados`
    $empleados=" 
    CREATE TABLE IF NOT EXISTS `empleados` (
  `idemp` int(5) NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `apellidouno` text NOT NULL,
  `apellidodos` text NOT NULL,
  `email` text NOT NULL,
  `dni` text NOT NULL,
  `estado` text NOT NULL,
  `nuss` text NOT NULL,
  `sexo` int(1) NOT NULL,
  `observaciones` text NOT NULL,
  `telfcont` int(15) NOT NULL,
  `telfcont2` int(15) NOT NULL,
  `calle` text NOT NULL,
  `piso` varchar(5) NOT NULL,
  `puerta` varchar(5) NOT NULL,
  `cp` int(10) NOT NULL,
  `localidad` text NOT NULL,
  `provincia` int(3) NOT NULL,
  `fechaent` text NOT NULL,
  `fechasal` text NOT NULL,
  `hijos` int(3) NOT NULL,
  `estadocivil` int(1) NOT NULL,
  `linkfoto` text NOT NULL,
  PRIMARY KEY (`idemp`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100 ;";
	if (mysql_query($empleados)){
		echo(" <td bgcolor='009900'> OK </td></tr>");
	}
	else
	{
		echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
	}
 echo("<tr><td>Creaci&oacute;n de la Tabla Nominas en la Base de Datos </td>");
    // Estructura de la tabla `nominas`
    $nominas="CREATE TABLE IF NOT EXISTS `nominas` (`idnomina` int(5) NOT NULL AUTO_INCREMENT,
  `idemp` int(5) NOT NULL,  `mes` text NOT NULL, `urtea` int(4) NOT NULL,
  `total` float NOT NULL,  `idcontrato` int(5) NOT NULL,  `fechapago` date NOT NULL,
  `estadonom` int(2) NOT NULL,  `tiponom` int(2) NOT NULL,  PRIMARY KEY (`idnomina`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1000 ; ";
	if ( mysql_query($nominas)){
		echo(" <td bgcolor='009900'> OK </td></tr>");
	}
	else
	{
		echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
	}
	  // Estructura de la tabla `conceptos nominas`
	  echo("<tr><td>Creaci&oacute;n de la Tabla Conceptos Nominas en la Base de Datos </td>");
    $conceptosnom="CREATE TABLE IF NOT EXISTS `conceptosnom` (  `IdConceptoNom` int(11) NOT NULL AUTO_INCREMENT,
  	`IdNomina` int(5) NOT NULL,  `IdConcepto` int(5) NOT NULL,  `CantidadConcepto` int(11) NOT NULL,
 	 `PrecioConcepto` float NOT NULL,  `Devengado` float NOT NULL,  `Adeducir` float NOT NULL,
  	PRIMARY KEY (`IdConceptoNom`) ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ; ";
	if ( mysql_query($conceptosnom)){
		echo(" <td bgcolor='009900'> OK </td></tr>");
	}
	else
	{
		echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
	}
	 // Estructura de la tabla `Tipos de Conceptos nominas`
	 echo("<tr><td>Creaci&oacute;n de la Tabla Tipos Conceptos Nominas en la Base de Datos </td>");
	     $tconceptosnom="CREATE TABLE IF NOT EXISTS `t_conceptos` (  `idconcepto` int(5) NOT NULL AUTO_INCREMENT,
  			`denominacion` text NOT NULL, `tipoconcepto` int(1) NOT NULL,  PRIMARY KEY (`idconcepto`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
			if ( mysql_query($tconceptosnom)){
				echo(" <td bgcolor='009900'> OK </td></tr>");
			}
			else
			{
				echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
			}
	 // Volvar datos a la tabla `Tipos de Conceptos nominas`
	 echo("<tr><td>Volcar datos de la Tabla Tipos de Conceptos Nominas en la Base de Datos </td>");
	 	$datosconpnom=" INSERT INTO `t_conceptos` (`idconcepto`, `denominacion`, `tipoconcepto`) VALUES
		(1, 'Horas Contrato - Base', 0),
		(2, 'Horas Extra', 0),
		(3, 'Horas Dietas', 0),
		(4, 'Plus Transporte', 0),
		(5, 'Plus Actividad', 0),
		(6, 'Complemento Domingo', 0),
		(7, 'Vac. Pendientes Pago', 0),
		(8, 'Hora Festivo', 0),
		(9, 'Hora Nocturna', 0),
		(10, 'Cot. Conting. Común', 1),
		(11, 'Cot. Desempleo', 1),
		(12, 'Cot. Form. Prof.', 1),
		(13, 'Complemento de Actividad Especial', 0),
		(14, 'Retención I.R.P.F.', 1),
		(15, 'Paga Extra Primera', 0); ";
		if ( mysql_query($datosconpnom)){
			echo(" <td bgcolor='009900'> OK </td></tr>");
		}
		else
		{
			echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
		}
	 	 // Estructura de la tabla `Tipos de Estados nominas`
	 		echo("<tr><td>Creaci&oacute;n de la Tabla Tipos Conceptos Nominas en la Base de Datos </td>");
	     $testadosnom="CREATE TABLE IF NOT EXISTS `t_estadosnom` (`idestadonom` int(2) NOT NULL AUTO_INCREMENT,
  			`descestadonom` text NOT NULL,  PRIMARY KEY (`idestadonom`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ; ";
			if ( mysql_query($testadosnom)){
				echo(" <td bgcolor='009900'> OK </td></tr>");
			}
			else
			{
				echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
			}
			
			// Volcar la tabla `Tipos de Estados nominas`
	 		echo("<tr><td>Volcar la Tabla Tipos Conceptos Nominas en la Base de Datos </td>");
	     $tstatenomdatos=" INSERT INTO `t_estadosnom` (`idestadonom`, `descestadonom`) VALUES
			(1, 'Pendiente Pago'), (2, 'Pagado'), (3, 'Anulado'); ";
			if ( mysql_query($tstatenomdatos)){
				echo(" <td bgcolor='009900'> OK </td></tr>");
			}
			else
			{
				echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
			}
	 
	 	 // Estructura de la tabla `Tipos nominas`
	 		echo("<tr><td>Creaci&oacute;n de la Tabla Tipos Nominas en la Base de Datos </td>");
	     $ttiponom=" CREATE TABLE IF NOT EXISTS `t_tiponom` (`idtiponom` int(2) NOT NULL AUTO_INCREMENT,
  			`desctiponom` text NOT NULL,  PRIMARY KEY (`idtiponom`) ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ; ";
			if ( mysql_query($ttiponom)){
				echo(" <td bgcolor='009900'> OK </td></tr>");
			}
			else
			{
				echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
			}	
			
			// Volcar Datos de la tabla `Tipos nominas`
	 		echo("<tr><td>Volvar Datos en la Tabla Tipos Nominas en la Base de Datos </td>");
	     $ttiponomdatos=" INSERT INTO `t_tiponom` (`idtiponom`, `desctiponom`) VALUES
			(1, 'Mensual'), (2, 'Ordinaria'), (3, 'Extraordinaria'); ";
			if ( mysql_query($ttiponomdatos)){
				echo(" <td bgcolor='009900'> OK </td></tr>");
			}
			else
			{
				echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
			}	 
	 
	//Estructura Tabla Solicitudes
    echo("<tr><td>Creaci&oacute;n de la Tabla Solicitudes en la Base de Datos </td>");
	//Estructura de la tabla solicitudes
	$solicitudes="CREATE TABLE IF NOT EXISTS `solicitudes` (
  `IdSolicitud` int(5) NOT NULL AUTO_INCREMENT, `IdEmp` int(5) NOT NULL, `Tipo` int(1) NOT NULL,
  `FechaInicio` date NOT NULL, `FechaFin` date NOT NULL, `Motivo` text NOT NULL, `Aprobado` int(1) NOT NULL,
   `FechaAprobado` date NOT NULL, `Anotaciones` text NOT NULL,
    PRIMARY KEY (`IdSolicitud`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;"  ;
     
	if (mysql_query($solicitudes) ){
		echo(" <td bgcolor='009900'> OK </td></tr>");
	}
	else
	{
		echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
	}
	
		echo("<tr><td>Creaci&oacute;n de la Tabla Tipos de Solicitudes </td>");
	 //Esctructura tabla de t_tiposol
  $t_tiposol= "CREATE TABLE IF NOT EXISTS `t_tiposol` (`idtiposol` int(11) NOT NULL AUTO_INCREMENT,
  `desctiposol` text NOT NULL,  PRIMARY KEY (`idtiposol`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1
   AUTO_INCREMENT=1 ;";
	if (mysql_query($t_tiposol)){
		echo(" <td bgcolor='009900'> OK </td></tr>");
	}
	else
	{
		echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
	}
	echo("<tr><td>Creaci&oacute;n de los diferentes Tipos de Solicitudes  </td>");
	//Volcar la base de datos para la tabla `t_tiposol`
	  $desctiposol= "INSERT INTO `t_tiposol` (`idtiposol`, `desctiposol`) VALUES
		(1, 'Permiso Reglamentario'), (2, 'Permiso Especial'),
		(3, 'Permiso Sin Sueldo'), (4, 'Vacaciones'); ";
	if (mysql_query($desctiposol)){
		echo(" <td bgcolor='009900'> OK </td></tr>");
	}
	else
	{
		echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
	}	
	
	
	
echo("<tr><td>Creaci&oacute;n de la Tabla Ausencias en la Base de Datos </td>");
     // Estructura de la tabla `ausencias`
  $ausencias=" CREATE TABLE IF NOT EXISTS `ausencias` (
  `idausencia` int(11) NOT NULL AUTO_INCREMENT,  `idempleado` int(5) NOT NULL,
  `idsolicitud` int(5) NOT NULL,  `tipoausencia` int(2) NOT NULL, `estado` int(2) NOT NULL,
  `fechainicio` date NOT NULL,  `fechafin` date NOT NULL,  `horas` int(11) NOT NULL,
  `anotaciones` text NOT NULL,  PRIMARY KEY (`idausencia`) 
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1; ";
  
	if (mysql_query($ausencias)){
		echo(" <td bgcolor='009900'> OK </td></tr>");
	}
	else
	{
		echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
	}
	
	//TABLA DE T_TIPOAUSENCIAS
	echo("<tr><td>Creaci&oacute;n de la Tabla de Tipos Ausencias </td>");
	 //Esctructura tabla de t_tipoausencias
  $t_tipoausencuias= "CREATE TABLE IF NOT EXISTS `t_tipoausencia` (`idtipoausencia` int(11) NOT NULL AUTO_INCREMENT,
  		`desctipoausencia` text NOT NULL,  PRIMARY KEY (`idtipoausencia`) ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ; ";
	if (mysql_query($t_tipoausencuias)){
		echo(" <td bgcolor='009900'> OK </td></tr>");
	}
	else
	{
		echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
	}
	echo("<tr><td>Creaci&oacute;n de los diferentes Tipos del Asuencias </td>");
	//Volcar la base de datos para la tabla `t_estadosemp`
	  $desctipoaus= "INSERT INTO `t_tipoausencia` (`idtipoausencia`, `desctipoausencia`) VALUES
		(1, 'Ausencia Solicitada'), (2, 'Enfermedad'), (3, 'Asistencia Medica'),
		(4, 'Impuntualidad'), (5, 'Otros Motivos'); ";
	if (mysql_query($desctipoaus)){
		echo(" <td bgcolor='009900'> OK </td></tr>");
	}
	else
	{
		echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
	}
	
	//FIN DE T_TIPOAUSENCIAS
	
	echo("<tr><td>Creaci&oacute;n de la Tabla Estados de los Empleados </td>");
	 //Esctructura tabla de t_estados
  $t_estados= "CREATE TABLE IF NOT EXISTS `t_estadosemp` (`idestado` int(11) NOT NULL AUTO_INCREMENT,
  `descestado` text NOT NULL,  PRIMARY KEY (`idestado`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;";
	if (mysql_query($t_estados)){
		echo(" <td bgcolor='009900'> OK </td></tr>");
	}
	else
	{
		echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
	}
	echo("<tr><td>Creaci&oacute;n de los diferentes Estados del Empleado </td>");
	//Volcar la base de datos para la tabla `t_estadosemp`
	  $descestados= "INSERT INTO `t_estadosemp` (`idestado`, `descestado`) VALUES
		(NULL, 'Activo'), (NULL, 'Inactivo'), (NULL, 'Practicas'),
		(NULL, 'Maternidad'), (NULL, 'Permiso'), (NULL, 'Otro'), (NULL, 'Baja'); ";
	if (mysql_query($descestados)){
		echo(" <td bgcolor='009900'> OK </td></tr>");
	}
	else
	{
		echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
	}
	
	//ENTIDADES BANCARIAS
	echo("<tr><td>Creaci&oacute;n de la Tabla de Entidades Bancarias</td>");
	 //Esctructura tabla de t_entidades
  $t_entidades= " CREATE TABLE IF NOT EXISTS `t_entidades` (`IdEntidad` int(3) DEFAULT NULL,  
  `CodigoEntidad` varchar(4) DEFAULT NULL, `NombreEntidad` text ) ENGINE=MyISAM DEFAULT CHARSET=utf8; ";
	if (mysql_query($t_entidades)){
		echo(" <td bgcolor='009900'> OK </td></tr>");
	}
	else
	{
		echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
	}
	
	echo("<tr><td>Agregar los codigos y nombres de las Entidades Bancarias</td>");
//Volcar la base de datos para la tabla  t_entidades
  $descentidades= "INSERT INTO `t_entidades` (`IdEntidad`, `CodigoEntidad`, `NombreEntidad`) VALUES
		(2, '0073', 'OPENBANK'),
		(3, '0122', 'CITIBANK ESPAÑA'),
		(4, '0186', 'BANCO MEDIOLANUM'),
		(5, '0200', 'PRIVAT BANK DEGROOF'),
		(6, '0224', 'SANTANDER CONSUMER'),
		(7, '0049', 'BANCO SANTANDER'),
		(8, '0036', 'SANTANDER INVESTMENT'),
		(9, '0086', 'BANCO BANIF'),
		(10, '0061', 'BANCA MARCH '),
		(11, '0065', 'BARCLAYS BANK '),
		(12, '0072', 'BANCO PASTOR '),
		(13, '0075', 'BANCO POPULAR ESPAÑOL'),
		(14, '0003', 'BANCO DE DEPOSITOS'),
		(15, '0216', 'TARGOBANK'),
		(16, '0229', 'BANCO POPULAR E-COM'),
		(17, '0081', 'BANCO DE SABADELL '),
		(18, '0093', 'BANCO DE VALENCIA '),
		(19, '0128', 'BANKINTER '),
		(20, '0182', 'BBVA '),
		(21, '0057', 'BANCO DEPOSITARIO BBVA'),
		(22, '0058', 'BNP PARIBAS ESPAÑA'),
		(23, '0136', 'BANCO ARABE ESPAÑOL'),
		(24, '0196', 'WESTLB S.E.'),
		(25, '0219', 'BANQUE MAROCAINE C.E.'),
		(26, '0220', 'BANCO FINANTIA SONFINLOC'),
		(27, '0227', 'UNO-E BANK'),
		(28, '1460', 'CREDIT SUISSE S.E.'),
		(29, '1524', 'UBI BANCA INTERNATIONAL S.E.'),
		(30, '1534', 'KBL EUROPEAN PRIVATE B. S.E.'),
		(31, '0198', 'BANCO COOPERATIVO '),
		(32, '0094', 'RBC DEXIA INVESTOR SERV.'),
		(33, '0184', 'BANCO EUROPEO DE FINANZAS'),
		(34, '0188', 'BANCO ALCALÁ'),
		(35, '0235', 'BANCO PICHINCHA'),
		(36, '1490', 'SELF TRADE BANK'),
		(37, '1491', 'TRIODOS BANK, S.E.'),
		(38, '3001', 'C.R. ALMENDRALEJO'),
		(39, '3005', 'C.R. CENTRAL'),
		(40, '3007', 'C.R. GIJÓN'),
		(41, '3008', 'C.R. NAVARRA'),
		(42, '3009', 'C.R. EXTREMADURA'),
		(43, '3016', 'C.R. SALAMANCA'),
		(44, '3017', 'C.R. SORIA'),
		(45, '3018', 'C.R.REGIONAL '),
		(46, '3020', 'C.R. UTRERA'),
		(47, '3021', 'C.R. ARAGÓN'),
		(48, '3023', 'C.R. GRANADA'),
		(49, '3035', 'C. LABORAL POPULAR'),
		(50, '3045', 'C.R. ALTEA'),
		(51, '3059', 'C.R. ASTURIAS'),
		(52, '3060', 'C.R. BURGOS, FUENTE., SEG. Y CASTELL.'),
		(53, '3063', 'C.R. CÓRDOBA'),
		(54, '3067', 'C.R. JAÉN'),
		(55, '3070', 'C.R. GALEGA'),
		(56, '3076', 'CAJA SIETE'),
		(57, '3080', 'C.R. TERUEL'),
		(58, '3081', 'C.R. CASTILLA-LA MANCHA'),
		(59, '3082', 'RURALCAJA'),
		(60, '3085', 'C.R. ZAMORA'),
		(61, '3089', 'C.R.BAENA'),
		(62, '3095', 'C.R. S. ROQUE DE ALMENARA'),
		(63, '3096', 'C.R. L''ALCUDIA'),
		(64, '3098', 'C.R. NTRA SRA DEL ROSARIO'),
		(65, '3102', 'C.R. S. VICENTE VALL D''UXÓ'),
		(66, '3104', 'C.R. NTRA SRA DEL CAMPO'),
		(67, '3105', 'C.R. CALLOSA D''ENSARRIA'),
		(68, '3110', 'C.R. DE VILLAREAL'),
		(69, '3111', 'C.R. S. ISIDRO VALL D''UXÓ'),
		(70, '3112', 'C.R. BURRIANA'),
		(71, '3113', 'C.R. L''ALCORA'),
		(72, '3114', 'C.R. S. ISIDRO'),
		(73, '3115', 'C.R. ADAMUZ'),
		(74, '3116', 'C.R. MOTA DEL CUERVO'),
		(75, '3117', 'C.R. ALGEMESÍ'),
		(76, '3118', 'C.R. TORRENT'),
		(77, '3119', 'C.R. ALQUERIAS'),
		(78, '3121', 'C.R. CHESTE'),
		(79, '3127', 'C.R. CASAS IBÁÑEZ'),
		(80, '3130', 'C.R. S. JOSÉ DE ALMASSORA'),
		(81, '3134', 'C. R. NTRA SRA DE LA ESPERANZA'),
		(82, '3135', 'C.R. S. JOSÉ DE NULES'),
		(83, '3138', 'C.R. BETXI'),
		(84, '3144', 'C.R. VILLAMALEA'),
		(85, '3146', 'C. CRTO COOPERATIVO'),
		(86, '3150', 'C.R. ALBAL '),
		(87, '3152', 'C.R. VILLAR'),
		(88, '3157', 'C.R. LA JUNQUERA DE CHILCHES'),
		(89, '3159', 'C. POPULAR C. RURAL'),
		(90, '3160', 'C.R. S. JOSÉ DE VILLAVIEJA'),
		(91, '3162', 'C.R. BENICARLÓ'),
		(92, '3165', 'C.R. S. ISIDRO DE VILAFAMES'),
		(93, '3166', 'C.R. S. ISIDRO DE LES COVES '),
		(94, '3174', 'C.R. VINAROS'),
		(95, '3177', 'C.R. CANARIAS'),
		(96, '3179', 'C. R.ALGINET'),
		(97, '3187', 'C.R. DEL SUR'),
		(98, '3188', 'CREDIT VALENCIA'),
		(99, '3189', 'C. R. ARAGONESA Y PIRINEOS'),
		(100, '3190', 'GLOBALCAJA'),
		(101, '3191', 'NUEVA C. R. DE ARAGON, S.C.C.'),
		(102, '2000', 'CECA'),
		(103, '0125', 'BANCOFAR'),
		(104, '0487', 'BANCO MARE NOSTRUM'),
		(105, '0490', 'BANCA CIVICA'),
		(106, '2010', 'BANCO GRUPO CAJA TRES'),
		(107, '2017', 'BANCO GRUPO CAJA TRES'),
		(108, '2018', 'BANCA CIVICA'),
		(109, '2031', 'BANCO MARE NOSTRUM'),
		(110, '2037', 'BANKIA '),
		(111, '2042', 'BANKIA '),
		(112, '2043', 'BANCO MARE NOSTRUM'),
		(113, '2045', 'CAIXA ONTINYENT'),
		(114, '2048', 'LIBERBANK'),
		(115, '2051', 'BANCO MARE NOSTRUM'),
		(116, '2052', 'BANKIA '),
		(117, '2054', 'BANCA CIVICA'),
		(118, '2056', 'COLONYA'),
		(119, '2065', 'BANCA CIVICA'),
		(120, '2066', 'LIBERBANK'),
		(121, '2069', 'BANKIA '),
		(122, '2080', 'NCG BANCO'),
		(123, '2081', 'BANCO MARE NOSTRUM'),
		(124, '2086', 'BANCO GRUPO CAJA TRES'),
		(125, '2090', 'BANCO CAM'),
		(126, '2096', 'BANCO CEISS'),
		(127, '2099', 'LIBERBANK'),
		(128, '2103', 'UNICAJA BANCO'),
		(129, '2104', 'BANCO CEISS'),
		(130, '2105', 'CAJA CASTILLA LA MANCHA'),
		(131, '2106', 'BANCA CIVICA'),
		(132, '2107', 'UNNIM BANC'),
		(133, '2013', 'CATALUNYA BANC'),
		(134, '2038', 'BANKIA '),
		(135, '0099', 'BANKIA BANCA PRIVADA'),
		(136, '0232', 'BANCO INVERSIS'),
		(137, '2085', 'IBERCAJA BANCO '),
		(138, '2095', 'KUTXABANK'),
		(139, '0046', 'BANCO GALLEGO'),
		(140, '0059', 'BANCO DE MADRID'),
		(141, '0237', 'BBK BANK CAJASUR'),
		(142, '2097', 'KUTXABANK'),
		(143, '2101', 'KUTXABANK'),
		(144, '2100', 'CAIXABANK '),
		(145, '0133', 'NUEVO MICROBANK'),
		(146, '3058', 'CAJAMAR'),
		(147, '0031', 'BANCO ETCHEVERRIA'),
		(148, '0078', 'BANCA PUEYO'),
		(149, '0138', 'BANKOA'),
		(150, '0160', 'THE BANK OF TOKYO'),
		(151, '0234', 'BANCO CAMINOS'),
		(152, '1465', 'ING DIRECT'),
		(153, '3025', 'C. DE INGENIEROS'),
		(154, '3029', 'C. CRÉDITO DE PETREL'),
		(155, '3084', 'IPAR KUTXA RURAL'),
		(156, '3123', 'C. R. TURIS'),
		(157, '3137', 'C.R. CASINOS'),
		(158, '3140', 'C.R. GUISSONA'),
		(159, '3183', 'C. DE ARQUITECTOS'),
		(160, '3186', 'C.R. ALBALAT'); ";
	if (mysql_query($descentidades)){
		echo(" <td bgcolor='009900'> OK </td></tr>");
	}
	else
	{
		echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
	}
	
	
	//FIN DE ENTIDADES BANCARIAS
	
	
	
echo("<tr><td>Creaci&oacute;n de la Tabla Contratos en la Base de Datos </td>");
  //Esctructura tabla de contratos
  $contratos= "CREATE TABLE IF NOT EXISTS `contratos` (
		  `idcontrato` int(5) NOT NULL AUTO_INCREMENT,
		  `idempleado` int(5) NOT NULL,
		  `tipocontrato` int(2) NOT NULL,
		  `motivofin` int(2) NOT NULL,
		  `fechainicio` date NOT NULL,
		  `fechafin` date NOT NULL,
		  `idcuenta` int(11) NOT NULL,
		  `estado` int(2) NOT NULL,
		  `fechafirma` date NOT NULL,
		  `fechaexp` date NOT NULL,
		  `anotacion` text NOT NULL,
		  `entidad` varchar(4) NOT NULL,
		  `oficina` varchar(4) NOT NULL,
		  `dc` varchar(2) NOT NULL,
		  `ncuenta` text NOT NULL,
		  PRIMARY KEY (`idcontrato`)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ; ";
	if (mysql_query($contratos)){
		echo(" <td bgcolor='009900'> OK </td></tr>");
	}
	else
	{
		echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
	}
	
	//TIPOS DE CONTRATOS
	echo("<tr><td>Creaci&oacute;n de la Tabla Tipos de Contratos en la Base de Datos </td>");
     //Estuctura de la Tipos de Contratos
     	$t_tipocontrato="CREATE TABLE IF NOT EXISTS `t_tipocontrato` (
  		`idtipocontrato` int(11) NOT NULL AUTO_INCREMENT, `desctipocontrato` text NOT NULL,
 		 PRIMARY KEY (`idtipocontrato`) ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ; ";
		if (mysql_query($t_tipocontrato)){
			echo(" <td bgcolor='009900'> OK </td></tr>");
		}
		else
		{
			echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
		}
		echo("<tr><td>Creaci&oacute;n de los diferentes Tipos de Contratos en la Base de Datos </td>");
		//DAtos de la Tipos de Contratos
     	$desctipocontrato="INSERT INTO `t_tipocontrato` (`idtipocontrato`, `desctipocontrato`) VALUES
		(1, 'Otros Tipos'), (2, 'Indefinido'), (3, 'Indefinido de fijos-discontinuos'),
		(4, 'Trabajadores con Discapacidad'), (5, 'Formativo'), (6, 'De Relevo'),
		(7, 'Fomento De La Contratacion Indefinida'), (8, 'Practicas'), (9, 'Insercion'),
		(10, 'Trabajo de grupo'), (11, 'Trabajo a domicilio'), (12, 'Duracion Determinada'),
		(13, 'Sustitucion Anticipacion Jubilacion'); ";
		if (mysql_query($desctipocontrato)){
			echo(" <td bgcolor='009900'> OK </td></tr>");
		}
		else
		{
			echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
		}
		//FIN TIPOS DE CONTRATOS
	
	//ESTADOS DE LAS AUSENCIAS
	echo("<tr><td>Creaci&oacute;n de la Tabla Estados de Ausencias en la Base de Datos </td>");
     //Estuctura de la Tipos de Contratos
     	$t_estadosaus="CREATE TABLE IF NOT EXISTS `t_estadosaus` (`idestado` int(11) NOT NULL AUTO_INCREMENT,
  		`descestado` text NOT NULL,  PRIMARY KEY (`idestado`) ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ; ";
		if (mysql_query($t_estadosaus)){
			echo(" <td bgcolor='009900'> OK </td></tr>");
		}
		else
		{
			echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
		}
		echo("<tr><td>Creaci&oacute;n de los diferentes Estados de Ausencias en la Base de Datos </td>");
		//DAtos de la Tipos de Contratos
     	$descestados="INSERT INTO `t_estadosaus` (`idestado`, `descestado`) VALUES 
		(1, 'Incumplimiento'), (2, 'Pendiente'), (3, 'Justificada'), (4, 'Injustificada');  ";
		if (mysql_query($descestados)){
			echo(" <td bgcolor='009900'> OK </td></tr>");
		}
		else
		{
			echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
		}
		//FIN TIPOS DE AUSENCIAS	
	
	//ESTADOS DE LAS PROVINCIAS
	echo("<tr><td>Creaci&oacute;n de la Tabla de Provincias en la Base de Datos </td>");
     //Estuctura de la Tipos de Contratos
     	$t_provincias="CREATE TABLE IF NOT EXISTS `t_provincias` ( `idprovincia` int(3) NOT NULL AUTO_INCREMENT,
  		`nombreprovincia` text,  KEY `idprovincia` (`idprovincia`) ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ; ";
		if (mysql_query($t_provincias)){
			echo(" <td bgcolor='009900'> OK </td></tr>");
		}
		else
		{
			echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
		}
		echo("<tr><td>Creaci&oacute;n de los diferentes Provincias </td>");
		//DAtos de las Provincias
     	$descpronvicias="INSERT INTO `t_provincias` (`idprovincia`, `nombreprovincia`) VALUES
			(1, 'Alava'),
			(2, 'Albacete'),
			(3, 'Alicante'),
			(4, 'Almería'),
			(5, 'Asturias'),
			(6, 'Avila'),
			(7, 'Badajoz'),
			(8, 'Islas Baleares'),
			(9, 'Barcelona'),
			(10, 'Burgos'),
			(11, 'Cáceres'),
			(12, 'Cádiz'),
			(13, 'Cantabria'),
			(14, 'Castellón'),
			(15, 'Ciudad Real'),
			(16, 'Córdoba'),
			(17, 'A Coruña'),
			(18, 'Cuenca'),
			(19, 'Girona'),
			(20, 'Granada'),
			(21, 'Guadalajara'),
			(22, 'Guipúzcoa'),
			(23, 'Huelva'),
			(24, 'Huesca'),
			(25, 'Jaén'),
			(26, 'León'),
			(27, 'Lleida'),
			(28, 'Lugo'),
			(29, 'Madrid'),
			(30, 'Málaga'),
			(31, 'Murcia'),
			(32, 'Navarra'),
			(33, 'Ourense'),
			(34, 'Palencia'),
			(35, 'Las Palmas'),
			(36, 'Pontevedra'),
			(37, 'La Rioja'),
			(38, 'Salamanca'),
			(39, 'S. C. de Tenerife'),
			(40, 'Segovia'),
			(41, 'Sevilla'),
			(42, 'Soria'),
			(43, 'Tarragona'),
			(44, 'Teruel'),
			(45, 'Toledo'),
			(46, 'Valencia'),
			(47, 'Valladolid'),
			(48, 'Vizcaya'),
			(49, 'Zamora'),
			(50, 'Zaragoza'),
			(51, 'Ceuta'),
			(52, 'Melilla');  ";
		if (mysql_query($descpronvicias)){
			echo(" <td bgcolor='009900'> OK </td></tr>");
		}
		else
		{
			echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
		}
		//FIN DE LISTADO DE  PROVINCIAS
	
	
	//ESTADOS DE LAS CONTRATOS
	echo("<tr><td>Creaci&oacute;n de la Tabla Estados de Contratos en la Base de Datos </td>");
     //Estuctura de la Estados de Contratos
     	$t_estadoscont="CREATE TABLE IF NOT EXISTS `t_estadoscont` (`idestado` int(11) NOT NULL AUTO_INCREMENT,
	  `descestado` text NOT NULL,  PRIMARY KEY (`idestado`) ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ; ";
		if (mysql_query($t_estadoscont)){
			echo(" <td bgcolor='009900'> OK </td></tr>");
		}
		else
		{
			echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
		}
		echo("<tr><td>Creaci&oacute;n de los diferentes Estados de Contratos en la Base de Datos </td>");
		//DAtos de la Estados de Contratos
     	$descestados="INSERT INTO `t_estadoscont` (`idestado`, `descestado`) VALUES (1, 'Finalizado'),
		(2, 'Iniciado/Validado'), (3, 'Pendiente Impresion'), (4, 'Pendiente Firma');	";
		if (mysql_query($descestados)){
			echo(" <td bgcolor='009900'> OK </td></tr>");
		}
		else
		{
			echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
		}
		//FIN ESTADOS DE LAS CONTRATOS	
	
		//MOTIVOS FIN DE LAS CONTRATOS
	echo("<tr><td>Creaci&oacute;n de la Tabla Motivos Fin de Contratos en la Base de Datos </td>");
     //Estuctura de la MOTIVOS de Contratos
     	$t_motivosfin="CREATE TABLE IF NOT EXISTS `t_fincont` (`idmotivofin` int(11) NOT NULL AUTO_INCREMENT, `descmotivo` text NOT NULL,
  		PRIMARY KEY (`idmotivofin`) ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ; ";
		if (mysql_query($t_motivosfin)){
			echo(" <td bgcolor='009900'> OK </td></tr>");
		}
		else
		{
			echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
		}
		echo("<tr><td>Creaci&oacute;n de los diferentes Motivos Fin de Contratos en la Base de Datos </td>");
		//DAtos de la MOTIVOS de Contratos
     	$descmotivos="INSERT INTO `t_fincont` (`idmotivofin`, `descmotivo`) VALUES
		(1, 'Modificación'), (2, 'Suspensión'), (3, 'Extinción'); ";
		if (mysql_query($descmotivos)){
			echo(" <td bgcolor='009900'> OK </td></tr>");
		}
		else
		{
			echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
		}
		//FIN MOTIVOS FIN DE LAS CONTRATOS	
	
	//CREAR TABLA TIPOS DE PERMISOS
	echo("<tr><td>Creaci&oacute;n de la Tabla Tipos de Permisos en la Base de Datos </td>");
     //Estuctura de la tabla miembros
  $tpermisos=" CREATE TABLE IF NOT EXISTS `t_tipoperm` (
  `idtipo` int(11) NOT NULL AUTO_INCREMENT,  `descpermiso` text NOT NULL,  `infopermiso` text NOT NULL,
  PRIMARY KEY (`idtipo`) ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;  ";   
	if (mysql_query($tpermisos)){
		echo(" <td bgcolor='009900'> OK </td></tr>");
	}
	else
	{
		echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
	}
	//FIN TABLA TIPOS DE PERMISOS	
	
  //VOLCAR DIFERENTES TIPOS DE PERMISOS
	echo("<tr><td>Creaci&oacute;n de los diferentes Tipos de Permisos en la Base de Datos </td>");
     //Estuctura de la tabla miembros
  $datostperm=" INSERT INTO `t_tipoperm` (`idtipo`, `descpermiso`, `infopermiso`) VALUES 
		(1, 'TABBEMP', 'Menu Hijo de Busqueda de Empleado'),
		(2, 'TABBNOM', 'Menu Hijo de Busqueda de Nominas'),
		(3, 'TABBSOL', 'Menu Hijo de Busqueda de Solicitudes'),
		(4, 'TABBAUS', 'Menu Hijo de Busqueda de Ausencias'),
		(5, 'TABNEMP', 'Menu Hijo de Nuevo de Empleado'),
		(6, 'TABNNOM', 'Menu Hijo de Nueva de Nominas'),
		(7, 'TABSTATS', 'Menu Hijo Generar Estadisticas'),
		(8, 'TABUSERA', 'Menu Hijo Gestion Usuarios y Permisos'),
		(9, 'TABINST', 'Menu Hijo Instalar'),
		(10, 'TABNSOL', 'Menu Hijo de Nueva de Solicitud'),
		(11, 'TABNAUS', 'Menu Hijo de Nueva Ausencia'),
		(12, 'TABNCON', 'Menu Hijo de Nuevo Contrato'),
		(13, 'TABBCONT', 'Menu Hijo de Busqueda de Contratos'),
		(14, 'BTNDELEMP', 'Boton Eliminar Empleado'),
		(15, 'BTNDELNOM', 'Boton Eliminar Nomina'),
		(16, 'BTNMODEMP', 'Botón Guardar Cambios del Empleado'),
		(17, 'BTNIMPEMP', 'Boton Imprimir Datos Empleado'),
		(18, 'BTNNEWNOM', 'Boton Crear Nueva Nomina'),
		(19, 'BTNIMPNOM', 'Boton Imprimir Listado Nominas'),
		(20, 'BTNXLSNOM', 'Boton Exportar Listado Nominas'),
		(21, 'MENUGESTIONCRM', 'Menu Principal de Gestion CRM'),
		(22, 'MENUCONSULTAS', 'Menu Principal de Consultas'),
		(23, 'MENUCREACION', 'Menu Principal de Creacion'),
		(24, 'MENUBUSQUEDA', 'Menu Principal de Busqueda'),
		(25, 'TABADMINEMPS', 'Menu Hijo de Gestión de Estados Empleado'),
		(26, 'TABADMINTSOL', 'Menu Hijo de Gestión de Tipo Solicitudes'),
		(27, 'TABADMINTAUS', 'Menu Hijo de Gestión de Tipo Ausencia'),
		(28, 'TABADMINAUSS', 'Menu Hijo de Gestión de Estados Ausencias'),
		(29, 'TABADMINTCONT', 'Menu Hijo de Gestión de Tipo Contrato'),
		(30, 'TABADMINCONTS', 'Menu Hijo de Gestión de Estados Contratos'),
		(31, 'TABADMINCONTFIN', 'Menu Hijo de Gestión de Motivo Fin Contrato'),
		(32, 'BTNNEWSOL', 'Boton Nueva Solicitud'),
		(33, 'BTNNEWAUS', 'Boton Nueva Ausencia'),
		(34, 'BTNNEWCONT', 'Boton Nuevo Ausencia'),
		(35, 'TABUSERAPERM', 'Menu Hijo de la Gestion de Permisos'),
		(36, 'BTNMODAUS', 'Boton Guardar Cambios de la Ausencia'),
		(37, 'BTNMODCONT', 'Boton Guardar Cambios del Contrato'),
		(38, 'BTNMODSOL', 'Boton Guardar Cambios de la Solicitud'),
		(39, 'TABRUNREPORTE', 'Menu Hijo de Ejecutar Reporte'),
		(40, 'TABADMINNOMCON', 'Menu Hijo de Gestión de Conceptos de la Nomina'),
		(41, 'BTNMODNOM', 'Botón Guardar Cambios en la Nomina'),
		(42, 'BTNADDITEMNOM', 'Botón Agregar Concepto de la Nomina'),
		(43, 'BTNDELITEMNOM', 'Botón Eliminar Concepto de la Nomina'),
		(44, 'EMPTABHIST', 'Muestra el Tab Historico de Cambios de la ficha de empleados'); ";   
	if (mysql_query($datostperm)){
		echo(" <td bgcolor='009900'> OK </td></tr>");
	}
	else
	{
		echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
	}
	//FIN DIFERENTES TIPOS DE PERMISOS	
	
		//CREAR TABLA PERMISOS
		echo("<tr><td>Creaci&oacute;n de la Tabla Permisos en la Base de Datos </td>");
     //Estuctura de la tabla miembros
	  $sqlpermtabla=" 
	  CREATE TABLE IF NOT EXISTS `permisos` (  `idpermiso` int(11) NOT NULL AUTO_INCREMENT,
  	`idmiembro` int(11) NOT NULL,  `idtipo` int(11) NOT NULL,  PRIMARY KEY (`idpermiso`) ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;	   ";   
		if (mysql_query($sqlpermtabla)){
			echo(" <td bgcolor='009900'> OK </td></tr>");
		}
		else
		{
			echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
		}
		//FIN TABLA PERMISOS
		
		//ASIGNACIONE DE PERMISOS AL ADMINISTRADOR
		echo("<tr><td>Asignacion de Permisos al usuario Administrador </td>");
     //Estuctura de la tabla miembros
	  $spermisosadmin=" INSERT INTO `permisos` (`idpermiso`, `idmiembro`, `idtipo`) VALUES
		(1, 1, 1), (2, 1, 2), (3, 1, 3), (4, 1, 4), (5, 1, 5), (6, 1, 6), (7, 1, 7),
		(8, 1, 8), (9, 1, 9), (10, 1, 10), (11, 1, 11), (12, 1, 12), (13, 1, 13), (14, 1, 14),
		(15, 1, 15), (16, 1, 16), (17, 1, 17), (18, 1, 18), (19, 1, 19), (20, 1, 20), (21, 1, 21),
		(22, 1, 22), (23, 1, 23), (24, 1, 24), (25, 1, 25), (26, 1, 26), (27, 1, 27),
		(28, 1, 28), (29, 1, 29), (30, 1, 30), (31, 1, 31), (32, 1, 32), (33, 1, 33),(34, 1, 34), 
		(35, 1, 35), (36, 1, 36), (37, 1, 37), (38, 1, 38), (39, 1, 39) , (40, 1, 40) , (41, 1, 41)
		, (42, 1, 42) , (43, 1, 43), (44, 1, 44); ";   
		if (mysql_query($spermisosadmin)){
			echo(" <td bgcolor='009900'> OK </td></tr>");
		}
		else
		{
			echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
		}
		//FIN TABLA PERMISOS
		
	//CREAR TABLA MIEMBROS
echo("<tr><td>Creaci&oacute;n de la Tabla Miembros en la Base de Datos </td>");
     //Estuctura de la tabla miembros
	  $miembros="CREATE TABLE IF NOT EXISTS `miembros` ( `idusario` int(11) NOT NULL AUTO_INCREMENT,
	  `usuario` text NOT NULL, `userpass` text NOT NULL,  `anotaciones` text NOT NULL,
	  PRIMARY KEY (`idusario`) ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;   ";   
	if (mysql_query($miembros)){
		echo(" <td bgcolor='009900'> OK </td></tr>");
	}
	else
	{
		echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
	}
	
	echo("<tr><td>Creaci&oacute;n de Usuario Administrador en la Tabla Miembros </td>");
	 //insertar en la tabla miembros el usuario administrador   
	   $usuarioadm="INSERT INTO `miembros` (`idusario`, `usuario`, `userpass`, `anotaciones`) VALUES
	   (1, '$useradmin', '$passadmin', 'Usuario adminsitrativo con acceso total') ; ";
	if (mysql_query($usuarioadm)){
		echo(" <td bgcolor='009900'> OK </td></tr>");
	}
	else
	{
		echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
	}

	
	echo("<tr><td>Creaci&oacute;n de la Tabla Historico de Cambios </td>");
	 //Esctructura tabla de la tabla historico de cambios
  $t_hcambios= "CREATE TABLE IF NOT EXISTS `historicocambios` (`idhistcambio` int(11) NOT NULL AUTO_INCREMENT,
  `usuariocambio` text NOT NULL,  `fechahora` datetime NOT NULL,  `desccambio` text NOT NULL,
  `tabla` text NOT NULL,  `idempleado` int(11) NOT NULL,  `idregistro` text NOT NULL,
  PRIMARY KEY (`idhistcambio`) ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT= 1 ; ";
	if (mysql_query($t_hcambios)){
		echo(" <td bgcolor='009900'> OK </td></tr>");
	}
	else
	{
		echo(" <td bgcolor='CC0000'> FALLO </td></tr>");
	}

    //crear archivo de conexion a la bbdd si no existe
    $url = 'conectarbbdd.php';
    echo('<center>');
	$datos = "<?php
	mysql_connect('$host', '$user', '$pass') or
    die('Could not connect: ' . mysql_error());
	mysql_select_db('$bbdd');
	?>";

    echo("<tr><td>Creaci&oacute;n Arhivo de Conexi&oacute; autom&aacute;tica (conetarbbdd.php): </td>");
    if (!$archivo = fopen($url, 'c')) {
	echo(" <td bgcolor='CC0000'> FALLO </td></tr><table>");
         echo "<div id='error'><img src='imagenes/errorbd.png'> 
         No se ha podido crear el archivo ($url). Comprueba que no existe o que tienes permiso de escritura en el directorio </div>";
         exit;
    }
   else{
		echo(" <td bgcolor='009900'> OK </td></tr>");
	}
    // Si el archivo se ha abierto escribir los datos
    echo("<tr><td>Escritura de los paremetros de Conexi&oacute; autom&aacute;tica (conetarbbdd.php): </td>");
    if (fwrite($archivo, $datos) === FALSE) {
	echo(" <td bgcolor='CC0000'> FALLO </td></tr><table>");
        echo "<div id='error'><img src='imagenes/errorbd.png'> 
        No se ha podido escribir en el archivo($url). Comprueba que tienes permiso de escritura en el directorio </div>";
        exit;
    }
   else{
	echo(" <td bgcolor='009900'> OK </td></tr>");
   }
     fclose($archivo); 
     
    //crear archivo de con los datos de la empresa no existe
    $url = 'funciones/empresa.php';
    echo('<center>');
	$datos = "<?php
	\$nombreemp$varvacia='$nombreemp';
	\$cifemp$varvacia='$cifemp';
	?>";

    echo("<tr><td>Creaci&oacute;n Arhivo de con Datos de le Empresa: </td>");
    if (!$archivo = fopen($url, 'c')) {
	echo(" <td bgcolor='CC0000'> FALLO </td></tr><table>");
         echo "<div id='error'><img src='imagenes/errorbd.png'> 
         No se ha podido crear el archivo ($url). Comprueba que no existe o que tienes permiso de escritura en el directorio </div>";
         exit;
    }
   else{
		echo(" <td bgcolor='009900'> OK </td></tr>");
	}     
    // Si el archivo se ha abierto escribir los datos
    echo("<tr><td>Escritura  de los  Datos de le Empresa: </td>");
    if (fwrite($archivo, $datos) === FALSE) {
	echo(" <td bgcolor='CC0000'> FALLO </td></tr><table>");
        echo "<div id='error'><img src='imagenes/errorbd.png'> 
        No se ha podido escribir en el archivo($url). Comprueba que tienes permiso de escritura en el directorio </div>";
        exit;
    }
   else{
	echo(" <td bgcolor='009900'> OK </td></tr></table>");
   }
     fclose($archivo); 
    echo('<br> <div id="noerror">INSTALACIÓN FINALIZADA. COMPRUEBE LA LISTA DE TAREAS </div> </center>');
     
}
  ?>

</body>
</html>
