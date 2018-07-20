<?php
	require_once('login/comprobarweb.php');
?>
<html>
<head>
<title> Seleccionar Empleado: </title>
<link rel=StyleSheet href="estilos.css" TYPE="text/css">

<script> 
function retornavalores(idemp, nomb, ape1, ape2, dnie, nuss){
   window.opener.document.getElementById('idemplea2').value=idemp; 
   window.opener.document.getElementById('apellido1').value=ape1; 
   window.opener.document.getElementById('apellido2').value=ape2;
   window.opener.document.getElementById('nombre').value=nomb;  
   window.opener.document.getElementById('dni').value=dnie; 
   window.opener.document.getElementById('nuss').value=nuss; 
   window.close(); 
} 
</script>  

</head>

<body>
<table class="tablaazul" bgcolor="white" border="3" bordercolor="#6396BB" cellpadding="4" cellspacing="0">
<tr>
<form action="">
<th>IdEmp</th>
<th>Nombre</th>
<th>1er Apellido</th>
<th>2ndo Apellido</th>
<th>DNI</th> 
<th>NUSS</th> 
<th> &nbsp </th>
</tr>
<br>    
    
<?php
include("conectarbbdd.php");

$result = mysql_query("SELECT * FROM  `empleados` LIMIT 0 , 90");


while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    printf("<tr> <td>%s</td>", $row[0]);
     printf("<td> %s &nbsp </td>", $row[1]);
      printf("<td> %s &nbsp </td>", $row[2]);
     printf("<td> %s &nbsp </td>", $row[3]);
    printf("<td> %s &nbsp </td>", $row[5]);
    printf("<td> %s &nbsp </td>", $row[7]);
    printf("<td> <button type='submit' onclick=retornavalores('%s','%s','%s','%s','%s','%s')>
    <img src='./imagenes/seleccionar2.png' > </button> </td> </tr>",$row[0], urlencode($row[1]), urlencode($row[2]),urlencode($row[3]), $row[5], $row[7]);
}

mysql_free_result($result);
?>

</table>
</form> 
</center>
</body>
</html>


