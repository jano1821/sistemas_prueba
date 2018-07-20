<?php
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=ExportarExcel.xls");
?>
<html>
<head>
<title> Sitema de Empleados y Nominas Online </title>
</head>

<body>

<?php
	$idnom=$_REQUEST['e_idnom'];
	$idemplea=$_REQUEST['e_idemplea'];
	$dnie=$_REQUEST['e_dnie'];
	$anioa=$_REQUEST['e_anioa'];
	$mes=$_REQUEST['e_mes'];
	$tipobusc=$_REQUEST['e_tipobusc'];
	$canteuros=$_REQUEST['e_canteuros'];
	$fechapago=$_REQUEST['e_fechapago'];
	$estadonom=$_REQUEST['e_estadonom'];
	$tiponom=$_REQUEST['e_tiponom'];
	
	//SABER QUE VARIABLES ESTAN VACIAS
	include("../conectarbbdd.php");
	$total=0; //contador para poner el and en el select
	if (!empty($idnom)) {
    $sqlidnom=" `idnomina` LIKE  '$idnom' ";
    $total=1;
	}
	if (!empty($idemplea)) {
		if ($total==0){
		 $sqlidemp=" `idemp` LIKE  '$idemplea' "; $total=1;}
    else {
    	 $sqlidemp=" AND `idemp` LIKE  '$idemplea'";}
	}
	if (!empty($anioa)) {
		if ($total==0){
		 $sqlanioa=" `urtea` LIKE  '$anioa' "; $total=1;}
    else {
    	 $sqlanioa=" AND `urtea` LIKE  '$anioa'";}
	}
	if (!empty($mes)) {
		$opciones = array( '', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' );
		$mes=$opciones[$mes];
		if ($total==0){
		 $sqlmes=" `mes` LIKE  '%$mes%' "; $total=1;}
    else {
    	 $sqlmes=" AND `mes` LIKE  '%$mes%'";}
	}
	
	if (!empty($fechapago)) {
		if ($total==0){
		 $sqlfechapago=" `fechapago` LIKE  '$fechapago' "; $total=1;}
    else {
    	 $sqlfechapago=" AND `fechapago` LIKE  '$fechapago'";}
	}
	
		if (!empty($estadonom)) {
		$estadonom=$estadonom-1;
		if ($total==0){
		 $sqlestadonom=" `estadonom` LIKE  '$estadonom' "; $total=1;}
    else {
    	 $sqlestadonom=" AND `estadonom` LIKE  '$estadonom'";}
	}
	
	if (!empty($tiponom)) {
		$tiponom=$tiponom-1;
		if ($total==0){
		 $sqltiponom=" `tiponom` LIKE  '$tiponom' "; $total=1;}
    else {
    	 $sqltiponom=" AND `tiponom` LIKE  '$tiponom'";}
	}	
	
	
	if (!empty($dnie)) {
		$result = mysql_query("SELECT * FROM  `empleados` WHERE  `dni` LIKE  '$dnie'");
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
		if ($total==0){
		 $sqltotal=" `total` $tipobusc $canteuros "; $total=1;}
    else {
    	 $sqltotal=" AND `total` $tipobusc $canteuros ";}
	}
	$resultquery = "SELECT * FROM  `nominas` WHERE  $sqlidnom $sqlidemp $sqlanioa $sqldnie $sqlfechapago $sqlestadonom $sqltiponom $sqlmes $sqltotal";
	echo ($resultquery); 
	if ($total==0){
	echo ("<center><label id='error'> <img src='imagenes/cuidado.png'> No has introducido ningun criterio para la busqueda </label></center>");
	}
	else
	{
		echo ("<hr><center><br> LISTADO DE LOS RESULTADOS DE LA BUSQUEDA <br> <br>");
		echo("<table id='listadoemp'><tr><th></th><th> IDNomina </th>");
		echo("<th> IdEmpleado </th>");
		echo("<th> Mes </th>");
		echo("<th> A&ntilde;o </th>");
		echo("<th> Fecha Pago </th>");
		echo("<th> Estado Nomina </th>");
		echo("<th> Tipo Nomina </th>");
		echo("<th> H.Contrato </th>");
		echo("<th> Total </th></tr>");
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
		$result=mysql_query($resultquery);
		while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
			printf ("<tr><th></th>");
			printf("<td>  %s </td>", $row[0]);
			printf("<td>  %s </td>", $row[1]);
			printf("<td>  %s </td> ", $row[2]);
			printf("<td>  %s </td>", $row[3]);
			printf("<td>  %s </td>", $row[6]);
			printf("<td>  %s </td>", $arrayestados[$row[7]]);
			printf("<td>  %s </td>", $arraytipos[$row[8]]);
			//buscar si tiene horas de contrato
			$sqlnomconp = "SELECT * FROM  `conceptosnom` WHERE  `IdNomina` = '$row[0]' AND  `IdConcepto` = 1 ";
			$resulsql=mysql_query($sqlnomconp);
			$existefilanom=0;
			while ($filanom = mysql_fetch_array($resulsql, MYSQL_NUM)) {
					printf("<td>  %s </td>", $filanom[3]);
					$existefilanom=1;
			}
			if ($existefilanom == '0'){
				printf("<td>  0 </td>");
			}
			printf("<td> %.2f </td></tr>", $row[4]);
		}
		echo("</table></center>");
		mysql_close();
	}
?>
</table>
</form> 
</center>
</body>
</html>


