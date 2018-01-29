<?php
require_once ( 'vendor/autoload.php' );

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as XlsxReader;

$reader = new XlsxReader();
// open working file
$spreadsheet = $reader->load('data.xlsx');
// select target sheet
$sheet = $spreadsheet->getSheetByName('students');

// reading data from cells as 2 dimensional array
$cells = $sheet->rangeToArray('B4:H42');

// データのtrimと合計値の計算
$cells = array_map( function( $row ) {
  $sum = trim($row[2]) + trim($row[3]) + trim($row[4]) + trim($row[5]) + trim($row[6]);
  $row[7] = $sum;
  return $row;
}, $cells);

//echo "名前\t\t国語\t数学\t英語\t社会\t理科\t合計点\n";
printf("%-12s\t%-5s\t%-5s\t%-5s\t%-5s\t%-5s\t%-5s\n","名前","国語","数学","英語","社会","理科","合計点");
foreach( $cells as $row ) {
  $count = 0;
  printf("%-12s\t",$row[0] . ' ' . $row[1]);
  printf("%-5d\t",$row[2]);
  printf("%-5d\t",$row[3]);
  printf("%-5d\t",$row[4]);
  printf("%-5d\t",$row[5]);
  printf("%-5d\t",$row[6]);
  printf("%-5d",$row[7]);
  echo "\n";
}

