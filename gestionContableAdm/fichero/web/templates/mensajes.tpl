<center>
{if $mostrarMsj}
    {if !empty($msjOk)}
        <!--  start message-green -->
        <div id="message-green">
        <table border="0" width="70%" cellpadding="0" cellspacing="0">
        <tr>
	        <td class="green-left">{$msjOk}</a></td>
	        <td class="green-right"><a class="close-green"><img src="images/table/icon_close_green.gif"   alt="" /></a></td>
        </tr>
        </table>
        </div>
        <!--  end message-green -->
    {else}
        {foreach from=$arrWarns item=warns}
            <!--  start message-yellow -->
            <div id="message-yellow">
            <table border="0" width="70%" cellpadding="0" cellspacing="0">
            <tr>
                <td class="yellow-left">{$warns}</td>
                <td class="yellow-right"><a class="close-yellow"><img src="images/table/icon_close_yellow.gif"   alt="" /></a></td>
            </tr>
            </table>
            </div>
            <!--  end message-yellow -->
        {/foreach}

        {foreach from=$arrErrors item=error}
            <!--  start message-red -->
            <div id="message-red">
            <table border="0" width="70%" cellpadding="0" cellspacing="0">
            <tr>
	            <td class="red-left">{$error}</td>
	            <td class="red-right"><a class="close-red"><img src="images/table/icon_close_red.gif"   alt="" /></a></td>
            </tr>
            </table>
            </div>
            <!--  end message-red -->
        {/foreach}
    {/if}
{/if}
</center>

