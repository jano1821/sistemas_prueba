<?php
	require_once('login/comprobarweb.php');
?>
<html>
<head>
<title> Sitema de Empleados y Nominas Online </title>
<link rel=StyleSheet href="./estilos.css" TYPE="text/css">
</head>

<body>
<center>

<form name='formulario' method="post" action="<?=$_SERVER['PHP_SELF']?>"> 
<h3>Datos del Empleado: </h3>

<?php

function crear_dropdown( $name, array $options, $selected=null )
{
    $dropdown = '<select name="'.$name.'" id="'.$name.'">'."\n";
    $selected = $selected;
    foreach( $options as $key=>$option )
    {
        $select = $selected==$key ? ' selected' : null;
        $dropdown .= '<option value="'.$key.'"'.$select.'>'.$option.'</option>'."\n";
    }

    $dropdown .= '</select>'."\n";
    return $dropdown;
}
?>


<table>
  <tbody>
<?php
$datoempl= $_GET['idempleatu'];

include("./conectarbbdd.php");

$result = mysql_query("SELECT * FROM  `empleados` WHERE  `idemp` LIKE  '$datoempl' LIMIT 0 , 30");

while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	echo('<input type="hidden" name="idemple" value="'.$datoempl.'" >');
    printf("  <tr><td><label><strong> IdEmpleado: </strong> </label> </td> <td colspan='3'> <input  name='ida' value='%s' readonly='true'/></td>", $row[0]);
    printf(" </tr> <tr> <td><label> Apellido 1:</label> </td> <td> <input  value='%s' name='ape1'/></td>  ", $row[2]);
    printf(" <td><label> Telefono Contacto:</label> </td> <td> <input  value='%s' name='telcont1'/></td>  ", $row[10]);
    printf("</tr><tr><td><label>  Apellido 2:</label> </td><td> <input  value='%s' name='ape2'/></td> ", $row[3]);
    printf(" <td><label> Otro Telf. Contacto:</label> </td> <td> <input  value='%s' name='telcont2'/></td> ", $row[11]);
	 printf(" </tr> <tr> <td><label> Nombre:</label> </td> <td> <input  value='%s' name='nombre'/> </td>", $row[1]);
      
	 //Estado del Empleado recogiendo valores de la tabla t_estadosemp
		//crear array
		$options = array();
		include("conectarbbdd.php");
		$resultado = mysql_query("SELECT * FROM  `t_estadosemp`");
		while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
    		$options[] = $fila[1];
		}
     printf("<td><label  > Estado del Empleado </label> </td> <td>");
    //nombre del dropdown
    $name = 'state';
    //opciones que tendra el dropdown
	 //opcion seleccionada en el dropdown
	 $selected = $row[6];
	 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
	 echo crear_dropdown( $name, $options, $selected );
	 printf("</td>");
    //Fin estadoempleados
	  
    printf("</tr></tr> <tr> <td> <label > DNI </label> </td> <td> <input  value='%s' name='dni'/> </td>", $row[5]);
    printf("<td><label> Sexo </label> </td> <td>");
    //nombre del dropdown
    $name = 'sexo';
    //opciones que tendra el dropdown
	 $options = array( 'Hombre', 'Mujer');
	 //opcion seleccionada en el dropdown
	 $selected = $row[8];
	 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
	 echo crear_dropdown( $name, $options, $selected );
	  printf("</td></tr>");    
	 echo('<tr><td colspan="4"> <HR align="center"> </td></tr>');
	 printf("<tr><td> <label> Calle: </label> </td> <td> <input  value='%s' name='calle'/></td>", $row[12]);
	 printf("<td><label> Codigo Postal:</label> </td> <td> <input  value='%s' name='cp'/> </td></tr>", $row[15]);   
	 printf("<tr><td> <label> Piso: </label> </td> <td> <input  value='%s' name='piso'/></td>", $row[13]);
	 printf("<td><label> Puerta:</label> </td> <td> <input  value='%s' name='puerta'/> </td></tr>", $row[14]); 
	 printf("<tr><td> <label> Localidad: </label> </td> <td> <input  value='%s' name='localidad'/></td>", $row[16]);

	  //Provicias: recogiendo valores de la tabla t_provincias
	  //crear array
		$optionsprov = array();
		include("conectarbbdd.php");
		$resulprov = mysql_query("SELECT * FROM  `t_provincias`");
		while ($filaprov = mysql_fetch_array($resulprov, MYSQL_NUM)) {
    		$optionsprov[] = $filaprov[1];
		}
     printf("<td><label> Provincia:</label> </td> <td>");
    //nombre del dropdown
    $name = 'provincia';
    //opciones que tendra el dropdown
	 //opcion seleccionada en el dropdown
	 $selected = $row[17];
	 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
	 echo crear_dropdown( $name, $optionsprov, $selected );
	 printf("</td>");
    //Fin provincias
	
	 echo('<tr><td colspan="4"> <HR align="center"> </td></tr>');
    printf("<tr><td> <label> Email: </label> </td> <td> <input  value='%s' name='email'/></td>", $row[4]);
	 printf("<td><label> Numero Seguridad Social:</label> </td> <td> <input  value='%s' name='numss'/> </td></tr>", $row[7]);   
	 printf("<tr><td> <label> Numero de Hijos: </label> </td> <td>");
    $name = 'nhijos';
	 $options = array( 'Ninguno - 0', '1','2', '3','4', '6');
	 $selected = $row[20];
	 echo crear_dropdown( $name, $options, $selected ); 
	  printf("</td>"); 
	 printf("<td><label> Estado Civil:</label> </td> <td>"); 
	  $name = 'estadocivil';
	 $options = array( 'Soltero/a', 'Casado/a','Viudo/a');
	 $selected = $row[21];
	 echo crear_dropdown( $name, $options, $selected ); 
	  printf("</td></tr>"); 
	 printf("<tr><td> <label> Fecha Entrada Emp.: </label> </td> <td> <input  value='%s' name='fechaent'/></td>", $row[18]); 
	 printf("<td><label> Fecha Salida Empresa:</label> </td> <td> <input  value='%s' name='fechasal'/> </td></tr>", $row[19]);
	  echo('<tr><td colspan="4"> <HR align="center"> </td></tr>');  
    printf(" <tr> <td> <label> Observaciones: </label> </td></tr> <tr><td rowspan='4' colspan='4'> <textarea cols='72' rows='5' name='masdatos' >%s</textarea></td> </tr>", $row[9]); 
    printf("</tbody></table>");
    $numid=$row[0];
}

mysql_close();
?>
<br><br> <button type='submit' name="imprimir" onclick="window.print()">  <img src='./imagenes/imprimir.png'> </button>
<button type='submit' name="volver">  <img src='./imagenes/volver.png'> </button>

<?php
if(isset($_POST["imprimir"])) 
{ 
   $idempleatu=$_REQUEST['idemple'];
	echo ('<meta http-equiv="Refresh" content="0; URL=verempprint.php?idempleatu='.$idempleatu.'">');
}
if(isset($_POST["volver"])) 
{ 
   $idempleatu=$_REQUEST['idemple'];
	echo ('<meta http-equiv="Refresh" content="0; URL=verempleado.php?idempleatu='.$idempleatu.'">');
}
?>
</form> 
</center>
</body>
</html>



