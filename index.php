<?php
  include 'excel_reader.php';     // include the class

// creates an object instance of the class, and read the excel file data
$excel = new PhpExcelReader;
$excel->read('demo.xls');

//returns a HTML table with excel rows and columns data

function sheetData($sheet) {
  $html = '<table style="border-collapse: collapse;">';     // begin html table

  $x = 1;
  while($x <= $sheet['numRows']) {
    $html .= "<tr>\n";
    $y = 1;
    while($y <= $sheet['numCols']) {
      $cell = isset($sheet['cells'][$x][$y]) ? $sheet['cells'][$x][$y] : '';
      $html .= "<td style='border: 1px solid black; padding: 0 0.5em;'>$cell</td>\n";
      $y++;
    }  
    $html .= "</tr>\n";
    $x++;
  }

  return $html .'</table>';     // ends and returns the html table
}

$sheets = count($excel->sheets);       // gets the number of sheets
$excel_data = '';                         // to store the the html tables with data of each sheet

// traverses the number of sheets and sets html table with each sheet data in $excel_data
for($i=0; $i<$sheets; $i++) {
  $excel_data .= '<h4>Sheet '. ($i + 1) .' (<em>'. $excel->boundsheets[$i]['name'] .'</em>)</h4>'. sheetData($excel->sheets[$i]) .'<br/>';  
}
?>

<?php
    echo $excel_data;    // displays tables with excel file data
?>
