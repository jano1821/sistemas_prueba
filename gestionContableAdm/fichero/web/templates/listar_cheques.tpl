{include file="header.tpl" title="Cheques" section="cheque"}

<!-- start content-outer ........................................................................................................................START -->
<div id="content-outer">
<!-- start content -->
<div id="content">

	<!--  start page-heading -->
	<div id="page-heading">
		<h1>Cheques</h1>
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
                            <!-- Mostrar todos -->
                            <td style="width:20px;"><input type="button" value="Todos" class="form-reset" onClick="window.location.href='cheques.php?section=4'" /></td>

                            <!-- Buscador -->
                            <form id="searchCheques" action="cheques.php?section=1&action=search" method="post">
                            <td style="width:400px;">
                                <input type="submit" value="Buscar" class="form-submit" />
                                Cuenta: <input type="text" class="inp-form" name="cuenta" value="{$smarty.post.cuenta}" />
                                Cheque: <input type="text" class="inp-form" name="cheque" value="{$smarty.post.cheque}" />
                            </td>
                            </form>

                            <!-- Agregar Cheque -->
                            <td style="width:30px; align:right;">
                                <a href="cheques.php?section=5" title="Agregar Cheque" class="agregar_persona info-tooltip"></a>
                            </td>
                        </tr>
		            </table>

				<br/>
				<center>
				{include file="mensajes.tpl" mostrarMsj=$mostrarMsj msjOk=$msjOk arrWarns=$arrWarns arrErrors=$arrErrors}
                </center>
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				    <tr>
                        {if !empty($smarty.get.section)}
					        {assign var="sect" value=$smarty.get.section}
					    {else}
					        {assign var="sect" value=4}
					    {/if}
					    <th class="table-header-repeat"><a href="cheques.php?section={$sect}&order=1" title="Fecha">Fecha</a></th>
					    <th class="table-header-repeat">Cuenta</th>
					    <th class="table-header-repeat">Nro Cheque</th>
					    <th class="table-header-repeat"><a href="cheques.php?section={$sect}&order=2" title="Persona">Persona</a></th>
					    <th class="table-header-repeat"><a href="cheques.php?section={$sect}&order=3" title="Importe">Importe</a></th>
					    <th class="table-header-repeat">Destinatario</th>
					    <th class="table-header-options line-left">Acciones</th>
				    </tr>

                    {assign var="sumaChequesCobrados" value="0"}
                    {assign var="sumaChequesPorCobrar" value="0"}
                    {assign var="cont" value="0"}
				    {foreach from=$cheques item=cheque}
                        {if $cheque.destino != ''}
                            {assign var="sumaChequesCobrados" value=$sumaChequesCobrados+$cheque.pesos}
                        {else}
                            {assign var="sumaChequesPorCobrar" value=$sumaChequesPorCobrar+$cheque.pesos}
                        {/if}
                        {assign var="cont" value=$cont+1}
                          <tr {if (($cont % 2) == 0)} class="alternate-row" {/if}>

					        {assign var="fecha" value=" "|explode:$cheque.fecha_cobro}
					        {assign var="fechaExplode" value="-"|explode:$fecha[0]}
					        {assign var="fechaDia" value=$fechaExplode[2]}
					        {assign var="fechaMes" value=$fechaExplode[1]}
					        {assign var="fechaAnio" value=$fechaExplode[0]}
   					        <td style="width:70px; text-align:center;">{$fechaDia}-{$fechaMes}-{$fechaAnio}</td>
					        <td style="width:180px; text-align:center;">{$cheque.cuenta}</td>
					        <td style="width:180px; text-align:center;">{$cheque.nro_cheque}</td>
					        <td style="width:140px; text-align:center;">{$cheque.persona}</td>
					        <td style="width:80px; text-align:center; color:green;">${$cheque.pesos}</td>
					        <td style="width:140px; text-align:center;">{if $cheque.destino == ''} - {else} {$cheque.destino} {/if}</td>
					        <td class="options-width" style="text-align:center; width:40px;">
                                {if $cheque.destino == ''}
				                <a href="cheques.php?id_cheque={$cheque.id_cheque}&section=2" title="Agregar Destinatario" class="icon-8 info-tooltip"></a>
                                {/if}
								{if $smarty.session.tipo == 1}
                                    {if $cheque.destino != ''}
                                        <a href="cheques.php?id_cheque={$cheque.id_cheque}&section=3" title="Editar Destinatario" class="icon-1 info-tooltip"></a>
                                    {/if}
								    <a href="cheques.php?id_cheque={$cheque.id_cheque}&section=6" title="Editar Cheque" class="icon-1 info-tooltip"></a>
				                    <a title="Eliminar" class="icon-2 info-tooltip" onClick="confirmDelete('el Cheque Nro: {$cheque.nro_cheque}','cheques.php?id_cheque={$cheque.id_cheque}&section=1&action=delete')"></a>
								{/if}
					        </td>
				        </tr>
				    {/foreach}
                    {if $cont > 0}
                    <tr>
    				     <td  colspan="5" style="text-align:right; font-weight: bold; font-size: 20px;">Total Cobrados:</td>
					    <td  colspan="2" style="text-align:left; color:green; font-weight: bold; font-size: 20px;">${$sumaChequesCobrados}</td>
				    </tr>
                    <tr>
    				     <td  colspan="5" style="text-align:right; font-weight: bold; font-size: 20px;">Total Por Cobrar:</td>
					    <td  colspan="2" style="text-align:left; color:orange; font-weight: bold; font-size: 20px;">${$sumaChequesPorCobrar}</td>
				    </tr>
                    {/if}
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

