{include file="header.tpl" title="Persona" section="persona"}



<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading"><h1>
    {if $smarty.get.section == 3} 
        Editar Movimiento 
    {else} 
        {if $smarty.get.section == 5}
            Agregar Producto 
        {else}
            Descontar Dinero
        {/if}
    {/if} 
</h1></div>


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
		    {if (!empty($smarty.get.id_persona)) && ($smarty.get.section == 3)}
		        {if empty($tipo)}
		            {if empty($smarty.get.tipo)}
                        {assign var="tipo" value=""}
                    {else}
                        {assign var="tipo" value=$smarty.get.tipo}
                    {/if}
		        {else}
		            {assign var="tipo" value=$tipo}
		        {/if}
		        
    		    {assign var="edit" value=true}
		        <form name="agregar_editar_movimiento" action="fichas.php?id_ficha={$smarty.get.id_ficha}&id_persona={$smarty.get.id_persona}&section=3&action=edit&tipo={$tipo}" method="post" class="login-form">
		    {else}
    		    {assign var="edit" value=false}
		        <form name="agregar_editar_movimiento" action="fichas.php?id_persona={$smarty.get.id_persona}&section=2&action=add&tipo={$tipo}" method="post" class="login-form">
		    {/if}
            
            {*<input type="hidden" name="tipo" {if $tipo == 1}value="true"{else}value="false"{/if} />*}
		    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
		        
		        <tr>
			        <th valign="top">Fecha:</th>
			        {assign var="fec" value=$smarty.post.fecha}
			        {if $edit && (empty($smarty.post.fecha))}
			              {assign var="fec" value=$fecha}
			              {assign var="textAdicional" value="El valor original era.."}
			        {/if}
			        {if empty($fec)}
    			        {assign var="fec" value=$smarty.now|date_format:'%Y-%m-%d'}
			        {/if}
			        
			        <td>
			            <form id="chooseDateForm" action="#">
			            <input type="text" {if $mostrarMsj && empty($smarty.post.fecha)} class="inp-form-error" {else} class="inp-form" {/if} id="fechas" name="fecha" value="{$fec}" readonly/>
			        
			            <a href=""  id="date-pick"><img src="images/forms/icon_calendar.jpg"   alt="" /></a></td>
			        <td>
			             {if $mostrarMsj && empty($smarty.post.fecha)}
			             <div class="error-left"></div>
    			         <div class="error-inner">Campo requerido. {$textAdicional}</div>
			             {/if}
			        </td>
		        </tr>
		        
		        <tr>
			        <th valign="top">Descripci&oacute;n:</th>
			        {assign var="desc" value=$smarty.post.descripcion}
			        {if $edit && (empty($smarty.post.descripcion))}
			              {assign var="desc" value=$descripcion}
			              {assign var="textAdicional" value="El valor original era.."}
			        {/if}
			        <td><textarea rows="" cols="" class="form-textarea" name="descripcion">{if $smarty.get.section == 6 && empty($desc)}Entrega{else}{$desc}{/if}</textarea></td>
			        <td></td>
		        </tr>
		        
		        <tr>
			        <th valign="top">Valor:</th>
			        {assign var="val" value=$smarty.post.valor}
			        {if $edit && (empty($smarty.post.valor))}
			              {assign var="val" value=$valor}
			              {assign var="textAdicional" value="El valor original era.."}
			        {/if}
			        <td><input type="text" {if $mostrarMsj && empty($smarty.post.valor)} class="inp-form-error" {else} class="inp-form" {/if} name="valor" value="{$val}" /></td>
			        <td>
			             {if $mostrarMsj && empty($smarty.post.valor)}
			             <div class="error-left"></div>
    			         <div class="error-inner">Campo requerido. {$textAdicional}</div>
			             {/if}
			        </td>
		        </tr>
		        
	            <tr>
		            <th>&nbsp;</th>
		            <td valign="top">
			            <input type="submit" value="{if $edit}Editar{else}Agregar{/if}" class="form-submit" />
			            <input type="button" value="Atr&aacute;s" class="form-reset" onClick="window.location.href='personas.php?section=1'" />
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

