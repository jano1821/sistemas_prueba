<?php
class PHPExcelProc{
	public function efectuarExportacion(){
		$archivo = "archivos/cts.xlsx";
		set_time_limit(0);
ini_set('memory_limit','2500M');
		//error_reporting(E_ALL);
		//ini_set('display_errors', '1');
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

		$bandera=2;

		foreach ($empleador as $doc) {


				$objPHPExcelReaderSoles = new PHPExcel();
				$objPHPExcelReaderSoles->getProperties()->setCreator("Alejandro Nuñez")
																->setLastModifiedBy("Alejandro Nuñez")
																->setTitle($doc)
																->setSubject("Office 2010 XLSX Documento")
																->setDescription("Documento generado")
																->setKeywords("office 2010 openxml php")
																->setCategory("Reporte");

				$objPHPExcelReaderSoles->setActiveSheetIndex(0);

				$objPHPExcelReaderSoles->setActiveSheetIndex(0)->setCellValue('A1', "C_NUMCTA");
				$objPHPExcelReaderSoles->setActiveSheetIndex(0)->setCellValue('B1', "C_NUMDOC");
				$objPHPExcelReaderSoles->setActiveSheetIndex(0)->setCellValue('C1', "NOMBRES");
				$objPHPExcelReaderSoles->setActiveSheetIndex(0)->setCellValue('D1', "APELLIDOS");
				$objPHPExcelReaderSoles->setActiveSheetIndex(0)->setCellValue('E1', "C_DESCRI");
				$objPHPExcelReaderSoles->setActiveSheetIndex(0)->setCellValue('F1', "ABONAR");
				$objPHPExcelReaderSoles->setActiveSheetIndex(0)->setCellValue('G1', "INTANGIBLE");
				$objPHPExcelReaderSoles->setActiveSheetIndex(0)->setCellValue('H1', "SUELDOS");
				$objPHPExcelReaderSoles->setActiveSheetIndex(0)->setCellValue('I1', "OBSERVACION");
				$objPHPExcelReaderSoles->setActiveSheetIndex(0)->setCellValue('J1', "FECHA_VALOR");

				$objPHPExcelReaderDolares = new PHPExcel();
				$objPHPExcelReaderDolares->getProperties()->setCreator("Alejandro Nuñez")
																->setLastModifiedBy("Alejandro Nuñez")
																->setTitle($doc)
																->setSubject("Office 2010 XLSX Documento")
																->setDescription("Documento generado")
																->setKeywords("office 2010 openxml php")
																->setCategory("Reporte");

				$objPHPExcelReaderDolares->setActiveSheetIndex(0);

				$objPHPExcelReaderDolares->setActiveSheetIndex(0)->setCellValue('A1', "C_NUMCTA");
				$objPHPExcelReaderDolares->setActiveSheetIndex(0)->setCellValue('B1', "C_NUMDOC");
				$objPHPExcelReaderDolares->setActiveSheetIndex(0)->setCellValue('C1', "NOMBRES");
				$objPHPExcelReaderDolares->setActiveSheetIndex(0)->setCellValue('D1', "APELLIDOS");
				$objPHPExcelReaderDolares->setActiveSheetIndex(0)->setCellValue('E1', "C_DESCRI");
				$objPHPExcelReaderDolares->setActiveSheetIndex(0)->setCellValue('F1', "ABONAR");
				$objPHPExcelReaderDolares->setActiveSheetIndex(0)->setCellValue('G1', "INTANGIBLE");
				$objPHPExcelReaderDolares->setActiveSheetIndex(0)->setCellValue('H1', "SUELDOS");
				$objPHPExcelReaderDolares->setActiveSheetIndex(0)->setCellValue('I1', "OBSERVACION");
				$objPHPExcelReaderDolares->setActiveSheetIndex(0)->setCellValue('J1', "FECHA_VALOR");

				$soles=0;
				$dolares=0;

				for ($row = $bandera; $row <= $highestRow; $row++){
					if ($doc==$sheet->getCell("K".$row)->getValue()){
						if ("SOLES"==$sheet->getCell("E".$row)->getValue()){
							$objPHPExcelReaderSoles->setActiveSheetIndex(0)->setCellValueExplicit('A'.($soles+2), $sheet->getCell('A'.$row)->getValue(),PHPExcel_Cell_DataType::TYPE_STRING);
							$objPHPExcelReaderSoles->setActiveSheetIndex(0)->setCellValueExplicit('B'.($soles+2), $sheet->getCell('B'.$row)->getValue(),PHPExcel_Cell_DataType::TYPE_STRING);
							$objPHPExcelReaderSoles->setActiveSheetIndex(0)->setCellValue('C'.($soles+2), $sheet->getCell('C'.$row)->getValue());
							$objPHPExcelReaderSoles->setActiveSheetIndex(0)->setCellValue('D'.($soles+2), $sheet->getCell('D'.$row)->getValue());
							$objPHPExcelReaderSoles->setActiveSheetIndex(0)->setCellValue('E'.($soles+2), $sheet->getCell('E'.$row)->getValue());
							$objPHPExcelReaderSoles->setActiveSheetIndex(0)->setCellValue('F'.($soles+2), $sheet->getCell('F'.$row)->getValue());
							$objPHPExcelReaderSoles->setActiveSheetIndex(0)->setCellValue('G'.($soles+2), $sheet->getCell('G'.$row)->getValue());
							$objPHPExcelReaderSoles->setActiveSheetIndex(0)->setCellValue('H'.($soles+2), $sheet->getCell('H'.$row)->getValue());
							$objPHPExcelReaderSoles->setActiveSheetIndex(0)->setCellValue('I'.($soles+2), $sheet->getCell('I'.$row)->getValue());
							$objPHPExcelReaderSoles->setActiveSheetIndex(0)->setCellValue('J'.($soles+2), $sheet->getCell('J'.$row)->getValue());
							$objPHPExcelReaderSoles->getActiveSheet()->getStyle('J'.($soles+2))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);

							$soles++;
						}else{
							$objPHPExcelReaderDolares->setActiveSheetIndex(0)->setCellValueExplicit('A'.($dolares+2), $sheet->getCell('A'.$row)->getValue(),PHPExcel_Cell_DataType::TYPE_STRING);
							$objPHPExcelReaderDolares->setActiveSheetIndex(0)->setCellValueExplicit('B'.($dolares+2), $sheet->getCell('B'.$row)->getValue(),PHPExcel_Cell_DataType::TYPE_STRING);
							$objPHPExcelReaderDolares->setActiveSheetIndex(0)->setCellValue('C'.($dolares+2), $sheet->getCell('C'.$row)->getValue());
							$objPHPExcelReaderDolares->setActiveSheetIndex(0)->setCellValue('D'.($dolares+2), $sheet->getCell('D'.$row)->getValue());
							$objPHPExcelReaderDolares->setActiveSheetIndex(0)->setCellValue('E'.($dolares+2), $sheet->getCell('E'.$row)->getValue());
							$objPHPExcelReaderDolares->setActiveSheetIndex(0)->setCellValue('F'.($dolares+2), $sheet->getCell('F'.$row)->getValue());
							$objPHPExcelReaderDolares->setActiveSheetIndex(0)->setCellValue('G'.($dolares+2), $sheet->getCell('G'.$row)->getValue());
							$objPHPExcelReaderDolares->setActiveSheetIndex(0)->setCellValue('H'.($dolares+2), $sheet->getCell('H'.$row)->getValue());
							$objPHPExcelReaderDolares->setActiveSheetIndex(0)->setCellValue('I'.($dolares+2), $sheet->getCell('I'.$row)->getValue());
							$objPHPExcelReaderDolares->setActiveSheetIndex(0)->setCellValue('J'.($dolares+2), $sheet->getCell('J'.$row)->getValue());
							$objPHPExcelReaderDolares->getActiveSheet()->getStyle('J'.($dolares+2))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);

							$dolares++;
						}

					}else{
						$bandera = $bandera + $dolares + $soles;
						break;
					}
				}

				if ($soles>0){
					$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcelReaderSoles, "Excel5");
					$objWriter->save("archivos/". $doc ."_soles.xls");
				}

				if ($dolares>0){
					$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcelReaderDolares, "Excel5");
					$objWriter->save("archivos/". $doc ."_dolares.xls");
				}



				/*while($doc==$sheet->getCell("K2")->getValue()){
						$objPHPExcel->getActiveSheet()->removeRow(2);
						$objWriter2 = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
						$objWriter2->save($archivo);
				}

				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="' . $doc . '.xls"');
				header('Cache-Control: max-age=0');


				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcelReader,
																												'Excel5');
				$objWriter->save('php://output');*/

				//exit;
		}
	}
};
?>