<?php
class contador{
	public function efectuarConteo(){
		$archivo = "archivos/cts_prueba.xlsx";
		error_reporting(E_ALL);
		ini_set('display_errors', '1');
		require_once 'Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$inputFileType = PHPExcel_IOFactory::identify($archivo);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($archivo);
		$sheet = $objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();

		$empleador = array();

		for ($row = 2; $row <= $highestRow; $row++){
				$docEmpleador = $sheet->getCell("K".$row)->getValue();
				if (!in_array($docEmpleador, $empleador)) {
					array_push($empleador,$sheet->getCell("K".$row)->getValue());
				}
		}

		return count($docEmpleador);
	}
}
?>