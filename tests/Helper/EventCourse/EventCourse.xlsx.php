<?php declare(strict_types=1);

require 'Worker.php';
$lang = $this->getData('lang');

\date_default_timezone_set('Europe/London');

// Create new PHPExcel object
$excel = new \phpOMS\Utils\Excel\Excel();

// Styles
// Table Head
$headStyle = new PHPExcel_Style();
$headStyle->applyFromArray(
    [
        'alignment' => [
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        ],
        'fill'      => [
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
        ],
        'borders'   => [
            'bottom' => [
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'],
            ],
            'right'  => [
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'],
            ],
            'top'    => [
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'],
            ],
            'left'   => [
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'],
            ],
        ],
    ]
);
// Table Sub
// Table Input
$inputStyle = new PHPExcel_Style();
$inputStyle->applyFromArray(
    [
        'fill'    => [
            'type'  => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => ['argb' => 'FFA9FFB9'],
        ],
        'borders' => [
            'bottom' => [
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => ['argb' => 'FFD1D1D1'],
            ],
            'right'  => [
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => ['argb' => 'FFD1D1D1'],
            ],
            'top'    => [
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => ['argb' => 'FFD1D1D1'],
            ],
            'left'   => [
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => ['argb' => 'FFD1D1D1'],
            ],
        ],
    ]
);
// Colored1
$colored1Style = new PHPExcel_Style();
$colored1Style->applyFromArray(
    [
        'fill'    => [
            'type'  => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => ['argb' => 'FFFFFF00'],
        ],
        'borders' => [
            'bottom' => [
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => ['argb' => 'FFD1D1D1'],
            ],
            'right'  => [
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => ['argb' => 'FFD1D1D1'],
            ],
            'top'    => [
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => ['argb' => 'FFD1D1D1'],
            ],
            'left'   => [
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => ['argb' => 'FFD1D1D1'],
            ],
        ],
    ]
);
// Variable but don't change
$fixedStyle = new PHPExcel_Style();
$fixedStyle->applyFromArray(
    [
        'fill'    => [
            'type'  => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => ['argb' => 'FFDADADA'],
        ],
        'borders' => [
            'bottom' => [
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => ['argb' => 'FFD1D1D1'],
            ],
            'right'  => [
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => ['argb' => 'FFD1D1D1'],
            ],
            'top'    => [
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => ['argb' => 'FFD1D1D1'],
            ],
            'left'   => [
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => ['argb' => 'FFD1D1D1'],
            ],
        ],
    ]
);
// Table Total
$totalStyle = new PHPExcel_Style();
$totalStyle->applyFromArray(
    [
        'font'    => [
            'bold' => true,
        ],
        'fill'    => [
            'type'  => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => ['argb' => 'FF97C8FF'],
        ],
        'borders' => [
            'bottom' => [
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'],
            ],
            'right'  => [
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'],
            ],
            'top'    => [
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'],
            ],
            'left'   => [
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'],
            ],
        ],
    ]
);
// Table Cell
// Table Outer
$outerStyle = new PHPExcel_Style();
$outerStyle->applyFromArray(
    [
        'borders' => [
            'outline' => [
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'],
            ],
        ],
    ]
);

// Negativ value
$badBudget = new PHPExcel_Style_Conditional();
$badBudget->setConditionType(PHPExcel_Style_Conditional::CONDITION_CELLIS);
$badBudget->setOperatorType(PHPExcel_Style_Conditional::OPERATOR_LESSTHAN);
$badBudget->addCondition('0');
$badBudget->getStyle()->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
$badBudget->getStyle()->getFont()->setBold(true);

// Set document properties
$excel->getProperties()->setCreator('Orange Management Solutions')
    ->setLastModifiedBy('Dennis Eichhorn')
    ->setTitle('Event & Course Budget')
    ->setSubject('Budget Evaluation')
    ->setDescription('Document used in order to evaluate the event & course expenses.')
    ->setKeywords('OMS Budget Event Course')
    ->setCategory('Controlling');

$budget = [
    'A' => 69000,
    'B' => 9000,
    'D' => 15000,
    'E' => 60000,
    'I' => 0,
    'K' => 141000,
    'M' => 0,
    'P' => 0,
    'R' => 15000,
    'S' => 0,
    'U' => 14000,
    'V' => 77000,
    ''  => 0,
];

$excel->getActiveSheet()
    ->mergeCells('A1:K1')
    ->setCellValue('A1', $lang['Overview'])
    ->getStyle('A1:K1')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$excel->getActiveSheet()
    ->setCellValue('A3', $lang['FiscalYearStart'])
    ->setCellValue('B3', $fiscal_start->format('Y/m/d'))
    ->setCellValue('D3', $lang['FiscalYearEnd'])
    ->setCellValue('E3', $fiscal_end->format('Y/m/d'))
    ->setCellValue('G3', $lang['Cutoff'])
    ->setCellValue('H3', $fiscal_current->format('Y/m/d'));

// Cost Object
$i = 5;
$excel->getActiveSheet()
    ->setCellValue('A' . $i, $lang['Type'])
    ->setCellValue('B' . $i, $lang['Name'])
    ->setCellValue('C' . $i, $lang['History'])
    ->setCellValue('D' . $i, $lang['Actual'])
    ->setCellValue('E' . $i, $lang['Forecast'])
    ->setCellValue('F' . $i, $lang['Budget'])
    ->setCellValue('G' . $i, $lang['DiffBudget%']);

++$i;
$start = $i;
foreach ($types as $key => $stype) {
    $excel->getActiveSheet()
        ->setCellValue('A' . $i, $key)
        ->setCellValue('B' . $i, $stype)
        ->setCellValue('C' . $i, (isset($type[$key][$fiscal_end_prev->format('Y')]['value']) ? $type[$key][$fiscal_end_prev->format('Y')]['value'] : 0.0))
        ->setCellValue('D' . $i, (isset($type[$key][$fiscal_end->format('Y')]['value']) ? $type[$key][$fiscal_end->format('Y')]['value'] : 0.0))
        ->setCellValue('E' . $i, '=D' . $i . '/' . \abs(((int) $fiscal_current->format('m') - ((int) $fiscal_end->format('m') + 1)) % 12 + 1) . '*12')
        ->setCellValue('F' . $i, $budget[$key])
        ->setCellValue('G' . $i, '=(E' . $i . '-F' . $i . ')/F' . $i);

    ++$i;
}

$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':B' . $i);

$excel->getActiveSheet()
    ->setCellValue('A' . $i, $lang['Total'])
    ->setCellValue('C' . $i, '=SUM(C' . $start . ':C' . ($i - 1) . ')')
    ->setCellValue('D' . $i, '=SUM(D' . $start . ':D' . ($i - 1) . ')')
    ->setCellValue('E' . $i, '=SUM(E' . $start . ':E' . ($i - 1) . ')')
    ->setCellValue('F' . $i, '=SUM(F' . $start . ':F' . ($i - 1) . ')')
    ->setCellValue('G' . $i, '=(E' . $i . '-F' . $i . ')/F' . $i);

// Cost Center
$i += 2;
$excel->getActiveSheet()
    ->setCellValue('A' . $i, $lang['CostCenter'])
    ->setCellValue('B' . $i, $lang['Description'])
    ->setCellValue('C' . $i, $lang['History'])
    ->setCellValue('D' . $i, $lang['Actual'])
    ->setCellValue('E' . $i, $lang['Forecast'])
    ->setCellValue('F' . $i, $lang['DiffHistory%']);

++$i;
$start = $i;
foreach ($costcenter as $key => $cc) {
    $excel->getActiveSheet()
        ->setCellValue('A' . $i, $key)
        ->setCellValue('B' . $i, $ccDef[$key])
        ->setCellValue('C' . $i, (isset($costcenter[$key][$fiscal_end_prev->format('Y')]['value']) ? $costcenter[$key][$fiscal_end_prev->format('Y')]['value'] : 0.0))
        ->setCellValue('D' . $i, (isset($costcenter[$key][$fiscal_end->format('Y')]['value']) ? $costcenter[$key][$fiscal_end->format('Y')]['value'] : 0.0))
        ->setCellValue('E' . $i, '=D' . $i . '/' . \abs(((int) $fiscal_current->format('m') - ((int) $fiscal_end->format('m') + 1)) % 12 + 1) . '*12')
        ->setCellValue('F' . $i, '=(E' . $i . '-C' . $i . ')/C' . $i);

    ++$i;
}

$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':B' . $i);

$excel->getActiveSheet()
    ->setCellValue('A' . $i, $lang['Total'])
    ->setCellValue('C' . $i, '=SUM(C' . $start . ':C' . ($i - 1) . ')')
    ->setCellValue('D' . $i, '=SUM(D' . $start . ':D' . ($i - 1) . ')')
    ->setCellValue('E' . $i, '=SUM(E' . $start . ':E' . ($i - 1) . ')')
    ->setCellValue('F' . $i, '=(E' . $i . '-C' . $i . ')/C' . $i);

// Account
$i += 2;
$excel->getActiveSheet()
    ->setCellValue('A' . $i, $lang['Account'])
    ->setCellValue('B' . $i, $lang['Description'])
    ->setCellValue('C' . $i, $lang['History'])
    ->setCellValue('D' . $i, $lang['Actual'])
    ->setCellValue('E' . $i, $lang['Forecast'])
    ->setCellValue('F' . $i, $lang['DiffHistory%']);

++$i;
$start = $i;
foreach ($account as $key => $ac) {
    $excel->getActiveSheet()
        ->setCellValue('A' . $i, $key)
        ->setCellValue('B' . $i, $acDef[$key])
        ->setCellValue('C' . $i, (isset($account[$key][$fiscal_end_prev->format('Y')]['value']) ? $account[$key][$fiscal_end_prev->format('Y')]['value'] : 0.0))
        ->setCellValue('D' . $i, (isset($account[$key][$fiscal_end->format('Y')]['value']) ? $account[$key][$fiscal_end->format('Y')]['value'] : 0.0))
        ->setCellValue('E' . $i, '=D' . $i . '/' . \abs(((int) $fiscal_current->format('m') - ((int) $fiscal_end->format('m') + 1)) % 12 + 1) . '*12')
        ->setCellValue('F' . $i, '=(E' . $i . '-C' . $i . ')/C' . $i);

    ++$i;
}

$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':B' . $i);

$excel->getActiveSheet()
    ->setCellValue('A' . $i, $lang['Total'])
    ->setCellValue('C' . $i, '=SUM(C' . $start . ':C' . ($i - 1) . ')')
    ->setCellValue('D' . $i, '=SUM(D' . $start . ':D' . ($i - 1) . ')')
    ->setCellValue('E' . $i, '=SUM(E' . $start . ':E' . ($i - 1) . ')')
    ->setCellValue('F' . $i, '=(E' . $i . '-C' . $i . ')/C' . $i);

// Formatting
$excel->getActiveSheet()
    ->getStyle('F6:F19')
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

$excel->getActiveSheet()
    ->getStyle('F22:F' . $i)
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);

$excel->getActiveSheet()
    ->getStyle('G6:G19')
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);

$excel->getActiveSheet()
    ->duplicateStyle($fixedStyle, 'B3')
    ->duplicateStyle($fixedStyle, 'E3')
    ->duplicateStyle($fixedStyle, 'H3');

foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $column) {
    $excel->getActiveSheet()
        ->getColumnDimension($column)
        ->setAutoSize(true);
}

// Rename worksheet
$excel->getActiveSheet()->setTitle('Overview');

$excel->createSheet(1);

$excel->setActiveSheetIndex(1)
    ->mergeCells('A1:K1')
    ->setCellValue('A1', $lang['AdviceBudget'])
    ->getStyle('A1:K1')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$excel->getActiveSheet()
    ->setCellValue('A3', $lang['FiscalYearStart'])
    ->setCellValue('B3', $fiscal_start->format('Y/m/d'))
    ->setCellValue('D3', $lang['FiscalYearEnd'])
    ->setCellValue('E3', $fiscal_end->format('Y/m/d'))
    ->setCellValue('G3', $lang['Cutoff'])
    ->setCellValue('H3', $fiscal_current->format('Y/m/d'));

$excel->getActiveSheet()
    ->setCellValue('A5', $lang['Type'])
    ->setCellValue('B5', $lang['ID'])
    ->setCellValue('C5', $lang['Description'])
    ->setCellValue('D5', $lang['Start'])
    ->setCellValue('E5', $lang['End'])
    ->setCellValue('F5', $lang['Actual'])
    ->setCellValue('G5', $lang['Pending'])
    ->setCellValue('H5', $lang['Total']);

$i = $start = 6;
foreach ($costobject as $key => $co) {
    if (\strrpos($key, 'B', -\strlen($key)) !== false && isset($co[$fiscal_end->format('Y')]['value'])) {
        $excel->getActiveSheet()
            ->setCellValue('A' . $i, '=MID(B' . $i . ', 1, 1)')
            ->setCellValue('B' . $i, $key)
            ->setCellValue('C' . $i, (!isset($courseList[$key]) ? '' : $courseList[$key][2]))
            ->setCellValue('D' . $i, isset($courseList[$key][4]) ? $courseList[$key][4] : '')
            ->setCellValue('E' . $i, isset($courseList[$key][5]) ? $courseList[$key][5] : '')
            ->setCellValue('F' . $i, $co[$fiscal_end->format('Y')]['value'])
            ->setCellValue('G' . $i, 0.0)
            ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

        ++$i;
    }
}

foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $column) {
    $excel->getActiveSheet()
        ->getColumnDimension($column)
        ->setAutoSize(true);
}

$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':E' . $i)
    ->setCellValue('A' . $i, $lang['Total'])
    ->setCellValue('F' . $i, '=SUM(F' . $start . ':F' . ($i - 1) . ')')
    ->setCellValue('G' . $i, '=SUM(G' . $start . ':G' . ($i - 1) . ')')
    ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Forecast'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '/(1+MOD(MONTH($H$3)-(MONTH($E$3)+1),12))*12');

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Budget'])
    ->setCellValue('H' . $i, '=' . $budget['B']);

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Remaining'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '-H' . ($i - 3));

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['RemainingForecast'])
    ->setCellValue('H' . $i, '=H' . ($i - 2) . '-H' . ($i - 3));

foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $column) {
    $excel->getActiveSheet()
        ->getColumnDimension($column)
        ->setAutoSize(true);
}

$excel->getActiveSheet()
    ->duplicateStyle($colored1Style, 'H' . $start . ':H' . ($i - 2))
    ->duplicateStyle($inputStyle, 'G' . $start . ':G' . ($i - 2))
    ->duplicateStyle($fixedStyle, 'B3')
    ->duplicateStyle($fixedStyle, 'E3')
    ->duplicateStyle($fixedStyle, 'H3')
    ->duplicateStyle($headStyle, 'A5:H5')
    ->duplicateStyle($totalStyle, 'A' . ($i - 4) . ':H' . $i);

$excel->getActiveSheet()
    ->getStyle('F6:H' . $i)
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

$conditionalStyles = $excel->getActiveSheet()->getStyle('H' . $i)->getConditionalStyles();
\array_push($conditionalStyles, $badBudget);
$excel->getActiveSheet()->getStyle('H' . $i)->setConditionalStyles($conditionalStyles);

$excel->getActiveSheet()->setTitle('Advice');

$excel->createSheet(2);

$excel->setActiveSheetIndex(2)
    ->mergeCells('A1:K1')
    ->setCellValue('A1', $lang['DemoBudget'])
    ->getStyle('A1:K1')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$excel->getActiveSheet()
    ->setCellValue('A3', $lang['FiscalYearStart'])
    ->setCellValue('B3', $fiscal_start->format('Y/m/d'))
    ->setCellValue('D3', $lang['FiscalYearEnd'])
    ->setCellValue('E3', $fiscal_end->format('Y/m/d'))
    ->setCellValue('G3', $lang['Cutoff'])
    ->setCellValue('H3', $fiscal_current->format('Y/m/d'));

$excel->getActiveSheet()
    ->setCellValue('A5', $lang['Type'])
    ->setCellValue('B5', $lang['ID'])
    ->setCellValue('C5', $lang['Description'])
    ->setCellValue('D5', $lang['Start'])
    ->setCellValue('E5', $lang['End'])
    ->setCellValue('F5', $lang['Actual'])
    ->setCellValue('G5', $lang['Pending'])
    ->setCellValue('H5', $lang['Total']);

$i = $start = 6;
foreach ($costobject as $key => $co) {
    if (\strrpos($key, 'D', -\strlen($key)) !== false && isset($co[$fiscal_end->format('Y')]['value'])) {
        $excel->getActiveSheet()
            ->setCellValue('A' . $i, '=MID(B' . $i . ', 1, 1)')
            ->setCellValue('B' . $i, $key)
            ->setCellValue('C' . $i, (!isset($courseList[$key]) ? '' : $courseList[$key][2]))
            ->setCellValue('D' . $i, isset($courseList[$key][4]) ? $courseList[$key][4] : '')
            ->setCellValue('E' . $i, isset($courseList[$key][5]) ? $courseList[$key][5] : '')
            ->setCellValue('F' . $i, $co[$fiscal_end->format('Y')]['value'])
            ->setCellValue('G' . $i, 0.0)
            ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

        ++$i;
    }
}

foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $column) {
    $excel->getActiveSheet()
        ->getColumnDimension($column)
        ->setAutoSize(true);
}

$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':E' . $i)
    ->setCellValue('A' . $i, $lang['Total'])
    ->setCellValue('F' . $i, '=SUM(F' . $start . ':F' . ($i - 1) . ')')
    ->setCellValue('G' . $i, '=SUM(G' . $start . ':G' . ($i - 1) . ')')
    ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Forecast'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '/(1+MOD(MONTH($H$3)-(MONTH($E$3)+1),12))*12');

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Budget'])
    ->setCellValue('H' . $i, '=' . $budget['D']);

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Remaining'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '-H' . ($i - 3));

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['RemainingForecast'])
    ->setCellValue('H' . $i, '=H' . ($i - 2) . '-H' . ($i - 3));

foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $column) {
    $excel->getActiveSheet()
        ->getColumnDimension($column)
        ->setAutoSize(true);
}

$excel->getActiveSheet()
    ->duplicateStyle($colored1Style, 'H' . $start . ':H' . ($i - 2))
    ->duplicateStyle($inputStyle, 'G' . $start . ':G' . ($i - 2))
    ->duplicateStyle($fixedStyle, 'B3')
    ->duplicateStyle($fixedStyle, 'E3')
    ->duplicateStyle($fixedStyle, 'H3')
    ->duplicateStyle($headStyle, 'A5:H5')
    ->duplicateStyle($totalStyle, 'A' . ($i - 4) . ':H' . $i);

$excel->getActiveSheet()
    ->getStyle('F6:H' . $i)
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

$conditionalStyles = $excel->getActiveSheet()->getStyle('H' . $i)->getConditionalStyles();
\array_push($conditionalStyles, $badBudget);
$excel->getActiveSheet()->getStyle('H' . $i)->setConditionalStyles($conditionalStyles);

$excel->getActiveSheet()->setTitle('Demo');

// Sheet
$excel->createSheet(3);

$excel->setActiveSheetIndex(3)
    ->mergeCells('A1:K1')
    ->setCellValue('A1', $lang['BriefingBudget'])
    ->getStyle('A1:K1')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$excel->getActiveSheet()
    ->setCellValue('A3', $lang['FiscalYearStart'])
    ->setCellValue('B3', $fiscal_start->format('Y/m/d'))
    ->setCellValue('D3', $lang['FiscalYearEnd'])
    ->setCellValue('E3', $fiscal_end->format('Y/m/d'))
    ->setCellValue('G3', $lang['Cutoff'])
    ->setCellValue('H3', $fiscal_current->format('Y/m/d'));

$excel->getActiveSheet()
    ->setCellValue('A5', $lang['Type'])
    ->setCellValue('B5', $lang['ID'])
    ->setCellValue('C5', $lang['Description'])
    ->setCellValue('D5', $lang['Start'])
    ->setCellValue('E5', $lang['End'])
    ->setCellValue('F5', $lang['Actual'])
    ->setCellValue('G5', $lang['Pending'])
    ->setCellValue('H5', $lang['Total']);

$i = $start = 6;
foreach ($costobject as $key => $co) {
    if (\strrpos($key, 'E', -\strlen($key)) !== false && isset($co[$fiscal_end->format('Y')]['value'])) {
        $excel->getActiveSheet()
            ->setCellValue('A' . $i, '=MID(B' . $i . ', 1, 1)')
            ->setCellValue('B' . $i, $key)
            ->setCellValue('C' . $i, (!isset($courseList[$key]) ? '' : $courseList[$key][2]))
            ->setCellValue('D' . $i, isset($courseList[$key][4]) ? $courseList[$key][4] : '')
            ->setCellValue('E' . $i, isset($courseList[$key][5]) ? $courseList[$key][5] : '')
            ->setCellValue('F' . $i, $co[$fiscal_end->format('Y')]['value'])
            ->setCellValue('G' . $i, 0.0)
            ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

        ++$i;
    }
}

$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':E' . $i)
    ->setCellValue('A' . $i, $lang['Total'])
    ->setCellValue('F' . $i, '=SUM(F' . $start . ':F' . ($i - 1) . ')')
    ->setCellValue('G' . $i, '=SUM(G' . $start . ':G' . ($i - 1) . ')')
    ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Forecast'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '/(1+MOD(MONTH($H$3)-(MONTH($E$3)+1),12))*12');

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Budget'])
    ->setCellValue('H' . $i, '=' . $budget['E']);

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Remaining'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '-H' . ($i - 3));

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['RemainingForecast'])
    ->setCellValue('H' . $i, '=H' . ($i - 2) . '-H' . ($i - 3));

foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $column) {
    $excel->getActiveSheet()
        ->getColumnDimension($column)
        ->setAutoSize(true);
}

$excel->getActiveSheet()
    ->duplicateStyle($colored1Style, 'H' . $start . ':H' . ($i - 2))
    ->duplicateStyle($inputStyle, 'G' . $start . ':G' . ($i - 2))
    ->duplicateStyle($fixedStyle, 'B3')
    ->duplicateStyle($fixedStyle, 'E3')
    ->duplicateStyle($fixedStyle, 'H3')
    ->duplicateStyle($headStyle, 'A5:H5')
    ->duplicateStyle($totalStyle, 'A' . ($i - 4) . ':H' . $i);

$excel->getActiveSheet()
    ->getStyle('F6:H' . $i)
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

$conditionalStyles = $excel->getActiveSheet()->getStyle('H' . $i)->getConditionalStyles();
\array_push($conditionalStyles, $badBudget);
$excel->getActiveSheet()->getStyle('H' . $i)->setConditionalStyles($conditionalStyles);

$excel->getActiveSheet()->setTitle('Briefing & Training');

// Sheet
$excel->createSheet(4);

$excel->setActiveSheetIndex(4)
    ->mergeCells('A1:K1')
    ->setCellValue('A1', $lang['IMPLABudget'])
    ->getStyle('A1:K1')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$excel->getActiveSheet()
    ->setCellValue('A3', $lang['FiscalYearStart'])
    ->setCellValue('B3', $fiscal_start->format('Y/m/d'))
    ->setCellValue('D3', $lang['FiscalYearEnd'])
    ->setCellValue('E3', $fiscal_end->format('Y/m/d'))
    ->setCellValue('G3', $lang['Cutoff'])
    ->setCellValue('H3', $fiscal_current->format('Y/m/d'));

$excel->getActiveSheet()
    ->setCellValue('A5', $lang['Type'])
    ->setCellValue('B5', $lang['ID'])
    ->setCellValue('C5', $lang['Description'])
    ->setCellValue('D5', $lang['Start'])
    ->setCellValue('E5', $lang['End'])
    ->setCellValue('F5', $lang['Actual'])
    ->setCellValue('G5', $lang['Pending'])
    ->setCellValue('H5', $lang['Total']);

$i = $start = 6;
foreach ($costobject as $key => $co) {
    if (\strrpos($key, 'I', -\strlen($key)) !== false && isset($co[$fiscal_end->format('Y')]['value'])) {
        $excel->getActiveSheet()
            ->setCellValue('A' . $i, '=MID(B' . $i . ', 1, 1)')
            ->setCellValue('B' . $i, $key)
            ->setCellValue('C' . $i, (!isset($courseList[$key]) ? '' : $courseList[$key][2]))
            ->setCellValue('D' . $i, isset($courseList[$key][4]) ? $courseList[$key][4] : '')
            ->setCellValue('E' . $i, isset($courseList[$key][5]) ? $courseList[$key][5] : '')
            ->setCellValue('F' . $i, $co[$fiscal_end->format('Y')]['value'])
            ->setCellValue('G' . $i, 0.0)
            ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

        ++$i;
    }
}

$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':E' . $i)
    ->setCellValue('A' . $i, $lang['Total'])
    ->setCellValue('F' . $i, '=SUM(F' . $start . ':F' . ($i - 1) . ')')
    ->setCellValue('G' . $i, '=SUM(G' . $start . ':G' . ($i - 1) . ')')
    ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Forecast'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '/(1+MOD(MONTH($H$3)-(MONTH($E$3)+1),12))*12');

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Budget'])
    ->setCellValue('H' . $i, '=' . $budget['I']);

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Remaining'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '-H' . ($i - 3));

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['RemainingForecast'])
    ->setCellValue('H' . $i, '=H' . ($i - 2) . '-H' . ($i - 3));

foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $column) {
    $excel->getActiveSheet()
        ->getColumnDimension($column)
        ->setAutoSize(true);
}

$excel->getActiveSheet()
    ->duplicateStyle($colored1Style, 'H' . $start . ':H' . ($i - 2))
    ->duplicateStyle($inputStyle, 'G' . $start . ':G' . ($i - 2))
    ->duplicateStyle($fixedStyle, 'B3')
    ->duplicateStyle($fixedStyle, 'E3')
    ->duplicateStyle($fixedStyle, 'H3')
    ->duplicateStyle($headStyle, 'A5:H5')
    ->duplicateStyle($totalStyle, 'A' . ($i - 4) . ':H' . $i);

$excel->getActiveSheet()
    ->getStyle('F6:H' . $i)
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

$conditionalStyles = $excel->getActiveSheet()->getStyle('H' . $i)->getConditionalStyles();
\array_push($conditionalStyles, $badBudget);
$excel->getActiveSheet()->getStyle('H' . $i)->setConditionalStyles($conditionalStyles);

$excel->getActiveSheet()->setTitle('IMPLA');

// Sheet
$excel->createSheet(5);

$excel->setActiveSheetIndex(5)
    ->mergeCells('A1:K1')
    ->setCellValue('A1', $lang['MarketingSupportBudget'])
    ->getStyle('A1:K1')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$excel->getActiveSheet()
    ->setCellValue('A3', $lang['FiscalYearStart'])
    ->setCellValue('B3', $fiscal_start->format('Y/m/d'))
    ->setCellValue('D3', $lang['FiscalYearEnd'])
    ->setCellValue('E3', $fiscal_end->format('Y/m/d'))
    ->setCellValue('G3', $lang['Cutoff'])
    ->setCellValue('H3', $fiscal_current->format('Y/m/d'));

$excel->getActiveSheet()
    ->setCellValue('A5', $lang['Type'])
    ->setCellValue('B5', $lang['ID'])
    ->setCellValue('C5', $lang['Description'])
    ->setCellValue('D5', $lang['Start'])
    ->setCellValue('E5', $lang['End'])
    ->setCellValue('F5', $lang['Actual'])
    ->setCellValue('G5', $lang['Pending'])
    ->setCellValue('H5', $lang['Total']);

$i = $start = 6;
foreach ($costobject as $key => $co) {
    if (\strrpos($key, 'M', -\strlen($key)) !== false && isset($co[$fiscal_end->format('Y')]['value'])) {
        $excel->getActiveSheet()
            ->setCellValue('A' . $i, '=MID(B' . $i . ', 1, 1)')
            ->setCellValue('B' . $i, $key)
            ->setCellValue('C' . $i, (!isset($courseList[$key]) ? '' : $courseList[$key][2]))
            ->setCellValue('D' . $i, isset($courseList[$key][4]) ? $courseList[$key][4] : '')
            ->setCellValue('E' . $i, isset($courseList[$key][5]) ? $courseList[$key][5] : '')
            ->setCellValue('F' . $i, $co[$fiscal_end->format('Y')]['value'])
            ->setCellValue('G' . $i, 0.0)
            ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

        ++$i;
    }
}

$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':E' . $i)
    ->setCellValue('A' . $i, $lang['Total'])
    ->setCellValue('F' . $i, '=SUM(F' . $start . ':F' . ($i - 1) . ')')
    ->setCellValue('G' . $i, '=SUM(G' . $start . ':G' . ($i - 1) . ')')
    ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Forecast'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '/(1+MOD(MONTH($H$3)-(MONTH($E$3)+1),12))*12');

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Budget'])
    ->setCellValue('H' . $i, '=' . $budget['M']);

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Remaining'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '-H' . ($i - 3));

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['RemainingForecast'])
    ->setCellValue('H' . $i, '=H' . ($i - 2) . '-H' . ($i - 3));

foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $column) {
    $excel->getActiveSheet()
        ->getColumnDimension($column)
        ->setAutoSize(true);
}

$excel->getActiveSheet()
    ->duplicateStyle($colored1Style, 'H' . $start . ':H' . ($i - 2))
    ->duplicateStyle($inputStyle, 'G' . $start . ':G' . ($i - 2))
    ->duplicateStyle($fixedStyle, 'B3')
    ->duplicateStyle($fixedStyle, 'E3')
    ->duplicateStyle($fixedStyle, 'H3')
    ->duplicateStyle($headStyle, 'A5:H5')
    ->duplicateStyle($totalStyle, 'A' . ($i - 4) . ':H' . $i);

$excel->getActiveSheet()
    ->getStyle('F6:H' . $i)
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

$conditionalStyles = $excel->getActiveSheet()->getStyle('H' . $i)->getConditionalStyles();
\array_push($conditionalStyles, $badBudget);
$excel->getActiveSheet()->getStyle('H' . $i)->setConditionalStyles($conditionalStyles);

$excel->getActiveSheet()->setTitle('Marketing Support');

// Sheet
$excel->createSheet(6);

$excel->setActiveSheetIndex(6)
    ->mergeCells('A1:K1')
    ->setCellValue('A1', $lang['PromotionBudget'])
    ->getStyle('A1:K1')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$excel->getActiveSheet()
    ->setCellValue('A3', $lang['FiscalYearStart'])
    ->setCellValue('B3', $fiscal_start->format('Y/m/d'))
    ->setCellValue('D3', $lang['FiscalYearEnd'])
    ->setCellValue('E3', $fiscal_end->format('Y/m/d'))
    ->setCellValue('G3', $lang['Cutoff'])
    ->setCellValue('H3', $fiscal_current->format('Y/m/d'));

$excel->getActiveSheet()
    ->setCellValue('A5', $lang['Type'])
    ->setCellValue('B5', $lang['ID'])
    ->setCellValue('C5', $lang['Description'])
    ->setCellValue('D5', $lang['Start'])
    ->setCellValue('E5', $lang['End'])
    ->setCellValue('F5', $lang['Actual'])
    ->setCellValue('G5', $lang['Pending'])
    ->setCellValue('H5', $lang['Total']);

$i = $start = 6;
foreach ($costobject as $key => $co) {
    if (\strrpos($key, 'P', -\strlen($key)) !== false && isset($co[$fiscal_end->format('Y')]['value'])) {
        $excel->getActiveSheet()
            ->setCellValue('A' . $i, '=MID(B' . $i . ', 1, 1)')
            ->setCellValue('B' . $i, $key)
            ->setCellValue('C' . $i, (!isset($courseList[$key]) ? '' : $courseList[$key][2]))
            ->setCellValue('D' . $i, isset($courseList[$key][4]) ? $courseList[$key][4] : '')
            ->setCellValue('E' . $i, isset($courseList[$key][5]) ? $courseList[$key][5] : '')
            ->setCellValue('F' . $i, $co[$fiscal_end->format('Y')]['value'])
            ->setCellValue('G' . $i, 0.0)
            ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

        ++$i;
    }
}

$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':E' . $i)
    ->setCellValue('A' . $i, $lang['Total'])
    ->setCellValue('F' . $i, '=SUM(F' . $start . ':F' . ($i - 1) . ')')
    ->setCellValue('G' . $i, '=SUM(G' . $start . ':G' . ($i - 1) . ')')
    ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Forecast'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '/(1+MOD(MONTH($H$3)-(MONTH($E$3)+1),12))*12');

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Budget'])
    ->setCellValue('H' . $i, '=' . $budget['P']);

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Remaining'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '-H' . ($i - 3));

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['RemainingForecast'])
    ->setCellValue('H' . $i, '=H' . ($i - 2) . '-H' . ($i - 3));

foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $column) {
    $excel->getActiveSheet()
        ->getColumnDimension($column)
        ->setAutoSize(true);
}

$excel->getActiveSheet()
    ->duplicateStyle($colored1Style, 'H' . $start . ':H' . ($i - 2))
    ->duplicateStyle($inputStyle, 'G' . $start . ':G' . ($i - 2))
    ->duplicateStyle($fixedStyle, 'B3')
    ->duplicateStyle($fixedStyle, 'E3')
    ->duplicateStyle($fixedStyle, 'H3')
    ->duplicateStyle($headStyle, 'A5:H5')
    ->duplicateStyle($totalStyle, 'A' . ($i - 4) . ':H' . $i);

$excel->getActiveSheet()
    ->getStyle('F6:H' . $i)
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

$conditionalStyles = $excel->getActiveSheet()->getStyle('H' . $i)->getConditionalStyles();
\array_push($conditionalStyles, $badBudget);
$excel->getActiveSheet()->getStyle('H' . $i)->setConditionalStyles($conditionalStyles);

$excel->getActiveSheet()->setTitle('Promotion');

// Sheet
$excel->createSheet(7);

$excel->setActiveSheetIndex(7)
    ->mergeCells('A1:K1')
    ->setCellValue('A1', $lang['RoadshowBudget'])
    ->getStyle('A1:K1')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$excel->getActiveSheet()
    ->setCellValue('A3', $lang['FiscalYearStart'])
    ->setCellValue('B3', $fiscal_start->format('Y/m/d'))
    ->setCellValue('D3', $lang['FiscalYearEnd'])
    ->setCellValue('E3', $fiscal_end->format('Y/m/d'))
    ->setCellValue('G3', $lang['Cutoff'])
    ->setCellValue('H3', $fiscal_current->format('Y/m/d'));

$excel->getActiveSheet()
    ->setCellValue('A5', $lang['Type'])
    ->setCellValue('B5', $lang['ID'])
    ->setCellValue('C5', $lang['Description'])
    ->setCellValue('D5', $lang['Start'])
    ->setCellValue('E5', $lang['End'])
    ->setCellValue('F5', $lang['Actual'])
    ->setCellValue('G5', $lang['Pending'])
    ->setCellValue('H5', $lang['Total']);

$i = $start = 6;
foreach ($costobject as $key => $co) {
    if (\strrpos($key, 'S', -\strlen($key)) !== false && isset($co[$fiscal_end->format('Y')]['value'])) {
        $excel->getActiveSheet()
            ->setCellValue('A' . $i, '=MID(B' . $i . ', 1, 1)')
            ->setCellValue('B' . $i, $key)
            ->setCellValue('C' . $i, (!isset($courseList[$key]) ? '' : $courseList[$key][2]))
            ->setCellValue('D' . $i, isset($courseList[$key][4]) ? $courseList[$key][4] : '')
            ->setCellValue('E' . $i, isset($courseList[$key][5]) ? $courseList[$key][5] : '')
            ->setCellValue('F' . $i, $co[$fiscal_end->format('Y')]['value'])
            ->setCellValue('G' . $i, 0.0)
            ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

        ++$i;
    }
}

$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':E' . $i)
    ->setCellValue('A' . $i, $lang['Total'])
    ->setCellValue('F' . $i, '=SUM(F' . $start . ':F' . ($i - 1) . ')')
    ->setCellValue('G' . $i, '=SUM(G' . $start . ':G' . ($i - 1) . ')')
    ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Forecast'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '/(1+MOD(MONTH($H$3)-(MONTH($E$3)+1),12))*12');

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Budget'])
    ->setCellValue('H' . $i, '=' . $budget['S']);

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Remaining'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '-H' . ($i - 3));

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['RemainingForecast'])
    ->setCellValue('H' . $i, '=H' . ($i - 2) . '-H' . ($i - 3));

foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $column) {
    $excel->getActiveSheet()
        ->getColumnDimension($column)
        ->setAutoSize(true);
}

$excel->getActiveSheet()
    ->duplicateStyle($colored1Style, 'H' . $start . ':H' . ($i - 2))
    ->duplicateStyle($inputStyle, 'G' . $start . ':G' . ($i - 2))
    ->duplicateStyle($fixedStyle, 'B3')
    ->duplicateStyle($fixedStyle, 'E3')
    ->duplicateStyle($fixedStyle, 'H3')
    ->duplicateStyle($headStyle, 'A5:H5')
    ->duplicateStyle($totalStyle, 'A' . ($i - 4) . ':H' . $i);

$excel->getActiveSheet()
    ->getStyle('F6:H' . $i)
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

$conditionalStyles = $excel->getActiveSheet()->getStyle('H' . $i)->getConditionalStyles();
\array_push($conditionalStyles, $badBudget);
$excel->getActiveSheet()->getStyle('H' . $i)->setConditionalStyles($conditionalStyles);

$excel->getActiveSheet()->setTitle('Roadshow');

// Sheet
$excel->createSheet(8);

$excel->setActiveSheetIndex(8)
    ->mergeCells('A1:K1')
    ->setCellValue('A1', $lang['AdditionalSupportBudget'])
    ->getStyle('A1:K1')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$excel->getActiveSheet()
    ->setCellValue('A3', $lang['FiscalYearStart'])
    ->setCellValue('B3', $fiscal_start->format('Y/m/d'))
    ->setCellValue('D3', $lang['FiscalYearEnd'])
    ->setCellValue('E3', $fiscal_end->format('Y/m/d'))
    ->setCellValue('G3', $lang['Cutoff'])
    ->setCellValue('H3', $fiscal_current->format('Y/m/d'));

$excel->getActiveSheet()
    ->setCellValue('A5', $lang['Type'])
    ->setCellValue('B5', $lang['ID'])
    ->setCellValue('C5', $lang['Description'])
    ->setCellValue('D5', $lang['Start'])
    ->setCellValue('E5', $lang['End'])
    ->setCellValue('F5', $lang['Actual'])
    ->setCellValue('G5', $lang['Pending'])
    ->setCellValue('H5', $lang['Total']);

$i = $start = 6;
foreach ($costobject as $key => $co) {
    if (\strrpos($key, 'U', -\strlen($key)) !== false && isset($co[$fiscal_end->format('Y')]['value'])) {
        $excel->getActiveSheet()
            ->setCellValue('A' . $i, '=MID(B' . $i . ', 1, 1)')
            ->setCellValue('B' . $i, $key)
            ->setCellValue('C' . $i, (!isset($courseList[$key]) ? '' : $courseList[$key][2]))
            ->setCellValue('D' . $i, isset($courseList[$key][4]) ? $courseList[$key][4] : '')
            ->setCellValue('E' . $i, isset($courseList[$key][5]) ? $courseList[$key][5] : '')
            ->setCellValue('F' . $i, $co[$fiscal_end->format('Y')]['value'])
            ->setCellValue('G' . $i, 0.0)
            ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

        ++$i;
    }
}

$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':E' . $i)
    ->setCellValue('A' . $i, $lang['Total'])
    ->setCellValue('F' . $i, '=SUM(F' . $start . ':F' . ($i - 1) . ')')
    ->setCellValue('G' . $i, '=SUM(G' . $start . ':G' . ($i - 1) . ')')
    ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Forecast'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '/(1+MOD(MONTH($H$3)-(MONTH($E$3)+1),12))*12');

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Budget'])
    ->setCellValue('H' . $i, '=' . $budget['U']);

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Remaining'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '-H' . ($i - 3));

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['RemainingForecast'])
    ->setCellValue('H' . $i, '=H' . ($i - 2) . '-H' . ($i - 3));

foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $column) {
    $excel->getActiveSheet()
        ->getColumnDimension($column)
        ->setAutoSize(true);
}

$excel->getActiveSheet()
    ->duplicateStyle($colored1Style, 'H' . $start . ':H' . ($i - 2))
    ->duplicateStyle($inputStyle, 'G' . $start . ':G' . ($i - 2))
    ->duplicateStyle($fixedStyle, 'B3')
    ->duplicateStyle($fixedStyle, 'E3')
    ->duplicateStyle($fixedStyle, 'H3')
    ->duplicateStyle($headStyle, 'A5:H5')
    ->duplicateStyle($totalStyle, 'A' . ($i - 4) . ':H' . $i);

$excel->getActiveSheet()
    ->getStyle('F6:H' . $i)
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

$conditionalStyles = $excel->getActiveSheet()->getStyle('H' . $i)->getConditionalStyles();
\array_push($conditionalStyles, $badBudget);
$excel->getActiveSheet()->getStyle('H' . $i)->setConditionalStyles($conditionalStyles);

$excel->getActiveSheet()->setTitle('Additional Support');

// Sheet
$excel->createSheet(9);

$excel->setActiveSheetIndex(9)
    ->mergeCells('A1:K1')
    ->setCellValue('A1', $lang['ExportCourseBudget'])
    ->getStyle('A1:K1')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$excel->getActiveSheet()
    ->setCellValue('A3', $lang['FiscalYearStart'])
    ->setCellValue('B3', $fiscal_start->format('Y/m/d'))
    ->setCellValue('D3', $lang['FiscalYearEnd'])
    ->setCellValue('E3', $fiscal_end->format('Y/m/d'))
    ->setCellValue('G3', $lang['Cutoff'])
    ->setCellValue('H3', $fiscal_current->format('Y/m/d'));

$excel->getActiveSheet()
    ->setCellValue('A5', $lang['Type'])
    ->setCellValue('B5', $lang['ID'])
    ->setCellValue('C5', $lang['Description'])
    ->setCellValue('D5', $lang['Start'])
    ->setCellValue('E5', $lang['End'])
    ->setCellValue('F5', $lang['Actual'])
    ->setCellValue('G5', $lang['Pending'])
    ->setCellValue('H5', $lang['Total']);

$i = $start = 6;
foreach ($costobject as $key => $co) {
    if ((\strrpos($key, 'A', -\strlen($key)) !== false || $key === '') && isset($co[$fiscal_end->format('Y')]['value'])) {
        $excel->getActiveSheet()
            ->setCellValue('A' . $i, '=MID(B' . $i . ', 1, 1)')
            ->setCellValue('B' . $i, $key)
            ->setCellValue('C' . $i, (!isset($courseList[$key]) ? '' : $courseList[$key][2]))
            ->setCellValue('D' . $i, isset($courseList[$key][4]) ? $courseList[$key][4] : '')
            ->setCellValue('E' . $i, isset($courseList[$key][5]) ? $courseList[$key][5] : '')
            ->setCellValue('F' . $i, $co[$fiscal_end->format('Y')]['value'])
            ->setCellValue('G' . $i, 0.0)
            ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

        ++$i;
    }
}

$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':E' . $i)
    ->setCellValue('A' . $i, $lang['Total'])
    ->setCellValue('F' . $i, '=SUM(F' . $start . ':F' . ($i - 1) . ')')
    ->setCellValue('G' . $i, '=SUM(G' . $start . ':G' . ($i - 1) . ')')
    ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Forecast'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '/(1+MOD(MONTH($H$3)-(MONTH($E$3)+1),12))*12');

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Budget'])
    ->setCellValue('H' . $i, '=' . $budget['A']);

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Remaining'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '-H' . ($i - 3));

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['RemainingForecast'])
    ->setCellValue('H' . $i, '=H' . ($i - 2) . '-H' . ($i - 3));

foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $column) {
    $excel->getActiveSheet()
        ->getColumnDimension($column)
        ->setAutoSize(true);
}

$excel->getActiveSheet()
    ->duplicateStyle($colored1Style, 'H' . $start . ':H' . ($i - 2))
    ->duplicateStyle($inputStyle, 'G' . $start . ':G' . ($i - 2))
    ->duplicateStyle($fixedStyle, 'B3')
    ->duplicateStyle($fixedStyle, 'E3')
    ->duplicateStyle($fixedStyle, 'H3')
    ->duplicateStyle($headStyle, 'A5:H5')
    ->duplicateStyle($totalStyle, 'A' . ($i - 4) . ':H' . $i);

$excel->getActiveSheet()
    ->getStyle('F6:H' . $i)
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

$conditionalStyles = $excel->getActiveSheet()->getStyle('H' . $i)->getConditionalStyles();
\array_push($conditionalStyles, $badBudget);
$excel->getActiveSheet()->getStyle('H' . $i)->setConditionalStyles($conditionalStyles);

$excel->getActiveSheet()->setTitle('Export Courses');

// Sheet
$excel->createSheet(10);

$excel->setActiveSheetIndex(10)
    ->mergeCells('A1:K1')
    ->setCellValue('A1', $lang['CourseBudget'])
    ->getStyle('A1:K1')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$excel->getActiveSheet()
    ->setCellValue('A3', $lang['FiscalYearStart'])
    ->setCellValue('B3', $fiscal_start->format('Y/m/d'))
    ->setCellValue('D3', $lang['FiscalYearEnd'])
    ->setCellValue('E3', $fiscal_end->format('Y/m/d'))
    ->setCellValue('G3', $lang['Cutoff'])
    ->setCellValue('H3', $fiscal_current->format('Y/m/d'));

$excel->getActiveSheet()
    ->setCellValue('A5', $lang['Type'])
    ->setCellValue('B5', $lang['ID'])
    ->setCellValue('C5', $lang['Description'])
    ->setCellValue('D5', $lang['Start'])
    ->setCellValue('E5', $lang['End'])
    ->setCellValue('F5', $lang['Actual'])
    ->setCellValue('G5', $lang['Pending'])
    ->setCellValue('H5', $lang['Total']);

$i = $start = 6;
foreach ($costobject as $key => $co) {
    if ((\strrpos($key, 'K', -\strlen($key)) !== false || \strrpos($key, 'V', -\strlen($key)) !== false || \strrpos($key, 'R', -\strlen($key)) !== false) && isset($co[$fiscal_end->format('Y')]['value'])) {
        $excel->getActiveSheet()
            ->setCellValue('A' . $i, '=MID(B' . $i . ', 1, 1)')
            ->setCellValue('B' . $i, $key)
            ->setCellValue('C' . $i, (!isset($courseList[$key]) ? '' : $courseList[$key][2]))
            ->setCellValue('D' . $i, isset($courseList[$key][4]) ? $courseList[$key][4] : '')
            ->setCellValue('E' . $i, isset($courseList[$key][5]) ? $courseList[$key][5] : '')
            ->setCellValue('F' . $i, $co[$fiscal_end->format('Y')]['value'])
            ->setCellValue('G' . $i, 0.0)
            ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

        ++$i;
    }
}

$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':E' . $i)
    ->setCellValue('A' . $i, $lang['Total'])
    ->setCellValue('F' . $i, '=SUM(F' . $start . ':F' . ($i - 1) . ')')
    ->setCellValue('G' . $i, '=SUM(G' . $start . ':G' . ($i - 1) . ')')
    ->setCellValue('H' . $i, '=F' . $i . '+G' . $i);

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Forecast'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '/(1+MOD(MONTH($H$3)-(MONTH($E$3)+1),12))*12');

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Budget'])
    ->setCellValue('H' . $i, '=' . ($budget['K'] + $budget['R'] + $budget['V']));

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['Remaining'])
    ->setCellValue('H' . $i, '=H' . ($i - 1) . '-H' . ($i - 3));

++$i;
$excel->getActiveSheet()
    ->mergeCells('A' . $i . ':G' . $i)
    ->setCellValue('A' . $i, $lang['RemainingForecast'])
    ->setCellValue('H' . $i, '=H' . ($i - 2) . '-H' . ($i - 3));

foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $column) {
    $excel->getActiveSheet()
        ->getColumnDimension($column)
        ->setAutoSize(true);
}

$excel->getActiveSheet()
    ->duplicateStyle($colored1Style, 'H' . $start . ':H' . ($i - 2))
    ->duplicateStyle($inputStyle, 'G' . $start . ':G' . ($i - 2))
    ->duplicateStyle($fixedStyle, 'B3')
    ->duplicateStyle($fixedStyle, 'E3')
    ->duplicateStyle($fixedStyle, 'H3')
    ->duplicateStyle($headStyle, 'A5:H5')
    ->duplicateStyle($totalStyle, 'A' . ($i - 4) . ':H' . $i);

$excel->getActiveSheet()
    ->getStyle('F6:H' . $i)
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

$conditionalStyles = $excel->getActiveSheet()->getStyle('H' . $i)->getConditionalStyles();
\array_push($conditionalStyles, $badBudget);
$excel->getActiveSheet()->getStyle('H' . $i)->setConditionalStyles($conditionalStyles);

$excel->getActiveSheet()->setTitle('Events & Courses');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$excel->setActiveSheetIndex(0);

$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$objWriter->save('php://output');
