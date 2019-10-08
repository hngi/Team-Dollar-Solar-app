<?php

require_once('vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
date_default_timezone_set('Africa/Lagos');
//for reading
use PhpOffice\PhpSpreadsheet\Document\Properties;
use PhpOffice\PhpSpreadsheet\IOFactory;

use Dompdf\Dompdf;
//for pdf
require_once ('vendor/tecnickcom/tcpdf/tcpdf.php');



if(!isset($_POST['mass_calc_button'])){
    Header("Location : mass_calculator.php");
}else if (isset($_POST['mass_calc_button'])){
    //var_dump($_FILES['file_content']['type']);
    //$mimes = ['text/csv','application/vnd.ms-excel', 'text/xls', 'text/xlsx', 'application/vnd.oasis.opendocument.spreadsheet'];
    $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
    $mimes = ["text/csv", 'application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.oasis.opendocument.spreadsheet', "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"];
    
    if(in_array($_FILES["file_content"]["type"],$allowedFileType)){
        //exit(getcwd());
        $targetPath = getcwd().'/uploads/'.$_FILES['file_content']['name'];
        move_uploaded_file($_FILES['file_content']['tmp_name'], $targetPath);
        $inputFileType = 'Xlsx';
        //exit($_FILES['file_content']['name']);
        $inputFileName = getcwd().'/uploads/'.$_FILES['file_content']['name'];
        //load file
        $excel = IOFactory::load($inputFileName);
        //set active sheet to first sheet
        $excel->setActiveSheetIndex(0);
        $index = 2;

        $total = 0;
        $html = "<html><head><title></title></head><body>";
        $html .= "<table border = '2'>";
        $html .= "<th>
                    <td>Name</td>
                    <td>Quantity</td>
                    <td>Watt</td>
                    <td>Subtotal</td>
                    </th>";
        while($excel->getActiveSheet()->getCell('A'.$index)->getValue() != ""){
            //get the cell values
            $name       =       $excel->getActiveSheet()->getCell('A'.$index)->getValue();
            $quantity   =       $excel->getActiveSheet()->getCell('B'.$index)->getValue();
            $watt       =       $excel->getActiveSheet()->getCell('C'.$index)->getValue();
            
            $subtotal = $watt * $quantity;
            $total += $subtotal;
            $html       .=      "<tr><td></td><td>".$name."</td><td>".$quantity."</td><td>".$watt."</td><td>".$subtotal."</td></tr>";
            $index++;
        }

        $html .= "<tr><td></td><td><b>Total</b></td><td></td><td></td><td>".$total."</td></tr>";
        $html .="</table></body></html>";



    //do the pdf processing here
    $dompdf = new Dompdf();
    // Enable the HTML5 parser to tolerate poorly formed HTML
    $dompdf->set_option('isHtml5ParserEnabled', true);

    // Load into DomPDF from the external HTML file
    $content = file_get_contents('sample.html');

    $dompdf->loadHtml($html);

    // Render and download
    $dompdf->render();
    $dompdf->stream('costing.pdf');
    
    header("Location : mass_calculator.php");
}
// reference the Dompdf namespace

}