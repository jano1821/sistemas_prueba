<?php
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    printf("  <tr><th><label><strong> IdEmpleado: </strong> </label> </th> <td colspan='6'> <input  name='ida' value='%s' readonly='true'/></td>", $row[0]);
    printf(" </tr> <tr> <th><label> Apellido 1:</label> </th> <td> <input  value='%s' name='ape1'/></td>  ", $row[2]);
    printf(" <th><label> Telefono Contacto:</label> </th> <td> <input  value='%s' name='telcont1'/></td>  ", $row[10]);
        //Estado del Empleado recogiendo valores de la tabla t_estadosemp
		//crear array
		$options = array();
		include("conectarbbdd.php");
		$resultado = mysql_query("SELECT * FROM  `t_estadosemp`");
		while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
    		$options[] = $fila[1];
		}
     printf("<th><label  > Estado del Empleado </label> </th> <td>");
    //nombre del dropdown
    $name = 'state';
    //opciones que tendra el dropdown
	 //opcion seleccionada en el dropdown
	 $selected = $row[6];
	 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
	 echo crear_dropdown( $name, $options, $selected );
	 printf("</td>");
    //Fin estadoempleados
    printf("</tr><tr><th><label>  Apellido 2:</label> </th><td> <input  value='%s' name='ape2'/></td> ", $row[3]);
    printf(" <th><label> Otro Telf. Contacto:</label> </th> <td> <input  value='%s' name='telcont2'/></td> ", $row[11]);
      printf("<th><label> Sexo </label> </th> <td>");
    //nombre del dropdown
    $name = 'sexo';
    //opciones que tendra el dropdown
	 $options = array( 'Hombre', 'Mujer');
	 //opcion seleccionada en el dropdown
	 $selected = $row[8];
	 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
	 echo crear_dropdown( $name, $options, $selected);
	  printf("</td>");    

	 printf(" </tr> <tr> <th><label> Nombre:</label> </th> <td> <input  value='%s' name='nombre'/> </td>", $row[1]);
	 printf("<th> <label > DNI </label> <label class='asteriskred'> * </label> </th> <td> <input  value='%s' name='dni' /> </td></tr>", $row[5]);
  	 echo('<tr><td colspan="6"> <HR align="center"> </td></tr>');
	 printf("<tr><th> <label> Calle: </label> </th> <td> <input  value='%s' name='calle'/></td>", $row[12]);
	 printf("<th> <label> Piso: </label> </th> <td> <input  value='%s' name='piso'/></td>", $row[13]);
	 printf("<th><label> Puerta:</label> </th> <td> <input  value='%s' name='puerta'/> </td></tr>", $row[14]); 
	 
	 printf("<tr><th> <label> Localidad: </label> </th> <td> <input  value='%s' name='localidad'/></td>", $row[16]);
	  //Provicias: recogiendo valores de la tabla t_provincias
	  //crear array
		$optionsprov = array();
		include("conectarbbdd.php");
		$resulprov = mysql_query("SELECT * FROM  `t_provincias`");
		while ($filaprov = mysql_fetch_array($resulprov, MYSQL_NUM)) {
    		$optionsprov[] = $filaprov[1];
		}
     printf("<th><label> Provincia:</label> </th> <td>");
    //nombre del dropdown
    $name = 'provincia';
    //opciones que tendra el dropdown
	 //opcion seleccionada en el dropdown
	 $selected = $row[17];
	 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
	 echo crear_dropdown( $name, $optionsprov, $selected );
	 printf("</td>");
    //Fin provincias
	 
	 
	 printf("<th><label> Codigo Postal:</label> </th> <td> <input  value='%s' name='cp'/> </td></tr>", $row[15]);   

	 echo('<tr><td colspan="6"> <HR align="center"> </td></tr>');
    
	 printf("<tr><th><label> Numero Seguridad Social:</label> </th> <td> <input  value='%s' name='numss'/> </td>", $row[7]);   
	 printf("<th> <label> Numero de Hijos: </label> </th> <td>");
    $name = 'nhijos';
	 $options = array( 'Ninguno - 0', '1','2', '3','4', '5','6');
	 $selected = $row[20];
	 echo crear_dropdown( $name, $options, $selected ); 
	  printf("</td>"); 
	 printf("<th><label> Estado Civil:</label> </th> <td>"); 
	  $name = 'estadocivil';
	 $options = array( 'Soltero/a', 'Casado/a','Viudo/a');
	 $selected = $row[21];
	 echo crear_dropdown( $name, $options, $selected ); 
	  printf("</td></tr>"); 
	 printf("<tr><th> <label> Email: </label> </th> <td> <input  value='%s' name='email'/></td>", $row[4]);
	 printf("<th> <label> Fecha Entrada Emp.: </label> </th> <td> <input  value='%s' name='fechaent'/>", $row[18]); 
	 echo('<a href="#" onClick="cal.select(document.forms[\'formulario\'].fechaent,\'anchor2\',\'yyyy/MM/dd\'); return false;"  NAME="anchor2" ID="anchor2"><img src="./imagenes/calendario.gif"></a></td>');

	 printf("<th><label> Fecha Salida Empresa:</label> </th> <td> <input  value='%s' name='fechasal'/>", $row[19]);
	 echo('<a href="#" onClick="cal.select(document.forms[\'formulario\'].fechasal,\'anchor1\',\'yyyy/MM/dd\'); return false;"  NAME="anchor1" ID="anchor1"><img src="./imagenes/calendario.gif"></a></td></tr>');

	 echo('<tr><td colspan="6"> <HR align="center"> </td></tr>');  
    printf(" <tr> <th colspan='6'> <label> Observaciones: </label> </th></tr> <tr><td rowspan='3' colspan='6'> <textarea cols='112' rows='4' name='masdatos' >%s</textarea></td> </tr>", $row[9]); 
    printf("</tbody></table>");
 
    $numid=$row[0];
}

?>