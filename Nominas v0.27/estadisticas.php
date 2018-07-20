<?php
	require_once('login/comprobarweb.php');
?>
<html>
<head>
<title>Sitema de Empleados y Nominas Online </title>
<link rel=StyleSheet href="estilos.css" TYPE="text/css">
<link rel=StyleSheet href="menu/css/nav.css" TYPE="text/css">

<script language="JavaScript">
function seleccionar(num){
	if(num!=0){
		if (num==1){
			document.getElementById('campo').value = 'Estado';
		}
		if (num==2){
			document.getElementById('campo').value = 'Fecha';
		}
		if (num==3){
			document.getElementById('campo').value = 'Tipo';
		}
		if (num==4){
			document.getElementById('campo').value = 'TipoAusencia';
		}
		if (num==5){
			document.getElementById('campo').value = 'TipoContrato';
		}
	}
}

function comprobarsel(){
	var num = document.getElementById('campo').value;
	if(num==0){
		alert("La tabla seleccionada no es valida");
		return false;
	}
	else{
		return true;
	}
}
</script>

</head>

<body>
<?php
	include("menu/menu.php");
?>
<center>
<br>
<h2>Generador de estad&iacute;sticas:</h2>
<br>

<form method="post" action="<?=$_SERVER['PHP_SELF']?>"> 
<table>
<tr>
<td><label> Seleccionar Tabla: </label> </td>

<td><SELECT name="tabla" SIZE="1" onchange="seleccionar(this.selectedIndex)"> 
   <OPTION value="0">&nbsp</OPTION> 
   <OPTION value="1">Empleados</OPTION> 
   <OPTION value="2">Nominas</OPTION> 
   <OPTION value="3">Solicitudes</OPTION> 
   <OPTION value="4">Ausencias</OPTION> 
   <OPTION value="5">Contratos</OPTION> 
</SELECT> </td>

<td> &nbsp <label> Campo: </label> </td>
<td><input name="campo" id="campo" size='8' readonly="true"> </td>

<td> &nbsp <label> Elegir Accion: </label>  </td>
<td><SELECT name="accion" SIZE="1"> 
   <OPTION value="0">Contabilizar</OPTION> 
</SELECT> </td>
</tr>
</table>
<table>
<tr> <td> &nbsp <button type="submit" name="listar" id="listar" onclick="return comprobarsel();"> Generar Estad&iacute;sticas </button> </td> </tr>
</table>
</form>
<?php
if(isset($_POST["listar"])) 
{
	echo('<hr>');
	$tabla=$_REQUEST['tabla'];

	//Cargar Opciones de la tabla t_estadosemp
	include("conectarbbdd.php");
	if ($tabla == '1'){
		//crear array en blanco para el grafico
		$grafico=array();
		//crar variable para guardar el valor mas grande para definir como max en el grafico
		$mayor=0;
		// crear array para guardar las opciones de t_estado
		$opciones = array();
		//para variable para contrar los estados cont_estados
	   $contestados=0;
		include("conectarbbdd.php");
		$resultado = mysql_query("SELECT * FROM  `t_estadosemp`");
		echo('<br><h2> Mostrando el TOTAL de EMPLEADOS por ESTADO </h2><br>');
		echo('<table class="tablaazul" bgcolor="white" border="3" bordercolor="#BBD9EE" cellpadding="4" cellspacing="0">
		<tr>');
		while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
    		$opciones[] = $fila[1];
    		echo('<th>'.$fila[1].'</th>');
    		$contestados=$contestados+1;
		}
		echo('<th>TOTAL</th><tr>');
		for ($i = 0; $i <= $contestados-1; $i++) {
    		$datos=mysql_query("SELECT count( * ) as num_emple FROM empleados WHERE  `estado` LIKE  '$i'");
	 		$mostrar= mysql_fetch_array($datos, MYSQL_NUM);
	 		echo ('<td><input value="'.$mostrar[0].'" size="5"> </td>');
	 		//guardar en el array, todos lo valores para generar el grafico
	 		$grafico[]=$mostrar[0];
	 		//buscar el numero mayor para tener un valor maximo para el grafico
	 		if ($mostrar[0] > $mayor){
	 			$mayor=$mostrar[0];
	 		}
		}
 		$datos=mysql_query("SELECT count( * ) as num_emple FROM empleados");
 		$total= mysql_fetch_array($datos, MYSQL_NUM);
		echo ('<td><input value="'.$total[0].'" size="5"> </td>');
		echo('</tr></tr></table>');
		echo ('<br>');
		//CREACION DE GRAFICO
		//me falta alinear algo mas hacia el centro los divisores para que no queden tan mal graficamente
		echo('<br><h2> GRAFICO Mostrando el TOTAL de EMPLEADOS por ESTADO </h2><br>');
		echo('</center><div align="left">');
		echo('<div style="margin-left:30%; width:300px; height:20px; background-color:#FFF; border-color:#FE2">');
		if ($mayor == 0){
		//para que no de error y aparezca "algo" dibujado lo cambiamos a 1
		$mayor=1;
		}
		for ($i = 0; $i <= $contestados-1; $i++) {
			//calcular valor % correspondiente a cada campo valoractualx100/mayor
			$valorgraf=$grafico[$i]*100/$mayor;
			//si es par un color
			if (($i+1) % 2 == 0)
			{
				if ($valorgraf == 0)
				{
					echo('<div style="margin-left:30%; width:1%; height:20px; background-color:#AAA; border-right:1px #FFF solid;"> <div>&nbsp&nbsp&nbsp'.$opciones[$i].'&nbsp('.$grafico[$i].')</div> </div>');
				}
				else{
					echo('<div style="margin-left:30%; width:'.$valorgraf.'%; height:20px; background-color:#AAA; border-right:1px #FFF solid;"> <div>&nbsp&nbsp&nbsp'.$opciones[$i].'&nbsp'.$grafico[$i].')</div> </div>');
				}
			}
			// si es impar otro color
			else{
				if ($valorgraf == 0)
				{
					echo('<div style="margin-left:30%; width:1%; height:20px; background-color:#EEE; border-right:1px #FFF solid;"> <div>&nbsp&nbsp&nbsp'.$opciones[$i].'&nbsp('.$grafico[$i].')</div> </div>');
				}
				else{
					echo('<div style="margin-left:30%; width:'.$valorgraf.'%; height:20px; background-color:#EEE; border-right:1px #FFF solid;"> <div>&nbsp&nbsp&nbsp'.$opciones[$i].'&nbsp('.$grafico[$i].')</div> </div>');
				}
			}
		}
		echo('</div></div>');

		//FIN DEL GRAFICO
		
		mysql_close();
	}
	if ($tabla == '2'){
		echo('<br><h2> Mostrando el TOTAL de NOMINAS por FECHA </h2> <br>');
		echo('<table class="tablaazul" bgcolor="white" border="3" bordercolor="ivory" cellpadding="4" cellspacing="0">
		<tr><td></td>
		<th>Enero</th>
		<th>Febrero</th>
		<th>Marzo</th>
		<th>Abril</th>
		<th>Mayo</th>
		<th>Junio</th>
		<th>Julio</th>
		<th>Agosto</th>
		<th>Septiembre</th>
		<th>Octubre</th>
		<th>Noviembre</th>
		<th>Diciembre</th>
		<th>TOTAL</th> ');
		include("conectarbbdd.php");
		$sql = "SELECT DISTINCT urtea FROM `nominas` LIMIT 0, 30 ";
		$resultado = mysql_query($sql);
		while($row = mysql_fetch_array($resultado)){
	     		$nomanio= $row[0];
        		echo ('<tr><th>'.$nomanio.'</th>');
        		$meses=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        		for ($i = 0; $i <=11; $i++) {
        				$mesactual=$meses[$i];
        				$contanio=mysql_query("SELECT COUNT( * ) AS num_nom FROM nominas WHERE  `urtea` =$nomanio AND  `mes` LIKE  '$mesactual'");
 		  				$totalanio= mysql_fetch_array($contanio, MYSQL_NUM);
 		  				echo ('<td><input value="'.$totalanio[0].'" size="5"> </td>');
 		  		}
 		  		$total=mysql_query("SELECT COUNT( * ) AS num_nom FROM nominas WHERE  `urtea` =$nomanio");
 		  		$totalresul= mysql_fetch_array($total, MYSQL_NUM);
 		  		echo ('<td><input value="'.$totalresul[0].'" size="5"> </td>');
 		  		echo('</tr>');
		}
		echo('</tr></tr> </table>');
		mysql_close();
	}
	if ($tabla == '3'){
		echo('<br><h2> Mostrando el TOTAL de SOLICITUDES por TIPO </h2> <br>');
		//para variable para contrar los tipos de permiso cont_permisos
	   $cont_permisos=0;
		//recoger datos de t_tiposol
		$options = array();
		include("conectarbbdd.php");
		$result = mysql_query("SELECT * FROM  `t_tiposol`");
		echo('<table class="tablaazul" bgcolor="white" border="1" bordercolor="ivory" cellpadding="4" cellspacing="0">
		<tr>');
		while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    		$options[] = $row[1];
    		echo('<th>'.$row[1].'</th>');
			$cont_permisos=$cont_permisos+1;
		}
		echo('<th>TOTAL</th><tr>');
		for ($i = 1; $i <= $cont_permisos; $i++) {
    		$datos=mysql_query("SELECT count( * ) as num_sol FROM solicitudes WHERE  `Tipo` LIKE  '$i'");
	 		$mostrar= mysql_fetch_array($datos, MYSQL_NUM);
	 		echo ('<td>'.$mostrar[0].'</td>');
		}
		//calcular total
 		$datos=mysql_query("SELECT count( * ) as num_sol FROM solicitudes");
 		$total= mysql_fetch_array($datos, MYSQL_NUM);
 		echo ('<td>'.$total[0].'</td>');
		echo('</tr></tr></table>');
		mysql_close();
	}
	
		if ($tabla == '4'){
		echo('<br><h2> Mostrando el TOTAL de AUSENCIAS por TIPO AUSENCIAS </h2> <br>');
		echo('<table class="tablaazul" bgcolor="white" border="1" bordercolor="ivory" cellpadding="4" cellspacing="0">
		<tr>');
		include("conectarbbdd.php");
		//recoger datos de t_tiposol
		$options = array();
		include("conectarbbdd.php");
		$result = mysql_query("SELECT * FROM  `t_tipoausencia`");
		echo('<table class="tablaazul" bgcolor="white" border="1" bordercolor="ivory" cellpadding="4" cellspacing="0">
		<tr>');
		while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    		$options[] = $row[1];
    		echo('<th>'.$row[1].'</th>');
		}
		echo('<th>TOTAL</th></tr>');

		for ($i = 1; $i <= 5; $i++) {
    		$datos=mysql_query("SELECT count( * ) as num_aus FROM ausencias WHERE  `tipoausencia` LIKE  '$i'");
	 		$mostrar= mysql_fetch_array($datos, MYSQL_NUM);
	 		echo ('<td>'.$mostrar[0].'</td>');
		}
		//calcular total
 		$datos=mysql_query("SELECT count( * ) as num_aus FROM ausencias");
 		$total= mysql_fetch_array($datos, MYSQL_NUM);
 		echo ('<td>'.$total[0].'</td>');
		echo('</tr></tr></table>');
		mysql_close();
	}
	
		if ($tabla == '5'){
		echo('<br><h2> Mostrando el TOTAL de CONTRATOS por TIPO CONTRATOS </h2> <br>');
		echo('<table class="tablaazul" bgcolor="white" border="1" bordercolor="ivory" cellpadding="4" cellspacing="0">
		<tr>');
		$opciones = array();
		include("conectarbbdd.php");
		$resultado = mysql_query("SELECT * FROM  `t_tipocontrato`");
		echo('<table class="tablaazul" bgcolor="white" border="3" bordercolor="#BBD9EE" cellpadding="4" cellspacing="0">
		<tr>');
		while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
    		$opciones[] = $fila[1];
    		echo('<th>'.$fila[1].'</th>');
		}
		echo ('<th>TOTAL</th></tr>');
		for ($i = 0; $i <= 12; $i++) {
    		$datos=mysql_query("SELECT count( * ) as num_con FROM contratos WHERE  `tipocontrato` LIKE  '$i'");
	 		$mostrar= mysql_fetch_array($datos, MYSQL_NUM);
	 		echo ('<td>'.$mostrar[0].'</td>');
		}
		//calcular total
 		$datos=mysql_query("SELECT count( * ) as num_con FROM contratos");
 		$total= mysql_fetch_array($datos, MYSQL_NUM);
 		echo ('<td>'.$total[0].'</td>');
		echo('</tr></tr></table>');
		mysql_close();
	}
}

?>
</center>
</body>
</html>
