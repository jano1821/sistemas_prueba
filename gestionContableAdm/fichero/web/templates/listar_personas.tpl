{include file="header.tpl" title="Personas" section="persona"}

<!-- start content-outer ........................................................................................................................START -->
<div id="content-outer">
<!-- start content -->
<div id="content">

	<!--  start page-heading -->
	<div id="page-heading">
		<h1>Personas</h1>
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
                            <td style="width:20px;"><input type="button" value="Todos" class="form-reset" onClick="window.location.href='personas.php?section=4'" /></td>
                            <td style="width:20px;"><input type="button" value="Deudores" class="form-reset" onClick="window.location.href='personas.php?section=8'" /></td>

                            <!-- Buscador -->
                            <form id="searchPersonas" action="personas.php?section=1&action=search" method="post">
                            <td style="width:400px;">
                                <input type="submit" value="Buscar" class="form-submit" />
                                Apellido: <input type="text" class="inp-form" name="apellido" value="{$smarty.post.apellido}" />
                                Nombre: <input type="text" class="inp-form" name="nombre" value="{$smarty.post.nombre}" />
                            </td>
                            </form>

                            <!-- Agregar Personas -->
                            <td style="width:30px; align:right;">
                                <a href="personas.php?section=2" title="Agregar Persona" class="agregar_persona info-tooltip"></a>
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
					    {if !empty($smarty.get.section)}
					        {assign var="sect" value=$smarty.get.section}
					    {else}
					        {assign var="sect" value=4}
					    {/if}
					    <th class="table-header-repeat" style="width: 125px;"><a href="personas.php?section={$sect}&order=3" title="Ver Movimientos">&Uacute;ltimo Movimiento</a></th>
					    <th class="table-header-repeat"><a href="personas.php?section={$sect}&order=1" title="Ver Movimientos">Nombre </a></th>
					    <th class="table-header-repeat" style="width: 300px;">Tel&eacute;fono</th>
					    <th class="table-header-repeat"><a href="personas.php?section={$sect}&order=2" title="Ver Movimientos">Deuda</a></th>
					    <th class="table-header-options line-left">Acciones</th>
				    </tr>

                    {assign var="cont" value="0"}
				    {foreach from=$personas item=persona}
                        {assign var="cont" value=$cont+1}
                          <tr {if (($cont % 2) == 0)} class="alternate-row" {/if}>

					        {*<td>
					            {$cont}
					        </td>*}
					        {assign var="fecha" value=" "|explode:$persona.fechaUltimoMovimiento}
					        {assign var="fechaExplode" value="-"|explode:$fecha[0]}
					        {assign var="fechaDia" value=$fechaExplode[2]}
					        {assign var="fechaMes" value=$fechaExplode[1]}
					        {assign var="fechaAnio" value=$fechaExplode[0]}
   					        <td style="width:100px; text-align:center;">{$fechaDia}-{$fechaMes}-{$fechaAnio}</td>
					        <td>
					            <p style="width:90%;"><a href="personas.php?id_persona={$persona.id_persona}&section=7" title="Ver Movimientos">{$persona.apellido}, {$persona.nombre} </a></p>
					                <a title="<u>Direcci&oacute;n:</u> {$persona.direccion} <br>
                      			              <u>DNI:</u> {$persona.dni} <br>
                      			              <u>Cuit:</u> {$persona.cuit} <br>
                      			              <u>Correo:</u> {$persona.email} <br>
                      			              <u>Fecha Ultima Entrada:</u> {$persona.fechaUltimaEntrada} <br>
					                          <u>Descripci&oacute;n:</u> {$persona.descripcion|truncate:1700}
					                          " class="icon-6 info-tooltip"></a>
					        </td>
					        <td style="width:160px; text-align:center;">{$persona.telefono} / {$persona.celular}</td>
					        <td style="width:160px; text-align:center; {if $persona.deuda < 0} color:red; {else} color:green; {/if}">${if empty($persona.deuda)} 0 {else} {$persona.deuda} {/if}</td>
					        <td class="options-width" style=" text-align:center;">
				                <a href="personas.php?id_persona={$persona.id_persona}&section=5" title="Agregar Producto" class="icon-8 info-tooltip"></a>
				                <a href="personas.php?id_persona={$persona.id_persona}&section=6" title="Descontar Dinero" class="icon-9 info-tooltip"></a>
				                <a href="personas.php?id_persona={$persona.id_persona}&section=7" title="Ver Movimientos" class="icon-7 info-tooltip"></a>
								{if $smarty.session.tipo == 1}
								<a href="personas.php?id_persona={$persona.id_persona}&section=3" title="Editar" class="icon-1 info-tooltip"></a>
				                <a title="Eliminar" class="icon-2 info-tooltip" onClick="confirmDelete('{$persona.nombre} {$persona.apellido}','personas.php?id_persona={$persona.id_persona}&section=1&action=delete')"></a>
								{/if}
					        </td>
				        </tr>
				    {/foreach}
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

