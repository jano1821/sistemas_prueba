{include file="header.tpl" title="Contrase&ntilde;a" section="contrasena"}



<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading"><h1>Editar Contrase&ntilde;a</h1></div>


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
            <form name="agregar_editar_contrasena" action="contrasena.php?section=2&action=edit" method="post" class="login-form">

		    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                <tr>
			        <th valign="top">Usuario:</th>
			        {assign var="user" value=$smarty.post.usuario}
			        {if (empty($smarty.post.usuario))}
			              {assign var="user" value=$usuario}
			              {assign var="textAdicional" value="El valor original era.."}
			        {/if}
			        <td><input type="text" {if $mostrarMsj && empty($smarty.post.usuario) && empty($smarty.get.msj)} class="inp-form-error" {else} class="inp-form" {/if} name="usuario" value="{$user}" readonly /></td>
			        <td>
			             {if $mostrarMsj && empty($smarty.post.usuario) && empty($smarty.get.msj)}
			             <div class="error-left"></div>
    			         <div class="error-inner">Campo requerido. {$textAdicional}</div>
			             {/if}
			        </td>
		        </tr>

		        <tr>
			        <th valign="top">Contrase&ntilde;a:</th>
			        {assign var="pass" value=$smarty.post.contrasena}
			        {if (empty($smarty.post.contrasena))}
			              {assign var="pass" value=$contrasena}
			              {assign var="textAdicional" value="El valor original era.."}
			        {/if}
			        <td><input type="password" {if $mostrarMsj && empty($smarty.post.contrasena) && empty($smarty.get.msj)} class="inp-form-error" {else} class="inp-form" {/if} name="contrasena" value="{$pass}" /></td>
			        <td>
			             {if $mostrarMsj && empty($smarty.post.contrasena) && empty($smarty.get.msj)}
			             <div class="error-left"></div>
    			         <div class="error-inner">Campo requerido. {$textAdicional}</div>
			             {/if}
			        </td>
		        </tr>
		        
	            <tr>
		            <th>&nbsp;</th>
		            <td valign="top">
			            <input type="submit" value="Editar" class="form-submit" />
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

