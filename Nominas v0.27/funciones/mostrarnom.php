<?php
echo('<br><br><table>');
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo('<tr><td><b>IdNomina:</b></td><td><input name="idnom" value="'.$row[0].'" readonly></td><td>&nbsp;</td><td>&nbsp;</td>');
	printf("<td><b> Mes: </b></td><td><input value='%s' readonly></td>",$row[2] );
	printf("<td><b> A&ntilde;o: </b> <label class='asteriskgreen'> * </label> </td><td><input name='anionom' value='%s' ></td></tr>",$row[3]);
	echo('<tr><td><b>Fecha Pago:</b> <label class="asteriskgreen"> * </label> </td><td><input name="fechapago" id="fechapago" value="'.$row[6].'"></td>');
	echo('<td><a href="#" onClick="cal.select(document.forms[\'formulario\'].fechapago,\'anchor2\',\'yyyy/MM/dd\'); return false;"  NAME="anchor2" ID="anchor2"><img src="./imagenes/calendario.gif"></a></td>');
	echo('<td>&nbsp;</td>');	
	printf("<td><b> Tipo Nomina: </b> <label class='asteriskgreen'> * </label> </td><td>");
	$arraytipos = array();
	$resultipos = mysql_query("SELECT * FROM  `t_tiponom`");
	while ($filatipos = mysql_fetch_array($resultipos, MYSQL_NUM)) {
    		$arraytipos[] = $filatipos[1];
	}
	 $name = 'tiponom';
    //opciones que tendra el dropdown
	 //opcion seleccionada en el dropdown
	 $selected = $row[8];
	 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
	 echo crear_dropdown( $name, $arraytipos, $selected );
	 echo('</td>');
	
	printf("<td><b> Estado Nomina: </b> <label class='asteriskgreen'> * </label> </td><td>");
	$arrayestados = array();
	$resulestados = mysql_query("SELECT * FROM  `t_estadosnom`");
	while ($filaemp = mysql_fetch_array($resulestados, MYSQL_NUM)) {
    		$arrayestados[] = $filaemp[1];
	}
	 $name = 'estadonom';
    //opciones que tendra el dropdown
	 //opcion seleccionada en el dropdown
	 $selected = $row[7];
	 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
	 echo crear_dropdown( $name, $arrayestados, $selected );
	 echo('</td>');
   echo('<tr><td> <label> &nbsp </label> </td></tr>');
	echo('<tr><td colspan="6"> <b>Datos del Empleado:</b> </td></tr>');
   printf("<tr><td><label > IdEmpleado</label> <label class='asteriskgreen'> * </label> </td> <td> <input value='%s' name='idemplea2' id='idemplea2' readonly></td>  ", $row[1]);
   printf ("<td> <a href='verempleado.php?idempleatu=%s' target='empleado'><img src='./imagenes/buscar2.png'></a></td>", $row[1]);
	echo('<td><a href="javascript:abrir_popup(\'popup_selemp.php\')">');
	printf("<img src='./imagenes/seleccionar.png'></a></td>"); 
	$idempleforcont=$row[1]
;  $sqlemp = mysql_query ("SELECT * FROM  `empleados` WHERE  `idemp` =  '$row[1]' ");	
		while ($filaemp = mysql_fetch_array($sqlemp, MYSQL_NUM)) {
			echo('<td>DNI:</td> <td> <input  value="'.$filaemp[5].'" name="dni" id="dni" readonly></td>');
			echo('<td>NUSS:</td> <td> <input  value="'.$filaemp[7].'" name="nuss" id="nuss" readonly></td>');
			echo('</tr><td>Nombre: </td> <td> <input value="'.$filaemp[1].'" name="nombre" id="nombre" readonly></td><td>&nbsp;</td><td>&nbsp;</td>');
			echo('<td>Apellido 1: </td> <td> <input value="'.$filaemp[2].'" name="apellido1" id="apellido1" readonly></td>');
			echo('<td>Apellido 2: </td> <td> <input value="'.$filaemp[3].'" name="apellido2" id="apellido2" readonly></td>');
		}
	echo('</tr>');
	echo('<tr><td> <label> &nbsp </label> </td></tr>');
	echo('<tr><td colspan="6"> <b>Datos del Contrato:</b> </td></tr>');
   printf("<tr><td><label > IdContrato</label> <label class='asteriskgreen'> * </label> </td> <td> <input value='%s' name='idcontrato2' id='idcontrato2' readonly></td>  ", $row[5]);
	echo('<td><a href="javascript:abrir_popup(\'vercontrato.php?IdContrato='.$row[5].' \')">');
	printf("<img src='./imagenes/buscar2.png'></a></td>", $row[5]);  
	echo('<td><a href="javascript:abrir_popup(\'popup_selcont.php?idempleado='.$idempleforcont.' \')">');
	printf("<img src='./imagenes/seleccionar.png'></a></td>");   
    
  
  	$sqlcont = mysql_query ("SELECT * FROM  `contratos` WHERE  `idcontrato` =  '$row[5]' ");	
	while ($filacont = mysql_fetch_array($sqlcont, MYSQL_NUM)) {
				//cargar listado de tipo contratos
				$opciones = array();
				$resultado = mysql_query("SELECT * FROM  `t_tipocontrato`");
				while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
    				$opciones[] = $fila[1];
				}
			echo('<td>Tipo Contrato:</td> <td> <input value="'.$opciones[$filacont[2]].'" name="tipocontrato2" id="tipocontrato2" readonly></td>');
			echo('<td>Fecha Inicio:</td> <td> <input value="'.$filacont[4].'" name="finicio2" id="finicio2" readonly></td>');
			echo('</tr><td>Fecha Fin: </td> <td> <input value="'.$filacont[5].'" name="ffin2" id="ffin2" readonly></td><td>&nbsp;</td><td>&nbsp;</td>');
			//cargar listado de estado contratos
			$opestado = array();
			$resultado3 = mysql_query("SELECT * FROM  `t_estadoscont`");
			while ($fila3 = mysql_fetch_array($resultado3, MYSQL_NUM)) {
    			$opestado[] = $fila3[1];
			}
			echo('<td>Estado: </td> <td> <input value="'.$opestado[$filacont[7]].'" name="estadocont2" id="estadocont2" readonly></td>');
			echo('<td>Numero Cuenta: </td> <td> <input value="'.$filacont[14].'"  name="ncuenta2" id="ncuenta2" readonly></td>');
		}
	echo('</tr>');
	echo('<tr><td> <label> &nbsp </label> </td></tr>');
	echo('<tr><td colspan="6"> <b>Direccion de Domiciliacion:</b> </td></tr><tr>');
  $sqldir = mysql_query ("SELECT * FROM  `empleados` WHERE  `idemp` =  '$row[1]' ");	
		while ($filadir = mysql_fetch_array($sqldir, MYSQL_NUM)) {
			echo('<td>Localidad:</td> <td> <input value="'.$filadir[16].'" readonly></td> <td>&nbsp;</td><td>&nbsp;</td>');
			//Provicias: recogiendo valores de la tabla t_provincias
			//crear array
			$optionsprov = array();
			include("conectarbbdd.php");
			$resulprov = mysql_query("SELECT * FROM  `t_provincias`");
			while ($filaprov = mysql_fetch_array($resulprov, MYSQL_NUM)) {
			 		$optionsprov[] = $filaprov[1];
			}
			echo('<td>Provincia:</td> <td> <input   value="'.$optionsprov[$filadir[17]].'" readonly></td>');
			echo('<td>Codigo Postal: </td> <td> <input   value="'.$filadir[15].'" readonly></td></tr>');
			echo('<td>Calle: </td> <td> <input   value="'.$filadir[12].'" readonly></td><td>&nbsp;</td><td>&nbsp;</td>');
			echo('<td>Piso: </td> <td> <input   value="'.$filadir[13].'" readonly></td>');
			echo('<td>Puerta: </td> <td> <input   value="'.$filadir[14].'" readonly></td>');
		}
	echo('</tr>');
 	echo('<tr><td> <label> &nbsp </label> </td></tr>');
 		echo('<tr><td> <b> Total a Deducir:  </b> </td>');	
 		
 	//cargar los tipos de conceptos existentes
 	$arraytipocon = array();
	$sqltconcepto="SELECT * FROM  `t_conceptos`";
	$resultipo=mysql_query($sqltconcepto);
	while ($tconcepto = mysql_fetch_array($resultipo, MYSQL_NUM)) {
			//guardar en un array todos los tipos de conceptos de la nomina
			$arraytipocon[]= $tconcepto[2];
	}			
	//calcular el total de deducciones
	$sqlnomconp = "SELECT * FROM  `conceptosnom` WHERE  `IdNomina` = '$row[0]'";
	$sumadeduccuion=0;
	$resulsql=mysql_query($sqlnomconp);
	//mostrar todos las deducciones
	while ($filanom = mysql_fetch_array($resulsql, MYSQL_NUM)) {
		if ($arraytipocon[$filanom[2]-1]=='1'){ //si el tipo de concepto de nomina es 1, es deduccion
			$sumadeduccuion=$sumadeduccuion+$filanom[6];
		}	
	}
	printf("<td><input   value='%s &euro;' readonly></td><td> &nbsp; </td> <td>&nbsp;</td>", $sumadeduccuion);	
 	//recarlcular el total de devengos
	$sqlnomtotal = "SELECT * FROM  `conceptosnom` WHERE  `IdNomina` = '$row[0]'";
	$sumadevengo=0;
	$resultotal=mysql_query($sqlnomtotal);
	while ($filatotal = mysql_fetch_array($resultotal, MYSQL_NUM)) {
		if ($arraytipocon[$filatotal[2]-1]=='0'){ //si el tipo de concepto de nomina es 1, es devengo
			$sumadevengo=$sumadevengo+$filatotal[5];
		}
	}	
	echo('<td> <b> Total de Devengos:  </b> </td>');	
	printf("<td><input   value='%s &euro;' readonly></td>  ", $sumadevengo);
	echo('<td> <b> Total a Pagar:  </b> </td>');
	printf("<td><input   value='%s &euro;' readonly></td></tr>  ", $row[4]);
	echo('<tr><td> <label> &nbsp </label> </td></tr>');
}
echo('</table>');
?>