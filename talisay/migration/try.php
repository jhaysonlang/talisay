<?php
include 'PHPExcel/IOFactory.php';
$inputFileType = 'Excel5';
$inputFileName = 'ian.xls';

$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($inputFileName);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'HTML');
$objWriter->save('php://output');
exit;
?>