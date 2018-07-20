{include file="header.tpl" title="Cheque" section="cheque"}



<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading"><h1>{if $smarty.get.section == 6} Editar {else} Agregar {/if} Cheque</h1></div>


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
		    {if (!empty($smarty.get.id_cheque)) && ($smarty.get.section == 6)}
    		    {assign var="edit" value=true}
		        <form name="agregar_editar_cheque" action="cheques.php?id_cheque={$smarty.get.id_cheque}&section=6&action=edit" method="post" class="login-form">
		    {else}
    		    {assign var="edit" value=false}
		        <form name="agregar_editar_cheque" action="cheques.php?section=5&action=add" method="post" class="login-form">
		    {/if}
            
		    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
		        
		        <tr>
			        <th valign="top">Fecha:</th>
			        {assign var="fec" value=$smarty.post.fecha_cobro}
			        {if $edit && (empty($smarty.post.fecha_cobro))}
			              {assign var="fec" value=$fecha_cobro}
			              {assign var="textAdicional" value="El valor original era.."}
			        {/if}
			        {if empty($fec)}
    			        {assign var="fec" value=$smarty.now|date_format:'%Y-%m-%d'}
			        {/if}
			        
			        <td>
			            <form id="chooseDateForm" action="#">
			            <input type="text" {if $mostrarMsj && empty($smarty.post.fecha_cobro)} class="inp-form-error" {else} class="inp-form" {/if} id="fechas" name="fecha_cobro" value="{$fec}" readonly/>
			        
			            <a href=""  id="date-pick"><img src="images/forms/icon_calendar.jpg"   alt="" /></a></td>
			        <td>
			             {if $mostrarMsj && empty($smarty.post.fecha_cobro)}
			             <div class="error-left"></div>
    			         <div class="error-inner">Campo requerido. {$textAdicional}</div>
			             {/if}
			        </td>
		        </tr>

		        <tr>
			        <th valign="top">Cuenta:</th>
			        {assign var="cuen" value=$smarty.post.cuenta}
			        {if $edit && (empty($smarty.post.cuenta))}
			              {assign var="cuen" value=$cuenta}
			              {assign var="textAdicional" value="El valor original era.."}
			        {/if}
			        <td><input type="text" {if $mostrarMsj && empty($smarty.post.cuenta)} class="inp-form-error" {else} class="inp-form" {/if} name="cuenta" value="{$cuen}" /></td>
			        <td>
			             {if $mostrarMsj && empty($smarty.post.cuenta)}
			             <div class="error-left"></div>
    			         <div class="error-inner">Campo requerido. {$textAdicional}</div>
			             {/if}
			        </td>
		        </tr>
		        
		        <tr>
			        <th valign="top">Nro. Cheque:</th>
			        {assign var="nro" value=$smarty.post.nro_cheque}
			        {if $edit && (empty($smarty.post.nro_cheque))}
			              {assign var="nro" value=$nro_cheque}
			              {assign var="textAdicional" value="El valor original era.."}
			        {/if}
			        <td><input type="text" {if $mostrarMsj && empty($smarty.post.nro_cheque)} class="inp-form-error" {else} class="inp-form" {/if} name="nro_cheque" value="{$nro}" /></td>
			        <td>
			             {if $mostrarMsj && empty($smarty.post.nro_cheque)}
			             <div class="error-left"></div>
    			         <div class="error-inner">Campo requerido. {$textAdicional}</div>
			             {/if}
			        </td>
		        </tr>

                <tr>
			        <th valign="top">Persona:</th>
			        {assign var="per" value=$smarty.post.persona}
			        {if $edit && (empty($smarty.post.persona))}
			              {assign var="per" value=$persona}
			              {assign var="textAdicional" value="El valor original era.."}
			        {/if}
			        <td><input type="text" {if $mostrarMsj && empty($smarty.post.persona)} class="inp-form-error" {else} class="inp-form" {/if} name="persona" value="{$per}" /></td>
			        <td>
			             {if $mostrarMsj && empty($smarty.post.persona)}
			             <div class="error-left"></div>
    			         <div class="error-inner">Campo requerido. {$textAdicional}</div>
			             {/if}
			        </td>
		        </tr>

                <tr>
			        <th valign="top">Valor:</th>
			        {assign var="pes" value=$smarty.post.pesos}
			        {if $edit && (empty($smarty.post.pesos))}
			              {assign var="pes" value=$pesos}
			              {assign var="textAdicional" value="El valor original era.."}
			        {/if}
			        <td><input type="text" {if $mostrarMsj && empty($smarty.post.pesos)} class="inp-form-error" {else} class="inp-form" {/if} name="pesos" value="{$pes}" /></td>
			        <td>
			             {if $mostrarMsj && empty($smarty.post.pesos)}
			             <div class="error-left"></div>
    			         <div class="error-inner">Campo requerido. {$textAdicional}</div>
			             {/if}
			        </td>
		        </tr>

                <tr>
			        <th valign="top">Destino:</th>
			        {assign var="dest" value=$smarty.post.destino}
			        {if $edit && (empty($smarty.post.destino))}
			              {assign var="dest" value=$destino}
			              {assign var="textAdicional" value="El valor original era.."}
			        {/if}
			        <td><input type="text" class="inp-form" name="destino" value="{$dest}" /></td>
			        <td>
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

