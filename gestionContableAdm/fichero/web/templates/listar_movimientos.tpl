{include file="header.tpl" title="Movimientos" section="persona"}

<!-- start content-outer ........................................................................................................................START -->
<div id="content-outer">
<!-- start content -->
<div id="content">

	<!--  start page-heading -->
	<div id="page-heading">
		<h1>Movimientos de {$nombre} &nbsp;&nbsp;&nbsp;&nbsp; [ Tel:  {$telefono} ]</h1>
	</div>
	<!-- end page-heading -->

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
		<!--  start content-table-inner ...................................................................... START -->
		<div id="content-table-inner">

			<!--  start table-content  -->
			<div id="table-content">

				<!--  start product-table ..................................................................................... -->

                    <table border="0" width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <!-- Agregar Movimiento -->
                            <td style="width:30px; align:right;">
                                <a href="personas.php?id_persona={$id_persona}&section=6" title="Descontar Dinero" class="eliminar_persona info-tooltip"></a>
                                <a href="personas.php?id_persona={$id_persona}&section=5" title="Agregar Producto" class="agregar_persona info-tooltip"></a>
                            </td>
                        </tr>
		            </table>

				<br/>
				<center>
				{include file="mensajes.tpl" mostrarMsj=$mostrarMsj msjOk=$msjOk arrWarns=$arrWarns arrErrors=$arrErrors}
                </center>
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				    <tr>
					    {*<th class="table-header-check"> <!-- <a id="toggle-all" ></a> --> </th>*}
					    <th class="table-header-repeat">Fecha</th>
					    <th class="table-header-repeat">Descripci&oacute;n</th>
					    <th class="table-header-repeat">Debe</th>
					    <th class="table-header-repeat">Haber</th>
					    <th class="table-header-repeat">Total</th>
						{if $smarty.session.tipo == 1}
					    <th class="table-header-options line-left">Acciones</th>
						{/if}
				    </tr>
				    
				    {assign var="sumaPrecios" value="0"}

                    {assign var="cont" value="0"}
				    {foreach from=$fichas item=ficha}
				        {assign var="sumaPrecios" value=$sumaPrecios-$ficha.salida+$ficha.entrada}
                        {assign var="cont" value=$cont+1}
                          <tr {if (($cont % 2) == 0)} class="alternate-row" {/if}>
					        {*<td>
					            {$cont}
					        </td>*}
					        {assign var="fecha" value=" "|explode:$ficha.fecha}
					        {assign var="fechaExplode" value="-"|explode:$fecha[0]}
					        {assign var="fechaDia" value=$fechaExplode[2]}
					        {assign var="fechaMes" value=$fechaExplode[1]}
					        {assign var="fechaAnio" value=$fechaExplode[0]}
   					        <td style="width:100px; text-align:center;">{$fechaDia}-{$fechaMes}-{$fechaAnio}</td>
					        <td>
					            <p style="width:470px;">{$ficha.descripcion|truncate:60}</p>
					            <a title="{$ficha.descripcion|truncate:1700} <br>
                					            <u>Fecha / Hora de Carga:</u> {$ficha.fecha} <br>
					                          " class="icon-6 info-tooltip"></a>
					        </td>
					        <td style="width:100px; text-align:center; color:red;">{if $ficha.salida != 0}${$ficha.salida} {else} - {/if}</td>
					        <td style="width:100px; text-align:center; color:green;">{if $ficha.entrada != 0}${$ficha.entrada} {else} - {/if}</td>
					        <td style="width:100px; text-align:center; {if $sumaPrecios < 0} color:red; {else} color:green; {/if}">${$sumaPrecios}</td>
							{if $smarty.session.tipo == 1}
					        <td style=" text-align:center; width:50px;">
				                <a href="fichas.php?id_ficha={$ficha.id_ficha}&id_persona={$id_persona}&section=3" title="Editar" class="icon-1 info-tooltip"></a>
				                <a title="Eliminar" class="icon-2 info-tooltip" onClick="confirmDelete('{$ficha.descripcion|truncate:50}','fichas.php?id_ficha={$ficha.id_ficha}&id_persona={$id_persona}&section=1&action=delete')"></a>
					        </td>
							{/if}
				        </tr>
				    {/foreach}
				     <tr>
    				     <td  colspan="4" style="text-align:right; font-weight: bold; font-size: 20px;">Total:</td>
					    <td  colspan="2" style="text-align:center; {if $sumaPrecios < 0} color:red; {else} color:green; {/if}; font-weight: bold; font-size: 20px;">${$sumaPrecios}</td>
				    </tr>
				    <tr>
                        <td  colspan="7">
    				        <input type="button" value="Atr&aacute;s" class="form-reset" style="float: right;" onClick="window.location.href='personas.php?section=1'" />
    				    </td>
				    </tr>
				    
				</table>
				<!--  end product-table................................... -->
			</div>
			<!--  end content-table  -->

			<!--  start paging..................................................... -->
			{include file="paginador.tpl"}
			<!--  end paging................ -->

			<div class="clear"></div>

		</div>
		<!--  end content-table-inner ............................................END  -->
		</td>
		<td id="tbl-border-right"></td>
	</tr>
	<tr>
		<th class="sized bottomleft"></th>
		<td id="tbl-border-bottom">&nbsp;</td>
		<th class="sized bottomright"></th>
	</tr>
	</table>
	<div class="clear">&nbsp;</div>

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer........................................................END -->



{include file="footer.tpl"}

