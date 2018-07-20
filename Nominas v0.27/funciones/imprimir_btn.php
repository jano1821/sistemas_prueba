<?php
if(isset($_POST["printnom"])) 
{ 
   $idnomina=$_REQUEST['idnom'];
	echo ('<meta http-equiv="Refresh" content="0; URL=bnominap.php?idnom='.$idnomina.'">');
}
?>