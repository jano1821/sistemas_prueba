{include file="header.tpl" title="Persona" section="persona"}



<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading"><h1>{if $smarty.get.section == 3} Editar {else} Agregar {/if} Persona</h1></div>


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
    		    {assign var="edit" value=true}
		        <form name="agregar_editar_persona" action="personas.php?id_persona={$smarty.get.id_persona}&section=3&action=edit" method="post" class="login-form">
		    {else}
    		    {assign var="edit" value=false}
		        <form name="agregar_editar_persona" action="personas.php?section=2&action=add" method="post" class="login-form">
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
			        <th valign="top">Apellido:</th>
			        {assign var="ape" value=$smarty.post.apellido}
			        {if $edit && (empty($smarty.post.apellido))}
			              {assign var="ape" value=$apellido}
			              {assign var="textAdicional" value="El valor original era.."}
			        {/if}
			        <td><input type="text" {if $mostrarMsj && empty($smarty.post.apellido)} class="inp-form-error" {else} class="inp-form" {/if} name="apellido" value="{$ape}" /></td>
			        <td>
			             {if $mostrarMsj && empty($smarty.post.apellido)}
			             <div class="error-left"></div>
    			         <div class="error-inner">Campo requerido. {$textAdicional}</div>
			             {/if}
			        </td>
		        </tr>
		        
		        <tr>
			        <th valign="top">Direcci&oacute;n:</th>
			        {assign var="dir" value=$smarty.post.direccion}
			        {if $edit && (empty($smarty.post.direccion))}
			              {assign var="dir" value=$direccion}
			              {assign var="textAdicional" value="El valor original era.."}
			        {/if}
			        <td><input type="text" {if $mostrarMsj && empty($smarty.post.direccion)} class="inp-form-error" {else} class="inp-form" {/if} name="direccion" value="{$dir}" /></td>
			        <td>
			             {if $mostrarMsj && empty($smarty.post.direccion)}
			             <div class="error-left"></div>
    			         <div class="error-inner">Campo requerido. {$textAdicional}</div>
			             {/if}
			        </td>
		        </tr>
		        
		        <tr>
			        <th valign="top">Tel&eacute;fono:</th>
			        {assign var="tel" value=$smarty.post.telefono}
			        {if $edit && (empty($smarty.post.telefono))}
			              {assign var="tel" value=$telefono}
			              {assign var="textAdicional" value="El valor original era.."}
			        {/if}
			        <td><input type="text" {if $mostrarMsj && empty($smarty.post.telefono)} class="inp-form-error" {else} class="inp-form" {/if} name="telefono" value="{$tel}" /></td>
			        <td>
			             {if $mostrarMsj && empty($smarty.post.telefono)}
			             <div class="error-left"></div>
    			         <div class="error-inner">Campo requerido. {$textAdicional}</div>
			             {/if}
			        </td>
		        </tr>
		        
		        <tr>
			        <th valign="top">Tel&eacute;fono 2:</th>
			        {assign var="cel" value=$smarty.post.celular}
			        {if $edit && (empty($smarty.post.celular))}
			              {assign var="cel" value=$celular}
			              {assign var="textAdicional" value="El valor original era.."}
			        {/if}
			        <td><input type="text" {if $mostrarMsj && empty($smarty.post.celular)} class="inp-form-error" {else} class="inp-form" {/if} name="celular" value="{$cel}" /></td>
			        <td>
			             {*if $mostrarMsj && empty($smarty.post.celular)}
			             <div class="error-left"></div>
    			         <div class="error-inner">Campo requerido. {$textAdicional}</div>
			             {/if*}
			        </td>
		        </tr>
		        
		        <tr>
			        <th valign="top">DNI:</th>
			        {assign var="dni" value=$smarty.post.dni}
			        {if $edit && (empty($smarty.post.dni))}
			              {assign var="dni" value=$documento}
			              {assign var="textAdicional" value="El valor original era.."}
			        {/if}
			        <td><input type="text" {if $mostrarMsj && empty($smarty.post.dni)} class="inp-form-error" {else} class="inp-form" {/if} name="dni" value="{$dni}" /></td>
			        <td>
			             {*if $mostrarMsj && empty($smarty.post.dni)}
			             <div class="error-left"></div>
    			         <div class="error-inner">Campo requerido. {$textAdicional}</div>
			             {/if*}
			        </td>
		        </tr>
		        
		        <tr>
			        <th valign="top">Cuit:</th>
			        {assign var="cuitAux" value=$smarty.post.cuit}
			        {if $edit && (empty($smarty.post.cuit))}
			              {assign var="cuitAux" value=$cuit}
			              {assign var="textAdicional" value="El valor original era.."}
			        {/if}
			        <td><input type="text" {if $mostrarMsj && empty($smarty.post.cuit)} class="inp-form-error" {else} class="inp-form" {/if} name="cuit" value="{$cuitAux}" /></td>
			        <td>
			             {*if $mostrarMsj && empty($smarty.post.cuit)}
			             <div class="error-left"></div>
    			         <div class="error-inner">Campo requerido. {$textAdicional}</div>
			             {/if*}
			        </td>
		        </tr>
		        
		        <tr>
			        <th valign="top">Correo:</th>
			        {assign var="email" value=$smarty.post.email}
			        {if $edit && (empty($smarty.post.email))}
			              {assign var="email" value=$email}
			              {assign var="textAdicional" value="El valor original era.."}
			        {/if}
			        <td><input type="text" {if $mostrarMsj && empty($smarty.post.email)} class="inp-form-error" {else} class="inp-form" {/if} name="email" value="{$email}" /></td>
			        <td>
			             {*if $mostrarMsj && empty($smarty.post.email)}
			             <div class="error-left"></div>
    			         <div class="error-inner">Campo requerido. {$textAdicional}</div>
			             {/if*}
			        </td>
		        </tr>
		        
		        <tr>
			        <th valign="top">Descripci&oacute;n:</th>
			        {assign var="desc" value=$smarty.post.descripcion}
			        {if $edit && (empty($smarty.post.descripcion))}
			              {assign var="desc" value=$descripcion}
			              {assign var="textAdicional" value="El valor original era.."}
			        {/if}
			        <td><textarea rows="" cols="" class="form-textarea" name="descripcion">{$desc}</textarea></td>
			        <td></td>
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

