{include file="header.tpl" title="Persona" section="persona"}



<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading"><h1>Backups {$smarty.now|date_format:'%d-%m-%Y'}</h1></div>


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
		    <!-- start id-form -->
		    
		    <form id="backupDB" method="get" action="{$backupDB}">
                <input type="submit" value="Descargar Base de Datos ({$smarty.now|date_format:'%d-%m-%Y'})" class="form-submit-download" />
            </form>
            
            <form id="backupFiles" method="get" action="{$backupFiles}">
                <input type="submit" value="Descargar Archivos ({$smarty.now|date_format:'%d-%m-%Y'})" class="form-submit-download" />
            </form>
		    
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

