{include file="header.tpl" title="Destinatario Cheques" section="cheques"}



<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading"><h1>{if $smarty.get.section == 3} Editar {else} Agregar {/if} Destinatario</h1></div>


<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
<tr>
	<th rowspan="3" class="sized"><img src="images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
	<th class="topleft"></th>
	<td id="tbl-border-top">&nbsp;</td>
	<th class="topright"></th>
	<th rowspan="3" class="sized"><img src="images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
</tr>
<tr>
	<td id="tbl-border-left"></td>
	<td>
	<!--  start content-table-inner -->
	<div id="content-table-inner">

	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	    <td>
    	    <center>
    	    {include file="mensajes.tpl" mostrarMsj=$mostrarMsj msjOk=$msjOk arrWarns=$arrWarns arrErrors=$arrErrors}
		    <!-- start id-form -->
		    {if (!empty($smarty.get.id_cheque)) && ($smarty.get.section == 3)}
    		    {assign var="edit" value=true}
		        <form name="agregar_editar_destinatario" action="cheques.php?id_cheque={$smarty.get.id_cheque}&section=3&action=edit_destinatario" method="post" class="login-form">
		    {else}
    		    {assign var="edit" value=false}
		        <form name="agregar_editar_destinatario" action="cheques.php?id_cheque={$smarty.get.id_cheque}&section=2&action=add_destinatario" method="post" class="login-form">
		    {/if}

		    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
		        <tr>
			        <th valign="top">Nombre:</th>
			        {assign var="nom" value=$smarty.post.nombre}
			        {if $edit && (empty($smarty.post.nombre))}
			              {assign var="nom" value=$nombre}
			              {assign var="textAdicional" value="El valor original era.."}
			        {/if}
			        <td><input type="text" {if $mostrarMsj && empty($smarty.post.nombre)} class="inp-form-error" {else} class="inp-form" {/if} name="nombre" value="{$nom}" /></td>
			        <td>
			             {if $mostrarMsj && empty($smarty.post.nombre)}
			             <div class="error-left"></div>
    			         <div class="error-inner">Campo requerido. {$textAdicional}</div>
			             {/if}
			        </td>
		        </tr>

	            <tr>
		            <th>&nbsp;</th>
		            <td valign="top">
			            <input type="submit" value="{if $edit}Editar{else}Agregar{/if}" class="form-submit" />
			            <input type="button" value="Atr&aacute;s" class="form-reset" onClick="window.location.href='cheques.php?section=1'" />
		            </td>
		            <td></td>
	            </tr>
	        </table>
	        <!-- end id-form  -->
            </form>
            </center>
	    </td>
    </tr>
</table>

<div class="clear"></div>


</div>
<!--  end content-table-inner  -->
</td>
<td id="tbl-border-right"></td>
</tr>
<tr>
	<th class="sized bottomleft"></th>
	<td id="tbl-border-bottom">&nbsp;</td>
	<th class="sized bottomright"></th>
</tr>
</table>







{include file="footer.tpl"}

