<div id="tablist">

<?php
	echo('<table> <tr>');
	if ($_SESSION['BTNADDITEMNOM'] == '1'){	
		echo ('<td><button type="submit" name="additem"  onClick="javascript:abrir_popup();">  <img src="./imagenes/listadd.png"> </button></td>');
	}
	if ($_SESSION['BTNDELITEMNOM'] == '1'){	
		printf ("<td><button type='submit' name='delitem'>  <img src='./imagenes/listremove.png'> </button></td>");
	}
	printf ("<td><button type='submit' name='actualizar'>  <img src='./imagenes/actualizar.png'> </button></td>");
	printf ("<td><button type='submit' name='printnom'>  <img src='./imagenes/verimpresion.png'> </button></td>");
	printf ("<td><input type='hidden' name='idnomina' value='%s'>", $idnom);
	echo('</form>');
	//FALTA ENVIAR POR POST EL PARAMETRO USANDO UN INPUT HIDDEN QUE ALMACENE EL VALOR DEL IDEMPLEADO

	echo('<form action="exportar/export_nomina.php" name="fexportar" method="POST">');
	//FALTA ENVIAR POR POST EL PARAMETRO USANDO UN INPUT HIDDEN QUE ALMACENE EL VALOR DEL IDEMPLEADO
	printf ("<input type='hidden' name='idnomina' value='%s'>", $idnom);
	printf ("<td><button type='submit' name='exportarnom'>  <img src='./imagenes/exportarxls.png'> </button></td></tr>");
	echo("</form></table>");
    ?>
</div>