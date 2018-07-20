<div id="tablist">

<?php
	echo('<table> <tr>');
	printf ("<td><button type='submit' name='printnom'>  <img src='./imagenes/verimpresion.png'> </button></td>");
	printf ("<td><button type='submit' name='actualizar'>  <img src='./imagenes/actualizar.png'> </button></td>");
	if ($_SESSION['BTNMODNOM'] == '1'){
    	printf ("<td><button type='submit' name='gordenom' onclick='return validar_anio();'>  <img src='./imagenes/gorde.png'> </button></td>"); 
	}
	//FALTA ENVIAR POR POST EL PARAMETRO USANDO UN INPUT HIDDEN QUE ALMACENE EL VALOR DEL IDEMPLEADO
	if ($_SESSION['BTNDELNOM'] == '1'){
  		printf ("<td><button type='submit' name='borrarnom' onClick='confirmDel()'>  <img src='./imagenes/borrar.png'> </button>"); 
	}
	printf ("<input type='hidden' name='submitted' value='0'></td>"); 
	
	echo("</table>");
    ?>
</div>