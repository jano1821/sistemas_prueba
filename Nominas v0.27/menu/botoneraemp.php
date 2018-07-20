<div id="tablist">
<?php
   //comporbar permiso del boton guardar emp
    if ($_SESSION['BTNMODEMP'] == '1'){
    	printf ("<br> <button type='submit' name='gordeemp' onclick='return validar_dni();'>  <img src='./imagenes/gorde.png'> </button>"); 
    }
    printf ("<td><button type='submit' name='actualizar'>  <img src='./imagenes/actualizar.png'> </button></td>");
    //comporbar permiso del boton eliminar emp
    if ($_SESSION['BTNDELEMP'] == '1'){
   	printf ("<button type='submit' name='ezabatuemp' onClick='confirmDel()'>  <img src='./imagenes/borrar.png'> </button>"); 
    }
    printf ("<input type='hidden' name='submitted' value='0'>"); 
    //printf ("<button type='submit' name='listarnom'>  <img src='./imagenes/nominas.png'> </button>");
    //printf ("<button type='submit' name='crearnom2'>  <img src='./imagenes/nomina.png'> </button>");
        
    //comporbar permiso del boton imprimir emp
    if ($_SESSION['BTNIMPEMP'] == '1'){
    	printf ("<button type='submit' name='printlistnom'>  <img src='./imagenes/verimpresion.png'> </button>");
    }
	echo ('<td><button type="submit" name="fotoemp"  onClick="javascript:abrir_foto();">  <img src="./imagenes/foto.png"> </button></td>');
    ?>
</div>