<?php

require 'Worker.php';

date_default_timezone_set('Europe/London');

// Create new PHPExcel object
$excel = new \phpOMS\Utils\Excel\Excel();

// Set document properties
$excel->getProperties()->setCreator('Orange Management Solutions')
    ->setLastModifiedBy('Dennis Eichhorn')
    ->setTitle('Event & Course Budget')
    ->setSubject('Budget Evaluation')
    ->setDescription('Document used in order to evaluate the event & course expenses.')
    ->setKeywords('OMS Budget Event Course')
    ->setCategory('Controlling');

// Add some data
$excel->setActiveSheetIndex(0)
    ->mergeCells('A1:K1')
    ->mergeCells('A3:B3')
    ->mergeCells('A4:B4')
    ->mergeCells('A5:B5')
    ->mergeCells('A6:B6')
    ->mergeCells('A7:B7')
    ->mergeCells('A8:B8')
    ->setCellValue('A1', 'Event & Course Budget');

$excel->getActiveSheet()
    ->getStyle('A1:K1')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$excel->getActiveSheet()
    ->getColumnDimension('B')
    ->setWidth(40);

$excel->getActiveSheet()
    ->setCellValue('A3', 'Name')
    ->setCellValue('A4', 'EventCourseInt')
    ->setCellValue('A5', 'EventCourse')
    ->setCellValue('A6', 'Demo')
    ->setCellValue('A7', 'Briefing')
    ->setCellValue('A8', 'Advice')

    ->setCellValue('C3', 'History')
    ->setCellValue('D3', 'Plan')
    ->setCellValue('E3', 'Actual')
    ->setCellValue('F3', 'Forecast')
    ->setCellValue('G3', 'Diff. Forecast/History %')
    ->setCellValue('H3', 'Diff. Forecast/Plan %');

// Rename worksheet
$excel->getActiveSheet()->setTitle('Overview');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$excel->setActiveSheetIndex(0);

$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$objWriter->save('php://output');