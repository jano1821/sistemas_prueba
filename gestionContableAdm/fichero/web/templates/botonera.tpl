

<!-- Start: page-top-outer -->
<div id="page-top-outer">

<!-- Start: page-top -->
<div id="page-top">

	<!-- start logo -->
	<div id="logo">
	<a href="">
	  <!-- <img src="images/fichero-logo.png" width="173" height="45" alt="" /> -->
	  Fichero de Morosos
	</a>
	</div>
	<!-- end logo -->

	<!--  start top-search -->
	<div id="top-search">
	    <div id="date_time" class="date_time"></div>
	</div>
 	<!--  end top-search -->
 	<div class="clear"></div>

</div>
<!-- End: page-top -->

</div>
<!-- End: page-top-outer -->

<div class="clear">&nbsp;</div>

<!--  start nav-outer-repeat................................................................................................. START -->
<div class="nav-outer-repeat">
<!--  start nav-outer -->
<div class="nav-outer">

		<!-- start nav-right -->
		<div id="nav-right">

			<div class="nav-divider">&nbsp;</div>
			{if (empty($smarty.session.id_usuario))}
			    <a href="login.php">Entrar</a>
			{else}
			    <a href="login.php?action=logout">Salir <!-- ({$smarty.session.nombre}) --></a>
			{/if}
			<div class="clear">&nbsp;</div>

		</div>
		<!-- end nav-right -->


		<!--  start nav -->
		<div class="nav">
		<div class="table">

        <!--  INICIO Bloque Boton  -->

        <ul class="select">
		    <li>
		        <a href="personas.php?section=1"><b>Personas</b><!--[if IE 7]><!--></a><!--<![endif]-->
		    </li>
		</ul>

		<div class="nav-divider">&nbsp;</div>

        <!--  FIN Bloque Boton  -->
        
        <!--  INICIO Bloque Boton  -->

        <ul class="select">
		    <li>
		        <a href="personas.php?section=2"><b>Agregar Persona</b><!--[if IE 7]><!--></a><!--<![endif]-->
		    </li>
		</ul>

		<div class="nav-divider">&nbsp;</div>

        <!--  FIN Bloque Boton  -->

        <!--  INICIO Bloque Boton  -->

        <ul class="select">
		    <li>
		        <a href="cheques.php?section=1"><b>Cheques</b><!--[if IE 7]><!--></a><!--<![endif]-->
		    </li>
		</ul>

		<div class="nav-divider">&nbsp;</div>

        <!--  FIN Bloque Boton  -->

        <!--  INICIO Bloque Boton  -->

        <ul class="select">
		    <li>
		        <a href="cheques.php?section=5"><b>Agregar Cheque</b><!--[if IE 7]><!--></a><!--<![endif]-->
		    </li>
		</ul>

		<div class="nav-divider">&nbsp;</div>

        <!--  FIN Bloque Boton  -->

        <!--  INICIO Bloque Boton  -->

        <ul class="select">
		    <li>
		        <a href="contrasena.php?section=1"><b>Cambiar Contrase&ntilde;a</b><!--[if IE 7]><!--></a><!--<![endif]-->
		    </li>
		</ul>

		<div class="nav-divider">&nbsp;</div>

        <!--  FIN Bloque Boton  -->
{*
		{if $smarty.session.tipo == 1}        
        <!--  INICIO Bloque Boton  -->
        
        <ul class="select">
		    <li>
		        <a href="backup.php"><b>Backups</b><!--[if IE 7]><!--></a><!--<![endif]-->
		    </li>
		</ul>

		<div class="nav-divider">&nbsp;</div>

        <!--  FIN Bloque Boton  -->
		{/if}
*}
        <!--  INICIO Bloque Boton  -->
{*
        <ul {if $section == "ficha"} class="current" {else} class="select" {/if}>
		    <li>
		        <a href="fichas.php?section=1"><b>Fichas</b><!--[if IE 7]><!--></a><!--<![endif]-->
        		<!--[if lte IE 6]><table><tr><td><![endif]-->
        		<div {if $section == "ficha"} class="select_sub show" {else} class="select_sub" {/if}>
			        {if (!empty($smarty.session.tipo) && $smarty.session.tipo == 1)}
			        <ul class="sub">
  			            <li><a href="fichas.php?section=1">Agregar Ficha</a></li>
				        <li><a href="fichas.php?section=2">Ver Fichas</a></li>
			        </ul>
			        {/if}
		        </div>
		        <!--[if lte IE 6]></td></tr></table></a><![endif]-->
		    </li>
		</ul>

		<div class="nav-divider">&nbsp;</div>
*}
        <!--  FIN Bloque Boton  -->


		<div class="clear"></div>
		</div>
		<div class="clear"></div>
		</div>
		<!--  start nav -->

</div>
<div class="clear"></div>
<!--  start nav-outer -->
</div>
<!--  start nav-outer-repeat................................................... END -->

  <div class="clear"></div>

