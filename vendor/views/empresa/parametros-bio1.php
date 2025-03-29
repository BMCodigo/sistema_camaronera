<?php
load($inputFileName);


$sheet = $spreadsheet->getActiveSheet();

$newSpreadsheet = new Spreadsheet();
$newSheet = $newSpreadsheet->getActiveSheet();

$newSheet->setCellValue('A1', 'fecha_alimentacion');
$newSheet->setCellValue('B1', 'id_camaronera');
$newSheet->setCellValue('C1', 'id_piscina');


$rowIndex = 2; 
foreach ($sheet->getRowIterator() as $row) {
    $cellIterator = $row->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(false);

    $colIndex = 'A';
    foreach ($cellIterator as $cell) {
        $newSheet->setCellValue($colIndex . $rowIndex, $cell->getValue());
        $colIndex++;
    }
    $rowIndex++;
}


$newFileName = 'ruta/al/nuevo.xlsx';
$writer = new XlsxWriter($newSpreadsheet);
$writer->save($newFileName);

echo "Nuevo archivo Excel generado correctamente en $newFileName";
?>
