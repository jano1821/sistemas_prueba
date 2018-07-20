<?php
	require_once('login/comprobarweb.php');
?>
<html>
<head>
<title> Visualizar Fotografia Empleado </title>
<link rel=StyleSheet href="estilos.css" TYPE="text/css">

<script> 
function cerrarpopup(){ 
   window.close(); 
} 
</script>  

</head>

<body>
<?php
	$idemp= $_GET['idempleado'];
?>

<form action="<?=$PHP_SELF?>" method="post" enctype="multipart/form-data" name="frmdatos"> 

<table class="tablaazul" bgcolor="white" border="3" bordercolor="#6396BB" cellpadding="4" cellspacing="0">
<tr>
<th>Foto del Empleado N&uacute;mero: <?php echo ($idemp); ?> </th>
</tr>
<td>
<?php

include("conectarbbdd.php");
$result = mysql_query("SELECT * FROM  `empleados` WHERE  `idemp` LIKE  '$idemp' LIMIT 0 , 30");

while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    $linkfoto=$row[22];
}
echo ('<img src="'.$linkfoto.'" border="0" width="270" height="370">');
?>
    
</td>
<?php
echo('<input type="hidden" name="idemple" value="'.$idemp.'">');
?>
</tr>
<tr>
<td>
Buscar Foto: <input type="file" name="archivo" id="archivo"> 
</td>
</tr>
<tr>
<td>

<input type="submit" id="subirimagen" name="subirimagen" value="Subir Imagen">
</td>
</tr>
</table>
</form> 
<?php
if(isset($_POST["subirimagen"])) 
{ 
   $idemple=$_REQUEST['idemple'];
	//obtiene el nombre del archivo 
	$tamano = $_FILES["archivo"]['size'];
	$tipo = $_FILES["archivo"]['type'];
	$archivo = $_FILES["archivo"]['name'];
	
	//asigna la ruta de la carpeta donde quieres guardar el archivo   

	//Si el archivo es diferente de nulo   
	if($archivo!=null)
	{
	   // obtenemos la extension 
	 	$extension = $_FILES["archivo"]['type']; 
	 	$extension = explode("/",$extension);
	 	$nuevonombre=$idemple.".".$extension[1];
		echo('El tipo del archivo es'.$nuevonombre);
	   
	   if ($archivo != "") {
	      // guardamos el archivo a la carpeta files
	      $destino =  "archivos/fotos/".$nuevonombre;
	      if (copy($_FILES['archivo']['tmp_name'],$destino)) {
	      	echo('<script>');
	         echo('alert("Foto Subida Correctamente");');
	         echo('</script>');
	         //conectar a la bd guardar el enlace de la foto
	         include("conectarbbdd.php");
	         $result = mysql_query("UPDATE  `empleados` SET  `linkfoto` =  '$destino' 
	         WHERE  `empleados`.`idemp` = '$idemple';");
	         //refrescar la pagina web
	         echo ('<meta http-equiv="Refresh" content="0; URL=popup_foto.php?idempleado='.$idemple.'">');

	      } else {
	   	echo('<script>');
	      echo('alert("Error al subir archivo");');
	      echo('</script>');
	      }
	   } else {
	   	echo('<script>');
	      echo('alert("Error al subir archivo");');
	      echo('</script>');
	   }
	  	echo ('<meta http-equiv="Refresh" content="0; URL=popup_foto.php?idempleado='.$idemple.'">');	
	}
}
?>

</center>
</body>
</html>


