<?php

	//NECESITO TENER LA NOMINA EN UNA VARIABLE LLAMADA IDNOMINA

  include("./conectarbbdd.php");
   //cargas los tipos de conceptos existentes
   $arraytipocon = array();
	$sqltconcepto="SELECT * FROM  `t_conceptos`";
	$resultipo=mysql_query($sqltconcepto);
	while ($tconcepto = mysql_fetch_array($resultipo, MYSQL_NUM)) {
			//guardar en un array todos los tipos de conceptos de la nomina
			$arraytipocon[]= $tconcepto[2];
	}
	
	//recarlcular el total de devengos
		$sqlnomtotal = "SELECT * FROM  `conceptosnom` WHERE  `IdNomina` = '$idnomina'";	 
		$sumadevengo=0;
		$resultotal=mysql_query($sqlnomtotal);
		while ($filatotal = mysql_fetch_array($resultotal, MYSQL_NUM)) {
			if ($arraytipocon[$filatotal[2]-1]=='0'){ //si el tipo de concepto de nomina es 1, es devengo
				$sumadevengo=$sumadevengo+$filatotal[5];
			}
		}
	      
	   //buscar todas las deducciones y recarcular las deducciones siguiendo el nuevo total
	   $sqlnomconp = "SELECT * FROM  `conceptosnom` WHERE  `IdNomina` = '$idnomina'";
		$resulnomconp=mysql_query($sqlnomconp);
	
		//buscar las deducciones y recarcularlas
		$valordeduccion=0;
		while ($filanom = mysql_fetch_array($resulnomconp, MYSQL_NUM)) {
			//buscar que tipos son deducciones
			if ($arraytipocon[$filanom[2]-1]=='1'){ //si el tipo de concepto de nomina es 1, es deduccion
				//recalcular la deduccion
				$valordeduccion=$sumadevengo*($filanom[4]/100);
				//actualizar la deduccion
				$sqldeduccion="UPDATE `conceptosnom` SET  `Adeducir` =  '$valordeduccion' WHERE `IdConceptoNom` = '$filanom[0]'";
				$resulsqldeduc=mysql_query($sqldeduccion);  					
			}
		}
	
		
		//calcular el total de deducciones
		$sqlnomconp = "SELECT * FROM  `conceptosnom` WHERE  `IdNomina` = '$idnomina'";
		$sumadeduccuion=0;
		$resulsql=mysql_query($sqlnomconp);
		//mostrar todos las deducciones
		while ($filanom = mysql_fetch_array($resulsql, MYSQL_NUM)) {
			if ($arraytipocon[$filanom[2]-1]=='1'){ //si el tipo de concepto de nomina es 1, es deduccion
				$sumadeduccuion=$sumadeduccuion+$filanom[6];
			}
		}
		
		//guardar el valor total de las nominas
		$valortotal=$sumadevengo-$sumadeduccuion;
	   $sqlvalortotal="UPDATE `nominas` SET  `total` =  '$valortotal' WHERE  `nominas`.`idnomina` = '$idnomina'";
	   $resqltotalvalor=mysql_query($sqlvalortotal); 
	   
	   
?>