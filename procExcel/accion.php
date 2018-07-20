<?php
if (isset($_POST['boton'])) {
		/*include('contador.php');
		$contador = new contador;
		$cantidad=$contador->efectuarConteo();*/

	    include('PHPExcelProc.php');
		$phpExcelProc = new PHPExcelProc;
		//for ($i=1;$i<=$cantidad;$i++){
			$phpExcelProc -> efectuarExportacion();
		//}

}
?>