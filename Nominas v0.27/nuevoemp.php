<?php
	require_once('login/comprobarweb.php');
?>
<html>
<head>
<title> Sitema de Empleados y Nominas Online </title>
<link rel=StyleSheet href="estilos.css" TYPE="text/css">
<link rel=StyleSheet href="menu/css/nav.css" TYPE="text/css">

<script type="text/javascript">

function validar_dni ( )
{
    valid = true;

    if ( document.fcrearemp.dni.value == "" )
    {
        alert ( "EL DNI no puede estar en blanco" );
        valid = false;
    }

    return valid;
}

</script>

</head>

<body>

<?php
	include("menu/menu.php");
	include("funciones/crear_dropdown.php");
?>
<br>
<center>
<form name="fcrearemp" method="post" action="<?=$_SERVER['PHP_SELF']?>"> 
<div id="contenidoperm">
<h1>Dar de Alta Nuevo Empleado: </h1>
<table> 
  <tbody>
   <tr> 
   	<td><label for='person3'> Apellido 1:</label> </td> <td> <input value="<?php echo $_POST['apellido1']?>" name='apellido1'/> </td> 
      <td><label for='person3'> Telefono Contacto:</label> </td> <td> <input value="<?php echo $_POST['telcont1']?>" name='telcont1'/> </td>
   </tr><tr> 
       <td><label for='person3'> Apellido 2:</label> </td> <td> <input value="<?php echo $_POST['apellido2']?>" name='apellido2'/> </td>
       <td><label for='person3'> Otro Telefono Contacto:</label> </td> <td> <input value="<?php echo $_POST['telcont2']?>" name='telcont2'/> </td>
    </tr><tr>
        <td><label for='person3'> Nombre:</label> </td><td> <input id='person1' value="<?php echo $_POST['nombre']?>" name='nombre'/> </td>
<?php
//crear array
$options = array();
include("conectarbbdd.php");
$result = mysql_query("SELECT * FROM  `t_estadosemp`");
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    $options[] = $row[1];
}
printf("<td><label> Estado del Empleado </label> </td> <td>");
    //nombre del dropdown
    $name = 'estado';
	 //opcion seleccionada en el dropdown
	$selected = $_POST['estado'];
	 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
	 echo crear_dropdown( $name, $options, $selected );
	 	 printf("</td></tr>")
?>

    <tr> 
       <td> <label for='person3'> DNI </label> <label class="asteriskred"> * </label> </td> <td> <input id='person1' value='' name='dni' class="requerido"/>  </td> 
<?php
printf("<td><label> Sexo: </label> </td> <td>");
    //nombre del dropdown
    $name = 'sexo';
    //opciones que tendra el dropdown
	 $options = array('Hombre', 'Mujer');
	 //opcion seleccionada en el dropdown
	 $selected = $_POST['sexo'];
	 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
	 echo crear_dropdown( $name, $options, $selected );
	 printf("</td></tr>");
?>
    <tr><td colspan="4"> <HR align="center"> </td></tr>
    <tr>
    	<td><label> Calle: </label> </td><td><input value="<?php echo $_POST['calle']?>" name='calle'/> </td>
    	<td><label> Codigo Postal: </label> </td><td> <input value="<?php echo $_POST['cp']?>" name='cp'/> </td>
    </tr><tr>
    	<td><label> Piso: </label> </td><td> <input value="<?php echo $_POST['piso']?>" name='piso'/> </td>
    	<td><label> Puerta: </label> </td><td>  <input value="<?php echo $_POST['puerta']?>" name='puerta'/> </td>
    </tr><tr>
    	<td><label> Localidad: </label> </td><td>  <input value="<?php echo $_POST['localidad']?>" name='localidad'/> </td>

	<?php
		//crear array
		$options = array();
		include("conectarbbdd.php");
		$result = mysql_query("SELECT * FROM  `t_provincias`");
		while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		 	$options[] = $row[1];
		}
		printf("<td><label> Provincia: </label> </td><td>");
		 //nombre del dropdown
		 $name = 'provincia';
		 //opcion seleccionada en el dropdown
		$selected = $_POST['provincia'];
		 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
		 echo crear_dropdown( $name, $options, $selected );
		 	 printf("</td>")
	?>
   
   
    </tr>
    <tr><td colspan="4"> <HR align="center"> </td></tr>
    <tr>
   		<td> <label> Email: </label> </td> <td> <input value="<?php echo $_POST['email']?>" name='email'/></td>
   		<td><label> Numero Seguridad Social:</label> </td> <td> <input value="<?php echo $_POST['numss']?>" name='numss'/> </td>
   </tr>
   <tr> 
<?php
printf("<td><label> Numero de Hijos: </label> </td> <td>");
    //nombre del dropdown
    $name = 'nhijos';
    //opciones que tendra el dropdown
	 $options = array('Ninguno', '1', '2', '3', '4', '5', '6');
	 //opcion seleccionada en el dropdown
	 $selected = $_POST['nhijos'];
	 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
	 echo crear_dropdown( $name, $options, $selected );
	 printf("</td>");
?>     		 
  		 
<?php
printf("<td><label> Estado Civil: </label> </td> <td>");
    //nombre del dropdown
    $name = 'estadocivil';
    //opciones que tendra el dropdown
	 $options = array('Soltero/a', 'Casado/a', 'Viudo/a');
	 //opcion seleccionada en el dropdown
	 $selected = $_POST['estadocivil'];
	 //crear dropdwon con las opciones de estado, y pasarle a la funcion de crear el valor que esta en BBDD
	 echo crear_dropdown( $name, $options, $selected );
	 printf("</td></tr>");
?>   

   <tr><td colspan="4"> <HR align="center"> </td></tr>
   <tr> 
  		  <td> <label> Observaciones: </label></td>
   </tr>
   <tr>
   	 <td rowspan='4' colspan='4'> <textarea cols='72' rows='5' name='masdatos' ><?php echo($_REQUEST['masdatos']); ?></textarea></td> 
   </tr>
   </table>
	<br><INPUT type="submit" name="gordeemp" value="Crear Nuevo Empleado" size="20" onclick="return validar_dni();" > 
 	<br>
 	</div>
 	</form>
 	
</center>

<?php 
if(isset($_POST["gordeemp"])) 
{ 
	
	$apellido1=$_REQUEST['apellido1'];
	$telcont1=$_REQUEST['telcont1'];
	$apellido2=$_REQUEST['apellido2'];
	$telcont2=$_REQUEST['telcont2'];
	$nombre=$_REQUEST['nombre'];
	$estado=$_REQUEST['estado'];
	$dni=$_REQUEST['dni'];
	$sexo=$_REQUEST['sexo'];
	$nhijos=$_REQUEST['nhijos'];
	$estadocivil=$_REQUEST['estadocivil'];
	$calle=$_REQUEST['calle'];
	$cp=$_REQUEST['cp'];
	$piso=$_REQUEST['piso'];
	$puerta=$_REQUEST['puerta'];
	$localidad=$_REQUEST['localidad'];
	$provincia=$_REQUEST['provincia'];
	$email=$_REQUEST['email'];
	$numss=$_REQUEST['numss'];
	$masdatos=$_REQUEST['masdatos'];
	$fecha_actual = date("Y-m-d");
include("conectarbbdd.php");

//comprobar que el DNI no exista antes de guardarlo
$resulta = mysql_query("SELECT * FROM  `empleados` WHERE  `dni` LIKE  '$dni' LIMIT 0 , 30");
$numerofilas=mysql_num_rows($resulta);
mysql_close();

if ($numerofilas==0){
	include("conectarbbdd.php");
	//guardar los datos del empleado
	$result = mysql_query("INSERT INTO `empleados` (`idemp`, `nombre`, `apellidouno`, `apellidodos`, `email`, 
	`dni`, `estado`, `nuss`, `sexo`, `observaciones`, `telfcont`, `telfcont2`, `calle`, `piso`, `puerta`, 
	`cp`, `localidad`, `provincia`, `fechaent`, `fechasal`, `hijos`, `estadocivil`, `linkfoto`) VALUES (NULL, '$nombre', 
	'$apellido1', '$apellido2', '$email', '$dni', '$estado', '$numss', '$sexo', '$masdatos', 
	'$telcont1', '$telcont2', '$calle', '$piso', '$puerta', '$cp', '$localidad', '$provincia', '$fecha_actual', 
	'', '$nhijos', '$estadocivil', 'archivos/fotos/sinfoto.png');");
	if($result)
	{
		echo('<center> <img src="./imagenes/errorok.png"> </center>');
	} else {
		echo('<center> <img src="./imagenes/error1.png"> </center>');
	}
	//recuperar ultimo id de conexion del insert anterior y redireccionar
	$query = mysql_query("SELECT LAST_INSERT_ID()");
	$idempleado = mysql_result($query, 0, 0);
	//REGISTRAR CAMBIO EN EL HISTORICO
	$usuario = $_SESSION['SESS_USERNAME'];
	$desccambio = "Creacion Ficha Empleado";
	$tabla = "EMPLEADOS";
	$idemplhist = $idempleado;
	$idregistro = $idempleado;
	include("funciones/registrarcambio.php");
	
	echo ('<meta http-equiv="Refresh" content="0.1; URL=verempleado.php?idempleatu='.$idempleado.'">');
	mysql_close();
}
else {
	echo('<center> <div id="error"><img src="imagenes/cuidado.png">  El DNI introducido ya existe en la Base de Datos </div> </center>');
	$masdatos = $_POST['masdatos'];
}

} 
?> 
</body>
</html>


