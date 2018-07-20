<div id="tablist">
<?php
   echo("<table><tr>");
    printf ("<td><button type='submit' name='actualizar'>  <img src='./imagenes/actualizar.png'> </button></td>");
    printf ("<td><button type='submit' id='borraruser' name='borraruser' onClick='confirmDel()'>  <img src='./imagenes/borrar.png'> </button></td>"); 
    printf ("<input type='hidden' name='submitted' value='0'>"); 
    printf ("<td><button type='submit' name='guardar'>  <img src='./imagenes/gorde.png'> </button></td>");
     printf ("<td><button type='submit' name='copyuser' onClick='abrir_popup()'>  <img src='./imagenes/copiar.png'> Copia de Permisos </button></td>");
	echo('</tr></table>');
?>
</div>