<?php
	require_once('login/comprobarweb.php');
?>
<html>
<head>
<title> Sitema de Empleados y Nominas Online </title>
<link rel=StyleSheet href="estilos.css" TYPE="text/css">
<link rel=StyleSheet href="menu/css/nav.css" TYPE="text/css">
</head>

<body>
<?php
	include("menu/menu.php");
	include("funciones/crear_dropdown.php");
?>
 <center>

<h2><img src="./imagenes/buscar.png">   Busqueda de Nominas: </h2> <br>
 
<form method="post" action="<?php echo $PHP_SELF;?>">
<table>
<tr>
<td> <label> IdNomina </label> </td>
<td> <INPUT type="text" name="idnom" size="20" maxlength="20" value="<?php echo $_POST['idnom']?>"> </td>
<td><label> IdEmpleado </label></td>
<td><INPUT type="text" name="idemplea" size="20" maxlength="20" value="<?php echo $_POST['idemplea']?>"></td>
<td><label> DNI </label></td>
<td><INPUT type="text" name="dnie" size="20" maxlength="20" value="<?php echo $_POST['dnie']?>"></td>
</tr>
<tr>
<td><label> A&ntilde;o: </label></td>
<td><INPUT type="text" name="anioa" size="20" maxlength="20" value="<?php echo $_POST['anioa']?>"> </td>

<?php
printf("<td><label> Mes: </label></td> <td>");
    //nombre del dropdown
    $name = 'mes';
    //opciones que tendra el dropdown
	 $options = array( '', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' );
	 //opcion seleccionada en el dropdown
	 $selected = $_POST['mes'];
	 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
	 echo crear_dropdown( $name, $options, $selected );
	 printf("</td>");
?>
<td><label> Cantidad Total: </label></td>
<td>
	<select name="tipobusc">
  		<option value=">">mayor que</option>
  		<option value="<">menor que</option>
  </select>
 <INPUT type="text" name="canteuros" value="<?php echo $_POST['canteuros']?>" size="4"></td>
 <td> <label>&euro; </label></td>
</tr>
<tr>
<td> <label> Fecha Pago: </label> </td>
<td> <INPUT type="text" name="fechapago" size="20" maxlength="20" value="<?php echo $_POST['fechapago']?>"> </td>
<?php
printf("<td><label> Estado Nomina: </label></td> <td>");
		//CARGAR LOS ESTADOS DE LAS NOMINAS
		$arrayestados = array();
		include("conectarbbdd.php");
		$arrayestados[] = '&nbsp';
		$resulestados = mysql_query("SELECT * FROM  `t_estadosnom`");
		while ($filaemp = mysql_fetch_array($resulestados, MYSQL_NUM)) {
		 		$arrayestados[] = $filaemp[1];
		}
    //nombre del dropdown
    $name = 'estadonom';
	 //opcion seleccionada en el dropdown
	 $selected = $_POST['estadonom'];
	 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
	 echo crear_dropdown( $name, $arrayestados, $selected );
	 printf("</td>");
?>
<?php
printf("<td><label> Tipo Nomina: </label></td> <td>");
		//CARGAR LOS TIPOS DE LAS NOMINAS
		$arraytipos = array();
		include("conectarbbdd.php");
		$arraytipos[] = '&nbsp';
		$resultipos = mysql_query("SELECT * FROM  `t_tiponom`");
		while ($filatipos = mysql_fetch_array($resultipos, MYSQL_NUM)) {
	    		$arraytipos[] = $filatipos[1];
		}
    //nombre del dropdown
    $name = 'tiponom';
	 //opcion seleccionada en el dropdown
	 $selected = $_POST['tiponom'];
	 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
	 echo crear_dropdown( $name, $arraytipos, $selected );
	 printf("</td>");
?>

</tr>
<tr><td></td></tr>
<tr>
<td colspan="6"  align="center">
<INPUT type="submit" name="btnbuscar" value="Buscar">
<INPUT type="submit" name="botonlimpiar" value="Limpiar"> 
 </td>
</tr>

</table>
</form>

 </center>
 <?php
 if(isset($_POST["btnbuscar"])) 
{ 	
	$idnom=$_REQUEST['idnom'];
	$idemplea=$_REQUEST['idemplea'];
	$dnie=$_REQUEST['dnie'];
	$anioa=$_REQUEST['anioa'];
	$mes=$_REQUEST['mes'];
	$tipobusc=$_REQUEST['tipobusc'];
	$canteuros=$_REQUEST['canteuros'];
	$fechapago=$_REQUEST['fechapago'];
	$estadonom=$_REQUEST['estadonom'];
	$tiponom=$_REQUEST['tiponom'];
	//SABER QUE VARIABLES ESTAN VACIAS
	include("conectarbbdd.php");
	echo('<form action="exportar/export_buscn.php" name="fexportar" method="POST">');
	$total=0; //contador para poner el and en el select
	if (!empty($idnom)) {
		echo('<input type="hidden" name="e_idnom" value="'.$idnom.'">');
    $sqlidnom=" `idnomina` LIKE  '$idnom' ";
    $total=1;
	}
	if (!empty($idemplea)) {
		echo('<input type="hidden" name="e_idemplea" value="'.$idemplea.'">');
		if ($total==0){
		 $sqlidemp=" `idemp` LIKE  '$idemplea' "; $total=1;}
    else {
    	 $sqlidemp=" AND `idemp` LIKE  '$idemplea'";}
	}
	if (!empty($fechapago)) {
		echo('<input type="hidden" name="e_fechapago" value="'.$fechapago.'">');
		if ($total==0){
		 $sqlfechapago=" `fechapago` LIKE  '$fechapago' "; $total=1;}
    else {
    	 $sqlfechapago=" AND `fechapago` LIKE  '$fechapago'";}
	}
	
		if (!empty($estadonom)) {
		echo('<input type="hidden" name="e_estadonom" value="'.$estadonom.'">');
		$estadonom=$estadonom-1;
		if ($total==0){
		 $sqlestadonom=" `estadonom` LIKE  '$estadonom' "; $total=1;}
    else {
    	 $sqlestadonom=" AND `estadonom` LIKE  '$estadonom'";}
	}
	
	if (!empty($tiponom)) {
		echo('<input type="hidden" name="e_tiponom" value="'.$tiponom.'">');
		$tiponom=$tiponom-1;
		if ($total==0){
		 $sqltiponom=" `tiponom` LIKE  '$tiponom' "; $total=1;}
    else {
    	 $sqltiponom=" AND `tiponom` LIKE  '$tiponom'";}
	}
	
	if (!empty($mes)) {
		echo('<input type="hidden" name="e_mes" value="'.$mes.'">');
		$opciones = array( '', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' );
		$mes=$opciones[$mes];
		if ($total==0){
		 $sqlmes=" `mes` LIKE  '%$mes%' "; $total=1;}
    else {
    	 $sqlmes=" AND `mes` LIKE  '%$mes%'";}
	}

	if (!empty($anioa)) {
		echo('<input type="hidden" name="e_anioa" value="'.$anioa.'">');
		if ($total==0){
		 $sqlanioa=" `urtea` LIKE  '$anioa' "; $total=1;}
    else {
    	 $sqlanioa=" AND `urtea` LIKE  '$anioa'";}
	}
	
	if (!empty($dnie)) {
		echo('<input type="hidden" name="e_dnie" value="'.$dnie.'">');
		$result = mysql_query("SELECT * FROM  `empleados` WHERE  `dni` LIKE  '$dnie' LIMIT 0 , 30");
		$numerofilas=mysql_num_rows($result);
		while ($fila = mysql_fetch_array($result, MYSQL_NUM)) {
			$idemplega=$fila[0];
		}
		if ($total==0){
		 $sqldnie=" `idemp` LIKE  '$idemplega' "; $total=1;}
    else {
    	 $sqldnie=" AND `idemp` LIKE  '$idemplega'";}
	}
	if (!empty($canteuros)) {
		echo('<input type="hidden" name="e_canteuros" value="'.$canteuros.'">');
		echo('<input type="hidden" name="e_tipobusc" value="'.$tipobusc.'">');
		if ($total==0){
		 $sqltotal=" `total` $tipobusc $canteuros "; $total=1;}
    else {
    	 $sqltotal=" AND `total` $tipobusc $canteuros ";}
	}
	$resultquery = "SELECT * FROM  `nominas` WHERE  $sqlidnom $sqlidemp  $sqlanioa $sqldnie $sqlfechapago $sqlestadonom $sqltiponom $sqlmes $sqltotal";
	//echo ($resultquery); 
	if ($total==0){
	echo ("<center><label id='error'> <img src='imagenes/cuidado.png'> No has introducido ningun criterio para la busqueda </label></center>");
	}
	else
	{
		echo ("<hr> <center><br> LISTADO DE LOS RESULTADOS DE LA BUSQUEDA");
		echo ('<br><br><table border="0" cellspacing="1" cellpadding="4" width="100%" id="tablahover">');
		echo("<tr><th></th><th>IDNomina</th>");
		echo("<th>IdEmpleado</th>");
		echo("<th>Mes</th>");
		echo("<th>A&ntilde;o</th>");
		echo("<th>Fecha Pago</th>");
		echo("<th>Estado Nomina</th>");
		echo("<th>Tipo Nomina</th>");
		echo("<th>H.Contrato</th>");
		echo("<th>Total</th></tr>");
		$result=mysql_query($resultquery);
		//CARGAR LOS ESTADOS DE LAS NOMINAS
		$arrayestados = array();
		$resulestados = mysql_query("SELECT * FROM  `t_estadosnom`");
		while ($filaemp = mysql_fetch_array($resulestados, MYSQL_NUM)) {
		 		$arrayestados[] = $filaemp[1];
		}
		//CARGAR LOS TIPOS DE LAS NOMINAS
		$arraytipos = array();
		$resultipos = mysql_query("SELECT * FROM  `t_tiponom`");
		while ($filatipos = mysql_fetch_array($resultipos, MYSQL_NUM)) {
	    		$arraytipos[] = $filatipos[1];
		}
		while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
			printf ("<tr><th><a href='lnomina1.php?idnomina=%s' target='empleado%s'><img src='./imagenes/buscar2.png'></a></th>", $row[0], $row[0]);
			printf("<td>%s</td>", $row[0]);
			printf("<td>%s</td>", $row[1]);
			printf("<td>%s</td> ", $row[2]);
			printf("<td>%s</td>", $row[3]);
			printf("<td>%s</td> ", $row[6]);
			printf("<td>%s</td> ", $arrayestados[$row[7]]);
			printf("<td>%s</td> ", $arraytipos[$row[8]]);
			//buscar si tiene horas de contrato
			$sqlnomconp = "SELECT * FROM  `conceptosnom` WHERE  `IdNomina` = '$row[0]' AND  `IdConcepto` = 1 ";
			$resulsql=mysql_query($sqlnomconp);
			$existefilanom=0;
			while ($filanom = mysql_fetch_array($resulsql, MYSQL_NUM)) {
					printf("<td>%s</td>", $filanom[3]);
					$existefilanom=1;
			}
			if ($existefilanom == '0'){
				printf("<td>0</td>");
			}
			printf("<td>%s</td></tr>", $row[4]);
		}
		echo("</table></center>");
		mysql_close();
		echo('<br><center><INPUT type="submit" name="botonexportar" value="Exportar En Excel"></center></form> ');
	}
}

if(isset($_POST["botonlimpiar"])) 
{ 
	echo ('<meta http-equiv="Refresh" content="0; URL=buscarnom.php">');
}
?>

</body>
</html>
