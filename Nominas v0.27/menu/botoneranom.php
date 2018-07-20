<div id="tablist">

<?php
echo("<table><tr>");
//COMPROBAR PERMISOS DE CREARNOMINA
if ($_SESSION['BTNNEWNOM'] == '1'){
	printf ("<td> <button type='submit' name='crearnomina' onClick='return validar_estadoemp();'>  <img src='./imagenes/nomina.png'> </button></td>");
}
    printf ("<input type='hidden' name='submitted' value='0'></td>"); 

printf ("<td><button type='submit' name='actualizar'>  <img src='./imagenes/actualizar.png'> </button></td>");

//COMPROBAR PERMISOS DE IMPRIMIR LISTADO
if ($_SESSION['BTNIMPNOM'] == '1'){
	printf ("<td><button type='submit' name='printlistnom'>  <img src='./imagenes/verimpresion.png'> </button></td>");
}
    
printf ("</form>");
//COMPROBAR PERMISOS DE EXPORTAR EN EXCEL
if ($_SESSION['BTNXLSNOM'] == '1'){
	echo('<form action="exportar/export_listnemp.php" name="fexportar" method="POST">');
	//FALTA ENVIAR POR POST EL PARAMETRO USANDO UN INPUT HIDDEN QUE ALMACENE EL VALOR DEL IDEMPLEADO
	printf ("<input type='hidden' name='idempleatu' value='%s'>", $idemplega);
	printf ("<td><button type='submit' name='crearnomina'>  <img src='./imagenes/exportarxls.png'> </button></td></tr>");
	echo("</form>");
}


echo("</table>");
    ?>
</div>