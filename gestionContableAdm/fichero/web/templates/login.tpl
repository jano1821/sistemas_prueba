{include file="header.tpl" title="Login" section="login"}


<!-- Start: login-holder -->
<div id="login-holder">

	<!-- start logo -->
	<div id="logo-login">
		<p style="color:white; font-size: 25px; font-weight: bold; margin-top: 20px;">Fichero de Morosos</p>
		{*<img src="images/fichero-logo.png" width="156" height="40" alt="" />*}
	</div>
	<!-- end logo -->

	<div class="clear"></div>

	<!--  start loginbox ................................................................................. -->
	<div id="loginbox">

	<!--  start login-inner -->
	<div id="login-inner">
	    {f_showmessages}
          {if $f_type == "OK"}
            <span class="message_ok">{$f_message}</span>
          {elseif $f_type == "ERROR"}
            <span class="message_error">{$f_message}</span>
          {else}
            <span class="message_warning">{$f_message}</span>
          {/if}
        {/f_showmessages}
	    <form name="login" action="login.php?action=login" method="post" class="login-form">
		<table border="0" cellpadding="0" cellspacing="0" style="margin-top: 15px;">
		<tr>
			<th>Usuario</th>
			<td><input type="text" class="login-inp" name="user"/></td>
		</tr>
		<tr>
			<th>Contrase&ntilde;a</th>
			<td><input type="password" value=""  onfocus="this.value=''" class="login-inp" name="pass" /></td>
		</tr>
		<tr>
			<th></th>
			<td style="padding-top: 40px;">
			    <input type="submit" class="submit-login" value="Acceder"/>
			</td>
		</tr>
		</table>
		</form>
	</div>
 	<!--  end login-inner -->
	<div class="clear"></div>
 </div>
 <!--  end loginbox -->

</div>
<!-- End: login-holder -->




{include file="footer.tpl"}

